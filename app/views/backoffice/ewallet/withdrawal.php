<?php
/**
* Author:      Felipe Medeiros
* File:        withdrawal.php
* Created in:  26/06/2016 - 09:52
*/

if(isset($_GET['lang']) && $_GET['lang'] != null){
    $novoidioma = $_GET['lang'];
    $path = "langs/backoffice/".$novoidioma.".php";
    if(file_exists($path)){
        setcookie("idioma", $novoidioma, time()+(24*3600*30));
        $arq = $_SERVER['PHP_SELF'];
        $arq2 = explode("/", $arq);
        $arq3 = end($arq2);
        header("Location: $arq3");
    }else{
        echo "<script>alert('Este idioma não está disponível.');</script>";	
    }
}

if(isset($_COOKIE['idioma'])){
    $idioma = $_COOKIE['idioma'];
    $caminho = "langs/backoffice/".$idioma.".php";
if(file_exists($caminho)){
    include($caminho);
}else{
    exit();	
}
}else{
    $idioma = "pt-br";
    setcookie("idioma","pt-br", time()+(24*3600*30));
    include("langs/backoffice/pt-br.php");
}
?>
<!-- BEGIN PANEL STATS -->
<div class="panel panel-default">
<div class="panel-heading border-bottom-primary">
<h5 class="panel-title"><i class="icon-coins position-left"></i> <?=$lang['solicitacoes_saque']?></h5>
<div class="heading-elements">
<button type="button" class="btn bg-primary-800 btn-labeled" data-toggle="modal" data-target="#modal_withdrawal">
<b><i class="icon-plus3"></i></b> <?=$lang['solicitar_saque']?>
</button>
</div>
</div>
<div class="table-responsive no-border">
<table class="table table-xs table-striped data">
<thead><tr>
<th class="text-center"><?=$lang['data']?></th>
<th class="text-center"><?=$lang['data_pgto']?></th>
<th><?=$lang['forma']?></th>
<th><?=$lang['banco']?></th>
<th><?=$lang['carteira']?></th>
<th><?=$lang['value']?></th>
<th class="text-center"><?=$lang['status']?></th>
<th class="text-center"><?=$lang['acoes']?></th>
</tr></thead>
<tbody><?php foreach ($withdrawals as $row): ?>
<?php $bank = Bank::find_by_code($row->bank_code); ?>
<tr>
<td class="text-center"><?=date('d/m/y', strtotime($row->date));?></td>
<td class="text-center"><?php
if($row->status != 'open') echo date('d/m/y', strtotime($row->payment_date));
else echo '-';
?></td>
<td><?=ucfirst($row->gateway);?></td>
<td><?=$bank->code;?> - <?=$bank->name;?></td>
<td><?php
if($row->gateway == 'bitcoin') echo $row->bitcoin_address;
else echo '-';
?></td>
<td><?=display_money($row->value);?></td>
<td class="text-center">
<span class="label label-<?php
if($row->status == 'open') 		 echo 'primary';
elseif($row->status == 'paid') 		 echo 'success';
elseif($row->status == 'chargeback') echo 'danger';
elseif($row->status == 'cancel')	 echo 'danger';
?>"><?php
if($row->status == 'open') 		 echo strtoupper($lang['pendente']);
elseif($row->status == 'paid') 		 echo strtoupper($lang['pago']);
elseif($row->status == 'chargeback') echo strtoupper($lang['estornado']);
elseif($row->status == 'cancel')	 echo strtoupper($lang['cancelado']);
?></span>
</td>
<td class="text-center">
<ul class="icons-list">
<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
<i class="icon-menu9"></i>
</a>
<ul class="dropdown-menu dropdown-menu-right">
<li><a href="<?=site_url('backoffice/ewallet/view/' . $row->id);?>"><i class="icon-eye"></i> <?=$lang['ver']?></a></li>
</ul>
</li>
</ul>
</td>
</tr>
<?php endforeach; ?></tbody>
</table>
</div>
</div>
<script type="text/javascript">
$(document).ready(function () {
$('.data').dataTable();
})
</script>
<div id="modal_withdrawal" class="modal fade">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header bg-primary pr-15 pl-15 pt-10 pb-10">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h6 class="modal-title"><?=$lang['solicitar_saque']?></h6>
</div>
<form action="<?=site_url('backoffice/ewallet/withdrawal');?>" method="post">
<div class="modal-body">
<!--<font color='red'><b>Você só pode sacar valores ganhos por partidas ou por rede, nunca de recarga.</b></font>
<br>
<br>-->
<div class="form-group">
<label for="type"><?=$lang['forma_de_recebimento']?>:</label>
<?php $options = array(
'transferencia'		=> $lang['transferencia_bancaria'],
'bitcoin'			=> $lang['carteira_bitcoin'],
);
echo form_dropdown('type', $options, '', 'class="form-control"'); ?>
<p><b><?=$lang['preencha_dados_bancarios_endereco']?></b></p>
</div>
<div class="form-group">
<label for="amount"><?=$lang['valor_saque']?>:</label>
<input type="text" name="amount" id="amount" class="form-control money-mask" placeholder="Ex: <?=display_money(rand(100, 2000), '');?>" required />
<p><b><?=$lang['saldo_disponivel']?>:</b> <b><?php
$calculo = $creditswithdrawal - $debitswithdrawal;
if($calculo <= 0) $calculo = 0;
echo display_money($calculo);
?></b></p>
</div>
<div class="clearfix"></div>
<div class="form-group">
<p><?=$lang['saque_ciente']?>:</p>
<ul class="clist clist-angle">
<li><?=$lang['saque_minimo']?> <b><?=display_money($this->settings->min_withdrawal);?></b>.</li>

<?php if($this->settings->withdrawal_percent == 0): ?>
<li><?=$lang['sem_taxa_sol']?>.</li>
<?php else: ?>
<li><?=$lang['cobrado_taxa']?> <?=$this->settings->withdrawal_percent?>% <?=$lang['sobre_solicitacao']?>.</li>
<?php endif; ?>
<li><?=$lang['pagamento_enviado_ate']?> <b>1</b> <?=$lang['dias_uteis']?>.</li>
</ul>
</div>
</div>
<div class="modal-footer" style="margin-top: -50px;">
<input type="submit" class="btn btn-xs btn-primary" value="<?=$lang['solicitar']?>" />
</div>
</form>
</div>
</div>
</div>