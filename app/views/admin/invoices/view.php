<?php
/**
 * Project:    mmn.dev
 * File:       view.php
 * Author:     Felipe Medeiros
 * Createt at: 27/05/2016 - 20:47
 */
?>
<div class="panel">
	<div class="panel-heading p-10 border-bottom-indigo">
		<h5 class="panel-title"><i class="icon-info3 position-left"></i> Detalhes da Fatura</h5>
	</div>
	<div class="table-responsives">
		<div class="row">
			<div class="col-sm-6">
				<table class="table">
					<tr>
						<td style="width: 120px;"><b>Fatura Nº:</b></td>
						<td><?=$invoice->id;?></td>
					</tr>
					<tr>
						<td style="width: 120px;"><b>Categoria:</b></td>
						<td><span class="label label-info">
						<?php 
							if($invoice->type == 'buy') 	echo 'Adesão';
						elseif($invoice->type == 'upgrade') echo 'Upgrade';
						elseif($invoice->type == 'monthly') echo 'Mensalidade';
						elseif($invoice->type == 'recharge') echo 'Recarga';
						?>
					</span></td>
					</tr>
					<tr>
						<td><b>Status:</b></td>
						<td><span class="label label-default <?php
							if ($invoice->status == "paid")
								echo 'label-success';
							elseif ($invoice->status == "open")
								echo 'label-primary';
							elseif ($invoice->status == "canceled")
								echo 'label-danger';
							?>"><?=($invoice->status == 'paid' ? 'Pago' : ($invoice->status == 'canceled' ? 'Cancelada' : 'Aberta'));?></span></td>
					</tr>
					<tr>
						<td><b>Gerado em:</b></td>
						<td><?=date('d/m/Y', strtotime($invoice->date));?></td>
					</tr>
					<tr>
						<td><b>Pago em:</b></td>
						<td><?php
						if ($invoice->status == 'paid')
							echo date('d/m/Y à\s H:i:s', strtotime($invoice->payment_date));
						else
							echo '-';
						?></td>
					</tr>
				</table>
			</div>
			<div class="col-sm-6">
				<table class="table">
					<tr>
						<td style="width: 120px;"><b>Cliente:</b></td>
						<td><?=($user->firstname . ' ' . $user->lastname);?></td>
					</tr>
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
						<td><b>Metodo de pagamento:</b></td>
						<td><?php
						if ($invoice->status == 'paid'){
							if($invoice->payment_method == 'payout')
								echo 'Pagar faturas';
							elseif($invoice->payment_method == '')
								echo '-';
							else 
								echo ucfirst($invoice->payment_method);
						} else {
							echo '-';
						}
						?></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="panel">
	<div class="panel-heading p-10 border-bottom-indigo">
		<h5 class="panel-title"><i class="icon-list3 position-left"></i> Itens da Fatura</h5>
	</div>
	<div class="table-responsive">
		<table class="table table-striped">
			<thead><tr>
				<th class="text-center">#</th>
				<th>Item</th>
				<th>Descrição</th>
				<th class="text-center">Quantidade</th>
				<th class="text-right">Valor unitário</th>
				<th class="text-right">Sub Total</th>
			</tr></thead>
			<tbody><?php if(count($invoice->invoices_items) != 0): ?>
				<?php $sum = 0; $i = 1; foreach ($invoice->invoices_items as $item): ?><tr>
					<td class="text-center"><?=$i;?></td>
					<td class="text-left"><?=$item->name;?></td>
					<td class="text-left"><?=($item->description ? character_limiter($item->description, 50) : '-');?></td>
					<td class="text-center"><?=$item->amount;?></td>
					<td class="text-right"><?=display_money($item->value);?></td>
					<td class="text-right"><?=display_money(($item->value * $item->amount));?></td>
					<?php $sum += $item->amount * $item->value;?>
					</tr><?php ++$i; endforeach; ?>
			<?php else: ?>
				<tr><td colspan="6" class="text-center">Nenhum item nesta fatura.</td></tr>
			<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>
