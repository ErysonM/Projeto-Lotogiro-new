<div class="panel panel-flat">
	<div class="panel-body">
		<form method="post" class="form-horizontal">
			<div class="form-group row">
				<label for="logo" class="col-sm-3 control-label">
				<img src='<?=base_url('assets/images/gateways/mistermoney.png');?>'></label>
			</div>
			<div class="form-group row">
				<label for="mistermoney" class="col-sm-3 control-label"><b>Ativar recebimento via Mister Money:</b></label>
				<div class="col-sm-5"><input name="mistermoney" type="checkbox" data-labelauty="Ativar recebimento via Mister Money" value="Y" <?php if($settings->mistermoney == "Y"){ ?> checked="checked" <?php } ?>> Receber via Mister Money.</div>
			</div>
			<div class="form-group row">
				<label for="mistermoney_instrucoes" class="col-sm-3 control-label"><b>Instruções:</b></label>
				<div class="col-sm-5">
				<textarea class="form-control" name="mistermoney_instrucoes"><?=$settings->mistermoney_instrucoes;?></textarea>
				</div>
			</div>
			<div class="text-right">
				<button type="button" class="btn bg-teal btn-labeled" onclick="window.location.href='<?=site_url('admin/gateways');?>'"><b><i class="icon-circle-left2"></i></b>Voltar</button>
				<button type="submit" class="btn btn-primary">Salvar alterações <i class="icon-floppy-disk position-right"></i></button>
			</div>
		</form>
	</div>
</div>