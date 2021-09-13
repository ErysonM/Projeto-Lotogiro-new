<?php 
if(isset($_GET['lang']) && $_GET['lang'] != null){
    $novoidioma = $_GET['lang'];
    $path = "langs/backoffice/".$novoidioma.".php";
    if(file_exists($path)){
        setcookie("idioma", $novoidioma, time()+(24*3600*30));
        /*$arq = $_SERVER['PHP_SELF'];
        $arq2 = explode("/", $arq);
        $arq3 = end($arq2);
        header("Location: $arq3");*/
        $url = $_SERVER["REQUEST_URI"];
        $pos = strpos($url, "?");
        $url = substr($url, 0, $pos);
        header("Location: $url");
    }else{
        echo "<script>alert('Este idioma não está disponível.');</script>";	
    }
}
//var_dump($_COOKIE['idioma']);
if(isset($_COOKIE['idioma'])){
    $idioma = $_COOKIE['idioma'];
    $caminho = "langs/backoffice/".$idioma.".php";
if(file_exists($caminho)){
    include($caminho);
}else{
    exit();	
}
}else{
    $idioma = "pt-br";
    setcookie("idioma","pt-br", time()+(24*3600*30));
    include("langs/backoffice/pt-br.php");
}

$act_uri = $this->uri->segment(2, 0);
$lastsec = $this->uri->total_segments();
$act_uri_submenu = $this->uri->segment($lastsec);
$act_uri_submenu = $this->uri->segment(3, 0);
if (!$act_uri)	$act_uri = 'home';
while (is_numeric($act_uri_submenu)):
--$lastsec; 
$act_uri_submenu = $this->uri->segment($lastsec);
endwhile;

$last_activity = User::find_by_id($this->user->id);
$last_activity->last_activity = date("Y-m-d H:i:s");
$last_activity->save();

function no_accent($str)
{
    return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/", "/(ç)/","/(Ç)/"),explode(" ","a A e E i I o O u U n N c C"),$str);
}

