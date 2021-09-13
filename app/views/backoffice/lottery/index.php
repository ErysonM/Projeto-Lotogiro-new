<?php
/**
 * Author:      Felipe Medeiros
 * File:        index.php
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
		<h5 class="panel-title"><i class="icon-ticket position-left"></i> <?=$lang['loterias']?></h5>
		<?php /*<div class="heading-elements">
			<button type="button" class="btn bg-primary-800 btn-labeled" data-toggle="modal" data-target="#modal_video">
				<b><i class="icon-plus3"></i></b> Enviar Video (Ganhador)
			</button>
		</div>*/ ?>
	</div>
	
	
	<div class="portlet-body">
		<ul class="nav nav-tabs">
			<li class="active">
				<a href="#open" data-toggle="tab"> <?=$lang['loterias_ativas']?> </a>
			</li>
			<li>
				<a href="#end" data-toggle="tab"> <?=$lang['loterias_finalizadas']?> </a>
			</li>
			<li>
				<a href="#win" data-toggle="tab"> <?=$lang['loterias_ganhas']?> </a>
			</li>
			<li>
				<a href="#videos" data-toggle="tab"> <?=$lang['video_ganhadores']?> </a>
			</li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane fade active in" id="open">
	<div class="table-responsive">
		<table class="table data">
			<thead><tr>
				<th width="10px">#</th>
				<th><?=$lang['titulo']?></th>
				<th><?=$lang['status']?></th>
				<th><?=$lang['tipo']?></th>
				<th><?=$lang['inicio']?></th>
				<th><?=$lang['fim']?></th>
				<th><?=$lang['tickets_vendidos']?></th>
				<th><?=$lang['preco_ticket']?></th>
				<th><?=$lang['premio']?></th>
				<th><?=$lang['meus_tickets']?></th>
				<th width="100px"><?=$lang['acao']?></th>
			</tr></thead>
			<tbody><?php foreach($lotterys as $lottery):
			$meustickets = LottersTicket::count(array('conditions' => array('lottery_id = ? and user_id = ?', $lottery->id, $this->user->id)));
			?>
				<tr>
					<td class="text-center"><?=$lottery->id;?></td>
					<td><?=$lottery->name;?></td>
					<td><span class="label label-default <?php
							if ($lottery->status == "paid")
								echo 'label-success';
							elseif ($lottery->status == "open")
								echo 'label-primary';
							elseif ($lottery->status == "cancel")
								echo 'label-danger';
							?>"><?=($lottery->status == 'paid' ? $lang['paga'] : ($lottery->status == 'cancel' ? $lang['cancelada'] : $lang['aberta']));?></span></td>
					<td><?php
							if ($lottery->type == "fix") echo $lang['fixo'];
							else echo $lang['acumulativo'];
							?></td>
					<td><span class="hidden"><?=strtotime($lottery->starts);?></span> <?=date($this->settings->date_format, strtotime($lottery->starts));?> às <?=date($this->settings->date_time_format, strtotime($lottery->starts));?></td>
					<td><span class="hidden"><?=strtotime($lottery->ends);?></span> <?=date($this->settings->date_format, strtotime($lottery->ends));?> às <?=date($this->settings->date_time_format, strtotime($lottery->ends));?></td>
					<td><?=$lottery->buyed_tickets;?></td>
					<td><span class="hidden"><?=$lottery->ticket_price;?></span> <?=display_money($lottery->ticket_price);?></td>
					<td><span class="hidden"><?php
					if($lottery->type == 'fix') echo $lottery->value_initial;
					else echo $lottery->value_initial+($lottery->buyed_tickets*$lottery->ticket_price);
					?></span><?php 
					if($lottery->type == 'fix') echo display_money($lottery->value_initial);
					else echo display_money($lottery->value_initial+($lottery->buyed_tickets*$lottery->ticket_price));
					?></td>
					<td><?=$meustickets?></td>
					<td class="text-center">
					<a href="<?=site_url('backoffice/lotterys/view/' . $lottery->id);?>" class="btn btn-icon btn-xs btn-primary"><i class="icon-eye"></i> <?=$lang['ver']?></a>
					</td>
				</tr>
			<?php endforeach;?></tbody>
		</table>
	</div>
			</div>
			<div class="tab-pane fade" id="end">
	<div class="table-responsive">
		<table class="table data">
			<thead><tr>
				<th width="10px">#</th>
				<th><?=$lang['titulo']?></th>
				<th><?=$lang['status']?></th>
				<th><?=$lang['tipo']?></th>
				<th><?=$lang['inicio']?></th>
				<th><?=$lang['fim']?></th>
				<th><?=$lang['tickets_vendidos']?></th>
				<th><?=$lang['preco_ticket']?></th>
				<th><?=$lang['premio']?></th>
				<th><?=$lang['meus_tickets']?></th>
				<th width="100px"><?=$lang['acao']?></th>
			</tr></thead>
			<tbody><?php foreach($lotterys2 as $lottery): 
			$meustickets = LottersTicket::count(array('conditions' => array('lottery_id = ? and user_id = ?', $lottery->id, $this->user->id)));
			?>
				<tr>
					<td class="text-center"><?=$lottery->id;?></td>
					<td><?=$lottery->name;?></td>
					<td><span class="label label-default <?php
							if ($lottery->status == "paid")
								echo 'label-success';
							elseif ($lottery->status == "open")
								echo 'label-primary';
							elseif ($lottery->status == "cancel")
								echo 'label-danger';
							?>"><?=($lottery->status == 'paid' ? $lang['paga'] : ($lottery->status == 'cancel' ? $lang['cancelada'] : $lang['aberta']));?></span></td>
					<td><?php
							if ($lottery->type == "fix") echo $lang['fixo'];
							else echo $lang['acumulativo'];
							?></td>
					<td><span class="hidden"><?=strtotime($lottery->starts);?></span> <?=date($this->settings->date_format, strtotime($lottery->starts));?> às <?=date($this->settings->date_time_format, strtotime($lottery->starts));?></td>
					<td><span class="hidden"><?=strtotime($lottery->ends);?></span> <?=date($this->settings->date_format, strtotime($lottery->ends));?> às <?=date($this->settings->date_time_format, strtotime($lottery->ends));?></td>
					<td><?=$lottery->buyed_tickets;?></td>
					<td><span class="hidden"><?=$lottery->ticket_price;?></span> <?=display_money($lottery->ticket_price);?></td>
					<td><span class="hidden"><?php
					if($lottery->type == 'fix') echo $lottery->value_initial;
					else echo $lottery->value_initial+($lottery->buyed_tickets*$lottery->ticket_price);
					?></span><?php 
					if($lottery->type == 'fix') echo display_money($lottery->value_initial);
					else echo display_money($lottery->value_initial+($lottery->buyed_tickets*$lottery->ticket_price));
					?></td>
					<td><?=$meustickets?></td>
					<td class="text-center">
					<a href="<?=site_url('backoffice/lotterys/view/' . $lottery->id);?>" class="btn btn-icon btn-xs btn-primary"><i class="icon-eye"></i> <?=$lang['ver']?></a>
					</td>
				</tr>
			<?php endforeach;?></tbody>
		</table>
	</div>
			</div>
			<div class="tab-pane fade" id="win">
	<div class="table-responsive">
		<table class="table data">
			<thead><tr>
				<th width="10px">#</th>
				<th><?=$lang['titulo']?></th>
				<th><?=$lang['status']?></th>
				<th><?=$lang['tipo']?></th>
				<th><?=$lang['inicio']?></th>
				<th><?=$lang['fim']?></th>
				<th><?=$lang['tickets_vendidos']?></th>
				<th><?=$lang['preco_ticket']?></th>
				<th><?=$lang['premio']?></th>
				<th><?=$lang['meus_tickets']?></th>
				<th width="100px"><?=$lang['acao']?></th>
			</tr></thead>
			<tbody><?php foreach($wins as $lotteryx): 
			
			$lottery = Lotter::find_by_id($lotteryx->lottery_id);
			?>
				<tr>
					<td class="text-center"><?=$lottery->id;?></td>
					<td><?=$lottery->name;?></td>
					<td><span class="label label-default <?php
							if ($lottery->status == "paid")
								echo 'label-success';
							elseif ($lottery->status == "open")
								echo 'label-primary';
							elseif ($lottery->status == "cancel")
								echo 'label-danger';
							?>"><?=($lottery->status == 'paid' ? $lang['paga'] : ($lottery->status == 'cancel' ? $lang['cancelada'] : $lang['aberta']));?></span></td>
					<td><?php
							if ($lottery->type == "fix") echo $lang['fixo'];
							else echo $lang['acumulativo'];
							?></td>
					<td><span class="hidden"><?=strtotime($lottery->starts);?></span> <?=date($this->settings->date_format, strtotime($lottery->starts));?> às <?=date($this->settings->date_time_format, strtotime($lottery->starts));?></td>
					<td><span class="hidden"><?=strtotime($lottery->ends);?></span> <?=date($this->settings->date_format, strtotime($lottery->ends));?> às <?=date($this->settings->date_time_format, strtotime($lottery->ends));?></td>
					<td><?=$lottery->buyed_tickets;?></td>
					<td><span class="hidden"><?=$lottery->ticket_price;?></span> <?=display_money($lottery->ticket_price);?></td>
					<td><span class="hidden"><?php
					if($lottery->type == 'fix') echo $lottery->value_initial;
					else echo $lottery->value_initial+($lottery->buyed_tickets*$lottery->ticket_price);
					?></span><?php 
					if($lottery->type == 'fix') echo display_money($lottery->value_initial);
					else echo display_money($lottery->value_initial+($lottery->buyed_tickets*$lottery->ticket_price));
					?></td>
					<td class="text-center">
					<a href="<?=site_url('backoffice/lotterys/view/' . $lottery->id);?>" class="btn btn-icon btn-xs btn-primary"><i class="icon-eye"></i> <?=$lang['ver']?></a>
					</td>
				</tr>
			<?php endforeach;?></tbody>
		</table>
	</div>
			</div>
			<div class="tab-pane fade" id="videos">
			
			
				<div class="alert alert-info alert-styled-left">
					<span class="text-semibold"><?=$lang['sem_videos']?>.</span>
				</div>
				
			
			</div>
		</div>
	</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('.data').dataTable({
			columnDefs: [{ 
				orderable: false,
				width: '100px',
				targets: [ 3 ]
			}],
			drawCallback: function () {
				$(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
			},
			preDrawCallback: function() {
				$(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
			}
		});
	});
