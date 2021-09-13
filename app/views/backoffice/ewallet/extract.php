<?php
/**
 * Author:      Felipe Medeiros
 * File:        extract.php
 * Created in:  24/06/2016 - 22:37
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

function no_accent2($str)
{
    return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/", "/(ç)/","/(Ç)/"),explode(" ","a A e E i I o O u U n N c C"),$str);
}

function text_lang2($str)
{
	$str = no_accent2($str);
	$str = strtolower($str);
	$str = str_replace(" ", "_", $str);
	$str = str_replace("-", "", $str);
	$str = str_replace(".", "", $str);

	return $str;
}
?>
<!-- BEGIN PANEL STATS -->
<div class="row">
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="dashboard-stat bg-primary-800">
			<div class="visual">
				<i class="icon-coins"></i>
			</div>
			<div class="details">
				<div class="number"><?=display_money($balance);?></div>
				<div class="desc"><?=$lang['saldo_mes']?></div>
			</div>
		</div>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="dashboard-stat bg-success-800">
			<div class="visual">
				<i class="icon-diff-added"></i>
			</div>
			<div class="details">
				<div class="number"><?=display_money($credits);?></div>
				<div class="desc"><?=$lang['creditos_mes']?></div>
			</div>
		</div>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="dashboard-stat bg-danger-800">
			<div class="visual">
				<i class="icon-diff-removed"></i>
			</div>
			<div class="details">
				<div class="number"><?=display_money($debits);?></div>
				<div class="desc"><?=$lang['debitos_mes']?></div>
			</div>
		</div>
	</div>
</div>
<!-- END PANEL STATS -->
<div class="panel panel-default">
	<div class="panel-heading border-bottom-primary">
		<h5 class="panel-title"><i class="icon-printer4 position-left"></i> <?=$lang['extrato_mensal']?></h5>
		<div class="heading-elements">
			<div class="btn-group heading-btn">
				<button type="button" class="btn btn-xs btn-primary dropdown-toggle" data-toggle="dropdown"><i class="icon-calendar22 position-left"></i> <?=$year;?> <span class="caret"></span></button>
				<ul class="dropdown-menu dropdown-menu-right">
					<li><a href="<?=site_url('backoffice/ewallet/extract/' . date('Y') . '/' . $month);?>"><i class="icon-calendar22 position-left"></i> <?=date('Y');?></a></li>
					<li><a href="<?=site_url('backoffice/ewallet/extract/' . (date('Y') - 1) . '/' . $month);?>"><i class="icon-calendar22 position-left"></i> <?=(date('Y') - 1);?></a></li>
				</ul>
			</div>
			<div class="btn-group heading-btn">
				<button type="button" class="btn btn-xs btn-primary dropdown-toggle" data-toggle="dropdown"><i class="icon-calendar22 position-left"></i> <?=date('F', strtotime($year . '-' . $month . '-01'));?> <span class="caret"></span></button>
				<ul class="dropdown-menu dropdown-menu-right">
					<li><a href="<?=site_url('backoffice/ewallet/extract/' . $year . '/01')?>"><i class="icon-calendar22 position-left"></i> <?=$lang['mes1']?></a></li>
					<li><a href="<?=site_url('backoffice/ewallet/extract/' . $year . '/02')?>"><i class="icon-calendar22 position-left"></i> <?=$lang['mes2']?></a></li>
					<li><a href="<?=site_url('backoffice/ewallet/extract/' . $year . '/03')?>"><i class="icon-calendar22 position-left"></i> <?=$lang['mes3']?></a></li>
					<li><a href="<?=site_url('backoffice/ewallet/extract/' . $year . '/04')?>"><i class="icon-calendar22 position-left"></i> <?=$lang['mes4']?></a></li>
					<li><a href="<?=site_url('backoffice/ewallet/extract/' . $year . '/05')?>"><i class="icon-calendar22 position-left"></i> <?=$lang['mes5']?></a></li>
					<li><a href="<?=site_url('backoffice/ewallet/extract/' . $year . '/06')?>"><i class="icon-calendar22 position-left"></i> <?=$lang['mes6']?></a></li>
					<li><a href="<?=site_url('backoffice/ewallet/extract/' . $year . '/07')?>"><i class="icon-calendar22 position-left"></i> <?=$lang['mes7']?></a></li>
					<li><a href="<?=site_url('backoffice/ewallet/extract/' . $year . '/08')?>"><i class="icon-calendar22 position-left"></i> <?=$lang['mes8']?></a></li>
					<li><a href="<?=site_url('backoffice/ewallet/extract/' . $year . '/09')?>"><i class="icon-calendar22 position-left"></i> <?=$lang['mes9']?></a></li>
					<li><a href="<?=site_url('backoffice/ewallet/extract/' . $year . '/10')?>"><i class="icon-calendar22 position-left"></i> <?=$lang['mes10']?></a></li>
					<li><a href="<?=site_url('backoffice/ewallet/extract/' . $year . '/11')?>"><i class="icon-calendar22 position-left"></i> <?=$lang['mes11']?></a></li>
					<li><a href="<?=site_url('backoffice/ewallet/extract/' . $year . '/12')?>"><i class="icon-calendar22 position-left"></i> <?=$lang['mes12']?></a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="table-responsive no-border">
		<table class="table table-xs table-striped data">
			<thead><tr>
				<th><?=$lang['data']?></th>
				<th><?=$lang['descricao']?></th>
				<th><?=$lang['tipo']?></th>
				<th><?=$lang['valor']?></th>
			</tr></thead>
			<tbody><?php
			$final_balance = 0;
			foreach ($extracts as $extract):
				if ($extract->type == 'credit'):	$final_balance += $extract->value;
				elseif ($extract->type == 'debit'):	$final_balance -= $extract->value;
				endif;
			?>
				<tr>
					<td class="text-center"><span><span class="hidden"><?=strtotime($extract->date);?></span> <?=date($this->settings->date_format, strtotime($extract->date));?></span></td>
					<td><?=$lang[text_lang2($extract->description)];?></td>
					<td class="text-center"><span class="label label-<?php if ($extract->type == 'debit'):
						echo 'danger';
					elseif ($extract->type == 'lost'):
						echo 'warning';
					elseif ($extract->type == 'credit'):
						echo 'success';
					endif; ?>"><?php if ($extract->type == 'debit'):
						echo $lang['debito'];
					elseif ($extract->type == 'lost'):
						echo $lang['perca'];
					elseif ($extract->type == 'credit'):
						echo $lang['credito'];
					endif; ?></span></td>
					<td class="text-center"><?=display_money($extract->value);?></td>
				</tr>
			<?php endforeach; ?></tbody>
			<tfoot><tr>
				<td colspan="2"></td>
				<td class="text-right"><b><?=$lang['saldo_final']?>:</b></td>
				<td><span class="label label-<?php if ($final_balance == 0):
					echo 'default';
				elseif ($final_balance > 0):
					echo 'success';
				elseif ($final_balance < 0):
					echo 'danger';
				endif; ?> label-block"><?=display_money($final_balance);?></span></td>
			</tr></tfoot>
		</table>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function () {
		$('.data').dataTable();
	})
</script>