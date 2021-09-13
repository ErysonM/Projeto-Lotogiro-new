<?php
/**
 * Author:      Felipe Medeiros
 * File:        all.php
 * Created in:  26/06/2016 - 09:52
 */
?>
<div class="row">
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat bg-primary-800">
			<div class="visual">
				<i class="icon-coins"></i>
			</div>
			<div class="details">
				<div class="number"><?=display_money($abertos);?></div>
				<div class="desc">Abertos</div>
			</div>
			<a class="more" href="javascript:;">
				View more <i class="fa fa-arrow-right"></i>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat bg-success-800">
			<div class="visual">
				<i class="icon-wallet"></i>
			</div>
			<div class="details">
				<div class="number"><?=display_money($pagos);?></div>
				<div class="desc">Pagos</div>
			</div>
			<a class="more" href="javascript:;">
				Taxas arrecadadas: <?=display_money($taxas);?>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat bg-danger-800">
			<div class="visual">
				<i class="icon-coins"></i>
			</div>
			<div class="details">
				<div class="number"><?=display_money($cancelados);?></div>
				<div class="desc">Cancelados</div>
			</div>
			<a class="more" href="javascript:;">
				View more <i class="fa fa-arrow-right"></i>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat bg-purple-800">
			<div class="visual">
				<i class="icon-coins"></i>
			</div>
			<div class="details">
				<div class="number"><?=display_money($vencidos);?></div>
				<div class="desc">Vencidos</div>
			</div>
			<a class="more" href="javascript:;">
				View more <i class="fa fa-arrow-right"></i>
			</a>
		</div>
	</div>
</div>
<!-- BEGIN PANEL STATS -->
<div class="panel panel-flat">
	<div class="panel-heading p-10 border-bottom-purple">
		<h5 class="panel-title"><i class="icon-list position-left"></i>Lista de faturas</h5>
	</div>
	<div class="table-responsive">
		<table class="table data">
			<thead><tr>
				<th width="70px">ID</th>
				<th class="text-center">Categoria</th>
				<th>Associado</th>
				<th class="text-center">Criada em</th>
				<th class="text-center">Pago em</th>
				<th class="text-center">Valor</th>
				<th class="text-center">Status</th>
				<th class="text-center">Ação</th>
			</tr></thead>
			<tbody><?php foreach ($invoices as $invoice): ?>
				<?php $user = User::find_by_id($invoice->user_id); ?>
				<tr>
					<td class="text-center"><?=$invoice->id;?></td>
					<td class="text-center"><span class="label label-info">
						<?php 
							if($invoice->type == 'buy') 	echo 'Adesão';
						elseif($invoice->type == 'upgrade') echo 'Upgrade';
						elseif($invoice->type == 'monthly') echo 'Mensalidade';
						elseif($invoice->type == 'recharge') echo 'Recarga';
						?>
					</span></td>
					<td><a href="<?=site_url('admin/users/view/' . $user->id);?>"><?=($user->firstname . ' ' . $user->lastname);?></a></td>
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
						?>"><?=($invoice->status == 'open' ? 'Em aberto' : ($invoice->status == 'paid' ? 'Pago' : ($invoice->status == 'canceled' ? 'Cancelado' : '-')));?></span></td>
					<td class="text-center">
						<a href="<?=site_url('admin/invoices/view/' . $invoice->id);?>" class="btn btn-icon btn-xs btn-primary"><i class="icon-eye"></i></a>
						<!--<a href="<?=site_url('admin/invoices/cancel/' . $invoice->id);?>" class="btn btn-icon btn-xs btn-danger"><i class="icon-x"></i></a>
						<a href="<?=site_url('admin/invoices/paid/' . $invoice->id);?>" class="btn btn-icon btn-xs btn-success"><i class="icon-checkmark5"></i></a>
						-->
					</td>
				</tr>
			<?php endforeach;?></tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('.data').dataTable();
	})
</script>