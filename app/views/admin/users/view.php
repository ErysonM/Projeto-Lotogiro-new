<div class="panel">
	<div class="panel-heading p-10 border-bottom-indigo ">
		<h5 class="panel-title"><i class="icon-info3 position-left"></i> Detalhes do Associado</h5>
		<div class="heading-elements">
			<div class="btn-group heading-btn">
				<a href="<?=site_url('admin/users/backoffice/' . $user->id);?>" class="btn btn-primary" target="_blank">Acessar</a>
				<button class="btn dropdown-toggle btn-primary <?=($this->user->id == $user->id ? 'disabled' : '');?>" data-toggle="dropdown"><i class="fa fa-caret-down"></i></button>
				<ul class="dropdown-menu pull-right">
					<li><a href="<?=site_url('admin/users/edit/' . $user->id);?>"><i class="fa fa-pencil-square-o fa-fw"></i> Editar</a></li>
					<li><a data-toggle="modal" data-target="#modal_balance"><i class="fa fa-usd fa-fw"></i> Saldo</a></li>
					<li><a data-toggle="modal" data-target="#modal_ban"><i class="fa fa-exclamation-circle fa-fw"></i> Ban/Unban</a></li>
					<li><a href="<?=site_url('admin/users/link/' . $user->id);?>"><i class="fa fa-refresh fa-fw"></i> Liberar novo Link</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="table-responsives">
		<div class="row">
			<div class="col-sm-6">
				<table class="table">
					<tr>
						<td style="width: 150px;"><b>Link:</b></td>
						<td><?=($user->link != '' ? $user->link : 'Sem link definido.');?></td>
					</tr>
					<tr>
						<td><b>Nome:</b></td>
						<td><?=($user->firstname . ' ' . $user->lastname);?></td>
					</tr>
					<tr>
						<td><b>Email:</b></td>
						<td><?=$user->email;?></td>
					</tr>
					<tr>
						<td><b>Telefone</b></td>
						<td><?=($user->phone != '' ? $user->phone : '-');?></td>
					</tr>
					<tr>
						<td><b>Celular:</b></td>
						<td><?=($user->mobilephone != '' ? $user->mobilephone : '-');?></td>
					</tr>
					<tr>
						<td><b>Patrocinador:</b></td>
						<td><?=($user->enroller ? ('<a href="' . site_url('admin/users/view/' . $user->sponsor->id) . '">#' . $user->sponsor->id . ' - ' . $user->sponsor->firstname . ' ' . $user->sponsor->lastname . '</a>') : '-');?></td>
					</tr>
					<tr>
						<td><b>Cadastro:</b></td>
						<td><?=date($this->settings->date_format . " " . $this->settings->date_time_format, strtotime($user->create_date));?></td>
					</tr>
				</table>
			</div>
			<div class="col-sm-6">
				<table class="table">
					<tr>
						<td style="width: 150px;"><b>Status:</b></td>
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
					</tr>
					<tr>
						<td><b>Saldo:</b></td>
						<td><span class="label <?=($user->balance > 0 ? 'label-success' : ($user->balance < 0 ? 'label-danger' : 'label-default'));?>"><?=display_money($user->balance);?></span></td>
					</tr>
					<?php /*<tr>
						<td><b>Saldo&nbsp;Especial:</b></td>
						<td><span class="label <?=($user->balance_special > 0 ? 'label-success' : ($user->balance_special < 0 ? 'label-danger' : 'label-default'));?>"><?=display_money($user->balance_special);?></span></td>
					</tr>*/ ?>
					<tr>
						<td><b>Saldo&nbsp;Reservado:</b></td>
						<td><span class="label <?=($user->balance_reserved > 0 ? 'label-primary' : ($user->balance_reserved < 0 ? 'label-danger' : 'label-default'));?>"><?=display_money($user->balance_reserved);?></span></td>
					</tr>
					<?php /*<tr>
						<td><b>Pac&nbsp;Points:</b></td>
						<td><span class="label <?=($user->pacpoints > 0 ? 'label-primary' : ($user->pacpoints < 0 ? 'label-danger' : 'label-default'));?>"><?=display_money($user->pacpoints);?></span></td>
					</tr>*/ ?>
					<tr>
						<td><b>Endereço:</b></td>
						<td><?=$user->address_street;?>, <?=$user->address_number;?><?=(!empty($user->address_complement) ? ' - ' . $user->address_complement  : '');?></td>
					</tr>
					<tr>
						<td><b>Bairro/CEP:</b></td>
						<td><?=$user->address_district;?> - <?=$user->address_zip;?></td>
					</tr>
					<tr>
						<td><b>Cidade/UF:</b></td>
						<td><?=$user->address_city;?> - <?=$user->address_state;?></td>
					</tr>
					<tr>
						<td><b>Ultimo Login:</b></td>
						<td><?=date($this->settings->date_format . " " . $this->settings->date_time_format, strtotime($user->last_login));?></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="panel">
			<div class="panel-heading p-10 border-bottom-orange">
				<h5 class="panel-title"><i class="icon-users4 position-left"></i> Indicados</h5>
			</div>
			<div class="table-responsive">
				<table class="table table-xs data">
					<thead><tr>
						<th class="text-center" style="width: 10px">#</th>
						<th>Nome</th>
						<th class="text-center">Ação</th>
					</tr></thead>
					<tbody><?php foreach ($sponsored as $user2): ?>
						<tr>
							<td class="text-center"><?=$user2->id;?></td>
							<td><?=$user2->firstname . ' ' . $user2->lastname;?></td>
							<td class="text-center">
								<a href="<?=site_url('admin/users/view/' . $user2->id);?>" class="btn btn-icon btn-xs btn-primary"><i class="icon-eye"></i></a>
							</td>
						</tr>
					<?php endforeach;?></tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel">
			<div class="panel-heading p-10 border-bottom-orange">
				<h5 class="panel-title"><i class="icon-file-text position-left"></i> Faturas</h5>
			</div>
			<div class="table-responsive">
				<table class="table table-xs data">
					<thead><tr>
						<th class="text-center" style="width: 10px">#</th>
						<th>Categoria</th>
						<th>Valor</th>
						<th class="text-center">Status</th>
						<th class="text-center">Ação</th>
					</tr></thead>
					<tbody><?php foreach ($invoices as $invoice): ?>
						<tr>
							<td class="text-center"><?=$invoice->id;?></td>
							<td><span class="label label-info">
								<?=($invoice->type == 'buy' ? 'Adesão' : ($invoice->type == 'upgrade' ? 'Upgrade' : 'Outros'));?>
							</span></td>
							<td class="text-center"><span><span class="hidden"><?=($invoice->sum - $invoice->discount);?></span> <?=display_money(($invoice->sum - $invoice->discount));?></span></td>
							<td class="text-center"><span class="label <?php
								if ($invoice->status == "paid")
									echo 'label-success';
								elseif ($invoice->status == "open")
									echo 'label-info';
								elseif ($invoice->status == "canceled")
									echo 'label-warning';
								?>"><?=($invoice->status == 'open' ? 'Em aberto' : ($invoice->status == 'paid' ? 'Pago' : ($invoice->status == 'canceled' ? 'Cancelado' : '-')));?></span></td>
							<td class="text-center">
								<a href="<?=site_url('admin/invoices/view/' . $invoice->id);?>" class="btn btn-icon btn-xs btn-primary"><i class="icon-eye"></i></a>
								<a href="<?=site_url('admin/invoices/cancel/' . $invoice->id);?>" class="btn btn-icon btn-xs btn-danger"><i class="icon-x"></i></a>
							</td>
						</tr>
					<?php endforeach; ?></tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel">
			<div class="panel-heading p-10 border-bottom-orange">
				<h5 class="panel-title"><i class="icon-library2 position-left"></i> Saques</h5>
			</div>
			<div class="table-responsive">
				<table class="table table-xs data">
					<thead><tr>
						<th class="text-center" style="width: 10px">#</th>
						<th>Data</th>
						<th>Data Pgto</th>
						<th>Gateway</th>
						<th>Valor</th>
						<th>Status</th>
						<!--<th class="text-center">Ação</th>-->
					</tr></thead>
					<tbody><?php foreach ($withdrawals as $withdrawal): ?>
						<tr>
						<td><?=($withdrawal->id);?></td>
							<td><?=date($this->settings->date_format . " " . $this->settings->date_time_format, strtotime($withdrawal->date));?></td>
							<td><?=date($this->settings->date_format . " " . $this->settings->date_time_format, strtotime($withdrawal->payment_date));?></td>
							<td><?=ucfirst($withdrawal->gateway);?></td>
							<td><?=display_money(($withdrawal->value));?></td>
							<td class="text-center"><span class="label <?php
								if ($withdrawal->status == "paid")
									echo 'label-success';
								elseif ($withdrawal->status == "open")
									echo 'label-primary';
								elseif ($withdrawal->status == "chargeback")
									echo 'label-warning';
								?>"><?=($withdrawal->status == 'open' ? 'Em aberto' : ($withdrawal->status == 'paid' ? 'Pago' : ($withdrawal->status == 'chargeback' ? 'Estornado' : '-')));?></span></td>
							<!--<td class="text-center">
								<a href="<?=site_url('admin/withdrawals/view/' . $withdrawal->id);?>" class="btn btn-icon btn-xs btn-primary"><i class="icon-eye"></i></a>
							</td>-->
						</tr>
					<?php endforeach;?></tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div id="modal_balance" class="modal fade">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Creditar/Debitar Associado</h5>
			</div>

			<form action="<?=site_url('admin/users/balance/' . $user->id);?>" method="post" class="form-horizontal">
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label col-sm-3">Tipo:</label>
						<div class="col-sm-9">
							<select name="type" class="form-control" required>
								<option value="credit">Crédito</option>
								<option value="debit">Débito</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3">Valor:</label>
						<div class="col-sm-9">
							<input type="text" name="value" class="form-control money-mask" required />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3">Descrição:</label>
						<div class="col-sm-9">
							<input type="text" name="description" class="form-control" required />
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-link" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Ok</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div id="modal_ban" class="modal fade">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Ban/Unban Associado</h5>
			</div>

			<form action="<?=site_url('admin/users/ban/' . $user->id);?>" method="post" class="form-horizontal">
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label col-sm-3">Tipo:</label>
						<div class="col-sm-9">
							<select name="ban" class="form-control" required>
								<option value="Y">Banir</option>
								<option value="N">Desbanir</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3">Descrição:</label>
						<div class="col-sm-9">
							<input type="text" name="ban_description" class="form-control" />
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-link" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Ok</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function () {
		$('.data').dataTable();
	})
</script>