</script>
<?php 
/*<div id="modal_video" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-primary pr-15 pl-15 pt-10 pb-10">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h6 class="modal-title">Transferir Saldo</h6>
			</div>
			<form action="<?=site_url('backoffice/ewallet/transfer');?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<label for="amount">#ID Destinatário:</label>
						<input type="number" name="id_to" id="id_to" class="form-control" placeholder="Ex: <?=rand(10000, 60000);?>" required />
					</div>
					<div class="form-group">
						<label for="amount">Valor a ser transferido:</label>
						<input type="text" name="amount" id="amount" class="form-control mask-transfer" placeholder="Ex: <?=display_money(rand(100, 2000), '');?>" required OnKeyDown="calcValor()" OnKeyPress="calcValor()" OnKeyUp="calcValor()" Onblur="calcValor()" autocomplete="off"/>
						<p><b>Saldo disponível:</b> <b><?=display_money($this->user->balance);?></b></p>
					</div>
					<div class="form-group">
						<label for="amount">Valor necessário (Valor digitado + taxa):</label>
						<input type="text" name="amount2" id="amount2" class="form-control money-mask" value="0.00" disabled />
					</div>
					<div class="form-group">
						<label for="msg">Referência da transferência:</label>
						<input type="text" name="msg" id="msg" class="form-control" required/>
					</div>
					<div class="form-group">
						<label for="password">Senha de acesso:</label>
						<input type="password" name="password" id="password" class="form-control" required autocomplete="off"/>
					</div>
					<div class="form-group">
						<p>Ao solicitar transferência de saldo, você está ciente que:</p>
						<ul class="clist clist-angle">
							<li>O valor de transferência minimo é de <b><?=display_money($this->settings->transfer_min);?></b>.</li>
							<li>O valor de taxa por transferência é de <b><?=$this->settings->transfer_percent;?>%</b>.</li>
						</ul>
					</div>
				</div>
				<div class="modal-footer" style="margin-top: -50px;">
					<input type="submit" class="btn btn-xs btn-primary" value="Transferir" />
				</div>
			</form>
		</div>
	</div>
</div>*/ ?>