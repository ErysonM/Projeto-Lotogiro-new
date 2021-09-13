<?php 
$act_uri = $this->uri->segment(2, 0);
$lastsec = $this->uri->total_segments();
$act_uri_submenu = $this->uri->segment($lastsec);
$act_uri_submenu = $this->uri->segment(3, 0);
if (!$act_uri)	$act_uri = 'home';
while (is_numeric($act_uri_submenu)):
--$lastsec; 
$act_uri_submenu = $this->uri->segment($lastsec);
endwhile;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="icon" type="image/png" href="<?=base_url('favicon.png');?>" />
<title>Administração | <?=$this->settings->company_name;?></title>

<!-- Global stylesheets -->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css" />
<link href="<?=base_url('assets/css/icons/icomoon/styles.css');?>" rel="stylesheet" type="text/css" />
<link href="<?=base_url('assets/css/icons/fontawesome/styles.min.css');?>" rel="stylesheet" type="text/css">
<link href="<?=base_url('assets/css/bootstrap.css');?>" rel="stylesheet" type="text/css" />
<link href="<?=base_url('assets/css/core.css');?>" rel="stylesheet" type="text/css" />
<link href="<?=base_url('assets/css/components.css');?>" rel="stylesheet" type="text/css" />
<link href="<?=base_url('assets/css/colors.css');?>" rel="stylesheet" type="text/css" />
<link href="<?=base_url('assets/css/custom.css');?>" rel="stylesheet" type="text/css" />
<link href="<?=base_url('assets/css/bootstrap-datetimepicker.min.css');?>" rel="stylesheet" type="text/css" />
<!-- /global stylesheets -->

<!-- Core JS files -->
<script type="text/javascript" src="<?=base_url('assets/js/core/libraries/jquery.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/core/libraries/bootstrap.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/bootstrap-datetimepicker.min.js');?>"></script>
<script type="text/javascript">
jQuery.fn.bstooltip = jQuery.fn.tooltip;
jQuery.fn.bspopover = jQuery.fn.popover;
var base_url = '<?=base_url();?>';
</script>
<!-- /core JS files -->
</head>
<body class="navbar-top" style="margin-bottom: -11px;">
<!-- Main navbar -->
<div class="navbar navbar-default navbar-fixed-top header-highlight">
<div class="navbar-header">
<a class="navbar-brand" href="#">
<img src="<?=base_url('assets/images/logo_header.png');?>">

