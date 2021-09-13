<div class="panel panel-flat">
	<div class="panel-heading p-10 border-bottom-orange">
		<h5 class="panel-title"><i class="icon-pencil4 position-left"></i> Editar associado</h5>
		<div class="heading-elements panel-nav">
			<ul class="nav nav-tabs nav-tabs-bottom">
				<li class="active"><a href="#user-profile" data-toggle="tab"><i class="icon-profile position-left"></i> Dados Pessoais</a></li>
				<li><a href="#user-password" data-toggle="tab"><i class="icon-lock position-left"></i> Alterar senha</a></li>
			</ul>
		</div>
	</div>
	<form method="post" class="form-horizontal">
		<div class="panel-body panel-tab-content tab-content">
			<div class="tab-pane active" id="user-profile">
				<div class="form-group row">
					<label for="sponsor" class="col-sm-3 control-label"><b>Patrocinador:</b></label>
					<div class="col-sm-5"><input id="sponsor" class="form-control" type="text" value="#<?=($sponsor->id . ' - ' . $sponsor->firstname . ' ' . $sponsor->lastname);?>" readonly /></div>
				</div>
				<div class="form-group row">
					<label for="firstname" class="col-sm-3 control-label"><b>Nome:</b></label>
					<div class="col-sm-5"><input id="firstname" class="form-control" type="text" name="firstname" value="<?=$user->firstname;?>" /></div>
				</div>
				<div class="form-group row">
					<label for="lastname" class="col-sm-3 control-label"><b>Sobrenome:</b></label>
					<div class="col-sm-5"><input id="lastname" class="form-control" type="text" name="lastname" value="<?=$user->lastname;?>" /></div>
				</div>
				<div class="form-group row">
					<label for="birthday" class="col-sm-3 control-label"><b>Data de nascimento:</b></label>
					<div class="col-sm-5"><input id="birthday" class="form-control date-mask" type="text" name="birthday" value="<?=date($this->settings->date_format, strtotime($user->birthday));?>" required /></div>
				</div>
				<div class="form-group row">
					<label for="gender" class="col-sm-3 control-label"><b>Sexo:</b></label>
					<div class="col-sm-5"><select class="form-control" name="gender" required>
						<option value="female" <?php if ($user->gender == 'female'): echo 'selected'; endif;?>>Feminimo</option>
						<option value="male" <?php if ($user->gender == 'male'): echo 'selected'; endif;?>>Masculino</option>
					</select></div>
				</div>
				<div class="form-group row">
					<label for="cpf" class="col-sm-3 control-label"><b>CPF:</b></label>
					<div class="col-sm-5"><input id="cpf" class="form-control cpf-mask" type="text" name="cpf" value="<?=$user->cpf;?>" required /></div>
				</div>
				<div class="form-group row">
					<label for="phone" class="col-sm-3 control-label"><b>Telefone:</b></label>
					<div class="col-sm-5"><input id="phone" class="form-control phone-mask" type="text" name="phone" value="<?=$user->phone;?>" /></div>
				</div>
				<div class="form-group row">
					<label for="mobilephone" class="col-sm-3 control-label"><b>Celular:</b></label>
					<div class="col-sm-5"><input id="mobilephone" class="form-control mobilephone-mask" type="text" name="mobilephone" value="<?=$user->mobilephone;?>" /></div>
				</div>
				<div class="form-group row">
					<label for="email" class="col-sm-3 control-label"><b>E-mail:</b></label>
					<div class="col-sm-5"><input id="email" class="form-control" type="email" name="email" value="<?=$user->email;?>" required /></div>
				</div>
			</div>

			<div class="tab-pane" id="user-password">
				<div class="alert alert-info no-border">
					<span class="text-semibold">Atenção!</span>
					Caso não queira alterar a senha do afiliado, basta deixar estes campos em branco.
				</div>
				<div class="form-group row">
					<label for="password" class="col-sm-3 control-label"><b>Nova senha:</b></label>
					<div class="col-sm-5"><input id="password" class="form-control" type="password" name="password" /></div>
				</div>
				<div class="form-group row">
					<label for="confirm_password" class="col-sm-3 control-label"><b>Confirmar nova senha:</b></label>
					<div class="col-sm-5"><input id="confirm_password" class="form-control" type="password" name="confirm_password" /></div>
				</div>
			</div>
		</div>
		<div class="panel-footer">
			<div class="text-right">
				<button type="submit" class="btn btn-success btn-labeled btn-labeled-right">
					<b><i class="icon-floppy-disk"></i></b>
					Salvar alterações
				</button>
			</div>
		</div>
	</form>
</div>