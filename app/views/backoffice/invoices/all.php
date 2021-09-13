<?php
/**
* Project:    mmn.dev
* File:       all.php
* Author:     Felipe Medeiros
* Createt at: 27/05/2016 - 20:48
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
<div class="panel">
<div class="panel-heading p-10 border-bottom-indigo">
<h5 class="panel-title"><i class="icon-list position-left"></i> <?=$lang['minhas_faturas']?></h5>
</div>
<div class="table-responsive no-border">
<table class="table table-xs data">
<thead><tr>
<th width="70px" class="text-center">#</th>
<th class="text-center"><?=$lang['categoria']?></th>
<th class="text-center"><?=$lang['criada_em']?></th>
<th class="text-center"><?=$lang['pago_em']?></th>
<th class="text-center"><?=$lang['valor']?></th>
<th class="text-center"><?=$lang['status']?></th>
<th class="text-center"><?=$lang['acao']?></th>
</tr></thead>
<tbody><?php foreach ($invoices as $invoice): ?>
<tr>
<td class="text-center"><?=$invoice->id;?></td>
<td class="text-center"><span class="label label-info">
<?php 
if($invoice->type == 'buy') 	echo $lang['adesao'];
elseif($invoice->type == 'upgrade') echo $lang['upgrade'];
elseif($invoice->type == 'monthly') echo $lang['mensalidade'];
elseif($invoice->type == 'recharge') echo $lang['recarga'];
?>
</span></td>
<td class="text-center"><span><span class="hidden"><?=strtotime($invoice->date);?></span> <?=date("d/m/Y", strtotime($invoice->date));?></span></td>
<td class="text-center"><span class="hidden"><?=strtotime($invoice->payment_date);?></span> <?php if($invoice->status == 'paid') echo date("d/m/Y", strtotime($invoice->payment_date));
else echo "-";
?></td>
<td class="text-center"><span><span class="hidden"><?=($invoice->sum - $invoice->discount);?></span> <?=display_money(($invoice->sum - $invoice->discount));?></span></td>
<td class="text-center"><span class="label <?php
if ($invoice->status == "paid")
echo 'label-success';
elseif ($invoice->status == "open")
echo 'label-primary';
elseif ($invoice->status == "canceled")
echo 'label-danger';
?>"><?=($invoice->status == 'open' ? $lang['em_aberto'] : ($invoice->status == 'paid' ? $lang['pago'] : ($invoice->status == 'canceled' ? $lang['cancelado'] : '-')));?></span></td>
<td class="text-center">
<a href="<?=site_url('backoffice/invoices/view/' . $invoice->id);?>" class="btn btn-icon btn-xs btn-primary"><i class="icon-eye"></i></a>
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