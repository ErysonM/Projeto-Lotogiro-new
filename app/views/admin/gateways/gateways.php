<div class="panel panel-flat">
	<div class="panel-body">
<div class="row">
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat bg-teal-800">
			<div class="visual">
				<img src='<?=base_url('assets/images/gateways/bitcoin.png');?>'>
			</div>
			<div class="details">
				<div class="number"><?php echo ($settings->bitcoin == "Y" ? "<font color='green'><b>ATIVO</b></font>" : "<font color='red'><b>INATIVO</b></font>" ); ?></div>
			</div>
			<a class="more" href="<?=site_url('admin/gateways/bitcoin');?>">
				BITCOIN <i class="fa fa-arrow-right"></i>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat bg-teal-800">
			<div class="visual">
				<img src='<?=base_url('assets/images/gateways/boleto.png');?>'>
			</div>
			<div class="details">
				<div class="number"><?php echo ($settings->boleto == "Y" ? "<font color='green'><b>ATIVO</b></font>" : "<font color='red'><b>INATIVO</b></font>" ); ?></div>
			</div>
			<a class="more" href="<?=site_url('admin/gateways/boleto');?>">
				BOLETO <i class="fa fa-arrow-right"></i>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat bg-teal-800">
			<div class="visual">
				<img src='<?=base_url('assets/images/gateways/bcash.png');?>'>
			</div>
			<div class="details">
				<div class="number"><?php echo ($settings->bcash == "Y" ? "<font color='green'><b>ATIVO</b></font>" : "<font color='red'><b>INATIVO</b></font>" ); ?></div>
			</div>
			<a class="more" href="<?=site_url('admin/gateways/bcash');?>">
				BCASH <i class="fa fa-arrow-right"></i>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat bg-teal-800">
			<div class="visual">
				<img src='<?=base_url('assets/images/gateways/paypal.png');?>'>
			</div>
			<div class="details">
				<div class="number"><?php echo ($settings->paypal == "Y" ? "<font color='green'><b>ATIVO</b></font>" : "<font color='red'><b>INATIVO</b></font>" ); ?></div>
			</div>
			<a class="more" href="<?=site_url('admin/gateways/paypal');?>">
				PAYPAL <i class="fa fa-arrow-right"></i>
			</a>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat bg-teal-800">
			<div class="visual">
				<img src='<?=base_url('assets/images/gateways/mistermoney.png');?>'>
			</div>
			<div class="details">
				<div class="number"><?php echo ($settings->mistermoney == "Y" ? "<font color='green'><b>ATIVO</b></font>" : "<font color='red'><b>INATIVO</b></font>" ); ?></div>
			</div>
			<a class="more" href="<?=site_url('admin/gateways/mistermoney');?>">
				MISTERMONEY <i class="fa fa-arrow-right"></i>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat bg-teal-800">
			<div class="visual">
				<img src='<?=base_url('assets/images/gateways/transferencia.png');?>'>
			</div>
			<div class="details">
				<div class="number"><?php echo ($settings->transferencia == "Y" ? "<font color='green'><b>ATIVO</b></font>" : "<font color='red'><b>INATIVO</b></font>" ); ?></div>
			</div>
			<a class="more" href="<?=site_url('admin/gateways/transferencia');?>">
				TRANSFERÊNCIA BANCÁRIA <i class="fa fa-arrow-right"></i>
			</a>
		</div>
	</div>
</div>
	</div>
</div>