<?php
/**
* Project:    mmn.dev
* File:       forgot.php
* Author:     Felipe Medeiros
* Createt at: 09/06/2016 - 07:42
*/
?>
<!-- Password recovery -->
<?=form_open('admin/forgot', ['role'=> 'form', 'id' => 'forgot'])?>
<div class="panel panel-body login-form">
<div class="text-center">
<h5 class="content-group">
<img src="<?=base_url('assets/images/logo_header.png');?>">
</P>
<strong>Esqueceu sua senha?</strong>
<small class="display-block">
<span class="text-justify">Informe seu email no campo abaixo para dar inicio ao processo de redefinição.</span></small>
</h5>
</div>
<div class="form-group has-feedback">
<input name="email" type="email" class="form-control" placeholder="Email" required />
<div class="form-control-feedback">
<i class="icon-mail5 text-muted"></i>
</div>
</div>
<div class="col-sm-6 col-xs-6 col-lg-6">
<a href="<?=site_url('admin/login');?>" class="btn btn-icon bg-danger" data-popup="tooltip" title="Voltar">
<b><i class="icon-circle-left2"></i> Voltar</b>
</a>
</div>
<div class="col-sm-6 col-xs-6 col-lg-6">
<button type="submit" class="btn btn-icon bg-primary">Recuperar <i class="icon-circle-right2 position-right"></i></button>
</div>
</div>
<?=form_close();?>
<!-- /password recovery -->