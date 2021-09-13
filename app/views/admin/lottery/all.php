<?php
/**
 * mmn.dev
 * Arquivo:     all.php
 * Autor:       Felipe Medeiros
 * Criado em:   25/05/16 02:29
 */
?>
<div class="alert alert-info alert-styled-left">
	<span class="text-semibold">Atenção!</span> O sistema de loteria atualmente só premia um ganhador por sorteio.<br> 
	É planejado um upgrade futuro do sistema para poder premiar mais de um ganhador e com valores de prêmios diferentes por sorteio.<br>
	Ex: 1º Sorteado ganhou U$100, 2º Sorteado ganhou U$50, 3º Sorteado ganhou U$10, etc.
</div>

<div class="panel">
	<div class="panel-heading p-10 border-bottom-primary-800 border-bottom-lg">
		<h5 class="panel-title"><i class="icon-ticket position-left"></i> Lista de Loterias</h5>
					<div class="text-right">
				<a href="<?=site_url('cron/lottery/executelottery');?>"><span class="btn btn-info">Rodar Loterias <i class="icon-gift position-right"></i></span></a>	
				<a href="<?=site_url('admin/lotterys/create');?>"><span class="btn btn-primary">Adicionar nova <i class="icon-file-plus position-right"></i></span></a>
			</div>
	</div>

	<div class="table-responsive">
		<table class="table data">
			<thead><tr>
				<th width="10px">#</th>
				<th>Titúlo</th>
				<th>Status</th>
				<th>Tipo</th>
				<th>Inicio</th>
				<th>Fim</th>
				<th>Tickets vendidos</th>
				<th>Preço Ticket</th>
				<th>Prêmio</th>
				<th width="100px">Editar</th>
			</tr></thead>
			<tbody><?php foreach($lotterys as $lottery): ?>
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
							?>"><?=($lottery->status == 'paid' ? 'Paga' : ($lottery->status == 'cancel' ? 'Cancelada' : 'Aberta'));?></span></td>
					<td><?php
							if ($lottery->type == "fix") echo 'Fixo';
							else echo 'Acumulativo';
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
						<ul class="icons-list">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="icon-menu9"></i>
								</a>
								<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="<?=site_url('admin/lotterys/edit/' . $lottery->id);?>"><i class="icon-pencil"></i> Editar</a></li>
								<?php if($lottery->status == "open"): ?>
								<li><a href="<?=site_url('admin/lotterys/cancel/' . $lottery->id);?>" onclick="return confirm('Você tem certeza? Os tickets vendidos serão reembolsados.')"><i class="icon-trash"></i> Cancelar</a></li>
								<?php endif; ?>
								</ul>
							</li>
						</ul>
					</td>
				</tr>
			<?php endforeach;?></tbody>
		</table>
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