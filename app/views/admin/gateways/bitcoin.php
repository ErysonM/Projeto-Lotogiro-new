<div class="alert alert-warning alert-styled-left">
<span class="text-semibold">Atenção!</span> A forma utilizada para recebimento é a COINGATE.
</div>
<div class="panel panel-flat">
<div class="panel-body">
<form method="post" class="form-horizontal">
<div class="form-group row">
<label for="logo" class="col-sm-3 control-label">
<img src='<?=base_url('assets/images/gateways/bitcoin.png');?>'></label>
<div class="col-sm-5"><br><br>URL de Retorno: <i><?=site_url('callback/bitcoin')?></i></div>
</div>
<div class="form-group row">
<label for="bitcoin" class="col-sm-3 control-label"><b>Ativar recebimento via Bitcoin:</b></label>
<div class="col-sm-5"><input name="bitcoin" id="bitcoin" type="checkbox" data-labelauty="Ativar recebimento via Bitcoin" value="Y" <?php if($settings->bitcoin == "Y"){ ?> checked="checked" <?php } ?>> Receber via Bitcoin.</div>
</div>
<div class="form-group row">
<label for="bitcoin_appid" class="col-sm-3 control-label"><b>APP ID:</b></label>
<div class="col-sm-5"><input id="bitcoin_appid" name="bitcoin_appid" class="form-control" type="text" value="<?=$settings->bitcoin_appid;?>"/></div>
</div>
<div class="form-group row">
<label for="bitcoin_token" class="col-sm-3 control-label"><b>KEY:</b></label>
<div class="col-sm-5"><input id="bitcoin_token" name="bitcoin_token" class="form-control" type="text" value="<?=$settings->bitcoin_token;?>"/></div>
</div>
<div class="form-group row">
<label for="bitcoin_callbackpass" class="col-sm-3 control-label"><b>SECRET:</b></label>
<div class="col-sm-5"><input id="bitcoin_callbackpass" name="bitcoin_callbackpass" class="form-control" type="text" value="<?=$settings->bitcoin_callbackpass;?>"/></div>
</div>
<div class="form-group row">
<label for="bitcoin_notifyemail" class="col-sm-3 control-label"><b>E-mail notificação:</b></label>
<div class="col-sm-5"><input id="bitcoin_notifyemail" name="bitcoin_notifyemail" class="form-control" type="email" value="<?=$settings->bitcoin_notifyemail;?>" /></div>
</div>
<div class="text-right">
<button type="button" class="btn bg-teal btn-labeled" onclick="window.location.href='<?=site_url('admin/gateways');?>'"><b><i class="icon-circle-left2"></i></b>Voltar</button>
<button type="submit" class="btn btn-primary">Salvar alterações <i class="icon-floppy-disk position-right"></i></button>
</div>
</form>
</div>
</div>