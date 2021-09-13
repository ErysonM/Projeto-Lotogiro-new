<?php
/**
* Project:    mmn.dev
* File:       view.php
* Author:     Felipe Medeiros
* Createt at: 27/05/2016 - 20:47
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

<style>
    #cont_comprovante { position:relative; }
    #borda_comprovante{  border: solid 1px #ccc; padding-top: 2px; padding-bottom: 2px; border-radius: 5px 3px 5px 3px; }
    #comprovante { position:absolute; top:0;left:0; border:1px solid #ff0000; opacity:0.01; z-index:1;}
    #texto { border:0px; border-radius:4px; padding:5px; width: 60%;}
</style>

<div class="panel">
<div class="panel-heading p-10 border-bottom-indigo">
<h5 class="panel-title"><i class="icon-info3 position-left"></i> <?=$lang['detalhes_fatura']?></h5>
</div>
<div class="table-responsives">
<div class="row">
<div class="col-sm-6">
<table class="table">
<tr>
<td style="width: 120px;"><b><?=$lang['fatura_num']?>:</b></td>
<td><?=$invoice->id;?></td>
</tr>
<tr>
<td style="width: 120px;"><b><?=$lang['categoria']?>:</b></td>
<td><span class="label label-info">
<?php 
if($invoice->type == 'buy')     echo $lang['adesao'];
elseif($invoice->type == 'upgrade') echo $lang['upgrade'];
elseif($invoice->type == 'monthly') echo $lang['mensalidade'];
elseif($invoice->type == 'recharge') echo $lang['recarga'];
elseif($invoice->type == 'taxa_adesao') echo $lang['taxa_adesao'];
?>
</span></td>
</tr>
<tr>
<td><b><?=$lang['status']?>:</b></td>
<td><span class="label label-default <?php
if ($invoice->status == "paid")
echo 'label-success';
elseif ($invoice->status == "open")
echo 'label-primary';
elseif ($invoice->status == "canceled")
echo 'label-danger';
?>"><?=($invoice->status == 'paid' ? $lang['pago'] : ($invoice->status == 'canceled' ? $lang['cancelada'] : $lang['aberta']));?></span></td>
</tr>
<tr>
<td><b><?=$lang['gerado_em']?>:</b></td>
<td><?=date('d/m/Y', strtotime($invoice->date));?></td>
</tr>
<tr>
<td><b><?=$lang['pago_em']?>:</b></td>
<td><?php
if ($invoice->status == 'paid')
echo date('d/m/Y à\s H:i:s', strtotime($invoice->payment_date));
else
echo '-';
?></td>
</tr>
</table>
</div>
<div class="col-sm-6">
<table class="table">
<tr>
<td style="width: 120px;"><b><?=$lang['cliente']?>:</b></td>
<td><?=($user->firstname . ' ' . $user->lastname);?></td>
</tr>
<tr>
<td><b><?=$lang['endereco']?>:</b></td>
<td><?=$user->address_street;?>, <?=$user->address_number;?><?=(!empty($user->address_complement) ? ' - ' . $user->address_complement  : '');?></td>
</tr>
<tr>
<td><b><?=$lang['bairro_cep']?>:</b></td>
<td><?=$user->address_district;?> - <?=$user->address_zip;?></td>
</tr>
<tr>
<td><b<?=$lang['cidade_uf']?>:</b></td>
<td><?=$user->address_city;?> - <?=$user->address_state;?></td>
</tr>
<tr>
<td><b><?=$lang['metodo_pagamento']?>:</b></td>
<td><?php
if ($invoice->status == 'paid'){
if($invoice->payment_method == 'payout')
echo $lang['pagar_faturas'];
elseif($invoice->payment_method == '')
echo '-';
else 
echo ucfirst($invoice->payment_method);
} else {
echo '-';
}
?></td>
</tr>
</table>
</div>
</div>
</div>
</div>
<div class="panel">
<div class="panel-heading p-10 border-bottom-indigo">
<h5 class="panel-title"><i class="icon-list3 position-left"></i> Itens da Fatura</h5>
</div>
<div class="table-responsive">
<table class="table table-striped">
<thead><tr>
<th class="text-center">#</th>
<th><?=$lang['item']?></th>
<th><?=$lang['descricao']?></th>
<th class="text-center"><?=$lang['quantidade']?></th>
<th class="text-right"><?=$lang['valor_unitario']?></th>
<th class="text-right"><?=$lang['sub_total']?></th>
</tr></thead>
<tbody><?php if(count($invoice->invoices_items) != 0): ?>
<?php $sum = 0; $i = 1; foreach ($invoice->invoices_items as $item): ?><tr>
<td class="text-center"><?=$i;?></td>
<td class="text-left"><?=$item->name;?></td>
<td class="text-left"><?=($item->description ? character_limiter($item->description, 50) : '-');?></td>
<td class="text-center"><?=$item->amount;?></td>
<td class="text-right"><?=display_money($item->value);?></td>
<td class="text-right"><?=display_money(($item->value * $item->amount));?></td>
<?php $sum += $item->amount * $item->value;?>
</tr><?php ++$i; endforeach; ?>
<?php else: ?>
<tr><td colspan="6" class="text-center"><?=$lang['nenhum_item_fatura']?>.</td></tr>
<?php endif; ?>
</tbody>
</table>
</div>
</div>
<div class="row">
<div class="col-lg-4 col-lg-offset-8 col-sm-5 col-sm-offset-2 recap">
<div class="panel">
<table class="table table-clear">
<tr>
<td class="left"><strong><?=$lang['sub_total']?></strong></td>
<td class="right"><?=display_money($sum);?></td>
</tr>
<?php
if(substr($invoice->discount, -1) == "%")
$discount = sprintf("%01.2f", round(($sum / 100) * substr($invoice->discount, 0, -1), 2));
else
$discount = $invoice->discount;
$sum -= $discount;
?>
<?php if ($discount != 0): ?>
<tr>
<td class="left"><strong><?=$lang['descontos']?></strong></td>
<td class="right"><?=display_money($discount);?></td>
</tr>
<?php endif; ?>
<tr>
<td class="left"><strong><?=$lang['total']?></strong></td>
<td class="right"><strong><?=display_money($sum);?></strong></td>
</tr>
</table>
</div>
<div class="text-center mb-10">
<?php if ($invoice->status == 'open' && $sum != 0): ?>
<div class="btn-group btn-block dropup">
<button type="button" class="btn btn-block btn-success btn-labeled dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
<b><i class="icon-coins"></i></b> <?=$lang['pagamento']?> <span class="caret"></span>
</button>
<ul class="dropdown-menu dropdown-menu-right" role="menu">
<?php if($this->settings->bitcoin == 'Y'): ?>
<li>
<a data-target="#modal_btc_payment" data-toggle="modal">
<i class="fa fa-btc fa-fw position-left"></i> <b><?=$lang['pagar_bitcoins']?></font>
</a>
</li>
<?php endif; ?>
<?php if($this->settings->boleto == 'Y'): ?>
<li>
<a data-target="#modal_boleto" data-toggle="modal">
<i class="fa fa-dollar fa-fw position-left"></i> <?=$lang['pagar_boleto']?>
</a>
</li>
<?php endif; ?>
<?php if($this->settings->bcash == 'Y'): ?>
<li>
<a data-target="#modal_bcash" data-toggle="modal">
<i class="fa fa-credit-card fa-fw position-left"></i> <?=$lang['pagar_bcash']?>
</a>
</li>
<?php endif; ?>
<?php if($this->settings->paypal == 'Y'): ?>
<li>
<a data-target="#modal_paypal" data-toggle="modal">
<i class="fa fa-paypal fa-fw position-left"></i> <?=$lang['pagar_paypal']?>
</a>
</li>
<?php endif; ?>
<?php if($this->settings->mistermoney == 'Y'): ?>
<li>
<a data-target="#modal_mistermoney" data-toggle="modal">
<i class="fa fa-money fa-fw position-left"></i> <?=$lang['pagar_mistermoney']?>
</a>
</li>
<?php endif; ?>
<?php if($this->settings->transferencia == 'Y'): ?>
<li>
<a data-target="#modal_transferencia" data-toggle="modal">
<i class="fa fa-refresh fa-fw position-left"></i> <?=$lang['pagar_transferencia']?>
</a>
</li>
<?php endif; ?>
</ul>
</div>
<a class="btn btn-primary btn-block btn-labeled mb-10" data-toggle="modal" data-target="#modal_comprovante">
<b><i class="icon-file-upload"></i></b> <?=$lang['anexar_comprovante']?>
</a>
<?php endif; ?>
</div>
</div><!--/col-->
</div><!--/row-->

<?php if ($invoice->status == 'open' && $sum != 0): ?>

<!-- Payment modal -->
<div id="modal_btc_payment" class="modal fade">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header p-10 bg-primary">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h5 class="modal-title"><i class="fa fa-btc fa-fw position-left"></i> <?=$lang['pagamento_bitcoins']?></h5>
</div>
<div class="modal-body">
<div class="text-center">
<?php
define('APP_ID', $this->settings->bitcoin_appid);
define('API_KEY', $this->settings->bitcoin_token);
define('API_SECRET', $this->settings->bitcoin_callbackpass);

function api_request($url, $method = 'GET', $params = array()) {
$nonce      = time();
$message    = $nonce . APP_ID . API_KEY;
$signature  = hash_hmac('sha256', $message, API_SECRET);

$headers = array();
$headers[] = 'Access-Key: ' . API_KEY;
$headers[] = 'Access-Nonce: ' . $nonce;
$headers[] = 'Access-Signature: ' . $signature;

$curl = curl_init();

$curl_options = array(
CURLOPT_RETURNTRANSFER  => 1,
CURLOPT_URL             => $url
);

if ($method == 'POST') {
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
array_merge($curl_options, array(CURLOPT_POST => 1));
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
}

curl_setopt_array($curl, $curl_options);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);

$response       = curl_exec($curl);
$http_status    = curl_getinfo($curl, CURLINFO_HTTP_CODE);

curl_close($curl);

//return array('status_code' => $http_status, 'response_body' => $response);
return json_decode($response);
}

// POST Example
$callback = base_url('callback/bitcoin');
$post_params = array(
'order_id'          => $invoice->id,
'price'             => $invoice->sum,
'currency'          => 'BRL',
'receive_currency'  => 'BTC',
'callback_url'      => ''.$callback.'?token='.substr($this->encrypt->encode($invoice->id), 0, 8).'',
'cancel_url'        =>  base_url('backoffice/login'),
'success_url'       =>  base_url('backoffice/login'),
'description'       => '#'.$invoice->id.''
);

//$response = api_request('https://api.coingate.com/v1/orders', 'POST', $post_params);
$url = 'https://blockchain.info/tobtc?currency=USD&value='.$sum.'';
$dadosSite = file_get_contents($url);
?>

<!--a href="<?=$response->payment_url;?>" target="_blank">
<img src='https://blockchain.info/pt/qr?data=1KwsJ2wbFpYR2ygDUEWgEs9xyrk38YDNt1'>
</a>
</center>
<span class="label label-default label-block mb-5"><?=$lang['aviso1_pag']?>.</span>
<span class="label label-danger label-block mb-5"><?=$lang['aviso2_pag']?>.</span>
<br>
<span class="label label-success label-block mb-5"><?=$lang['aviso3_pag']?>.</span>
<div class="alert alert-info alert-styled-left p-5 no-margin text-left">
<span class="text-semibold"><?=$lang['valor_bitcoin']?>:</span> &nbsp;BTC <?=$response->btc_amount;?><br>
<span class="text-semibold"><?=$lang['valor_pedido']?>:</span> &nbsp;<?=display_money($sum);?>
</div-->

<center><img class="img-responsive mb-5" src="https://blockchain.info/pt/qr?data=166ZBiApMBaUgnw8z52YoFGRXt9o3FpfK9"></center>
<span class="label label-default label-block mb-5">
166ZBiApMBaUgnw8z52YoFGRXt9o3FpfK9
</span>

<div class="alert alert-info alert-styled-left p-5 no-margin text-left">
<span class="text-semibold">Valor em bitcoin:</span> &nbsp;BTC <?=$dadosSite;?><br>
<span class="text-semibold">Valor do pedido:</span> &nbsp;<?=display_money($sum);?><br>
</div>
<span class="text-semibold">O valor deve ser exato, após anexe um comprovante da transfêrencia.</span>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger btn-xs btn-labeled" data-dismiss="modal">
<b><i class="icon-x"></i></b> <?=$lang['fechar']?>
</button>
</div>
</div>
</div>
</div>


<div id="modal_boleto" class="modal fade">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header p-10 bg-primary">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h5 class="modal-title"><i class="fa fa-dollar fa-fw position-left"></i> <?=$lang['pagamento_boleto']?></h5>
</div>
<div class="modal-body">
<div class="text-center">
<span class="label label-default label-block mb-5"><?=$lang['boleto_des']?>.</span>

<div class="alert alert-info alert-styled-left p-5 no-margin text-left">
<span class="text-semibold"><?=$lang['valor_pedido']?>:</span> &nbsp;<?=display_money($sum);?>
</div>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger btn-xs btn-labeled" data-dismiss="modal">
<b><i class="icon-x"></i></b> <?=$lang['fechar']?>
</button>
</div>
</div>
</div>
</div>


<div id="modal_bcash" class="modal fade">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header p-10 bg-primary">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h5 class="modal-title"><i class="fa fa-credit-card fa-fw position-left"></i> <?=$lang['pagamento_bcash']?></h5>
</div>
<div class="modal-body">
<div class="text-center">
<form name="bcash" action="https://www.bcash.com.br/checkout/pay/" target="_blank" method="post">
<!-- Identificação do vendedor -->;
<input name="email_loja" type="hidden" value="<?=$this->settings->bcash_email;?>">
<input name="url_aviso" type="hidden" value="<?=base_url('callback/bcash');?>">
<!-- Dados do Pedido / Produtos -->
<input name="produto_codigo_1" type="hidden" value="<?=$invoice->id;?>">
<input name="produto_descricao_1" type="hidden" value="Pedido <?$invoice->id;?>">
<input name="produto_qtde_1" type="hidden" value="1">
<input name="produto_valor_1" type="hidden" value="<?=$invoice->sum * $this->settings->dolar;?>">
<!-- Dados do Comprador -->
<input name="email" type="hidden" value="<?=$this->user->email;?>">
<input name="nome" type="hidden" value="<?=$this->user->firstname;?> <?=$this->user->lastname;?>">
<input name="cpf" type="hidden" value="<?=$this->user->cpf;?>">
<input name="telefone" type="hidden" value="<?=$this->user->phone;?>">
<!-- Dados de Entrega -->
<input name="cep" type="hidden" value="<?=$this->user->address_zip;?>">
<input name="endereco" type="hidden" value="<?=$this->user->address_street;?>">
<input name="cidade" type="hidden" value="<?=$this->user->address_city;?>">
<input name="estado" type="hidden" value="<?=$this->user->address_state;?>">
<input type="image" src="https://www.bcash.com.br/webroot/img/bt_comprar.gif" value="<?=$lang['comprar']?>" alt="<?=$lang['comprar']?>" border="0" align="absbottom">
</form>
<span class="label label-default label-block mb-5"><?=$lang['aviso_24h']?>.</span>
<div class="alert alert-info alert-styled-left p-5 no-margin text-left">
<span class="text-semibold"><?=$lang['valor_pedido']?>:</span> &nbsp;<?=display_money($sum);?>
</div>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger btn-xs btn-labeled" data-dismiss="modal">
<b><i class="icon-x"></i></b> <?=$lang['fechar']?>
</button>
</div>
</div>
</div>
</div>


<div id="modal_paypal" class="modal fade">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header p-10 bg-primary">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h5 class="modal-title"><i class="fa fa-paypal fa-fw position-left"></i> <?=$lang['pagamento_paypal']?></h5>
</div>
<div class="modal-body">
<div class="text-center">
<form action="https://www.paypal.com/cgi-bin/webscr" target="_blank" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="<?=$this->settings->paypal_email;?>">
<input type="hidden" name="notify_url" value="<?=base_url('callback/paypal');?>" />
<input type="hidden" name="lc" value="BRL">
<input type="hidden" name="item_name" value="Pedido <?=$invoice->id;?>">
<input type="hidden" name="item_number" value="<?=$invoice->id;?>">
<input type="hidden" name="amount" value="<?=$invoice->sum?>">
<input type="hidden" name="currency_code" value="BRL">
<input type="hidden" name="button_subtype" value="services">
<input type="hidden" name="no_note" value="0">
<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest">
<input type="image" src="https://www.paypalobjects.com/pt_BR/BR/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - A maneira fácil e segura de enviar pagamentos online!">
<img alt="" border="0" src="https://www.paypalobjects.com/pt_BR/i/scr/pixel.gif" width="1" height="1">
</form>
<span class="label label-default label-block mb-5"><?=$lang['aviso_24h']?>.</span>
<div class="alert alert-info alert-styled-left p-5 no-margin text-left">
<span class="text-semibold"><?=$lang['valor_pedido']?>:</span> &nbsp;<?=display_money($sum);?>
</div>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger btn-xs btn-labeled" data-dismiss="modal">
<b><i class="icon-x"></i></b> <?=$lang['fechar']?>
</button>
</div>
</div>
</div>
</div>


<div id="modal_mistermoney" class="modal fade">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header p-10 bg-primary">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h5 class="modal-title"><i class="fa fa-money fa-fw position-left"></i> <?=$lang['pagamento_mistermoney']?></h5>
</div>
<div class="modal-body">
<div class="text-center">
<?php
echo $this->settings->mistermoney_instrucoes;
?>
<br><br>
<span class="label label-default label-block mb-5"><?=$lang['aviso_transf']?>.</span>
<br>
<div class="alert alert-info alert-styled-left p-5 no-margin text-left">
<span class="text-semibold"><?=$lang['valor_pedido']?>:</span> &nbsp;<?=display_money($sum);?>
</div>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger btn-xs btn-labeled" data-dismiss="modal">
<b><i class="icon-x"></i></b> <?=$lang['fechar']?>
</button>
</div>
</div>
</div>
</div>
<div id="modal_transferencia" class="modal fade">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header p-10 bg-primary">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h5 class="modal-title"><i class="fa fa-refresh fa-fw position-left"></i> <?=$lang['pagamento_transferencia']?></h5>
</div>
<div class="modal-body">
<div class="text-center">
<?php
echo $this->settings->transferencia_instrucoes;
?>
<br><br>
<span class="label label-default label-block mb-5"><?=$lang['aviso_transf']?>.</span>
<br>
<div class="alert alert-info alert-styled-left p-5 no-margin text-left">
<span class="text-semibold"><?=$lang['valor_pedido']?>:</span> &nbsp;<?=display_money($sum);?>
</div>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger btn-xs btn-labeled" data-dismiss="modal">
<b><i class="icon-x"></i></b> <?=$lang['fechar']?>
</button>
</div>
</div>
</div>
</div>
<div id="modal_comprovante" class="modal fade">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header p-10 bg-primary">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h5 class="modal-title"><i class="icon-file-upload position-left"></i> <?=$lang['comprovantes']?></h5>
</div>
<div class="modal-body">
<div class="text-center">
<?php if (Comprovant::count(array('conditions' => array('invoice_id = ?', $invoice->id))) > 0): ?>
<span class="label label-success label-block mb-5"><?=$lang['tem_anexo']?>.</span>
<?php else: ?>
<span class="label label-danger label-block mb-5"><?=$lang['nenhum_arquivo']?></span>
<?php endif; ?>
<br>

<?php echo form_open_multipart('backoffice/invoices/upload/'.$invoice->id);?>
<div id="cont_comprovante">
    <input type="file" name="comprovante" id="comprovante" size="10000" class="form-control"/>
    <div id="borda_comprovante">
        <button> <?=$lang['escolher_arquivo']?> </button>
        <input type="text" id="texto" value="<?=$lang['nenhum_arquivo_selecionado']?>" />
    </div>
</div>

<br>
<input type="submit" value="Upload" class="form-control" />
<span class="label label-default label-block mb-5"<?=$lang['maximo_1mb']?>.</span>
</form>
<br>
<div class="table-responsive">
<table class="table table-xs table-striped">
<?php if (Comprovant::count(array('conditions' => array('invoice_id = ?', $invoice->id))) > 0): ?>
<tr><td>#</td><td><?=$lang['arquivo']?></td></tr>
<?php endif; ?>
<?php 
$i = 1;
foreach ($comprovants as $comprovant):
?>
<tr>
<td><?php echo $i;?></td> <td><?php echo $comprovant->filename_original;?></td>
</tr>
<?php 
$i++;
endforeach; 
?>
</table>
</div>
<br>
<div class="alert alert-info alert-styled-left p-5 no-margin text-left">
<span class="text-semibold"><?=$lang['valor_pedido']?>:</span> &nbsp;<?=display_money($sum);?>
</div>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger btn-xs btn-labeled" data-dismiss="modal">
<b><i class="icon-x"></i></b> <?=$lang['fechar']?>
</button>
</div>
</div>
</div>
</div>
<!-- /Payment modal -->
<?php endif; ?>

<script>
    $('#comprovante').on('change',function(){
                
        var numArquivos = $(this).get(0).files.length;
        if ( numArquivos == 1 ) {
            var nome_arquivo = $('#comprovante')[0].files[0].name;
            $('#texto').val( nome_arquivo );
        }
    });
</script>