<div class="row">
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat bg-success-800">
			<div class="visual">
				<i class="icon-earth"></i>
			</div>
			<div class="details">
				<div class="number"><?=$users_total;?></div>
				<div class="desc">Total de usuários</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat bg-primary-800">
			<div class="visual">
				<i class="icon-checkmark"></i>
			</div>
			<div class="details">
				<div class="number"><?=($users_active);?></div>
				<div class="desc">Total Ativos</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat bg-danger-800">
			<div class="visual">
				<i class="icon-enter"></i>
			</div>
			<div class="details">
				<div class="number"><?=($users_month);?></div>
				<div class="desc">Novos este mês</div>
			</div>
		</div>
	</div>
</div>
<div class="panel">
	<div class="panel-heading p-10 border-bottom-orange">
		<h5 class="panel-title"><i class="icon-users4 position-left"></i> Lista de associados</h5>
	</div>
	<div class="table-responsive">
		<table class="table table-xs data">
			<thead><tr>
				<th width="10">#</th>
				<th>Status</th>
				<th>Nome</th>
				<th>E-mail</th>
				<th>Telefone</th>
				<th>Celular</th>
				<th>Saldo</th>
				<th>Saldo Reerv.</th>
			</tr></thead>
			<tbody>
				<?php foreach ($users as $user): ?><tr>
					<td class="text-center"><?=$user->id;?></td>
					<td><span class="label label-<?php 
					if($user->banned == 'Y'):

						echo 'warning';

					elseif($user->status != 'active'):

						echo 'default';

					else:

						echo 'success';

					endif; ?>"><?php 
					
					if($user->banned == 'Y'):

						echo 'BLOQUEADO';

					elseif($user->status != 'active'):

						echo 'PENDENTE';

					else:

						echo 'ATIVO';

					endif; ?></span></td>
					<td><a href="<?=site_url('admin/users/view/' . $user->id);?>"><?=($user->firstname . ' ' . $user->lastname);?></td>
					<td><?=$user->email;?></td>
					<td class="text-center"><?=$user->phone;?></td>
					<td class="text-center"><?=$user->mobilephone;?></td>
					<td class="text-center"><span class="label <?=($user->balance > 0 ? 'label-success' : ($user->balance < 0 ? 'label-danger' : 'label-default'));?>"><?=display_money($user->balance);?></td>
					<td><span class="label <?=($user->balance_reserved > 0 ? 'label-primary' : ($user->balance_reserved < 0 ? 'label-danger' : 'label-default'));?>"><?=display_money($user->balance_reserved);?></span></td>
				</tr><?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function () {
		$('.data').dataTable();
	})
</script>