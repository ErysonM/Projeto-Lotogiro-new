<div class="panel panel-flat">
<div class="panel-body">
<form method="post" class="form-horizontal">
<div class="form-group row">
<label for="sponsor" class="col-sm-3 control-label"><b>Patrocinador:</b></label>
<div class="col-sm-5"><input id="sponsor" class="form-control" type="text" value="<?=($sponsor->firstname . ' ' . $sponsor->lastname);?>" readonly="readonly" disabled/></div>
</div>
<div class="form-group row">
<label for="fullname" class="col-sm-3 control-label"><b>Nome completo:</b></label>
<div class="col-sm-5">
<input id="fullname" class="form-control" type="text" value="<?=($this->user->firstname . ' ' . $this->user->lastname);?>"/>
</div>
</div>
<div class="form-group row">
<label for="birthday" class="col-sm-3 control-label"><b>Data de nascimento:</b></label>
<div class="col-sm-5">
<input id="birthday" class="form-control date-mask" type="text" name="birthday" value="<?=date($this->settings->date_format, strtotime($this->user->birthday));?>"/>
</div>
</div>
<div class="form-group row">
<label for="cpf" class="col-sm-3 control-label"><b>CPF:</b></label>
<div class="col-sm-5">
<input id="cpf" class="form-control cpf-mask" type="text" name="cpf" value="<?=$this->user->cpf;?>"/>
</div>
</div>
<div class="form-group row">
<label for="gender" class="col-sm-3 control-label"><b>Sexo:</b></label>
<div class="col-sm-5">
<select class="form-control" name="gender" required>
<option value="female" <?php if ($this->user->gender == 'female'): echo 'selected'; endif;?>>Feminino</option>
<option value="male" <?php if ($this->user->gender == 'male'): echo 'selected'; endif;?>>Masculino</option>
</select>
</div>
</div>
<div class="form-group row">
<label for="phone" class="col-sm-3 control-label"><b>Telefone:</b></label>
<div class="col-sm-5">
<input id="phone" class="form-control phone-mask" type="text" name="phone" value="<?=$this->user->phone;?>" />
</div>
</div>
<div class="form-group row">
<label for="mobilephone" class="col-sm-3 control-label"><b>Celular:</b></label>
<div class="col-sm-5">
<input id="mobilephone" class="form-control mobilephone-mask" type="text" name="mobilephone" value="<?=$this->user->mobilephone;?>" />
</div>
</div>
<div class="form-group row">
<label for="email" class="col-sm-3 control-label"><b>E-mail:</b></label>
<div class="col-sm-5">
<input id="email" class="form-control" type="texto" value="<?=$this->user->email;?>" data-validate="required" readonly="readonly" disabled/>
</div>
</div>
<div class="text-right">
<button type="submit" class="btn btn-primary">Salvar alterações <i class="icon-floppy-disk position-right"></i></button>
</div>
</form>
</div>
</div>