<?php
/**
 * mmn.dev
 * Arquivo:     all.php
 * Autor:       Felipe Medeiros
 * Criado em:   25/05/16 02:29
 */
?>
<div class="panel">
	<div class="panel-heading p-10 border-bottom-primary-800 border-bottom-lg">
		<h5 class="panel-title"><i class="icon-menu3 position-left"></i> Lista de administradores</h5>
					<div class="text-right">
				<a href="<?=site_url('admin/system/usercreate');?>"><span class="btn btn-primary">Adicionar novo <i class="icon-user-plus position-right"></i></span></a>
			</div>
	</div>
	<div class="table-responsive">
		<table class="table data">
			<thead><tr>
				<th width="10px">#</th>
				<th>E-mail</th>
				<th>Nome</th>
				<th>Cadastro</th>
				<th>Status</th>
				<th width="100px">Editar</th>
			</tr></thead>
			<tbody><?php foreach($admins as $admin): ?>
				<tr>
					<td class="text-center"><?=$admin->id;?></td>
					<td><?=$admin->email;?></td>
					<td><?=$admin->firstname;?> <?=$admin->lastname;?></td>
					<td><?=date($this->settings->date_format, strtotime($admin->create_date));?> às <?=date($this->settings->date_time_format, strtotime($admin->create_date));?></td>
					<td><span class="label <?php
						if ($admin->status == "Y")
							echo 'label-success';
						elseif ($admin->status == "N")
							echo 'label-danger';
						?>"><?php
						if($admin->status == 'Y') echo 'Ativo';
						else echo 'Inativo';
						?></span></td>
					<td class="text-center">
						<ul class="icons-list">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="icon-menu9"></i>
								</a>
								<ul class="dropdown-menu dropdown-menu-right">
									<li><a href="<?=site_url('admin/system/useredit/' . $admin->id);?>"><i class="icon-pencil"></i> Editar</a></li>
									<li><a href="<?=site_url('admin/system/userdelete/' . $admin->id);?>" onclick="return confirm('Você tem certeza?')"><i class="icon-trash"></i> Excluir</a></li>
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