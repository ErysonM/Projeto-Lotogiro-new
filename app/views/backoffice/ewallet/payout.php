<?php
/**
 * Author:      Felipe Medeiros
 * File:        payout.php
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
		<h5 class="panel-title"><i class="icon-coins position-left"></i> <?=$lang['pagar_faturas']?></h5>
		<div class="heading-elements">
			<button type="button" class="btn bg-primary-800 btn-labeled" data-toggle="modal" data-target="#modal_payout">
				<b><i class="icon-plus3"></i></b> <?=$lang['pagar_fatura']?>
			</button>
		</div>
	</div>
	<h2><?=$lang['pag_fatura_realizados']?></h2>
	<div class="table-responsive no-border">
		<table class="table table-xs table-striped data">
			<thead><tr>
				<th>#</th>
				<th class="text-center"><?=$lang['data']?></th>
				<th><?=$lang['n_fatura']?></th>
				<th><?=$lang['dono']?></th>
				<th><?=$lang['valor']?></th>
				<th><?=$lang['referencia']?></th>
			</tr></thead>
			<tbody><?php foreach ($payouts as $row): ?>
				<?php $id_to = User::find_by_id($row->owner_id); ?>
				<tr>
					<td><?=$row->id;?></td>
					<td class="text-center"><?=date('d/m/Y H:i', strtotime($row->date));?></td>
					<td><?=$row->invoice_id;?></td>
					<td><?=($id_to->firstname . ' ' . $id_to->lastname);?></td>
					<td><?=display_money($row->value);?></td>
					<td><?=($row->msg);?></td>
					<!--<td class="text-center">
						<ul class="icons-list">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="icon-menu9"></i>
								</a>
								<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="<?=site_url('backoffice/ewallet/transferview/' . $row->id);?>"><i class="icon-eye"></i> Ver</a></li>
								</ul>
							</li>
						</ul>
					</td>-->
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
<div id="modal_payout" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-primary pr-15 pl-15 pt-10 pb-10">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h6 class="modal-title"><?=$lang['pagar_fatura']?></h6>
			</div>
			<form action="<?=site_url('backoffice/ewallet/payout');?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<label for="invoice_id"><?=$lang['num_fatura']?>:</label>
						<input type="number" name="invoice_id" id="invoice_id" class="form-control" placeholder="Ex: <?=rand(10000, 60000);?>" required />
					</div>
					<div class="form-group">
						<label for="value"><?=$lang['valor_ser_pago']?>:</label>
						<input type="text" name="value" id="value" class="form-control mask-money" placeholder="Ex: <?=display_money(rand(100, 2000), '');?>" autocomplete="off"/>
						<p><b><?=$lang['saldo_disponivel']?>:</b> <b><?=display_money($this->user->balance);?></b></p>
					</div>
					<div class="form-group">
						<label for="msg"><?=$lang['ref_pagamento']?>:</label>
						<input type="text" name="msg" id="msg" class="form-control" required/>
					</div>
					<div class="form-group">
						<label for="password"><?=$lang['senha_acesso']?>:</label>
						<input type="password" name="password" id="password" class="form-control" required autocomplete="off"/>
					</div>
					<div class="form-group">
						<p><?=$lang['fatura_ciente']?>:</p>
						<ul class="clist clist-angle">
							<li><?=$lang['acao_irre']?>.</li>
							<li><?=$lang['sem_taxa_cobrada']?>.</li>
						</ul>
					</div>
				</div>
				<div class="modal-footer" style="margin-top: -50px;">
					<input type="submit" class="btn btn-xs btn-primary" value="Pagar" />
				</div>
			</form>
		</div>
	</div>
</div>