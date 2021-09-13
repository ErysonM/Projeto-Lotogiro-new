<div class="panel panel-flat">
	<div class="panel-body">
		<form method="post" class="form-horizontal">
			<div class="form-group row">
				<label for="title" class="col-sm-3 control-label"><b>Titulo:</b></label>
				<div class="col-sm-5"><input id="title" name="title" class="form-control" type="text" value="<?=$announcement->title;?>" required/></div>
			</div>
			<div class="form-group row">
				<label for="slug" class="col-sm-3 control-label"><b>Ref. URL:</b></label>
				<div class="col-sm-5">
				<input id="slug" name="slug" class="form-control" type="text" value="<?=$announcement->slug;?>" required/>
				</div>
			</div>
			<div class="form-group row">
				<label for="priority" class="col-sm-3 control-label"><b>Prioridade:</b></label>
				<div class="col-sm-5">
				<?php $options = array(
				'1'	=> 'Baixa',
				'2'	=> 'Media',
				'3' => 'Alta',
					);
			echo form_dropdown('priority', $options, $announcement->priority, 'class="form-control"'); ?>
				</div>
			</div>
			<div class="form-group row">
				<label for="body" class="col-sm-3 control-label"><b>Texto:</b></label>
				<div class="col-sm-5">
				<textarea name="body" class="form-control" id="body" required><?=nl2br($announcement->body);?></textarea>
				</div>
			</div>
			<div class="form-group row">
				<label for="date" class="col-sm-3 control-label"><b>Data de criação:</b></label>
				<div class="col-sm-5"><?=date($this->settings->date_format . " " . $this->settings->date_time_format, strtotime($announcement->date));?></div>
			</div>
			<div class="form-group row">
				<label for="date" class="col-sm-3 control-label"><b>Ultima edição:</b></label>
				<div class="col-sm-5"><?=date($this->settings->date_format . " " . $this->settings->date_time_format, strtotime($announcement->last_edit));?></div>
			</div>
			<div class="form-group row">
				<label for="last_editor" class="col-sm-3 control-label"><b>Ultimo editor:</b></label>
				<div class="col-sm-5">
				<div class="col-sm-5"><?=$lasteditor->firstname;?> <?=$lasteditor->lastname;?></div>
				</div>
			</div>
			<div class="text-right">
			<button type="button" class="btn bg-teal btn-labeled" onclick="window.location.href='<?=site_url('admin/announcements');?>'"><b><i class="icon-circle-left2"></i></b>Voltar</button>
				<button type="submit" class="btn btn-primary btn-labeled"><b><i class="icon-floppy-disk"></i></b>Alterar</button>
			</div>
		</form>
	</div>
</div>