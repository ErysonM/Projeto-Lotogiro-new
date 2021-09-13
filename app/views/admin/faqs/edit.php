<div class="panel panel-flat">
	<div class="panel-body">
		<form method="post" class="form-horizontal">
			<div class="form-group row">
				<label for="title" class="col-sm-3 control-label"><b>Titulo:</b></label>
				<div class="col-sm-5"><input id="title" name="title" class="form-control" type="text" value="<?=$faq->title;?>" required/></div>
			</div>
			<div class="form-group row">
				<label for="number" class="col-sm-3 control-label"><b>Número Ref.:</b></label>
				<div class="col-sm-5">
				<input id="number" name="number" class="form-control" type="number" value="<?=$faq->number;?>" min="1" required/>
				</div>
			</div>
			<div class="form-group row">
				<label for="text" class="col-sm-3 control-label"><b>Texto:</b></label>
				<div class="col-sm-5">
				<textarea name="text" class="form-control" id="text" required><?=nl2br($faq->text);?></textarea>
				</div>
			</div>
			<div class="form-group row">
				<label for="date" class="col-sm-3 control-label"><b>Data de criação:</b></label>
				<div class="col-sm-5"><?=date($this->settings->date_format . " " . $this->settings->date_time_format, strtotime($faq->date));?></div>
			</div>
			<div class="form-group row">
				<label for="date" class="col-sm-3 control-label"><b>Ultima edição:</b></label>
				<div class="col-sm-5"><?=date($this->settings->date_format . " " . $this->settings->date_time_format, strtotime($faq->last_edit));?></div>
			</div>
			<div class="form-group row">
				<label for="last_editor" class="col-sm-3 control-label"><b>Ultimo editor:</b></label>
				<div class="col-sm-5">
				<div class="col-sm-5"><?=$lasteditor->firstname;?> <?=$lasteditor->lastname;?></div>
				</div>
			</div>
			<div class="text-right">
			<button type="button" class="btn bg-teal btn-labeled" onclick="window.location.href='<?=site_url('admin/faqs');?>'"><b><i class="icon-circle-left2"></i></b>Voltar</button>
				<button type="submit" class="btn btn-primary btn-labeled"><b><i class="icon-floppy-disk"></i></b>Alterar</button>
			</div>
		</form>
	</div>
</div>