<div class="panel panel-flat">
	<div class="panel-body">
		<form method="post" class="form-horizontal">
			<div class="form-group row">
				<label for="logo" class="col-sm-3 control-label">
				<img src='<?=base_url('assets/images/gateways/bcash.png');?>'></label>
				<div class="col-sm-5"><br><br>URL de Retorno: <i><?=site_url('callback/bcash')?></i></div>
			</div>
			<div class="form-group row">
				<label for="bcash" class="col-sm-3 control-label"><b>Ativar recebimento via BCash:</b></label>
				<div class="col-sm-5"><input name="bcash" type="checkbox" data-labelauty="Ativar recebimento via BCash" value="Y" <?php if($settings->bcash == "Y"){ ?> checked="checked" <?php } ?>> Receber via BCash.</div>
			</div>
			<div class="form-group row">
				<label for="bcash_email" class="col-sm-3 control-label"><b>E-mail BCash:</b></label>
				<div class="col-sm-5"><input id="bcash_email" name="bcash_email" class="form-control" type="text" value="<?=$settings->bcash_email;?>"/></div>
			</div>
			<div class="form-group row">
				<label for="bcash_token" class="col-sm-3 control-label"><b>Token BCash:</b></label>
				<div class="col-sm-5"><input id="bcash_token" name="bcash_token" class="form-control" type="text" value="<?=$settings->bcash_token;?>"/></div>
			</div>
			<div class="text-right">
				<button type="button" class="btn bg-teal btn-labeled" onclick="window.location.href='<?=site_url('admin/gateways');?>'"><b><i class="icon-circle-left2"></i></b>Voltar</button>
				<button type="submit" class="btn btn-primary">Salvar alterações <i class="icon-floppy-disk position-right"></i></button>
			</div>
		</form>
	</div>
</div>