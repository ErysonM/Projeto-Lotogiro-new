<?php
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
<div class="row">


<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

<div class="dashboard-stat bg-primary-800">
<div class="visual">
<i class="icon-wallet"></i>
</div>
<div class="details">
<?php list($currency, $value) = explode(' ', display_money($this->user->balance)); ?>
<div class="number"><?=display_money($this->user->balance);?></div>
<div class="desc"><?=$lang['saldo_disponivel']?></div>
</div>
<a class="more" href="<?=site_url('backoffice/ewallet/extract');?>">
<?=$lang['ver_balanco']?> <i class="fa fa-arrow-right"></i>
</a>
</div>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
<div class="dashboard-stat bg-primary-800">
<div class="visual">
<i class="icon-safe"></i>
</div>
<div class="details">
<div class="number"><?=display_money($this->user->balance_reserved);?></div>
<div class="desc"><?=$lang['saldo_reservado']?></div>
</div>
<a class="more" href="<?=site_url('backoffice/ewallet/extract');?>">
<?=$lang['ver_balanco']?> <i class="fa fa-arrow-right"></i>
</a>
</div>
</div>

<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
<div class="dashboard-stat bg-primary-800">
<div class="visual">
<i class="icon-users"></i>
</div>
<div class="details">
<div class="number counter"><?=$sponsored;?></div>
<div class="desc"><?=$lang['meus_indicados']?></div>
</div>
<a class="more" href="<?=site_url('backoffice/tree/my_indicated');?>">
<?=$lang['ver_indicados']?> <i class="fa fa-arrow-right"></i>
</a>
</div>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
<div class="dashboard-stat bg-primary-800">
<div class="visual">
<i class="icon-tree6"></i>
</div>
<div class="details">
<div class="number counter"><?=count_linear($this->user->id);?></div>
<div class="desc">
<?=$lang['minha_rede']?>
</div>
</div>
<a class="more" href="<?=site_url('backoffice/tree/linear');?>">
<?=$lang['ver_rede']?> <i class="fa fa-arrow-right"></i>
</a>
</div>
</div>
</div>
<!-- END PANEL STATS -->
<!-- TradingView Widget BEGIN -->
<!-- TradingView Widget BEGIN -->

<!-- TradingView Widget END -->
<!-- TradingView Widget END -->
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-8" >
<div class="panel panel-default">

<div class="panel-body p-10">

<!-- TradingView Widget BEGIN -->
<div class="tradingview-widget-container">
  <div id="tradingview_48fed"></div>
  <div class="tradingview-widget-copyright"><a href="https://uk.tradingview.com/symbols/FOREXCOM-XAUUSD/" rel="noopener" target="_blank"><span class="blue-text">XAUUSD Chart</span></a> by Real Forex Club</div>
  <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
  <script type="text/javascript">
  new TradingView.widget(
  {
  "height":"415",
  "width":"100%",
  "symbol": "FOREXCOM:XAUUSD",
  "interval": "1",
  "timezone": "Etc/UTC",
  "theme": "light",
  "style": "1",
  "locale": "uk",
  "toolbar_bg": "#f1f3f6",
  "enable_publishing": false,
  "hide_top_toolbar": true,
  "save_image": false,
  "container_id": "tradingview_48fed"
}
  );
  </script>
</div>
<!-- TradingView Widget END -->
</div>
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-4">
<div class="panel">
<div class="panel-heading p-10 border-bottom-purple">
<h5 class="panel-title"><i class="icon-chart position-left"></i> <?=$lang['statess']?></h5>
</div>
<div class="panel-body text-center">
<!--iframe src="https://staticmy.roboforex.com/pt/informers/providers/frame/small/88319/" height="50" width="327" scrolling="no" frameborder="0"></iframe-->

</div>
</div>

</div>

<div class="col-xs-12 col-sm-12 col-md-4">
<div class="panel">
<div class="panel-heading p-10 border-bottom-purple">
<h5 class="panel-title"><i class="icon-user position-left"></i> <?=$lang['status']?></h5>
</div>
<div class="panel-body text-center">
<div class="btn btn-<?php if($this->user->status == 'active') echo 'success'; else echo 'warning'; ?> btn-block btn-labeled">
<?php
$status = $this->user->status;
if($status == 'active')
{
	$status = 'ativo';
} 
else
{
	$status = 'inativo';
}
$status = $lang[$status];
if($this->user->status == 'active') echo "<b><i class='icon-check'></i></b> $status"; 
else echo "<b><i class='icon-cross'></i></b> $status"; 
?>	
</div>

</div>
</div>

</div>
<div class="col-xs-12 col-sm-12 col-md-4" >
<div class="panel panel-default">

<div class="panel-body p-10">

<div class="form-group">
<label style="display: block;">
<i class="icon-link2 position-left"></i> <b><?=$lang['link_cad']?></b>
<div class="panel-heading p-10 border-bottom-purple">
</div>
<a href="<?=site_url('backoffice/settings/link');?>" class="label label-success pull-right"><?=$lang['alterar']?></a>
</label>
<input class="form-control text-center" type="text" value="<?=site_url('sponsor/' . (!$this->user->link ? $this->user->id : $this->user->link));?>" readonly onclick="this.select();" />
</div>
</div>
</div>
</div>


