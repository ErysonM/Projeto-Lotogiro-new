<div class="panel panel-flat">
	<div class="panel-body">
		<form method="post" class="form-horizontal">
			<div class="form-group row">
				<label for="firstname" class="col-sm-3 control-label"><b>Nome:</b></label>
				<div class="col-sm-5"><input id="firstname" name="firstname" class="form-control" type="text" value="<?=$admin->firstname;?>" required/></div>
			</div>
			<div class="form-group row">
				<label for="lastname" class="col-sm-3 control-label"><b>Sobrenome:</b></label>
				<div class="col-sm-5">
				<input id="lastname" name="lastname" class="form-control" type="text" value="<?=$admin->lastname;?>" required/>
				</div>
			</div>
			<div class="form-group row">
				<label for="email" class="col-sm-3 control-label"><b>E-mail:</b></label>
				<div class="col-sm-5">
				<input id="email" name="email" class="form-control" type="email" value="<?=$admin->email;?>" required/>
				</div>
			</div>
			<div class="form-group row">
				<label for="password" class="col-sm-3 control-label"><b>Senha:</b></label>
				<div class="col-sm-5">
				<input id="password" name="password" class="form-control" type="password" value=""/> * Preencha caso queira alterar.
				</div>
			</div>
			<div class="form-group row">
				<label for="repassword" class="col-sm-3 control-label"><b>Repita Senha:</b></label>
				<div class="col-sm-5">
				<input id="repassword" name="repassword" class="form-control" type="password" value=""/>
				</div>
			</div>
			<div class="form-group row">
				<label for="status" class="col-sm-3 control-label"><b>Status:</b></label>
				<div class="col-sm-5">
				<?php $options = array(
				'Y'	=> 'Ativo',
				'N'	=> 'Inativo',
					);
			echo form_dropdown('status', $options, $admin->status, 'class="form-control"'); ?>
				</div>
			</div>
			<div class="form-group row">
				<label for="date" class="col-sm-3 control-label"><b>Data de criação:</b></label>
				<div class="col-sm-5"><?=date($this->settings->date_format . " " . $this->settings->date_time_format, strtotime($admin->create_date));?></div>
			</div>
			<div class="form-group row">
				<label for="date" class="col-sm-3 control-label"><b>Ultima edição:</b></label>
				<div class="col-sm-5"><?=date($this->settings->date_format . " " . $this->settings->date_time_format, strtotime($admin->last_edit));?></div>
			</div>
			<div class="form-group row">
				<label for="last_editor" class="col-sm-3 control-label"><b>Ultimo editor:</b></label>
				<div class="col-sm-5">
				<div class="col-sm-5"><?=$lasteditor->firstname;?> <?=$lasteditor->lastname;?></div>
				</div>
			</div>
			<div class="text-right">
			<button type="button" class="btn bg-teal btn-labeled" onclick="window.location.href='<?=site_url('admin/system/users');?>'"><b><i class="icon-circle-left2"></i></b>Voltar</button>
				<button type="submit" class="btn btn-primary btn-labeled"><b><i class="icon-floppy-disk"></i></b>Alterar</button>
			</div>
		</form>
	</div>
</div>