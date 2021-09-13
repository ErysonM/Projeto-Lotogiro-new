<div class="panel panel-flat">
	<div class="panel-body">
		<form method="post" class="form-horizontal">
			<div class="form-group row">
				<label for="logo" class="col-sm-3 control-label">
				<img src='<?=base_url('assets/images/gateways/paypal.png');?>'></label>
				<div class="col-sm-5"><br><br>URL de Retorno: <i><?=site_url('callback/paypal')?></i></div>
			</div>
			<div class="form-group row">
				<label for="paypal" class="col-sm-3 control-label"><b>Ativar recebimento via PayPal:</b></label>
				<div class="col-sm-5"><input name="paypal" type="checkbox" data-labelauty="Ativar recebimento via PayPal" value="Y" <?php if($settings->paypal == "Y"){ ?> checked="checked" <?php } ?>> Receber via PayPal.</div>
			</div>
			<div class="form-group row">
				<label for="paypal_email" class="col-sm-3 control-label"><b>E-mail PayPal:</b></label>
				<div class="col-sm-5"><input id="paypal_email" name="paypal_email" class="form-control" type="text" value="<?=$settings->paypal_email;?>"/></div>
			</div>
			<div class="form-group row">
				<label for="paypal_currency" class="col-sm-3 control-label"><b>Simbolo moeda:</b></label>
				<div class="col-sm-5">
				<?php $options = array(
						'$'	 => '$',
						'R$' => 'R$',
						'€'	 => '€',
					);
				echo form_dropdown('paypal_currency', $options, $settings->paypal_currency, 'class="form-control"'); ?>
				</div>
			</div>
			<div class="text-right">
				<button type="button" class="btn bg-teal btn-labeled" onclick="window.location.href='<?=site_url('admin/gateways');?>'"><b><i class="icon-circle-left2"></i></b>Voltar</button>
				<button type="submit" class="btn btn-primary">Salvar alterações <i class="icon-floppy-disk position-right"></i></button>
			</div>
		</form>
	</div>
</div>