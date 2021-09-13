<div class="panel panel-flat">
	<div class="panel-body">
		<form method="post" class="form-horizontal">
			<div class="form-group row">
				<label for="logo" class="col-sm-3 control-label">
				Logo: 
				</label>
				<div class="col-sm-5"><img src='<?=base_url('assets/images/logo_header.png');?>' style="background-color: black;"> Alterado apenas pelo administrador.</div>
			</div>
			<div class="form-group row">
				<label for="company_name" class="col-sm-3 control-label"><b>Empresa:</b></label>
				<div class="col-sm-5"><input id="company_name" name="company_name" class="form-control" type="text" value="<?=$settings->company_name;?>" required/></div>
			</div>
			<div class="form-group row">
				<label for="coampany_email" class="col-sm-3 control-label"><b>E-mail Empresa:</b></label>
				<div class="col-sm-5"><input id="company_email" name="company_email" class="form-control" type="text" value="<?=$settings->company_email;?>" required/></div>
			</div>
			<div class="form-group row">
				<label for="dolar" class="col-sm-3 control-label"><b>Valor Dólar:</b></label>
				<div class="col-sm-5"><input id="dolar" name="dolar" class="form-control mask-transfer" type="text" value="<?=number_format($settings->dolar, 2, '.', ',');?>" required/></div>
			</div>
			<div class="form-group row">
				<label for="maintenance" class="col-sm-3 control-label"><b>Manutenção:</b></label>
				<div class="col-sm-5"><input name="maintenance" type="checkbox" data-labelauty="Site fechado para manutenção" value="Y" <?php if($settings->maintenance == "Y"){ ?> checked="checked" <?php } ?>> Site fechado para manutenção.</div>
			</div>
			<div class="form-group row">
				<label for="lock_login" class="col-sm-3 control-label"><b>Fechar Login:</b></label>
				<div class="col-sm-5"><input name="lock_login" type="checkbox" data-labelauty="Bloquear login de empreendedores" value="Y" <?php if($settings->lock_login == "Y"){ ?> checked="checked" <?php } ?>> Bloquear login de empreendedores.</div>
			</div>
			<div class="form-group row">
				<label for="lock_payout" class="col-sm-3 control-label"><b>Bloquear Pagar Faturas:</b></label>
				<div class="col-sm-5"><input name="lock_payout" type="checkbox" data-labelauty="Bloquear pagar faturas" value="Y" <?php if($settings->lock_payout == "Y"){ ?> checked="checked" <?php } ?>> Bloquear pagar faturas de empreendedores.</div>
			</div>
			<div class="form-group row">
				<label for="lock_register" class="col-sm-3 control-label"><b>Bloquear Cadastros:</b></label>
				<div class="col-sm-5"><input name="lock_register" type="checkbox" data-labelauty="Bloquear cadastro de novos empreendedores" value="Y" <?php if($settings->lock_register == "Y"){ ?> checked="checked" <?php } ?>> Bloquear cadastro de novos empreendedores.</div>
			</div>
			<div class="form-group row">
				<label for="lock_withdrawal" class="col-sm-3 control-label"><b>Bloquear Saques:</b></label>
				<div class="col-sm-5"><input name="lock_withdrawal" type="checkbox" data-labelauty="Bloquear Saques" value="Y" <?php if($settings->lock_withdrawal == "Y"){ ?> checked="checked" <?php } ?>> Bloquear saques de empreendedores.</div>
			</div>
			<div class="form-group row">
				<label for="lock_transfer" class="col-sm-3 control-label"><b>Bloquear Transf. Saldo:</b></label>
				<div class="col-sm-5"><input name="lock_transfer" type="checkbox" data-labelauty="Bloquear Transferencia" value="Y" <?php if($settings->lock_transfer == "Y"){ ?> checked="checked" <?php } ?>> Bloquear transferencia de saldo.</div>
			</div>
			<div class="form-group row">
				<label for="transfer_percent" class="col-sm-3 control-label"><b>% Sob. Transf. Saldo:</b></label>
				<div class="col-sm-5">
				<input id="transfer_percent" name="transfer_percent" class="form-control" type="number" value="<?=$settings->transfer_percent;?>" min="0" max="100" required/> 0 = Para não cobrar % sobre a transferencia.
				</div>
			</div>
			<div class="form-group row">
				<label for="transfer_min" class="col-sm-3 control-label"><b>Transf. Minima:</b></label>
				<div class="col-sm-5">
				<input id="transfer_min" name="transfer_min" class="form-control" type="number" value="<?=$settings->transfer_min;?>" required/> 0 = Para não ter valor minimo de transferencia.
				</div>
			</div>
			<div class="form-group row">
				<label for="min_withdrawal" class="col-sm-3 control-label"><b>Saque Minimo:</b></label>
				<div class="col-sm-5">
				<input id="min_withdrawal" name="min_withdrawal" class="form-control" type="number" value="<?=$settings->min_withdrawal;?>" required/>
				</div>
			</div>
			<div class="form-group row">
				<label for="withdrawal_percent" class="col-sm-3 control-label"><b>% Sob. Saque:</b></label>
				<div class="col-sm-5">
				<input id="withdrawal_percent" name="withdrawal_percent" class="form-control" type="number" value="<?=$settings->withdrawal_percent;?>" min="0" max="100" required/> 0 = Para não cobrar % sobre o saque.
				</div>
			</div>
			<div class="form-group row">
				<label for="min_recharge" class="col-sm-3 control-label"><b>Recarga Minima:</b></label>
				<div class="col-sm-5">
				<input id="min_recharge" name="min_recharge" class="form-control" type="number" value="<?=$settings->min_recharge;?>" required/>
				</div>
			</div>
			<div class="form-group row">
				<label for="date_format" class="col-sm-3 control-label"><b>Formato da Data:</b></label>
				<div class="col-sm-5">
				<?php $options = array(
				'F j, Y'	=> date("F j, Y"),
				'Y/m/d'		=> date("Y/m/d"),
				'm/d/Y'		=> date("m/d/Y"),
				'd/m/Y'		=> date("d/m/Y"),
				'd.m.Y'		=> date("d.m.Y"),
				'd-m-Y' 	=> date("d-m-Y"),
					);
			echo form_dropdown('date_format', $options, $settings->date_format, 'class="form-control"'); ?>
				</div>
			</div>
			<div class="form-group row">
				<label for="date_time_format" class="col-sm-3 control-label"><b>Formato da Hora:</b></label>
				<div class="col-sm-5">
				<?php $options = array(
						'g:i a'	=> date("g:i a"),
						'g:i A'	=> date("g:i A"),
						'H:i'	=> date("H:i"),
					);
				echo form_dropdown('date_time_format', $options, $settings->date_time_format, 'class="form-control"'); ?>
				</div>
			</div>
			<div class="form-group row">
				<label for="currency" class="col-sm-3 control-label"><b>Simbolo moeda:</b></label>
				<div class="col-sm-5"><input id="currency" class="form-control" type="text" name="currency" value="<?=$settings->currency;?>" /></div>
			</div>
			<div class="form-group row">
				<label for="money_format" class="col-sm-3 control-label"><b>Formato da moeda:</b></label>
				<div class="col-sm-5">
				<?php $options = array(
						'1'  => "1,234.56",
						'2'  => "1.234,56",
						'3'  => "1234.56",
						'4'  => "1234,56",
					);
					echo form_dropdown('money_format', $options, $settings->money_format, 'class="form-control"'); ?>
					</div>
			</div>
			<div class="form-group row">
				<label for="money_currency_position" class="col-sm-3 control-label"><b>Posição do simbolo:</b></label>
				<div class="col-sm-5">
					<?php $options = array(
						'1'  => $settings->currency . " 100",
						'2'  => "100 " . $settings->currency,
					);
					echo form_dropdown('money_currency_position', $options, $settings->money_currency_position, 'class="form-control"'); ?>
				</div>
			</div>
			<div class="form-group row">
				<label for="visits" class="col-sm-3 control-label"><b>Visitantes:</b></label>
				<div class="col-sm-5">
				<input id="visits" name="visits" class="form-control" type="number" value="<?=$settings->visits;?>" required/>
				</div>
			</div>
			<div class="form-group row">
				<label for="real_visits" class="col-sm-3 control-label"><b>Visitantes Reais:</b></label>
				<div class="col-sm-5">
				<input id="real_visits" name="real_visits" class="form-control" type="text" value="<?=$settings->real_visits;?>" disabled readonly="readonly"/>
				</div>
			</div>
			<div class="form-group row">
				<label for="registers" class="col-sm-3 control-label"><b>Registros:</b></label>
				<div class="col-sm-5">
				<input id="registers" name="registers" class="form-control" type="number" value="<?=$settings->registers;?>" required/>
				</div>
			</div>
			<div class="form-group row">
				<label for="real_registers" class="col-sm-3 control-label"><b>Registros Reais:</b></label>
				<div class="col-sm-5">
				<input id="real_registers" name="real_registers" class="form-control" type="text" value="<?=$settings->real_registers;?>" disabled readonly="readonly"/>
				</div>
			</div>
			<div class="form-group row">
				<label for="bet" class="col-sm-3 control-label"><b>Partidas:</b></label>
				<div class="col-sm-5">
				<input id="bet" name="bet" class="form-control" type="number" value="<?=$settings->bet;?>" required/>
				</div>
			</div>
			<div class="form-group row">
				<label for="real_bet" class="col-sm-3 control-label"><b>Partidas Reais:</b></label>
				<div class="col-sm-5">
				<input id="real_bet" name="real_bet" class="form-control" type="text" value="<?=$settings->real_bet;?>" disabled readonly="readonly"/>
				</div>
			</div>
			<div class="text-right">
				<button type="submit" class="btn btn-primary">Salvar alterações <i class="icon-floppy-disk position-right"></i></button>
			</div>
		</form>
	</div>
</div>
			<script type="text/javascript">
				$(document).ready(function () {
				$('.mask-transfer').priceFormat({
						prefix: '',
						            centsSeparator: '.',
						thousandsSeparator: ''
								});
				})
			</script>