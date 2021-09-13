<div class="alert alert-info alert-styled-left alert-bordered">
<span class="text-semibold">Fique atento!</span> A conta bancaria que sera informada abaixo deve ter o mesmo nome e CPF aqui cadastrados.
</div>
<div class="panel">
<div class="panel-heading p-10 border-bottom-indigo">
<h5 class="panel-title"><i class="icon-library2 position-left"></i> Conta bancária</h5>
</div>
<div class="panel-body">
<form method="post" class="form-horizontal">
<div class="form-group row">
<label for="bank_code" class="col-sm-3 control-label"><b>Banco:</b></label>
<div class="col-sm-6"><select id="bank_code" name="bank_code" class="form-control" required>
<option value="" <?=($this->user->bank_code == '' ? 'selected' : '');?>>Selecione</option>
<?php foreach ($banks as $bank): ?>
<option value="<?=$bank->code;?>" <?=($this->user->bank_code == $bank->code ? 'selected' : '');?>><?=$bank->code;?> - <?=$bank->name;?></option>
<?php endforeach; ?>
</select></div>
</div>
<div class="form-group row" style="margin-bottom: 0;">
<label for="bank_agency" class="col-sm-3 control-label"><b>Número do agência:</b></label>
<div class="col-sm-3">
<input id="bank_agency" class="form-control" type="text" name="bank_agency" value="<?=$this->user->bank_agency;?>" required />
</div>
<div class="col-sm-3">
<input id="bank_agency_digit" class="form-control" type="text" name="bank_agency_digit" value="<?=$this->user->bank_agency_digit;?>" required />
<span class="help-block text-right no-margin">Se não tiver dígito, insira 0.</span>
</div>
</div>
<div class="form-group row" style="margin-bottom: 0;">
<label for="bank_account" class="col-sm-3 control-label"><b>Número da conta:</b></label>
<div class="col-sm-3">
<input id="bank_account" class="form-control" type="text" name="bank_account" value="<?=$this->user->bank_account;?>" required />
</div>
<div class="col-sm-3">
<input id="bank_account_digit" class="form-control" type="text" name="bank_account_digit" value="<?=$this->user->bank_account_digit;?>" required />
<span class="help-block text-right no-margin">Se não tiver dígito, insira 0.</span>
</div>
</div>
<div class="form-group row">
<label for="bank_account_type" class="col-sm-3 control-label"><b>Tipo da conta:</b></label>
<div class="col-sm-6"><select id="bank_account_type" name="bank_account_type" class="form-control" required>
<option value="" <?=($this->user->bank_account_type == '' ? 'selected' : '');?>>Selecione</option>
<option value="corrente" <?=($this->user->bank_account_type == 'corrente' ? 'selected' : '');?>>Corrente</option>
<option value="poupanca" <?=($this->user->bank_account_type == 'poupanca' ? 'selected' : '');?>>Poupança</option>
</select></div>
</div>
<div class="form-group row">
<label for="bank_owner" class="col-sm-3 control-label"><b>Titular da conta:</b></label>
<div class="col-sm-6">
<input id="bank_owner" class="form-control" type="text" value="<?=($this->user->firstname . ' ' . $this->user->lastname);?>" />
</div>
</div>
<div class="form-group row">
<label for="bank_cpf" class="col-sm-3 control-label"><b>CPF do titular:</b></label>
<div class="col-sm-6">
<input id="bank_cpf" class="form-control cpf-mask" type="text" value="<?=$this->user->cpf;?>" />
</div>
</div>
<div class="text-right">
<button type="submit" class="btn btn-primary btn-labeled">
<b><i class="icon-floppy-disk"></i></b>
Salvar alterações 
</button>
</div>
</form>
</div>
</div>