<div class="panel panel-flat">
	<div class="panel-body">
		<form method="post" class="form-horizontal">
			<div class="form-group row">
				<label for="name" class="col-sm-3 control-label"><b>Titulo:</b></label>
				<div class="col-sm-5"><input id="name" name="name" class="form-control" type="text" value="<?=$this->input->post('name');?>" required/></div>
			</div>
			<div class="form-group row">
				<label for="description" class="col-sm-3 control-label"><b>Descrição:</b></label>
				<div class="col-sm-5">
				<textarea name="description" class="form-control" id="description" required><?=$this->input->post('description');?></textarea>
				</div>
			</div>
			<div class="form-group row">
				<label for="type" class="col-sm-3 control-label"><b>Tipo Loteria:</b></label>
				<div class="col-sm-5">
				<?php $options = array(
				'fix'	=> 'Premio Fixo',
				'acum'	=> 'Premio Acumulativo',
					);
			echo form_dropdown('type', $options, $this->input->post('type'), 'class="form-control"'); ?>
				</div>
			</div>
			<div class="form-group row">
				<label for="ticket_price" class="col-sm-3 control-label"><b>Valor Ticket:</b></label>
				<div class="col-sm-5">
				<input id="ticket_price" name="ticket_price" class="form-control money-mask" type="text" value="<?=$this->input->post('ticket_price');?>" required/>
				</div>
			</div>
			<div class="form-group row">
				<label for="max_tickets" class="col-sm-3 control-label"><b>Máximo de Tickets Vendidos:</b></label>
				<div class="col-sm-5">
				<input id="max_tickets" name="max_tickets" class="form-control" type="number" min="0" value="<?php if(empty($this->input->post('max_tickets'))) echo 0; else echo $this->input->post('max_tickets'); ?>" required/>
				</div>Deixe 0 para não ter limite.
			</div>
			<div class="form-group row">
				<label for="max_tickets_person" class="col-sm-3 control-label"><b>Máximo de Tickets por Pessoa:</b></label>
				<div class="col-sm-5">
				<input id="max_tickets_person" name="max_tickets_person" class="form-control" type="number" min="0" value="<?php if(empty($this->input->post('max_tickets_person'))) echo 10; else echo $this->input->post('max_tickets_person'); ?>" required/>
				</div>Deixe 0 para não ter limite.
			</div>
			<div class="form-group row">
				<label for="percent_emp" class="col-sm-3 control-label"><b>Porcentagem do prêmio p/ empresa:</b></label>
				<div class="col-sm-5">
				<input id="percent_emp" name="percent_emp" class="form-control" type="number" min="0" max="100" value="<?php if(empty($this->input->post('percent_emp'))) echo 30; else echo $this->input->post('percent_emp'); ?>" required/>
				</div>Deixe 0 para não ter % sobre o prêmio.
			</div>
			<div class="form-group row">
				<label for="winners" class="col-sm-3 control-label"><b>N. Ganhadores:</b></label>
				<div class="col-sm-5">
				<?php $options = array(
				'1'	=> '1',
				'2'	=> '2',
				'3'	=> '3',
				'4'	=> '4',
				'5'	=> '5',
					);
			echo form_dropdown('winners', $options, $this->input->post('winners'), 'class="form-control" disabled'); ?>
				</div>
			</div>
			<div class="form-group row">
				<label for="value_initial" class="col-sm-3 control-label"><b>Valor inicial:</b></label>
				<div class="col-sm-5">
				<input id="value_initial" name="value_initial" class="form-control money-mask" type="text" value="<?php if(empty($this->input->post('value_initial'))) echo 0; else echo $this->input->post('value_initial'); ?>" required/>
				</div>Deixe 0 para não ter valor inicial, se a loteria for fixa o valor inicial será o valor do prêmio.
			</div>
			<div class="form-group row">
				<label for="buyed_tickets" class="col-sm-3 control-label"><b>Tickets vendidos:</b></label>
				<div class="col-sm-5">
				<input id="buyed_tickets" name="buyed_tickets" class="form-control" type="number" min="0" value="<?php if(empty($this->input->post('buyed_tickets'))) echo 0; else echo $this->input->post('buyed_tickets'); ?>" required/>
				</div>Deixe 0 para não ter tickets vendidos. Se a loteria for acumulativa vai influenciar no valor do prêmio.
			</div>
			<div class="form-group row">
				<label for="date" class="col-sm-3 control-label"><b>Data de criação:</b></label>
				<div class="col-sm-5"><?=date($this->settings->date_format . " " . $this->settings->date_time_format, strtotime(date('Y-m-d H:i:s')));?></div>
			</div>
			<div class="form-group row">
				<label for="ends" class="col-sm-3 control-label"><b>Data do sorteio:</b></label>
				<div class="col-sm-5">
				<input id="ends" name="ends" class="form_datetime form-control" type="text" value="<?=$this->input->post('ends');?>" required readonly  size="16"/>
				</div> Data onde ocorre a premiação.
			</div>
			<div class="text-right">
			<button type="button" class="btn bg-teal btn-labeled" onclick="window.location.href='<?=site_url('admin/lotterys');?>'"><b><i class="icon-circle-left2"></i></b>Voltar</button>
				<button type="submit" class="btn btn-primary btn-labeled"><b><i class="icon-file-plus"></i></b>Adicionar</button>
			</div>
		</form>
	</div>
</div>