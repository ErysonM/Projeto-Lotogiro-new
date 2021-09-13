<div class="alert alert-info alert-styled-left alert-bordered">
	<span class="text-semibold">Fique atento!</span> Você receberá transações por essa informação. Certifique-se que a informação está correta!
</div>
<div class="alert alert-info alert-styled-left alert-bordered">
	<span class="text-semibold">Não tem uma carteira bitcoin? Crie uma já! É simples!</span>
	 <br>Crie sua carteira usando este <a href="https://blockchain.info/" target="_blank">LINK</a>. 
	 <br>Após criar sua carteira copie e cole no campo abaixo o endereço de sua carteira. Pronto, você já vai poder receber seus pagamentos! ;)
</div>
<div class="panel">
	<div class="panel-heading p-10 border-bottom-indigo">
		<h5 class="panel-title"><i class="fa fa-btc fa-fw position-left"></i> Carteira bitcoin</h5>
	</div>
	<div class="panel-body">
		<form method="post" class="form-horizontal">
			<div class="form-group row">
				<label for="bitcoin_address" class="col-sm-3 control-label"><b> Carteira Bitcoin:</b></label>
				<div class="col-sm-6">
					<input id="bitcoin_address" class="form-control" type="text" name="bitcoin_address" value="<?=($this->user->bitcoin_address);?>" />
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