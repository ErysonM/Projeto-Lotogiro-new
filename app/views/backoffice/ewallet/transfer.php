<?php
/**
 * Author:      Felipe Medeiros
 * File:        transfer.php
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
		<h5 class="panel-title"><i class="icon-coins position-left"></i> <?=$lang['transferir_saldo']?></h5>
		<div class="heading-elements">
			<button type="button" class="btn bg-primary-800 btn-labeled" data-toggle="modal" data-target="#modal_transfer">
				<b><i class="icon-plus3"></i></b> <?=$lang['transferir']?>
			</button>
		</div>
	</div>
	<div class="table-responsive no-border">
		<table class="table table-xs table-striped data">
			<thead><tr>
				<th>#</th>
				<th class="text-center"><?=$lang['data']?></th>
				<th><?=$lang['de']?></th>
				<th><?=$lang['para']?></th>
				<th><?=$lang['valor_cheio']?></th>
				<th><?=$lang['taxa']?></th>
				<th><?=$lang['valor_recebido']?></th>
				<th><?=$lang['referencia']?></th>
			</tr></thead>
			<tbody><?php foreach ($transfers as $row): ?>
				<?php $id_from = User::find_by_id($row->id_from); 
					  $id_to = User::find_by_id($row->id_to); 
					?>
				<tr>
					<td><?=$row->id;?></td>
					<td class="text-center"><?=date('d/m/Y H:i', strtotime($row->date));?></td>
					<td><?=($id_from->firstname . ' ' . $id_from->lastname);?></td>
					<td><?=($id_to->firstname . ' ' . $id_to->lastname);?></td>
					<td><?=display_money($row->valuefull);?></td>
					<td><?=display_money($row->valuedisc);?></td>
					<td><?=display_money($row->valuewithdisc);?></td>
					<td><?php 
					if($row->id_from == $this->user->id) echo ($row->msg);
					else echo "-";
					?></td>
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

	$(document).ready(function () {
	$('.mask-transfer').priceFormat({
			prefix: '',
			            centsSeparator: '.',
			thousandsSeparator: ''
					});
	})

</script>
<script type="text/javascript">
function calcValor(){
    // zera calculo
    document.getElementById("amount2").value = '0';
 
    // valor líquido
    var VTOTALLIQUIDO = parseFloat(document.getElementById("amount").value);
 
    // acrescimo em porcentagem
    var DESCONTO1 = parseFloat(<?=$this->settings->transfer_percent;?>);
    if( isNaN ( DESCONTO1 ) ){
    	DESCONTO1 = 0;
    }
    var PDESCONTO = parseFloat( ( VTOTALLIQUIDO * DESCONTO1 ) / 100 );
 
    var TOTAL = parseFloat(VTOTALLIQUIDO) + parseFloat(PDESCONTO);
 
    document.getElementById("amount2").value = TOTAL.toFixed(2);
}
</script>
<div id="modal_transfer" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-primary pr-15 pl-15 pt-10 pb-10">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h6 class="modal-title"><?=$lang['transferir_saldo']?></h6>
			</div>
			<form action="<?=site_url('backoffice/ewallet/transfer');?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<label for="amount">#ID <?=$lang['destinatario']?>:</label>
						<input type="number" name="id_to" id="id_to" class="form-control" placeholder="Ex: <?=rand(10000, 60000);?>" required />
					</div>
					<div class="form-group">
						<label for="amount"><?=$lang['valor_ser_transf']?>:</label>
						<input type="text" name="amount" id="amount" class="form-control mask-transfer" placeholder="Ex: <?=display_money(rand(100, 2000), '');?>" required OnKeyDown="calcValor()" OnKeyPress="calcValor()" OnKeyUp="calcValor()" Onblur="calcValor()" autocomplete="off"/>
						<p><b><?=$lang['saldo_disponivel']?>:</b> <b><?=display_money($this->user->balance);?></b></p>
					</div>
					<div class="form-group">
						<label for="amount"><?=$lang['valor_mais_taxa']?>:</label>
						<input type="text" name="amount2" id="amount2" class="form-control money-mask" value="0.00" disabled />
					</div>
					<div class="form-group">
						<label for="msg"><?=$lang['ref_transferencia']?>:</label>
						<input type="text" name="msg" id="msg" class="form-control" required/>
					</div>
					<div class="form-group">
						<label for="password"><?=$lang['senha_acesso']?>:</label>
						<input type="password" name="password" id="password" class="form-control" required autocomplete="off"/>
					</div>
					<div class="form-group">
						<p><?=$lang['transf_ciente']?>:</p>
						<ul class="clist clist-angle">
							<li><?=$lang['transf_min']?> <b><?=display_money($this->settings->transfer_min);?></b>.</li>
							<li><?=$lang['taxa_transf']?> <b><?=$this->settings->transfer_percent;?>%</b>.</li>
						</ul>
					</div>
				</div>
				<div class="modal-footer" style="margin-top: -50px;">
					<input type="submit" class="btn btn-xs btn-primary" value="<?=$lang['transferir']?>" />
				</div>
			</form>
		</div>
	</div>
</div>