<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<!-- <script type="text/javascript" src="<?=base_url('assets/js/charts/google/lines/area.js');?>"></script> -->
<!-- BEGIN PANEL STATS -->
<div class="row">
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat bg-success-800">
			<div class="visual">
				<i class="icon-users"></i>
			</div>
			<div class="details">
				<div class="number"><?=$members;?></div>
				<div class="desc">Afiliados</div>
			</div>
			<a class="more" href="<?=site_url('admin/users');?>">
				View more <i class="fa fa-arrow-right"></i>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat bg-primary-800">
			<div class="visual">
				<i class="icon-coins"></i>
			</div>
			<div class="details">
				<div class="number"><?=display_money($revenues);?></div>
				<div class="desc">Total Faturado</div>
			</div>
			<a class="more" href="javascript:;">
				View more <i class="fa fa-arrow-right"></i>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat bg-danger-800">
			<div class="visual">
				<i class="icon-coins"></i>
			</div>
			<div class="details">
				<div class="number"><?=display_money($expenses);?></div>
				<div class="desc">Total em Bônus</div>
			</div>
			<a class="more" href="javascript:;">
				View more <i class="fa fa-arrow-right"></i>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat bg-purple-800">
			<div class="visual">
				<i class="icon-wallet"></i>
			</div>
			<div class="details">
				<div class="number"><?=display_money($balance);?></div>
				<div class="desc">Saldo</div>
			</div>
			<a class="more" href="javascript:;">
				View more <i class="fa fa-arrow-right"></i>
			</a>
		</div>
	</div>
</div>
<!-- END PANEL STATS -->
<div class="row">
	<div class="col-sm-6">
		<div class="panel">
			<div class="panel-heading p-10 border-bottom-orange">
				<h5 class="panel-title"><i class="icon-list3 position-left"></i> Últimos Acessos</h5>
			</div>
			<!-- <div class="panel-body no-padding pl-10 pr-10"> -->
				<div class="table-responsive no-border">
					<table class="table table-xs table-striped">
						<thead><tr>
							<th class="text-center">Data</th>
							<th>Nome</th>
						</tr></thead>
						<tbody><?php foreach ($last_logins as $user):?>
							<tr>
								<td class="text-center">
								<?=date($this->settings->date_format, strtotime($user->last_login));?> às <?=date($this->settings->date_time_format, strtotime($user->last_login));?>
								</td>
								<td><a href="<?=site_url('admin/users/view/' . $user->id);?>"><?=$user->firstname . ' ' . $user->lastname;?></a></td>
							</tr>
						<?php endforeach; ?></tbody>
					</table>
				</div>
			<!-- </div> -->
		</div>
	</div>
	<div class="col-sm-6">
		<div class="panel">
			<div class="panel-heading p-10 border-bottom-indigo">
				<h5 class="panel-title"><i class="icon-list3 position-left"></i> Últimos cadastros</h5>
			</div>
				<div class="table-responsive no-border">
					<table class="table table-xs table-striped">
						<thead><tr>
							<th class="text-center">Data</th>
							<th>Nome</th>
						</tr></thead>
						<tbody><?php foreach ($last_members as $user):?>
							<tr>
								<td class="text-center"><?=date($this->settings->date_format, strtotime($user->create_date));?></td>
								<td><a href="<?=site_url('admin/users/view/' . $user->id);?>"><?=$user->firstname . ' ' . $user->lastname;?></a></td>
							</tr>
						<?php endforeach; ?></tbody>
					</table>
				</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-8">
		<div class="panel">
			<div class="panel-heading p-10 border-bottom-purple-700">
				<h5 class="panel-title"><i class="icon-chart position-left"></i> Crescimento da rede</h5>
			</div>
				<div class="chart-container">
					<div class="chart" id="members-chart"></div>
				</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	// Initialize chart
	google.load("visualization", "1", {
		packages:["corechart"]
	});
	google.setOnLoadCallback(drawMembersChart);

	<?php
		$months					= [];
		$months[date('Y-m')]	= 0;
		for ($i = 1; $i < 6; $i++)
			$months[date('Y-m', strtotime("-$i month"))] = 0;

		foreach ($members_graph as $value)
			$months[$value->date_formatted]	= $value->amount;
		$data = array_reverse($months);
	?>

	// Members chart
	function drawMembersChart() {
		// Data
		var data = google.visualization.arrayToDataTable([
			['Ano', 'Total'],
			<?php foreach ($data as $key => $value):
				$meses = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];
				list($year, $month) = explode('-', $key);
				$legend = $meses[((int)$month) - 1];
				echo "['" . str_replace('-', '/', $legend) . "', {$value}],\r\n";
			endforeach; ?>
		]);

		// Options
		var options = {
			height: 300,
			curveType: 'function',
			areaOpacity: 0.4,
			chartArea: {
				left: '10%',
				right: '5%',
				width: '95%',
				height: '70%',
				// height: 250
			},
			colors: ['#1565C0', '#2E7D32', '#C62828'],
			pointSize: 4,
			vAxis: {
				title: 'Crescimento da Rede',
				titleTextStyle: {
					fontSize: 13,
					italic: false,
					bold: true
				},
				format: 'short'
			},
			hAxis: {
				title: 'Últimos 6 meses',
				titleTextStyle: {
					fontSize: 12,
					alignment: 'end',
					italic: false,
					bold: true
				}
			},
			legend: {
				position: 'top',
				alignment: 'end',
				textStyle: {
					fontSize: 12
				}
			}
		};

		// Draw chart
		var members_chart = new google.visualization.AreaChart($('#members-chart')[0]);
		members_chart.draw(data, options);
	}
	// Resize chart
	// ------------------------------
	$(function () {
		// Resize chart on sidebar width change and window resize
		$(window).on('resize', function() {
			drawMembersChart();
		});
	});
</script>