</a>
<ul class="nav navbar-nav pull-right visible-xs-block">
<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
</ul>
</div>
<div class="navbar-collapse collapse" style="border-color: transparent;" id="navbar-mobile">
<ul class="nav navbar-nav navbar-right">
<li class="dropdown dropdown-user">
<a class="dropdown-toggle" data-toggle="dropdown">
<img src="<?=base_url('assets/images/user_male.png');?>" />
<span><?=($this->admin->firstname . ' ' . $this->admin->lastname);?></span>
<i class="caret"></i>
</a>
<ul class="dropdown-menu dropdown-menu-right">
<li><a href="<?=site_url('admin/logout');?>"><i class="icon-switch2"></i> Logout</a></li>
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
<div class="sidebar-user">
<div class="category-content">
<div class="media">
<a href="#" class="media-left"><img src="<?=base_url('assets/images/user_male.png');?>" class="img-circle img-sm" alt=""></a>
<div class="media-body">
<span class="media-heading text-semibold"><?=($this->admin->firstname . ' ' . $this->admin->lastname);?></span>
<div class="text-size-mini text-muted">
<i class="icon-package text-size-small"></i> Administrador
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
<!-- /user menu -->
<!-- Main navigation -->
<div class="sidebar-category sidebar-category-visible">
<div class="category-content no-padding">
<ul class="navigation navigation-main navigation-accordion">
<!-- Main -->
<li class="navigation-header"><span>Menu principal</span> <i class="icon-menu" title="Menu principal"></i></li>
<li class="<?php if ($act_uri == 'home') { echo "active"; } ?>">
<a href="<?=site_url('admin/home');?>">
<i class="icon-home4"></i>
<span>Home</span>
</a>
</li>
<li class="<?php if ($act_uri == 'announcements') { echo "active"; } ?>">
<a href="<?=site_url('admin/announcements');?>">
<i class="icon-info3"></i>
<span>Comunicados <span class="pull-right-container">
<small class="label bg-blue pull-right" data-toggle="tooltip" title="Comunicados"><?=$this->contcomu?></small>
</span></span>
</a>
</li>
<li class="<?php if ($act_uri == 'faqs') { echo "active"; } ?>">
<a href="<?=site_url('admin/faqs');?>">
<i class="icon-headset"></i>
<span>F.A.Q</span>
</a>
</li>
<li class="<?php if ($act_uri == 'lotterys') { echo "active"; } ?>">
<a href="<?=site_url('admin/lotterys');?>">
<i class="icon-ticket"></i>
<span>Loteria</span>
</a>
</li>
<li class="<?php if ($act_uri == 'users') { echo "active"; } ?>">
<a href="<?=site_url('admin/users');?>">
<i class="icon-users4"></i>
<span>Associados</span>
</a>
</li>
<li class="<?php if ($act_uri == 'invoices') { echo "active"; } ?>">
<a href="<?=site_url('admin/invoices');?>">
<i class="icon-file-text"></i>
<span>Faturas</span>
</a>
</li>
<li class="<?php if ($act_uri == 'withdrawals') { echo "active"; } ?>">
<a href="<?=site_url('admin/withdrawals');?>">
<i class="icon-library2"></i>
<span>Gerenciar saques <span class="pull-right-container">
<small class="label bg-blue pull-right" data-toggle="tooltip" title="Saques Abertos"><?=$this->saquesopen?></small>
</span></span>
</a>
</li>
<!--<li class="<?php if ($act_uri == 'financial') { echo "active"; } ?>">
<a href="#">
<i class="icon-safe"></i>
<span>Financeiro</span>
</a>
<ul>
<li class="<?php if ($act_uri == 'financial' && $act_uri_submenu == 'extract') { echo "active"; } ?>">
<a href="#">Arq. Ret. Banco</a>
</li>
<li class="<?php if ($act_uri == 'financial' && $act_uri_submenu == 'entry') { echo "active"; } ?>">
<a href="#">Gerar Arq. Pag. Banco</a>
</li>
<li class="<?php if ($act_uri == 'financial' && $act_uri_submenu == 'entry') { echo "active"; } ?>">
<a href="#">Arq. Ret. Pag. Banco</a>
</li>
</ul>
</li>-->
<li class="<?php if ($act_uri == 'gateways') { echo "active"; } ?>">
<a href="<?=site_url('admin/gateways');?>">
<i class="icon-wallet"></i>
<span>Gateways de Pagamento</span>
</a>
</li>	
<li class="<?php if ($act_uri == 'reports') { echo "active"; } ?>">
<a href="#">
<i class="icon-stats-growth"></i>
<span>Relatórios</span>
</a>
<ul>
<li class="<?php if ($act_uri == 'reports' && $act_uri_submenu == 'extract') { echo "active"; } ?>">
<a href="#">Fluxo de Caixa</a>
</li>
<li class="<?php if ($act_uri == 'reports' && $act_uri_submenu == 'entry') { echo "active"; } ?>">
<a href="#">Entradas</a>
</li>
<li class="<?php if ($act_uri == 'reports' && $act_uri_submenu == 'withdrawal') { echo "active"; } ?>">
<a href="#">Saques</a>
</li>
</ul>
</li>							
<li class="<?php if ($act_uri == 'system') { echo "active"; } ?>">
<a href="#">
<i class="icon-cog"></i>
<span>Sistema</span>
</a>
<ul>
<li class="<?php if ($act_uri == 'system' && ($act_uri_submenu != 'index' && $act_uri_submenu != 'users' && $act_uri_submenu != 'useredit' && $act_uri_submenu != 'usercreate')) { echo "active"; } ?>">
<a href="<?=site_url('admin/system/plans');?>">Planos</a>
</li>
<li class="<?php if ($act_uri == 'system' && $act_uri_submenu != 'index' && $act_uri_submenu != 'plans' && $act_uri_submenu != 'planedit' && $act_uri_submenu != 'plancreate') { echo "active"; } ?>">
<a href="<?=site_url('admin/system/users');?>">Administradores</a>
</li>
<li class="<?php if ($act_uri == 'system' && $act_uri_submenu == 'index') { echo "active"; } ?>">
<a href="<?=site_url('admin/system/index');?>">Configurações</a>
</li>
</ul>
</li>
<?php /*<li class="<?php if ($act_uri == 'plans') { echo "active"; } ?>">
<a href="<?=site_url('admin/plans');?>">
<i class="icon-package"></i>
<span>Planos</span>
</a>
</li> */ ?>
<!-- /main -->
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
<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?=$module_name;?></span><?=($page_name ? ' - ' . $page_name : '');?></h4>
</div>
<?php if ($header_button != FALSE): ?><div class="heading-elements">
<?=$header_button;?>
</div><?php endif; ?>
</div>
<div class="breadcrumb-line breadcrumb-line-wide no-margin no-border-bottom" style="box-shadow: none;">
<?=$this->breadcrumbs->show();?>
<?php if(count($breadcrumbs_menu) != 0): ?>
<ul class="breadcrumb-elements"><?php foreach($breadcrumbs_menu as $menu): ?>
<li class="<?=($menu['sub'] ? 'dropdown' : '');?>">
<a href="<?=$menu['link'];?>" <?=($menu['sub'] ? 'class="dropdown-toggle" data-toggle="dropdown"' : '');?>>
<?=($menu['icon'] ? '<i class="' . $menu['icon'] . ' position-left"></i>' : '');?>
<?=$menu['name'];?>
<?=($menu['sub'] ? '<span class="caret"></span>' : '');?>
</a>
<?php if(count($menu['sub']) != 0): ?>
<ul class="dropdown-menu dropdown-menu-right"><?php foreach($menu['sub'] as $submenu): ?>
<li><a href="<?=$submenu['link'];?>">
<?=($submenu['icon'] ? '<i class="' . $submenu['icon'] . ' position-left"></i>' : '');?>
<?=$submenu['name'];?>
</a></li>
<?php endforeach; ?></ul>
<?php endif; ?>
</li>
<?php endforeach; ?></ul>
<?php endif; ?>
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

