<!-- Advanced login -->
<?php $attributes = array('role'=> 'form', 'id' => 'login'); ?>
<?=form_open('admin/login', $attributes)?>
<div class="panel panel-body login-form">
<div class="text-center">
<h5 class="content-group-lg mb-10" style="margin-top: 0;">
<img src="<?=base_url('assets/images/logo_header.png');?>">
</P></P></P></P>
<small class="display-block">ACESSO Á ADMINISTRAÇÃO.</small>
</h5>
</div>
<div class="form-group has-feedback has-feedback-left">
<input type="email" name="email" class="form-control" placeholder="Email" required />
<div class="form-control-feedback">
<i class="icon-envelop text-muted"></i>
</div>
</div>
<div class="form-group has-feedback has-feedback-left">
<input type="password" name="password" class="form-control" placeholder="Senha" required />
<div class="form-control-feedback">
<i class="icon-lock2 text-muted"></i>
</div>
</div>
<div class="row">
<div class="col-sm-6 col-xs-6 col-lg-6">
<a href="<?=site_url('admin/forgot');?>" class="btn btn-icon bg-danger" data-popup="tooltip" title="Esqueci minha senha?">
<b><i class="icon-lock"></i></b>
</a>
</div>
<div class="col-sm-6 col-xs-6 col-lg-6">
<button type="submit" class="btn btn-block btn-success btn-labeled btn-labeled-right">
<b><i class="icon-circle-right2"></i></b> Acessar
</button>
</div>
</div>
</div>
<?=form_close();?>
<!-- /advanced login -->