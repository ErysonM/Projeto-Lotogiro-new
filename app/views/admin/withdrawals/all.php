<?php
/**
 * Author:      Felipe Medeiros
 * File:        withdrawal.php
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
				<div class="number"><?=display_money($estornados);?></div>
				<div class="desc">Estornados</div>
			</div>
			<a class="more" href="javascript:;">
				View more <i class="fa fa-arrow-right"></i>
			</a>
		</div>
	</div>
</div>
<!-- BEGIN PANEL STATS -->
<div class="panel panel-default">
	<div class="panel-heading border-bottom-primary">
		<h5 class="panel-title"><i class="icon-coins position-left"></i> Solicitações de Saque</h5>
		<div class="heading-elements">
			<!--<button type="button" class="btn bg-primary-800 btn-labeled" data-toggle="modal" data-target="#modal_withdrawal">
				<b><i class="icon-plus3"></i></b> Solicitar saque
			</button>-->
		</div>
	</div>
	<div class="table-responsive no-border">
		<table class="table table-xs table-striped data">
			<thead><tr>
				<th class="text-center">Data</th>
				<th class="text-center">Data Pgto</th>
				<th>Forma</th>
				<th>Banco</th>
				<th>Carteira</th>
				<th>Valor</th>
				<th class="text-center">Status</th>
				<th class="text-center">Ações</th>
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
						    if($row->status == 'open') 		 echo 'PENDENTE';
						elseif($row->status == 'paid') 		 echo 'PAGO';
						elseif($row->status == 'chargeback') echo 'ESTORNADO';
						elseif($row->status == 'cancel')	 echo 'CANCELADO';
						?></span>
					</td>
					<td class="text-center">
						<ul class="icons-list">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="icon-menu9"></i>
								</a>
								<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="<?=site_url('admin/withdrawals/view/' . $row->id);?>"><i class="icon-eye"></i> Ver</a></li>
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