<div class="row">
	<div class="col-lg-4 col-sm-5 notice">
		<div class="well mb-20"><?=($invoice->notes ? nl2br($invoice->notes) : '<div class="text-center">--</div>');?></div>
	</div><!--/col-->
	<div class="col-lg-4 col-lg-offset-4 col-sm-5 col-sm-offset-2 recap">
		<div class="panel">
			<table class="table table-clear">
				<tr>
					<td class="left"><strong>Sub Total</strong></td>
					<td class="right"><?=display_money($sum);?></td>
				</tr>
				<?php
				if(substr($invoice->discount, -1) == "%")
					$discount = sprintf("%01.2f", round(($sum / 100) * substr($invoice->discount, 0, -1), 2));
				else
					$discount = $invoice->discount;
				$sum -= $discount;
				?>
				<?php if ($discount != 0): ?>
					<tr>
						<td class="left"><strong>Descontos</strong></td>
						<td class="right"><?=display_money($discount);?></td>
					</tr>
				<?php endif; ?>
				<tr>
					<td class="left"><strong>Total</strong></td>
					<td class="right"><strong><?=display_money($sum);?></strong></td>
				</tr>
			</table>
		</div>
		<div class="text-center mb-10">
			<div class="row">
				<div class="col-sm-6">
					<a class="btn btn-primary btn-block btn-labeled mb-10" data-toggle="modal" data-target="#modal_comprovante">
						<b><i class="icon-file-upload"></i></b> Ver comprovantes
					</a>
				</div>
				<div class="col-sm-6">
					<?php if($invoice->status == 'open'): ?>
					<a href="<?=base_url('admin/invoices/cancel/' . $invoice->id);?>" class="btn btn-danger btn-icon mb-10" data-popup="tooltip" title="Cancelar fatura">
						<b><i class="icon-x"></i></b>
					</a>

					<a href="<?=base_url('admin/invoices/paid/' . $invoice->id);?>" class="btn btn-success btn-icon mb-10" data-popup="tooltip" title="Marcar como pago">
						<b><i class="icon-checkmark5"></i></b>
					</a>
				<?php endif; ?>

				</div>
			</div>
		</div>
	</div><!--/col-->
</div><!--/row-->

<div id="modal_comprovante" class="modal fade">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header p-10 bg-primary">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title"><i class="icon-file-upload position-left"></i> Comprovantes</h5>
			</div>
			<div class="modal-body">
				<div class="text-center">
					<?php if (Comprovant::count(array('conditions' => array('invoice_id = ?', $invoice->id))) > 0): ?>
					<span class="label label-success label-block mb-5">Possui arquivos anexados.</span>
					<?php else: ?>
					<span class="label label-danger label-block mb-5">Nenhum arquivo anexado.</span>
					<?php endif; ?>
					<br>
					<div class="table-responsive">
					<table class="table table-xs table-striped">
					<?php if (Comprovant::count(array('conditions' => array('invoice_id = ?', $invoice->id))) > 0): ?>
					<tr><td>#</td><td>Arquivos</td></tr>
					<?php endif; ?>
					<?php 
					$i = 1;
					foreach ($comprovants as $comprovant):
					?>
					<tr>
					<td><?php echo $i;?></td>
					<td><a href="<?=base_url('assets/uploads');?>/<?php echo $comprovant->filename;?>" target="_blank"><?php echo $comprovant->filename_original;?><a></td>
					</tr>
					<?php 
					$i++;
					endforeach; 
					?>
					</table>
					</div>
					<br>
					<div class="alert alert-info alert-styled-left p-5 no-margin text-left">
						<span class="text-semibold">Valor do pedido:</span> &nbsp;<?=display_money($sum);?>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-xs btn-labeled" data-dismiss="modal">
					<b><i class="icon-x"></i></b> Fechar
				</button>
			</div>
		</div>
	</div>
</div>