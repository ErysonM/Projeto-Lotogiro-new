<div class="panel panel-flat">
	<div class="panel-body">
		<form method="post" class="form-horizontal">
			<div class="form-group row">
				<label for="status" class="col-sm-3 control-label"><b>Status:</b></label>
				<div class="col-sm-5">
				<span class="label label-default <?php
							if ($lottery->status == "paid")
								echo 'label-success';
							elseif ($lottery->status == "open")
								echo 'label-primary';
							elseif ($lottery->status == "cancel")
								echo 'label-danger';
							?>"><?=($lottery->status == 'paid' ? 'Paga' : ($lottery->status == 'cancel' ? 'Cancelada' : 'Aberta'));?>
				</span>
				</div>
			</div>
			<div class="form-group row">
				<label for="name" class="col-sm-3 control-label"><b>Titulo:</b></label>
				<div class="col-sm-5"><input id="name" name="name" class="form-control" type="text" value="<?=$lottery->name;?>" required/></div>
			</div>
			<div class="form-group row">
				<label for="description" class="col-sm-3 control-label"><b>Descrição:</b></label>
				<div class="col-sm-5">
				<textarea name="description" class="form-control" id="description" required><?=$lottery->description;?></textarea>
				</div>
			</div>
			<div class="form-group row">
				<label for="type" class="col-sm-3 control-label"><b>Tipo Loteria:</b></label>
				<div class="col-sm-5">
				<?php $options = array(
				'fix'	=> 'Premio Fixo',
				'acum'	=> 'Premio Acumulativo',
					);
			echo form_dropdown('type', $options, $lottery->type, 'class="form-control"'); ?>
				</div>
			</div>
			<div class="form-group row">
				<label for="ticket_price" class="col-sm-3 control-label"><b>Valor Ticket:</b></label>
				<div class="col-sm-5">
				<input id="ticket_price" name="ticket_price" class="form-control money-mask" type="text" value="<?=$lottery->ticket_price;?>" disabled required/>
				</div>
			</div>
			<div class="form-group row">
				<label for="max_tickets" class="col-sm-3 control-label"><b>Máximo de Tickets Vendidos:</b></label>
				<div class="col-sm-5">
				<input id="max_tickets" name="max_tickets" class="form-control" type="number" min="0" value="<?=$lottery->max_tickets;?>" required/>
				</div>Deixe 0 para não ter limite.
			</div>
			<div class="form-group row">
				<label for="max_tickets_person" class="col-sm-3 control-label"><b>Máximo de Tickets por Pessoa:</b></label>
				<div class="col-sm-5">
				<input id="max_tickets_person" name="max_tickets_person" class="form-control" type="number" min="0" value="<?=$lottery->max_tickets_person; ?>" required/>
				</div>Deixe 0 para não ter limite.
			</div>
			<div class="form-group row">
				<label for="percent_emp" class="col-sm-3 control-label"><b>Porcentagem do prêmio p/ empresa:</b></label>
				<div class="col-sm-5">
				<input id="percent_emp" name="percent_emp" class="form-control" type="number" min="0" max="100" value="<?=$lottery->percent_emp; ?>" required/>
				</div>Deixe 0 para não ter % sobre o prêmio.
			</div>
			<div class="form-group row">
				<label for="winners" class="col-sm-3 control-label"><b>N. Ganhadores:</b></label>
				<div class="col-sm-5">
				<?php $options = array(
				'1'	=> '1',
				'2'	=> '2',
				'3'	=> '3',
				'4'	=> '4',
				'5'	=> '5',
					);
			echo form_dropdown('winners', $options, $lottery->winners, 'class="form-control" disabled'); ?>
				</div>
			</div>
			<div class="form-group row">
				<label for="winner" class="col-sm-3 control-label"><b>Ganhador:</b></label>
				<div class="col-sm-5">
				<?php
				if($lottery->status == 'paid') echo "".$winner->firstname." ".$winner->lastname." (#".$winner->id.")";
				else echo "-";
				?>
				</div>
			</div>
			<div class="form-group row">
				<label for="value_total" class="col-sm-3 control-label"><b>Valor Arrecadado:</b></label>
				<div class="col-sm-5">
				<?php
				if($lottery->status == 'paid') echo display_money($lottery->value_total);
				else echo "-";
				?>
				</div>
			</div>
			<div class="form-group row">
				<label for="value_win" class="col-sm-3 control-label"><b>Valor prêmio pago:</b></label>
				<div class="col-sm-5">
				<?php
				if($lottery->status == 'paid') echo display_money($lottery->value_win);
				else echo "-";
				?>
				</div>
			</div>
			<div class="form-group row">
				<label for="value_initial" class="col-sm-3 control-label"><b>Valor inicial:</b></label>
				<div class="col-sm-5">
				<input id="value_initial" name="value_initial" class="form-control money-mask" type="text" value="<?=$lottery->value_initial; ?>" required/>
				</div>Deixe 0 para não ter valor inicial, se a loteria for fixa o valor inicial será o valor do prêmio.
			</div>
			<div class="form-group row">
				<label for="buyed_tickets" class="col-sm-3 control-label"><b>Tickets vendidos:</b></label>
				<div class="col-sm-5">
				<input id="buyed_tickets" name="buyed_tickets" class="form-control" type="number" min="0" value="<?=$lottery->buyed_tickets; ?>" required/>
				</div>Deixe 0 para não ter tickets vendidos. Se a loteria for acumulativa vai influenciar no valor do prêmio.
			</div>
			<div class="form-group row">
				<label for="date" class="col-sm-3 control-label"><b>Data de criação:</b></label>
				<div class="col-sm-5"><?=date($this->settings->date_format . " " . $this->settings->date_time_format, strtotime($lottery->starts));?></div>
			</div>
			<div class="form-group row">
				<label for="last_editor" class="col-sm-3 control-label"><b>Criador do sorteio:</b></label>
				<div class="col-sm-5">
				<div class="col-sm-5"><?=$create_by->firstname;?> <?=$create_by->lastname;?></div>
				</div>
			</div>
			<div class="form-group row">
				<label for="ends" class="col-sm-3 control-label"><b>Data do sorteio:</b></label>
				<div class="col-sm-5">
				<input id="ends" name="ends" class="form_datetime form-control" type="text" value="<?=$lottery->ends;?>" required readonly  size="16"/>
				</div> Data onde ocorre a premiação.
			</div>
			<div class="form-group row">
				<label for="date" class="col-sm-3 control-label"><b>Ultima edição:</b></label>
				<div class="col-sm-5"><?=date($this->settings->date_format . " " . $this->settings->date_time_format, strtotime($lottery->last_edit));?></div>
			</div>
			<div class="form-group row">
				<label for="last_editor" class="col-sm-3 control-label"><b>Ultimo editor:</b></label>
				<div class="col-sm-5">
				<div class="col-sm-5"><?=$lasteditor->firstname;?> <?=$lasteditor->lastname;?></div>
				</div>
			</div>
			<div class="text-right">
			<button type="button" class="btn bg-teal btn-labeled" onclick="window.location.href='<?=site_url('admin/lotterys');?>'"><b><i class="icon-circle-left2"></i></b>Voltar</button>
			<?php if($lottery->status == 'open'): ?>
			<button type="button" class="btn bg-danger btn-labeled" onclick="verifydelete()"><b><i class="icon-trash"></i></b>Cancelar</button>
			<?php endif; ?>
			<button type="submit" class="btn btn-primary btn-labeled"><b><i class="icon-floppy-disk"></i></b>Alterar</button>
			</div>
		</form>
	</div>
</div>

			<script>
			function verifydelete(){
				var r = confirm("Você tem certeza? Os tickets vendidos serão reembolsados.");
				if (r == true) {
					location.href='<?=site_url('admin/lotterys/cancel/' . $lottery->id);?>';
				}
			}
			</script>