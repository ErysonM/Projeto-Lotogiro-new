<?php
$idioma = "pt-br";
if(!empty($_COOKIE['idioma']))
{
	$idioma = $_COOKIE['idioma'];
}

$file = substr(APPPATH, 0, strlen(APPPATH)-4);
$path = $file."langs/backoffice/".$idioma.".php";
include($path);
?>

<!-- Advanced login -->
<?php $attributes = array('role'=> 'form', 'id' => 'login'); ?>
<?=form_open('backoffice/login', $attributes)?>
<div class="panel panel-body login-form">
<div class="text-center">
<h5 class="content-group-lg mb-10" style="margin-top: 0;">
<img src="<?=base_url('assets/images/logo_header.png');?>">
</P></P></P></P>
<small class="display-block"><?=$lang['acesso_usuario']?></small>
</h5>
</div>
<div class="form-group has-feedback has-feedback-left">
<input type="email" name="email" class="form-control" placeholder="<?=$lang['email']?>" required />
<div class="form-control-feedback">
<i class="icon-envelop text-muted"></i>
</div>
</div>
<div class="form-group has-feedback has-feedback-left">
<input type="password" name="password" class="form-control" placeholder="<?=$lang['senha']?>" required />
<div class="form-control-feedback">
<i class="icon-lock2 text-muted"></i>
</div>
</div>
<div class="row">
<div class="col-sm-6 col-xs-6 col-lg-6">
<a href="<?=site_url('backoffice/forgot');?>" class="btn btn-icon bg-danger" data-popup="tooltip" title="<?=$lang['esqueci_minha_senha']?>">
<b><i class="icon-lock"></i></b>
</a>
</div>
<div class="col-sm-6 col-xs-6 col-lg-6">
<button type="submit" class="btn btn-block btn-success btn-labeled btn-labeled-right">
<b><i class="icon-circle-right2"></i></b> <?=$lang['acessar']?>
</button>
</div>
</div>
</div>
<?=form_close();?>
<!-- /advanced login -->