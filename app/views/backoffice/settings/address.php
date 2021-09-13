<div class="panel panel-default">
	<div class="panel-body">
		<form method="post" class="form-horizontal">
			<div class="form-group row">
				<label for="country" class="col-sm-3 control-label"><b>Pais:</b></label>
				<div class="col-sm-5">
				<?php 
				echo form_dropdown('country', $options, $this->user->country, 'class="form-control"'); 
				?>
				</div>
			</div>
			<div class="form-group row">
				<label for="address_zip" class="col-sm-3 control-label"><b>CEP:</b></label>
				<div class="col-sm-5">
					<div class="input-group">
						<input id="address_zip" class="form-control cep-mask" type="text" name="address_zip" value="<?=$this->user->address_zip;?>" required />
						<span class="input-group-btn">
							<button id="btnSearchCep" class="btn btn-primary" type="button"><i class="icon-search4"></i></button>
						</span>
					</div>
				</div>
			</div>
			<div class="form-group row">
				<label for="address_street" class="col-sm-3 control-label"><b>Endereço:</b></label>
				<div class="col-sm-5"><input id="address_street" class="form-control" type="text" name="address_street" value="<?=$this->user->address_street;?>" required /></div>
			</div>
			<div class="form-group row">
				<label for="address_number" class="col-sm-3 control-label"><b>Número:</b></label>
				<div class="col-sm-5"><input id="address_number" class="form-control" type="text" name="address_number" value="<?=$this->user->address_number;?>" required /></div>
			</div>
			<div class="form-group row">
				<label for="address_complement" class="col-sm-3 control-label"><b>Complemento:</b></label>
				<div class="col-sm-5"><input id="address_complement" class="form-control" type="text" name="address_complement" value="<?=$this->user->address_complement;?>" /></div>
			</div>
			<div class="form-group row">
				<label for="address_district" class="col-sm-3 control-label"><b>Bairro:</b></label>
				<div class="col-sm-5"><input id="address_district" class="form-control" type="text" name="address_district" value="<?=$this->user->address_district;?>" required /></div>
			</div>
			<div class="form-group row">
				<label for="address_city" class="col-sm-3 control-label"><b>Cidade:</b></label>
				<div class="col-sm-5"><input id="address_city" class="form-control" type="text" name="address_city" value="<?=$this->user->address_city;?>" required /></div>
			</div>
			<div class="form-group row">
				<label for="address_state" class="col-sm-3 control-label"><b>Estado:</b></label>
				<div class="col-sm-5"><input id="address_state" class="form-control" type="text" name="address_state" value="<?=$this->user->address_state;?>" required /></div>
			</div>
			<div class="text-right">
				<button type="submit" class="btn btn-primary">Salvar alterações <i class="icon-floppy-disk position-right"></i></button>
			</div>
		</form>
	</div>
</div>