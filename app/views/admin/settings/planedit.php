<div class="panel panel-flat">
	<div class="panel-body">
		<form method="post" class="form-horizontal">
			<div class="form-group row">
				<label for="name" class="col-sm-3 control-label"><b>Nome:</b></label>
				<div class="col-sm-5"><input id="name" name="name" class="form-control" type="text" value="<?=$plan->name;?>" required/></div>
			</div>
			<div class="form-group row">
				<label for="status" class="col-sm-3 control-label"><b>Status:</b></label>
				<div class="col-sm-5">
				<?php $options = array(
				'Y'	=> 'Ativo',
				'N'	=> 'Inativo',
					);
			echo form_dropdown('status', $options, $plan->status, 'class="form-control"'); ?>
				</div>
			</div>
			<div class="form-group row">
				<label for="description" class="col-sm-3 control-label"><b>Descrição:</b></label>
				<div class="col-sm-5">
				<textarea name="description" class="form-control" id="description" required><?=nl2br($plan->description);?></textarea>
				</div>
			</div>
			<div class="form-group row">
				<label for="value" class="col-sm-3 control-label"><b>Valor:</b></label>
				<div class="col-sm-5"><input id="value" name="value" class="form-control money-mask" type="text" value="<?=display_money2($plan->value);?>" required/></div>
			</div>
			<div class="form-group row">
				<label for="old_value" class="col-sm-3 control-label"><b>Valor Antigo:</b></label>
				<div class="col-sm-5"><input id="old_value" name="old_value" class="form-control money-mask" type="text" value="<?=display_money2($plan->old_value);?>" required/></div>
			</div>
			<div class="form-group row">
				<label for="date" class="col-sm-3 control-label"><b>Data de criação:</b></label>
				<div class="col-sm-5"><?=date($this->settings->date_format . " " . $this->settings->date_time_format, strtotime($plan->create_date));?></div>
			</div>
			<div class="form-group row">
				<label for="date" class="col-sm-3 control-label"><b>Ultima edição:</b></label>
				<div class="col-sm-5"><?=date($this->settings->date_format . " " . $this->settings->date_time_format, strtotime($plan->last_edit));?></div>
			</div>
			<div class="form-group row">
				<label for="last_editor" class="col-sm-3 control-label"><b>Ultimo editor:</b></label>
				<div class="col-sm-5">
				<div class="col-sm-5"><?=$lasteditor->firstname;?> <?=$lasteditor->lastname;?></div>
				</div>
			</div>
			<div class="text-right">
			<button type="button" class="btn bg-teal btn-labeled" onclick="window.location.href='<?=site_url('admin/system/plans');?>'"><b><i class="icon-circle-left2"></i></b>Voltar</button>
				<button type="submit" class="btn btn-primary btn-labeled"><b><i class="icon-floppy-disk"></i></b>Alterar</button>
			</div>
		</form>
	</div>
</div>