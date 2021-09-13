<div class="panel panel-flat">
	<div class="panel-body">
		<form method="post" class="form-horizontal">
			<div class="form-group row">
				<label for="name" class="col-sm-3 control-label"><b>Nome:</b></label>
				<div class="col-sm-5"><input id="name" name="name" class="form-control" type="text" value="<?=$this->input->post('name');?>" required/></div>
			</div>
			<div class="form-group row">
				<label for="status" class="col-sm-3 control-label"><b>Status:</b></label>
				<div class="col-sm-5">
				<?php $options = array(
				'Y'	=> 'Ativo',
				'N'	=> 'Inativo',
					);
			echo form_dropdown('status', $options, $this->input->post('status'), 'class="form-control"'); ?>
				</div>
			</div>
			<div class="form-group row">
				<label for="description" class="col-sm-3 control-label"><b>Descrição:</b></label>
				<div class="col-sm-5">
				<textarea name="description" class="form-control" id="description" required><?=$this->input->post('description');?></textarea>
				</div>
			</div>
			<div class="form-group row">
				<label for="value" class="col-sm-3 control-label"><b>Valor:</b></label>
				<div class="col-sm-5"><input id="value" name="value" class="form-control money-mask" type="text" value="<?=display_money2($this->input->post('value'));?>" required/></div>
			</div>
			<div class="form-group row">
				<label for="date" class="col-sm-3 control-label"><b>Data de criação:</b></label>
				<div class="col-sm-5"><?=date($this->settings->date_format . " " . $this->settings->date_time_format, strtotime(date('Y-m-d H:i:s')));?></div>
			</div>
			<div class="text-right">
			<button type="button" class="btn bg-teal btn-labeled" onclick="window.location.href='<?=site_url('admin/system/plans');?>'"><b><i class="icon-circle-left2"></i></b>Voltar</button>
				<button type="submit" class="btn btn-primary btn-labeled"><b><i class="icon-file-plus"></i></b>Adicionar</button>
			</div>
		</form>
	</div>
</div>