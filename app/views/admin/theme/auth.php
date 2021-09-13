<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="theme-color" content="#00695C" />
<link rel="icon" type="image/png" href="<?=base_url('favicon.png');?>" />
<title><?=$page_name;?> | <?=$this->settings->company_name;?></title>

<!-- Global stylesheets -->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
<link href="<?=base_url('assets/css/icons/icomoon/styles.css');?>" rel="stylesheet" type="text/css">
<link href="<?=base_url('assets/css/bootstrap.css');?>" rel="stylesheet" type="text/css">
<link href="<?=base_url('assets/css/extras/animate.min.css');?>" rel="stylesheet" type="text/css">
<link href="<?=base_url('assets/css/core.css');?>" rel="stylesheet" type="text/css">
<link href="<?=base_url('assets/css/components.css');?>" rel="stylesheet" type="text/css">
<link href="<?=base_url('assets/css/colors.css');?>" rel="stylesheet" type="text/css">
<!-- /global stylesheets -->

<!-- Core JS files -->
<script type="text/javascript" src="<?=base_url('assets/js/plugins/loaders/pace.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/core/libraries/jquery.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/core/libraries/bootstrap.min.js');?>"></script>
<script type="text/javascript">
jQuery.fn.bstooltip = jQuery.fn.tooltip;
jQuery.fn.bspopover = jQuery.fn.popover;
</script>
<script type="text/javascript" src="<?=base_url('assets/js/plugins/loaders/blockui.min.js');?>"></script>
<!-- /core JS files -->

<!-- Theme JS files -->
<script type="text/javascript" src="<?=base_url('assets/js/plugins/forms/wizards/steps.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/plugins/forms/selects/select2.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/plugins/forms/styling/uniform.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/plugins/notifications/toastr.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/plugins/notifications/sweet_alert.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/plugins/forms/validation/validate.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/plugins/extensions/cookie.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/core/libraries/jasny_bootstrap.min.js');?>"></script>

<script type="text/javascript" src="<?=base_url('assets/js/core/app.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/core/medeiros.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/pages/auth.js');?>"></script>

<script type="text/javascript" src="<?=base_url('assets/js/plugins/ui/ripple.min.js');?>"></script>
<!-- /theme JS files -->
</head>
<body class="login-container bg-slate-800 login-cover">
<div id="fb-root"></div>
<!-- Page container -->
<div class="page-container login-container">
<!-- Page content -->
<div class="page-content">
<!-- Main content -->
<div class="content-wrapper">
<!-- Content area -->
<div class="content">
<?=$yield;?>
<!-- Footer -->
<div class="text-white text-center">
&copy; <?=date('Y');?> <a href="#" class="text-white"><?=$this->settings->company_name;?></a> - Todos os direitos reservados.
</div>
<!-- /footer -->
</div>
<!-- /content area -->
</div>
<!-- /main content -->
</div>
<!-- /page content -->
</div>
<!-- /page container -->
<script type="text/javascript">
$(document).ready(function() {
<?php
$message = $message ? $message : $this->session->flashdata('message');
if ($message):
$title	= $message['title']	? $message['title']	: FALSE;
$text	= $message['text']	? $message['text']	: 'Erro desconhecido! Contate o administrador do sistema.';
$type	= $message['type']	? $message['type']	: 'error';
echo 'toastr["'.$type.'"]("'.$text.'", '.(!$title ? 'false' : '"'.$title.'"').')';
endif;
?>
});
</script>
</body>
</html>