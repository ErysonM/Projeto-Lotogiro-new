<?php
$idioma = "pt-br";
if(!empty($_COOKIE['idioma']))
{
	$idioma = $_COOKIE['idioma'];
}

$file = substr(APPPATH, 0, strlen(APPPATH)-4);
$path = $file."langs/backoffice/".$idioma.".php";
include($path);

?>

<!-- Registration form -->
<div class="row">
<div class="col-lg-6 col-lg-offset-3">
<div class="panel panel-white registration-form">
<div class="text-center">
<h5 class="content-group-lg mb-10" style="margin-top: 0;">
<a href="<?=base_url('backoffice/login');?>"></P></P></P></P>
<img src="<?=base_url('assets/images/logo_header.png');?>">
</a></P></P></P></P>
<small class="display-block"><?=$lang['comece_ganhar']?>.</small>
</h5>
</div>

<!-- Wizard with validation -->
<form class="form-register" id="register" action="#" method="post">
<fieldset class="step" id="validation-step1">
<h6 class="form-wizard-title text-semibold">
<span class="form-wizard-count">1</span>
<?=$lang['patrocinador']?>
<small class="display-block"><?=$lang['quem_convidou']?></small>
</h6>
<div class="form-group">
<input id="sponsor" type="text" class="form-control" value="<?=$sponsor->firstname . ' ' . $sponsor->lastname . ' - #' . (!$sponsor->link ? $sponsor->id : $sponsor->link);?>" readonly />
</div>
</fieldset>
<fieldset class="step" id="validation-step2">
<h6 class="form-wizard-title text-semibold">
<span class="form-wizard-count">2</span>
<?=$lang['informacoes']?>
<small class="display-block"><?=$lang['conte_sobre_voce']?></small>
</h6>
<div class="row">
<div class="col-sm-6">
<div class="form-group">
<label for="firstname"><?=$lang['nome']?> *</label>
<input id="firstname" type="text" name="firstname" class="form-control" maxlength="20" required />
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<label for="lastname"><?=$lang['sobrenome']?> *</label>
<input id="lastname" type="text" name="lastname" class="form-control" maxlength="20" required />
</div>
</div>
</div>
<div class="row">
<div class="col-sm-4">
<div class="form-group">
<label for="birthday"><?=$lang['nascimento']?> *</label>
<input id="birthday" type="text" name="birthday" class="form-control date-mask" required />
</div>
</div>
<?php /*<div class="col-sm-4">
<div class="form-group">
<label for="cpf">CPF *</label>
<input id="cpf" type="text" name="cpf" class="form-control cpf-mask" />
</div>
</div>*/ ?>
<div class="col-sm-4">
<div class="form-group">
<label for="gender"><?=$lang['sexo']?> *</label>
<select id="gender" name="gender" class="form-control" required>
<option value=""><?=$lang['selecione']?></option>
<option value="female"><?=$lang['feminino']?></option>
<option value="male"><?=$lang['masculino']?></option>
</select>
</div>
</div>
<div class="col-sm-4">
<div class="form-group">
<label for="address_street"><?=$lang['pais']?> *</label>
<?php 
echo form_dropdown('country', $options, '', 'class="form-control"'); 
?>
</div>
</div>
</div>
</fieldset>
<?php /*<fieldset class="step" id="validation-step3">
<h6 class="form-wizard-title text-semibold">
<span class="form-wizard-count">3</span>
Endereço
<small class="display-block">Diga para nós aonde você mora.</small>
</h6>
<div class="row">
<div class="col-sm-7">
<div class="form-group">
<label for="address_street">País *</label>
<?php 
echo form_dropdown('country', $options, '', 'class="form-control"'); 
?>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-3">
<div class="form-group">
<label for="address_zip">CEP *</label>
<div class="input-group">
<input id="address_zip" type="text" name="address_zip" class="form-control cep-mask" />
<div class="input-group-btn">
<button type="button" id="btnSearchCep" class="btn btn-info btn-icon"><i class="icon-search4"></i></button>
</div>
</div>
</div>
</div>
<div class="col-sm-7">
<div class="form-group">
<label for="address_street">Endereço *</label>
<input id="address_street" type="text" name="address_street" class="form-control" />
</div>
</div>
<div class="col-sm-2">
<div class="form-group">
<label for="address_number">Numero *</label>
<input id="address_number" type="text" name="address_number" class="form-control" />
</div>
</div>
</div>
<div class="row">
<div class="col-sm-3">
<div class="form-group">
<label for="address_complement">Complemento</label>
<input id="address_complement" type="text" name="address_complement" class="form-control" />
</div>
</div>
<div class="col-sm-3">
<div class="form-group">
<label for="address_district">Bairro *</label>
<input id="address_district" type="text" name="address_district" class="form-control" />
</div>
</div>
<div class="col-sm-4">
<div class="form-group">
<label for="address_city">Cidade *</label>
<input id="address_city" type="text" name="address_city" class="form-control" />
</div>
</div>
<div class="col-sm-2">
<div class="form-group">
<label for="address_state">UF *</label>
<select name="address_state" id="address_state" class="form-control">
<option value="">--</option>
<option value="AC">AC</option>
<option value="AL">AL</option>
<option value="AM">AM</option>
<option value="AP">AP</option>
<option value="BA">BA</option>
<option value="CE">CE</option>
<option value="DF">DF</option>
<option value="ES">ES</option>
<option value="GO">GO</option>
<option value="MA">MA</option>
<option value="MG">MG</option>
<option value="MS">MS</option>
<option value="MT">MT</option>
<option value="PA">PA</option>
<option value="PB">PB</option>
<option value="PE">PE</option>
<option value="PI">PI</option>
<option value="PR">PR</option>
<option value="RJ">RJ</option>
<option value="RN">RN</option>
<option value="RS">RS</option>
<option value="RO">RO</option>
<option value="RR">RR</option>
<option value="SC">SC</option>
<option value="SE">SE</option>
<option value="SP">SP</option>
<option value="TO">TO</option>
</select>
</div>
</div>
</div>
</fieldset>*/ ?>
<fieldset class="step" id="validation-step3">
<h6 class="form-wizard-title text-semibold">
<span class="form-wizard-count">3</span>
<?=$lang['credenciais']?>
<small class="display-block"><?=$lang['defina_credenciais']?>.</small>
</h6>
<div class="form-group">
<label for="email"><?=$lang['email']?> *</label>
<input id="email" type="email" name="email" class="form-control" required />
</div>
<div class="row">
<div class="col-sm-6">
<div class="form-group">
<label for="password"><?=$lang['senha']?> *</label>
<input id="password" type="password" name="password" class="form-control" required />
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<label for="confirm_password"><?=$lang['confirmar_senha']?> *</label>
<input id="confirm_password" type="password" name="confirm_password" class="form-control" required />
</div>
</div>
</div>
</fieldset>
<div class="form-wizard-actions">
<button type="reset" class="btn btn-default" id="validation-back"><i class="icon-square-left"></i></button>
<button type="submit" class="btn btn-info" id="validation-next"><?=$lang['proximo']?></button>
</div>
</form>
</div>
<!-- /wizard with validation -->
</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
$(".form-register").formwizard({
disableUIStyles: true,
inDuration: 150,
outDuration: 150,
textSubmit: 'Cadastrar',
textNext: 'Próximo',
textBack: '<i class="icon-square-left"></i>'
});
$(".form-register").on("step_shown", function(event, data) {
$.uniform.update();
});
})
</script>