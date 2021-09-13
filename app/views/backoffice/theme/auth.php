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
		var base_url	= '<?=base_url();?>';
	</script>
	<script type="text/javascript" src="<?=base_url('assets/js/plugins/loaders/blockui.min.js');?>"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="<?=base_url('assets/js/core/libraries/jquery_ui/core.min.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/plugins/forms/wizards/form_wizard/form.min.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/plugins/forms/wizards/form_wizard/form_wizard.min.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/plugins/forms/styling/uniform.min.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/plugins/notifications/toastr.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/plugins/forms/validation/validate.min.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/plugins/extensions/cookie.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/plugins/meiomask/jquery.meio.mask.min.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/core/libraries/jasny_bootstrap.min.js');?>"></script>

	<script type="text/javascript" src="<?=base_url('assets/js/core/app.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/core/medeiros.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/pages/auth.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/core/cep.js');?>"></script>

	<script type="text/javascript" src="<?=base_url('assets/js/plugins/ui/ripple.min.js');?>"></script>
	<!-- /theme JS files -->

	<style>
	/*.vid-container{
	  position:relative;
	  height:100vh;
	  overflow:hidden;
	}
	.bgvid{
	  position:absolute;
	  left:0;
	  top:0;
	  width:100vw;
	}
	.panel{
	//opacity: .9;
	}*/
	</style>

</head>

<body class="login-container bg-slate-800 login-cover">
<div class="vid-container">
<!-- Page container -->
<div class="page-container login-container">
	<!-- Page content -->
	<div class="page-content">
		<!-- Main content -->
		<div class="content-wrapper">
			<!-- Content area -->
			<div class="content">
				<?=$yield;?>
				
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
				<!-- Footer -->
				<div class="text-white text-center">
					&copy; <?=date('Y');?> <a href="#" class="text-white"><?=$this->settings->company_name;?></a> - <?=$lang['direitos_reservados']?>.
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
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('.date-mask').setMask('99/99/9999');
		$('.cpf-mask').setMask('999.999.999-99');
		$('.cep-mask').setMask('99999-999');
		$('.phone-mask').setMask('(99) 9999-9999');
		$('.mobilephone-mask').setMask('(99) 99999-9999');

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