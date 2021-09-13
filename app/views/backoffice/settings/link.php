<div class="alert alert-info alert-styled-left alert-bordered">
	<span class="text-semibold">Fique atento!</span> Após efetuar a alteração, você não será capaz de fazer uma nova troca para seu link de indicação.
</div>
<div class="panel panel-flat">
	<div class="panel-body">
		<form method="post" class="form-horizontal">
			<div class="form-group row">
				<label for="link" class="col-sm-2 control-label"><b>Link de indicação:</b></label>
				<div class="col-sm-6">
					<div class="input-group">
						<span class="input-group-addon"><i><?=site_url('sponsor');?>/</i></span>
						<input id="link" class="form-control" type="text" name="link" value="<?=(!$this->user->link ? $this->user->id : $this->user->link);?>" />
					</div>
				</div>
			</div>
			<div class="text-right">
				<button type="submit" class="btn btn-primary">Salvar alterações <i class="icon-floppy-disk position-right"></i></button>
			</div>
		</form>
	</div>
</div>