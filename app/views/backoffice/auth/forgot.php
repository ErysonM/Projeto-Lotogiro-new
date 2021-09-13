<?php
/**
* Project:    mmn.dev
* File:       forgot.php
* Author:     Felipe Medeiros
* Createt at: 09/06/2016 - 07:42
*/

$idioma = "pt-br";
if(!empty($_COOKIE['idioma']))
{
	$idioma = $_COOKIE['idioma'];
}

$file = substr(APPPATH, 0, strlen(APPPATH)-4);
$path = $file."langs/backoffice/".$idioma.".php";
include($path);
?>
<!-- Password recovery -->
<?=form_open('backoffice/forgot', ['role'=> 'form', 'id' => 'forgot'])?>
<div class="panel panel-body login-form">
<div class="text-center">
<h5 class="content-group">
<img src="<?=base_url('assets/images/logo_header.png');?>"></P>
<strong><?=$lang['esqueceu_sua_senha']?></strong>
<small class="display-block"><span class="text-justify"><?=$lang['informe_email']?>.</span></small>
</h5>
</div>
<div class="form-group has-feedback">
<input name="email" type="email" class="form-control" placeholder="<?=$lang['email']?>" required />
<div class="form-control-feedback">
<i class="icon-mail5 text-muted"></i>
</div>
</div>
<div class="col-sm-6 col-xs-6 col-lg-6">
<a href="<?=site_url('backoffice/login');?>" class="btn btn-icon bg-danger" data-popup="tooltip" title="<?=$lang['voltar']?>">
<b><i class="icon-circle-left2"></i> <?=$lang['voltar']?></b>
</a>
</div>
<div class="col-sm-6 col-xs-6 col-lg-6">
<button type="submit" class="btn btn-icon bg-primary"><?=$lang['recuperar']?> <i class="icon-circle-right2 position-right"></i></button>
</div>
</div>
<?=form_close();?>
<!-- /password recovery -->