<script type="text/javascript" src="<?=base_url('assets/js/core/app.js');?>"></script>
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
/**
* Brazilian translation for bootstrap-datetimepicker
* Cauan Cabral <cauan@radig.com.br>
*/
;(function($){
$.fn.datetimepicker.dates['pt-BR'] = {
format: 'dd/mm/yyyy',
days: ["Domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado", "Domingo"],
daysShort: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb", "Dom"],
daysMin: ["Do", "Se", "Te", "Qu", "Qu", "Se", "Sa", "Do"],
months: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
monthsShort: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
today: "Hoje",
suffix: [],
meridiem: []
};
}(jQuery));
$(".form_datetime").datetimepicker({
format: "yyyy-mm-dd hh:ii",
autoclose: true,
language: 'pt-BR'
});
</script>            
<script type="text/javascript">
$.extend($.fn.dataTable.defaults, {
autoWidth: false,
dom: '<"datatable-header"fl><"datatable-scroll"tr><"datatable-footer"ip>',
info: false,
iDisplayLength: 10,
bLengthChange: false,
language: {
sEmptyTable: "Nenhum registro encontrado",
sInfo: "Exibindo _START_ até _END_ de _TOTAL_ registros",
sInfoEmpty: "Exibindo 0 até 0 de 0 registros",
sInfoFiltered: "(Filtrados de _MAX_ registros)",
sInfoPostFix: "",
sInfoThousands: ".",
sLengthMenu: "_MENU_",
sLoadingRecords: "Carregando...",
sProcessing: '<i class="fa fa-spinner fa-pulse fa-4x fa-fw"></i>',
sZeroRecords: "Nenhum registro encontrado",
sSearch: "",
oPaginate: {
sNext: '<i class=" icon-arrow-right15"></i>',
sPrevious: '<i class=" icon-arrow-left15"></i>',
sFirst: "Primeiro",
sLast: "Último"
},
oAria: {
sSortAscending: ": Ordenar colunas de forma ascendente",
sSortDescending: ": Ordenar colunas de forma descendente"
}
}
});
$.extend($.fn.dataTable.ext.classes, {
sFilterInput:	"form-control",
sLengthSelect:	"form-control"
});
$(document).ready(function() {
$('.date-mask').setMask('99/99/9999');
$('.cpf-mask').setMask('999.999.999-99');
$('.cep-mask').setMask('99999-999');
$('.phone-mask').setMask('(99) 9999-9999');
$('.mobilephone-mask').setMask('(99) 99999-9999').focusout(function(event) {
var target	= (event.currentTarget) ? event.currentTarget : event.srcElement,
phone	= target.value.replace(/\D/g, ''),
element	= $(target);

element.unsetMask();
if(phone.length > 10)
element.setMask('(99) 99999-9999');
else
element.setMask('(99) 9999-99999');
});

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
$text	= $message['text']	? $message['text']	: 'Erro desconhecido! Contate o administrador do sistema.';
$type	= $message['type']	? $message['type']	: 'error';
echo 'toastr["'.$type.'"]("'.$text.'", '.(!$title ? 'false' : '"'.$title.'"').')';
endif;
?>
});
</script>
</body>
</html>