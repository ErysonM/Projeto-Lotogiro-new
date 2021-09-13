<?php
/**
* Author:      Felipe Medeiros
* File:        Daily.php
* Created in:  25/06/2016 - 00:59
*/
class Daily extends CI_Controller {
public function index() {
}

public function verify(){
$settingup = Setting::first();
$dtultbonus = substr($settingup->last_daybonus, 0, 10);

if($dtultbonus == date("Y-m-d")) { 
$jaexecutou = true;
echo 'Já executou o cron de bonus hoje!<br><br>';
}

//0 (para domingo) até 6 (para sábado)
if((date('w') == 6) OR (date('w') == 0)) {
$jaexecutou = true;
echo 'Final de semana não paga bonus!<br><br>';
}

$users = User::all([
'conditions' => [
'teto != ?',
'0'
]]);

foreach ($users as $user) {
if(!$jaexecutou){
$contagem = Invoice::find_by_sql("SELECT sum(`sum`)  as `value` FROM `invoices` WHERE `user_id`='".$user->id."' AND `status`='paid' AND `type`='buy' AND `days` < '75'")[0]->value;

$invoices = Invoice::all(['conditions' => ['user_id = ? and status = ? and type = ? and days < ?', $user->id, 'paid', 'buy', 75], 'order' => 'id asc']);

if ($invoices) {
foreach ($invoices as $invoice) {
$invoice->days += 1;
$invoice->save();
}
}

$valorganho = (($contagem * 3) / 100);
$valorganho = number_format($valorganho, 2, '.', '');

/* Insere extrato */
$insert = array();
$insert['user_id']		= $user->id;
$insert['date']			= date('Y-m-d H:i:s');
$insert['value']		= $valorganho;
$insert['description']	= 'Bonus de lucratividade diaria.';

if($user->teto > $user->ganhos AND $user->status == 'active') 
$insert['type']			= 'credit';
else
$insert['type']			= 'lost';

$insert['bonus_cod']	= 3;
$insert['subtype']		= 'bonus';
Extract::create($insert);

if($user->teto > $user->ganhos AND $user->status == 'active'){
/* Atualizar usuário */
$user->balance += $valorganho; //CREDITA VALOR BONUS
$user->ganhos += $valorganho;
echo "".$user->firstname." ".$user->lastname." - Recebeu ".$valorganho." (3%) da lucratividade diaria.<br>";
}

/* BÔNUS DE LUCRATIVIDADE DIÁRIA EM REDE */
if($user->enroller != 0){
$patrocinador = User::find_by_id($user->enroller);

$valorganhopatrocinador = (($contagem * 0.2) / 100);
$valorganhopatrocinador = number_format($valorganhopatrocinador, 2, '.', '');

/* Insere extrato */
$insert = array();
$insert['user_id']		= $patrocinador->id;
$insert['date']			= date('Y-m-d H:i:s');
$insert['value']		= $valorganhopatrocinador;
$insert['description']	= 'Bonus de lucratividade diaria em rede.';

if($patrocinador->teto > $patrocinador->ganhos AND $patrocinador->status == 'active') 
$insert['type']			= 'credit';
else
$insert['type']			= 'lost';

$insert['bonus_cod']	= 4;
$insert['subtype']		= 'bonus';
Extract::create($insert);

if($patrocinador->teto > $patrocinador->ganhos AND $patrocinador->status == 'active'){
/* Atualizar usuário */
$patrocinador->balance += $valorganhopatrocinador; //CREDITA VALOR BONUS
$patrocinador->ganhos += $valorganhopatrocinador;
echo "".$patrocinador->firstname." ".$patrocinador->lastname." - Recebeu ".$valorganhopatrocinador." (0.2%) da lucratividade diaria de seu direto.<br>";
$patrocinador->save();
}
}
}

/* Verifica se tem ponto de ambos lados do binario */
if($user->pleft > 0 AND $user->pright > 0){

if($user->pleft > $user->pright) $point_remove = $user->pright;
elseif($user->pright > $user->pleft) $point_remove = $user->pleft;
else $point_remove = $user->pleft;

$vlrganhobinario = (($point_remove * 15) / 100); //15% DE BINARIO

/* Remove os pontos do binário */
$user->pleft -= $point_remove;
$user->pright -= $point_remove;

/* Insere extrato */
$insert = array();
$insert['user_id']		= $user->id;
$insert['date']			= date('Y-m-d H:i:s');
$insert['value']		= $vlrganhobinario;
$insert['description']	= 'Bonus binário.';

$contagemdiretosbin = User::count(array('conditions' => array('status = ? and enroller = ?', 'active', $user->id)));

if($user->teto > $user->ganhos AND $user->status == 'active' AND $contagemdiretosbin >= 2) 
$insert['type']			= 'credit';
else
$insert['type']			= 'lost';

$insert['bonus_cod']	= 5;
$insert['subtype']		= 'bonus';
Extract::create($insert);

if($user->teto > $user->ganhos AND $user->status == 'active' AND $contagemdiretosbin >= 2){
/* Atualizar usuário */
$user->balance += $vlrganhobinario; //CREDITA VALOR BONUS
$user->ganhos += $vlrganhobinario;
echo "".$user->firstname." ".$user->lastname." - Recebeu ".$vlrganhobinario." (15%) em bonus binário.<br>";
}
}

if($user->ganhos >= $user->teto){
$user->status = 'inactive';
echo "".$user->firstname." ".$user->lastname." - Ficou sem teto e inativou.<br>";

$invoices = Invoice::all(['conditions' => ['user_id = ? and status = ? and type = ? and days < ?', $user->id, 'paid', 'buy', 75], 'order' => 'id asc']);
if ($invoices) {
foreach ($invoices as $invoice) {
$invoice->days = 75;
$invoice->save();
}
}
}
$user->save();
}

if(!$jaexecutou){
$settingup->last_daybonus = date("Y-m-d H:i:s");
$settingup->save();
}

$dtback = "".date("Y-m-d", strtotime("-1 month"))." 00:00:00";
/* Mudança de status do pedido - aberto p/ cancelado (buy, upgrade, monthly, recharge) */		
$invoices = Invoice::all(['conditions' => ['status = ? and type != ? and date < ?', 'open', 'monthly', $dtback], 'order' => 'id asc']);
if ($invoices) {
foreach ($invoices as $invoice) {
$invoice->status = 'canceled';
$invoice->save();
echo '<br>Pedido '.$invoice->id.' cancelado por tempo. <br>';
}
}
}
}