function text_lang($str)
{
	$str = no_accent($str);
	$str = strtolower($str);
	$str = str_replace(" ", "_", $str);
	$str = str_replace("de_", "", $str);
	$str = str_replace("-", "", $str);
	$str = str_replace(".", "", $str);
	$str = str_replace("/", "_", $str);

	return $str;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="icon" type="image/png" href="<?=base_url('favicon.png');?>" />
<title><?=$lang['escritorio']?> | <?=$this->settings->company_name;?></title>

<!-- Global stylesheets -->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css" />
<link href="<?=base_url('assets/css/icons/icomoon/styles.css');?>" rel="stylesheet" type="text/css" />
<link href="<?=base_url('assets/css/icons/fontawesome/styles.min.css');?>" rel="stylesheet" type="text/css">
<link href="<?=base_url('assets/css/bootstrap.css');?>" rel="stylesheet" type="text/css" />
<link href="<?=base_url('assets/css/core.css');?>" rel="stylesheet" type="text/css" />
<link href="<?=base_url('assets/css/components.css');?>" rel="stylesheet" type="text/css" />
<link href="<?=base_url('assets/css/colors.css');?>" rel="stylesheet" type="text/css" />
<link href="<?=base_url('assets/css/binario.css');?>" rel="stylesheet" type="text/css" />
<link href="<?=base_url('assets/css/custom.css');?>" rel="stylesheet" type="text/css" />
<!-- /global stylesheets -->

<!-- Core JS files -->
<script type="text/javascript" src="<?=base_url('assets/js/core/libraries/jquery.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/core/libraries/bootstrap.min.js');?>"></script>
<script type="text/javascript">
jQuery.fn.bstooltip = jQuery.fn.tooltip;
jQuery.fn.bspopover = jQuery.fn.popover;
var base_url = '<?=base_url();?>';
</script>
<!-- /core JS files -->
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
</head>
<body class="navbar-top">
<!-- Main navbar -->
<div class="navbar navbar-default navbar-fixed-top header-highlight">
<div class="navbar-header">
<a class="navbar-brand" href="<?=site_url('backoffice/home');?>">
<img src="<?=base_url('assets/images/logo_header.png');?>">

<ul class="nav navbar-nav pull-right visible-xs-block">
<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-user"></i></a></li>
<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
</ul>
</div>
<div class="navbar-collapse collapse" style="border-color: transparent;" id="navbar-mobile">
<ul class="nav navbar-nav">
    <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>

<?php
$url_atual = base_url($_SERVER["REQUEST_URI"]);
$url_home = base_url('backoffice/home');
if($url_atual == $url_home)
{
?>
   
<?php
}
?>
</ul>
<ul class="nav navbar-nav navbar-right">
<li class="dropdown dropdown-user">
<a class="dropdown-toggle" data-toggle="dropdown">
<img src="<?=base_url('assets/images/user_' . $this->user->gender . '.png');?>" id="my_avatar" /></span>
<span><?=($this->user->firstname . ' ' . $this->user->lastname);?></span>
<i class="caret"></i>
</a>
<ul class="dropdown-menu dropdown-menu-right">
<li> 
	<a> 
    <img src='<?=base_url('assets/img');?>/pt-br.png' width="20px" height="20px" onclick="location.href='?lang=pt-br'">
	<img src='<?=base_url('assets/img');?>/en.png' width="20px" height="20px" onclick="location.href='?lang=en'">
	<img src='<?=base_url('assets/img');?>/es.png' width="20px" height="20px" onclick="location.href='?lang=es'">
    </a>	
</li>
<li><a href="<?=site_url('backoffice/settings/profile');?>"><i class="icon-profile"></i> <?=$lang['perfil']?></a></li>
<?php /*<li><a href="<?=site_url('backoffice/settings/avatar');?>"><i class="icon-user"></i> Avatar</a></li>*/ ?>
<li><a href="<?=site_url('backoffice/settings/link');?>"><i class="icon-link2"></i> <?=$lang['link_indicacao']?></a></li>
<li><a href="<?=site_url('backoffice/settings/address');?>"><i class="icon-location4"></i> <?=$lang['endereco']?></a></li>
<li><a href="<?=site_url('backoffice/settings/bank');?>"><i class="icon-library2"></i> <?=$lang['conta_bancaria']?></a></li>
<li><a href="<?=site_url('backoffice/settings/bitcoin');?>"><i class="icon-coins"></i> <?=$lang['carteira_bitcoin']?></a></li>
<li><a href="<?=site_url('backoffice/settings/password');?>"><i class="icon-lock"></i> <?=$lang['alterar_senha']?></a></li>
<li class="divider"></li>
<li><a href="<?=site_url('backoffice/logout');?>"><i class="icon-switch2"></i> <?=$lang['logout']?></a></li>
</ul>
</li>
</ul>
</div>
</div>
<!-- /main navbar -->
<!-- Page container -->
<div class="page-container">
<!-- Page content -->
<div class="page-content">
<!-- Main sidebar -->
<div class="sidebar sidebar-main sidebar-fixed">
<div class="sidebar-content">
<!-- User menu -->

<!-- /user menu -->
<div class="sidebar-user">
<div class="category-content">
<div class="media">
<a href="#" class="media-left"><img src="<?=base_url('assets/images/user_' . $this->user->gender . '.png');?>" class="img-circle img-sm" alt=""></a>
<div class="media-body">
<span class="media-heading text-semibold"><?=($this->user->firstname . ' ' . $this->user->lastname);?></span>
<div class="text-size-mini text-muted">
<i class="icon-package text-size-small"></i> Associado
</div>
</div>
<div class="media-right media-middle">
<ul class="icons-list">
<li>
<a href="<?=site_url('admin/logout');?>"><i class="icon-switch2"></i></a>
</li>
</ul>
</div>
</div>
</div>
</div>
<!-- Main navigation -->
<div class="sidebar-category sidebar-category-visible">
<div class="category-content no-padding">
<ul class="navigation navigation-main navigation-accordion">
<!-- Main -->
<li class="navigation-header"><span><?=$lang['menu_principal']?></span> <i class="icon-menu" title="<?=$lang['menu_principal']?>"></i></li>
<li class="<?php if ($act_uri == 'home') { echo "active"; } ?>">
<a href="<?=site_url('backoffice/home');?>">
<i class="icon-home4"></i>
<span><?=$lang['home']?></span>
</a>
</li>
<li class="<?php if ($act_uri == 'announcements') { echo "active"; } ?>">
<a href="<?=site_url('backoffice/announcements');?>">
<i class="icon-info3"></i>
<span><?=$lang['comunicados']?> <span class="pull-right-container">
<small class="label bg-blue pull-right" data-toggle="tooltip" title="Comunicados"><?=$this->contcomu?></small>
</span></span>
</a>
</li>
<li class="<?php if ($act_uri == 'recharge') { echo "active"; } ?>">
<?php /*<a href="<?=site_url('backoffice/recharge');?>">*/ ?>
<a href="javascript:void(0);" data-toggle="modal" data-target="#modal-investment">
<i class="icon-coins"></i>
<span><?=$lang['plano_investimento']?></span>
</a>
</li>
<li class="<?php if ($act_uri == 'invoices') { echo "active"; } ?>">
<a href="<?=site_url('backoffice/invoices');?>">
<i class="icon-file-text"></i>
<span><?=$lang['faturas']?></span>
</a>
</li>
<?php if($this->user->status == 'active'){ ?>
<li class="<?php if ($act_uri == 'tree') { echo "active"; } ?>">
<a href="#">
<i class="icon-tree7"></i>
<span><?=$lang['minha_rede']?></span>
</a>
<ul>
<li class="<?php if ($act_uri == 'tree' && $act_uri_submenu == 'my_indicated') { echo "active"; } ?>">
<a href="<?=site_url('backoffice/tree/my_indicated');?>"><?=$lang['meus_indicados']?></a>
</li>
<li class="<?php if ($act_uri == 'tree' && $act_uri_submenu == 'linear') { echo "active"; } ?>">
<a href="<?=site_url('backoffice/tree/linear');?>"><?=$lang['rede_linear']?></a>
</li>
<!--li class="<?php if ($act_uri == 'tree' && $act_uri_submenu == 'binary') { echo "active"; } ?>">
<a href="<?=site_url('backoffice/tree/binary');?>"><?=$lang['arvore_binaria']?></a>
</li-->
</ul>
</li>
<?php } ?>
<?php if($this->user->status == 'active'){ ?>
<li class="<?php if ($act_uri == 'ewallet') { echo "active"; } ?>">
<a href="#">
<i class="icon-library2"></i>
<span><?=$lang['financeiro']?></span>
</a>
<ul>
<li class="<?php if ($act_uri == 'ewallet' && $act_uri_submenu == 'extract') { echo "active"; } ?>">
<a href="<?=site_url('backoffice/ewallet/extract');?>"><?=$lang['extrato']?></a>
</li>
<li class="<?php if ($act_uri == 'ewallet' && ($act_uri_submenu == 'withdrawal' OR $act_uri_submenu == 'view')) { echo "active"; } ?>">
<a href="<?=site_url('backoffice/ewallet/withdrawal');?>"><?=$lang['saques']?></a>
</li>
<?php if($this->settings->lock_transfer != 'Y'): ?>
<li class="<?php if ($act_uri == 'ewallet' && $act_uri_submenu == 'transfer') { echo "active"; } ?>">
<a href="<?=site_url('backoffice/ewallet/transfer');?>"><?=$lang['transferir_saldo']?></a>
</li>
<?php endif; ?>
<?php if($this->settings->lock_payout != 'Y'): ?>
<li class="<?php if ($act_uri == 'ewallet' && $act_uri_submenu == 'payout') { echo "active"; } ?>">
<a href="<?=site_url('backoffice/ewallet/payout');?>"><?=$lang['pagar_faturas']?></a>
</li>
<?php endif; ?>
</ul>
</li>
<?php } ?>

<li class="<?php if ($act_uri == 'lotterys') { echo "active"; } ?>">
<a href="<?=site_url('backoffice/lotterys');?>">
<i class="icon-ticket" style="color: gold;"></i>
<span><font color="gold"><b><?=$lang['loteria']?></b> <span class="label label-warning"><?=$lang['novidade']?></span></font></span>
</a>
</li>
<!--li class="<?php if ($act_uri == 'school') { echo "active"; } ?>">
<a href="<?=site_url('backoffice/school');?>">
<i class="icon-books"></i>
<span><?=$lang['ebooks_audiobooks']?></span>
</a>
</li-->
<!--li class="<?php if ($act_uri == 'statistics') { echo "active"; } ?>">
<a href="<?=site_url('backoffice/statistics');?>">
<i class="icon-graph"></i>
<span><?=$lang['estatisticas']?></span>
</a>
</li-->


<?php if($this->user->status == 'active'){ ?>
<li class="<?php if ($act_uri == 'support' && $act_uri_submenu == 'ads') { echo "active"; } ?>">
<a href="<?=site_url('backoffice/support/ads');?>">
<i class="icon-flag3"></i>
<span><?=$lang['material_apoio']?></span>
</a>
</li>
<?php } ?>
<!--li class="<?php if ($act_uri == 'support' && $act_uri_submenu == 'faq') { echo "active"; } ?>">
<a href="<?=site_url('backoffice/support/faq');?>">
<i class="icon-headset"></i>
<span><?=$lang['faq']?></span>
</a>
</li-->
<!-- /main -->
<br>
<br>
<br>
<br>
<li class="navigation-header"><span><?=$lang['idiomass']?></span> <i class="icon-menu" title="<?=$lang['idiomass']?>"></i></li>
<li> 
	<a> 
    <img src='<?=base_url('assets/img');?>/pt-br.png' width="25px" height="25px" onclick="location.href='?lang=pt-br'">
	<img src='<?=base_url('assets/img');?>/en.png' width="25px" height="25px" onclick="location.href='?lang=en'">
	<img src='<?=base_url('assets/img');?>/es.png' width="25px" height="25px" onclick="location.href='?lang=es'">
    </a>	
</li>
</ul>
</div>
</div>
<!-- /main navigation -->
</div>
</div>
<!-- /main sidebar -->
<!-- Main content -->
<div class="content-wrapper ">
<!-- Page header -->
<div class="page-header panel noPrint no-border-top no-border-left no-border-right border-bottom-lg border-bottom-teal-400" style="padding-bottom: 0;">
<div class="page-header-content">
<div class="page-title">
<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?=$lang[text_lang($module_name)];?></span><?=($page_name ? ' - ' . $lang[text_lang($page_name)] : '');?></h4>
</div>
<?php if ($header_button != FALSE): ?><div class="heading-elements">
<?=$header_button;?>
</div><?php endif; ?>
</div>
<div class="breadcrumb-line breadcrumb-line-wide no-margin no-border-bottom" style="box-shadow: none;">
<?=$this->breadcrumbs->show();?>
</div>
</div>
<!-- /page header -->
<!-- Content area -->
<div class="content">
<?=$yield;?>
</div>
<!-- /content area -->
</div>
<!-- /main content -->

<div class="modal fade" id="modal-investment">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header bg-primary-800">
<button type="button" class="close" data-dismiss="modal">
<span aria-hidden="true">
<i class="icon-x icon-fw"></i>
</span>
</button>
<h4 class="modal-title">
<?=$lang['realizar_investimento']?>
</h4>
</div>
<form id="f-eWallet-investment" action="<?=site_url('backoffice/recharge');?>" onsubmit="return false;" method="post">
<div class="modal-body">
<div class="form-group">
<label for="value"><?=$lang['valor_investimento']?>:</label>
<input type="hidden" name="value" id = "value" value="100"   />
</div>
<div class="form-group">
<p><?=$lang['regras_investimento']?>:</p>
<ul class="clist clist-angle">
<li><?=$lang['msg1_investimento']?> .</li>
<li><?=$lang['msg2_investimento']?>.</li>
</ul>
</div>
</div>
<div class="modal-footer">
<input type="submit" class="btn btn-success" value="<?=$lang['investir']?>" />
</div>
</form>
</div>
</div>
</div>


</div>
<!-- /page content -->
</div>
<!-- /page container -->

<!-- Core JS files -->
<script type="text/javascript" src="<?=base_url('assets/js/plugins/loaders/pace.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/plugins/loaders/blockui.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/plugins/notifications/sweet_alert.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/plugins/notifications/toastr.js');?>"></script>
<!-- /core JS files -->
<!-- Theme JS files -->
<script type="text/javascript" src="<?=base_url('assets/js/core/libraries/jquery_ui/interactions.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/core/libraries/jquery_ui/widgets.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/core/libraries/jquery_ui/effects.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/plugins/extensions/mousewheel.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/plugins/ui/nicescroll.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/plugins/notifications/toastr.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/plugins/tables/datatables/datatables.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/plugins/visualization/d3/d3.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/plugins/visualization/d3/d3_tooltip.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/plugins/counterup/waypoints.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/plugins/counterup/jquery.counterup.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/plugins/meiomask/jquery.meio.mask.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/plugins/priceformat/jquery.price_format.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/jqueryrotate.js');?>"></script>

<script type="text/javascript" src="<?=base_url('assets/js/core/app.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/e-wallet.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/core/medeiros.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/core/cep.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/layout_fixed_custom.js');?>"></script>
<!-- /theme JS files -->
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-39808340-8', 'auto');
ga('send', 'pageview');
</script>
<script type="text/javascript">
window.block_form	= function (form, status) {
if (status)
$('input, textarea, button', form).attr('disabled', true);
else
$('input, textarea, button', form).removeAttr('disabled');
};

$.extend($.fn.dataTable.defaults, {
autoWidth: false,
dom: '<"datatable-header"fl><"datatable-scroll"tr><"datatable-footer"ip>',
info: false,
iDisplayLength: 10,
bLengthChange: false,
language: {
sEmptyTable: "<?=$lang['dt_vazia']?>",
sInfo: "<?=$lang['exibindo']?> _START_ <?=$lang['ate']?> _END_ <?=$lang['de']?> _TOTAL_ <?=$lang['registros']?>",
sInfoEmpty: "<?=$lang['exibindo']?> 0 <?=$lang['ate']?> 0 <?=$lang['de']?> 0 <?=$lang['registros']?>",
sInfoFiltered: "(<?=$lang['filtrados']?> <?=$lang['de']?> _MAX_ <?=$lang['registros']?>)",
sInfoPostFix: "",
sInfoThousands: ".",
sLengthMenu: "_MENU_",
sLoadingRecords: "<?=$lang['dt_carregando']?>",
sProcessing: '<i class="fa fa-spinner fa-pulse fa-4x fa-fw"></i>',
sZeroRecords: "<?=$lang['dt_vazia']?>",
sSearch: "",
oPaginate: {
sNext: '<i class=" icon-arrow-right15"></i>',
sPrevious: '<i class=" icon-arrow-left15"></i>',
sFirst: "<?=$lang['primeiro']?>",
sLast: "<?=$lang['ultimo']?>"
},
oAria: {
sSortAscending: ": <?=$lang['ordem_asc']?>",
sSortDescending: ": <?=$lang['ordem_desc']?>"
}
}
});
$.extend($.fn.dataTable.ext.classes, {
sFilterInput:	"form-control",
sLengthSelect:	"form-control"
});
$(document).ready(function() {
$('.counter').counterUp({
delay: 100,
time: 1200
});

$('.date-mask').setMask('99/99/9999');
$('.cpf-mask').setMask('999.999.999-99');
$('.cep-mask').setMask('99999-999');
$('.phone-mask').setMask('(99) 9999-9999');
$('.mobilephone-mask').setMask('(99) 99999-9999');

$('.money-mask').priceFormat({
prefix: '',
<?php
switch ($this->settings->money_format)
{
case 1:
?>
centsSeparator: '.',
thousandsSeparator: ','
<?php
break;
case 2:
?>
centsSeparator: '.',
thousandsSeparator: ','
<?php
break;
case 3:        
?>
centsSeparator: '.',
thousandsSeparator: ''
<?php
break;
case 4:
?>
centsSeparator: ',',
thousandsSeparator: ''
<?php
break;
default:
?>
centsSeparator: '.',
thousandsSeparator: ','
<?php
break;
}
?>
});

<?php
$message = $message ? $message : $this->session->flashdata('message');
if ($message):
$title	= $message['title']	? $message['title']	: FALSE;
$text	= $message['text']	? $message['text']	: $lang['erro_desconhecido'];
$type	= $message['type']	? $message['type']	: 'error';
echo 'toastr["'.$type.'"]("'.$text.'", '.(!$title ? 'false' : '"'.$title.'"').')';
endif;
?>
});

/*
var angle = 0;
setInterval(function(){
angle+=3;
$("#my_avatar2").rotate(angle);
},50);
*/
</script>
</body>
</html>