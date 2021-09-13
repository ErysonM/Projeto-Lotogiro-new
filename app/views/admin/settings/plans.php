<?php
/**
 * mmn.dev
 * Arquivo:     plans.php
 * Autor:       Felipe Medeiros
 * Criado em:   25/05/16 02:29
 */
?>
<div class="panel">
	<div class="panel-heading p-10 border-bottom-primary-800 border-bottom-lg">
		<h5 class="panel-title"><i class="icon-package position-left"></i> Lista de Planos</h5>
					<div class="text-right">
				<a href="<?=site_url('admin/system/plancreate');?>"><span class="btn btn-primary">Adicionar novo <i class="icon-file-plus position-right"></i></span></a>
			</div>
	</div>
	<div class="table-responsive">
		<table class="table data">
			<thead><tr>
				<th width="10px">#</th>
				<th>Plano</th>
				<th>Valor</th>
				<th class="text-center">Status</th>
				<th width="100px">Editar</th>
			</tr></thead>
			<tbody><?php foreach($plans as $plan): ?>
				<tr>
					<td class="text-center"><?=$plan->id;?></td>
					<td><?=$plan->name;?></td>
					<td><?=display_money($plan->value);?></td>
					<td class="text-center">
						<span class="label label-<?=($plan->status == 'Y' ? 'success' : 'danger');?>"><?=($plan->status == 'Y' ? 'Ativo' : 'Inativo');?></span>
					</td>
					<td class="text-center">
						<ul class="icons-list">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="icon-menu9"></i>
								</a>
								<ul class="dropdown-menu dropdown-menu-right">
									<li><a href="<?=site_url('admin/system/planedit/' . $plan->id);?>"><i class="icon-pencil"></i> Editar</a></li>
									<li><a href="<?=site_url('admin/system/plandelete/' . $plan->id);?>" onclick="return confirm('Você tem certeza?')"><i class="icon-trash"></i> Excluir</a></li>
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