<!--div class="col-xs-12 col-sm-12 col-md-3">
<div class="panel">
<div class="panel-heading p-10 border-bottom-indigo">
<h5 class="panel-title"><i class="icon-coins position-left"></i> <?=$lang['investimento']?></h5>
</div>
<div class="table-responsive no-border">
<table class="table table-xs table-striped" cellspacing="0" cellpadding="0">
<thead><tr>
<th class="col-sm-2 text-center"><?=$lang['valor_investido']?></th>
<th class="col-sm-2 text-center"><?=$lang['ganho_diario']?></th>
</tr></thead>
<tbody>
<tr>
<td class="text-center"><?=display_money($investido)?></td>
<td class="text-center"><?=display_money($diario)?></td>
</tr>
<tr>
<td colspan="2" class="text-center"><?=$lang['dias_pago']?>.</td>
</tr>
</tbody>
</table>
</div>
</div>
</div-->

</div>


<div class="row">
<div class="col-xs-12 col-sm-12 col-md-8">
<div class="panel">
<div class="panel-heading p-10 border-bottom-indigo">
<h5 class="panel-title"><i class="icon-users position-left"></i> <?=$lang['ultimos_indicados']?></h5>
</div>
<div class="table-responsive no-border">
<table class="table table-xs table-striped" cellspacing="0" cellpadding="0">
<thead><tr>
<th class="col-sm-2 text-center"><?=$lang['data']?></th>
<th class="col-sm-5"><?=$lang['nome']?></th>
<th class="col-sm-3 text-center"><?=$lang['celular']?></th>
</tr></thead>
<tbody>
<?php if (count($l_sponsored) <= 0): ?>
<tr><td colspan="3" class="text-center"><?=$lang['msg_indicacao']?>.</td></tr>
<?php else: ?>
<?php foreach ($l_sponsored as $user): ?>
<tr>
<td class="text-center"><small><?=date($this->settings->date_format, strtotime($user->create_date));?></small></td>
<td><?=($user->firstname . ' ' . $user->lastname);?></td>
<td class="text-center"><?=$user->mobilephone;?></td>
</tr>
<?php endforeach; ?>
<?php endif; ?>
</tbody>
</table>
</div>
</div>
</div>
<!--iframe src="https://staticmy.roboforex.com/pt/informers/providers/frame/performance/88319/" height="423" width="645" frameborder="0"></iframe-->
<!--div class="col-xs-12 col-sm-12 col-md-4">
<div class="panel">
<div class="panel-heading p-10 border-bottom-indigo">
<h5 class="panel-title"><i class="icon-tree5 position-left"></i> <?=$lang['binario']?></h5>
</div>
<div class="table-responsive no-border">
<table class="table table-xs table-striped" cellspacing="0" cellpadding="0">
<thead><tr>
<th class="col-sm-2 text-center"><?=$lang['esq']?></th>
<th class="col-sm-2 text-center"><?=$lang['dir']?></th>
<th class="col-sm-2 text-center">%</th>
</tr></thead>
<tbody>
<tr>
<td class="text-center"><?=$this->user->pleft;?></td>
<td class="text-center"><?=$this->user->pright;?></td>
<?php if($this->user->ganhos >= $this->user->teto): ?>
<td class="text-center">-</td>
<?php else: ?>
<td class="text-center">15%</td>
<?php endif; ?>
</tr>
</tbody>
</table>
</div>
</div>
</div-->
<!--div class="col-xs-12 col-sm-12 col-md-3">
<div class="panel">
<div class="panel-heading p-10 border-bottom-purple">
<h5 class="panel-title"><i class="icon-balance position-left"></i> <?=$lang['derramamento']?></h5>
</div>
<div class="panel-body text-center">
<form method="post" class="form-horizontal">
<div class="form-group row">
<select class="form-control" name="position" required>
<option value="auto" <?php if ($this->user->position == 'auto'): echo 'selected'; endif;?>><?=$lang['automatico']?></option>
<option value="left" <?php if ($this->user->position == 'left'): echo 'selected'; endif;?>><?=$lang['esquerda']?></option>
<option value="right" <?php if ($this->user->position == 'right'): echo 'selected'; endif;?>><?=$lang['direita']?></option>
</select>
</div>
<div class="text-center">
<button type="submit" class="btn btn-primary"><?=$lang['salvar']?> <i class="icon-floppy-disk position-right"></i></button>
</div>
</form>
</div>
</div>
</div-->
</div>

<div class="row">
<div class="col-xs-12 col-sm-12 col-md-8">
<div class="panel">
<div class="btcwdgt-chart"></div>
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-4">
<div class="panel">
<div class="btcwdgt-price" bw-cur="usd"></div>
</div>
</div>
</div>





<?php /*if($this->user->first_recharge == 'N'): ?>
<!-- Modal -->
<div class="modal fade" id="FirstRecharge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="myModalLabel"><?=$this->settings->company_name?></h4>
</div>
<div class="modal-body">
Olá! Seja muito bem-vindo(a)! Parece que você é novo no PacmoneyCoin.<br><br>
Temos algo muito bom para você! Como forma de incentivo aos novos jogadores estamos realizando uma promoção onde você faz sua primeira recarga e automaticamente ganha um saldo especial bônus de <font color='green'>100%</font>  do valor recarregado!<br><br>
Seja muito bem-vindo(a) ao mundo dos bitcoins! Esperamos que tenha um bom jogo!
<br><br>
Atenciosamente, 
<br><br>
Equipe PacMoneyCoin.<br>
www.pacmoneycoin.com
<img src=''>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
</div>
</div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function () {
$('#FirstRecharge').modal('show');
});
</script>
<?php endif;*/ ?>