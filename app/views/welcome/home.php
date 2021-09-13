<?php
//include("config.php"); //Conexão com o BD 

if(isset($_GET['lang']) && $_GET['lang'] != null){
$novoidioma = $_GET['lang'];
$path = "langs/".$novoidioma.".php";
if(file_exists($path)){
setcookie("idioma", $novoidioma, time()+(24*3600*30));
$arq = $_SERVER['PHP_SELF'];
$arq2 = explode("/", $arq);
$arq3 = end($arq2);
header("Location: $arq3");
}else{
echo "<script>alert('Este idioma não está disponível.');</script>";	
}
}

if(isset($_COOKIE['idioma'])){
$idioma = $_COOKIE['idioma'];
$caminho = "langs/".$idioma.".php";
if(file_exists($caminho)){
include($caminho);
}else{
exit();	
}
}else{
$idioma = "pt-br";
setcookie("idioma","pt-br", time()+(24*3600*30));
include("langs/pt-br.php");
}
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="pt-br"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="pt-br"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="pt-br"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="pt-br"> <!--<![endif]-->
<head>
<!-- Basic -->
<meta charset="utf-8" />
<title><?=$lang['titulo']?> | <?=$lang['frase']?></title>
<!-- Mobile Specific Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

<!-- Libs CSS -->
<link href="<?=base_url('assets/css');?>/bootstrap2.css" rel="stylesheet" />
<link href="<?=base_url('assets/css');?>/font-awesome.min.css" rel="stylesheet" />
<link href="<?=base_url('assets/css');?>/flexslider.css" rel="stylesheet" />
<link href="<?=base_url('assets/css');?>/owl.carousel.css" rel="stylesheet" />

<!-- On Scroll Animations -->
<link href="<?=base_url('assets/css');?>/animate.min.css" rel="stylesheet" />

<!-- Template CSS -->
<link href="<?=base_url('assets/css');?>/style2.css" rel="stylesheet" />

<!-- Responsive CSS -->
<link href="<?=base_url('assets/css');?>/responsive.css" rel="stylesheet" />

<!-- Favicons -->
<link rel="shortcut icon" type="image/png" href="<?=base_url('assets/images/favicon.png');?>" />

<!-- Google Fonts -->
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300italic,800italic,800,700italic,700,600italic,600,400italic,300' rel='stylesheet' type='text/css' />
<link href='//fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css' />
<style type="text/css">
body { margin-bottom: -11px!important; }
#footer { padding: 25px 0!important; }
#footer_copyright p { line-height: inherit!important; }
#about { padding-bottom: 0!important; }
@media  only screen and (max-width: 991px) {
#about #tabs-holder img {
margin-bottom: 0!important;
}
}
.navbar-brand {
padding: 0!important;
margin: 5px 10px!important;
}
@media  only screen and (max-width: 767px) {
.navbar-brand {
margin: 7px 10px!important;
}
}

.video-container {
position: relative;
padding-bottom: 56.25%;
padding-top: 30px; height: 0; overflow: hidden;
}

.video-container iframe,
.video-container object,
.video-container embed {
position: absolute;
top: 0;
left: 0;
width: 100%;
height: 100%;
}

/* centered columns styles */
.row-centered {
text-align:center;
}
.col-centered {
display:inline-block;
float:none;
/* reset the text-align */
text-align:left;
/* inline-block space fix */
margin-right:-4px;
}

</style>
</head>
<body>
<!-- PRELOADER -->
<div class="animationload">
<div class="loader"></div>
</div>

<!-- HEADER -->
<header id="header">

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="myModalLabel"><?=$lang['titulo']?></h4>
</div>
<div class="modal-body">
<div class="video-container">
<iframe width="853" height="480" src="https://www.youtube.com/embed/" frameborder="0" allowfullscreen></iframe>
</div>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal"><?=$lang['fechar']?></button>
</div>
</div>
</div>
</div>

<!-- Modal 2 -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="myModalLabel"><?=$lang['titulo']?></h4>
</div>
<div class="modal-body">
<?=$lang['precadastro'];?>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal"><?=$lang['fechar']?></button>
</div>
</div>
</div>
</div>

<div class="navbar navbar-fixed-top">
<div class="container">
<!-- Navigation Bar -->
<div class="navbar-header" style="margin-top:15px;">
<!-- Responsive Menu Button -->
<button type="button" id="nav-toggle" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-menu">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<!-- Logo Image -->
<a class="navbar-brand" id="GoToHome" href="#intro">
<img src="<?=base_url('assets/images/logo_header.png');?>">
</a>
</div>
<!-- End Navigation Bar -->
<!-- Navigation Menu -->
<nav id="navigation-menu" class="collapse navbar-collapse" role="navigation">
<ul class="nav navbar-nav navbar-right">
<li>
<img src='<?=base_url('assets/img');?>/pt-br.png' width="50px" height="50px" onclick="location.href='?lang=pt-br'">
<img src='<?=base_url('assets/img');?>/en.png' width="50px" height="50px" onclick="location.href='?lang=en'">
<img src='<?=base_url('assets/img');?>/es.png' width="50px" height="50px" onclick="location.href='?lang=es'">
</li>
<li><a class="l-menu selected-nav" id="GoToHome" href="#intro"><?=$lang['menu1']?></a></li>
<li><a class="l-menu" id="GoToAbout" href="#about"><?=$lang['menu2']?></a></li>
<li><a class="l-menu" id="GoToFeatures" href="#features"><?=$lang['menu3']?></a></li>

<li><a class="l-menu" id="GoToContacts" href="#contact-info"><?=$lang['menu5']?></a></li>
<li><a href="<?=base_url('backoffice');?>"><?=$lang['menu6']?></a></li>
</ul>
</nav><!-- End Navigation Menu -->
</div><!-- End container -->
</div><!-- End navbar fixed top  -->
</header><!-- END HEADER -->
<!-- CONTENT WRAPPER -->
<div id="content_wrapper">
<!-- INTRO -->
<section id="intro">

<!-- SLIDES HOLDER -->
<div id="slides">
<ul class="slides-container">

<!-- SLIDE #1 -->
<li>
<!-- Overlay Pattern -->
<div class="overlay"></div>
<!-- Intro Slide Text -->
<div class="intro-content text-center">
<h2><?=$lang['boasvindas']?></h2>a
<!-- INTRO BUTTONS -->
<div class="intro_buttons">
<a class="btn btn-theme" href="#" onClick='alert("<?=$lang['restrito']?>");return false;'><?=$lang['cadastrese']?></a>
<a class="btn btn-theme" href="<?=base_url('backoffice');?>">LOGIN</a>
</div>
</div>
<!-- Background Image  -->
<img src="<?=base_url('assets/img');?>/slider/intro_slide_1.jpg" />
</li>
<!-- END SLIDE #1 -->

<!-- SLIDE #2 -->

<li>
<!-- Overlay Pattern -->
<div class="overlay"></div>
<!-- Intro Slide Text -->
<div class="intro-content text-center">
<h2><?=$lang['frase1']?></h2>
<!-- INTRO BUTTONS -->
<div class="intro_buttons">
<a class="btn btn-theme" href="#" onClick='alert("<?=$lang['restrito']?>");return false;'><?=$lang['cadastrese']?></a>
<a class="btn btn-theme" href="<?=base_url('backoffice');?>"><?=$lang['menu6']?></a>
</div>
</div>
<!-- Background Image  -->
<img src="<?=base_url('assets/img');?>/slider/intro_slide_2.jpg" />
</li><!-- END SLIDE #2 -->
<!-- SLIDE #3 -->
<li>
<!-- Overlay Pattern -->
<div class="overlay"></div>
<!-- Intro Slide Text -->
<div class="intro-content text-center">
<h2><?=$lang['frase2']?></h2>
<!-- INTRO BUTTONS -->
<div class="intro_buttons">
<a class="btn btn-theme" href="#" onClick='alert("<?=$lang['restrito']?>");return false;'><?=$lang['cadastrese']?></a>
<a class="btn btn-theme" href="<?=base_url('backoffice');?>"><?=$lang['menu6']?></a>
</div>
</div>
<!-- Background Image  -->
<img src="<?=base_url('assets/img');?>/slider/intro_slide_3.jpg" />
</li><!-- END SLIDE #3 -->
<!-- SLIDE #4 -->
<li>
<!-- Overlay Pattern -->
<div class="overlay"></div>
<!-- Intro Slide Text -->
<div class="intro-content text-center">
<h2><?=$lang['frase3']?></h2>
<!-- INTRO BUTTONS -->
<div class="intro_buttons">
<a class="btn btn-theme" href="#" onClick='alert("<?=$lang['restrito']?>");return false;'><?=$lang['cadastrese']?></a>
<a class="btn btn-theme" href="<?=base_url('backoffice');?>"><?=$lang['menu6']?></a>
</div>
</div>
<!-- Background Image  -->
<img src="<?=base_url('assets/img');?>/slider/intro_slide_4.jpg" />
</li><!-- END SLIDE #4 -->
</ul>
<!-- SLIDES NAVIGATION -->
<nav class="slides-navigation">
<a href="#" class="next fa fa-angle-right"></a>
<a href="#" class="prev fa fa-angle-left"></a>
</nav>
</div>	<!-- END SLIDES HOLDER -->
<!-- SCROLL DOWN MOUSE -->
<div class="scroll-down" id="GoToAbout" href="#about" style="cursor: pointer;">
<div class="mouse">
<span class="fa fa-angle-down"></span>
</div>
<span><?=$lang['saibamais']?></span>
</div>
</section><!-- END INTRO -->

<!-- ABOUT -->
<section id="about">
<div class="container">
<!-- SECTION TITLE -->
<div class="row">
<div class="col-sm-12 titlebar">
<h3><?=$lang['aempresa']?></h3>
<h2><?=$lang['quemsomos']?></h2>
</div>
</div>
<!-- TABS HOLDER -->
<div id="tabs-holder" class="row">
<!-- TABS -->
<div class="col-md-7">
<!-- Nav Tabs -->
<ul class="nav nav-tabs" role="tablist">
<li class="active animated" data-animation="bounceIn" data-animation-delay="300">
<a href="#tab_1" role="tab" data-toggle="tab"><?=$lang['comofunciona']?></a>
</li>
<li class=" animated" data-animation="bounceIn" data-animation-delay="500">
<a href="#tab_2" role="tab" data-toggle="tab"><?=$lang['nossahistoria']?></a>
</li>
</ul>

<!-- Tab Panes -->
<div class="tab-content">
<!-- TAB #1 -->
<div id="tab_1" class="tab-pane active animated" data-animation="bounceIn" data-animation-delay="300">
<!-- Tab #1 Description -->
<?=$lang['texto1']?>
</div><!-- END TAB #1 -->
<!-- TAB #2 -->
<div id="tab_2" class="tab-pane animated" data-animation="bounceIn" data-animation-delay="300">
<!-- Tab #2 Description -->
<?=$lang['texto2']?>
</div><!-- END TAB #2 -->
</div><!-- End Tab Panes -->

</div><!-- END TABS -->
<!-- TABS HOLDER IMAGE -->
<div class="col-md-5 text-center animated" data-animation="fadeInRight" data-animation-delay="700">
<a data-toggle="modal" data-target="#myModal" href="#"> <img class="img-responsive" src="<?=base_url('assets/img');?>/thumbs/about-image-<?=$idioma?>.png" /></a>
</div>
</div><!-- END TABS HOLDER -->

<div class="row" style="margin-top: 30px;">
<!-- SECTION TITLE -->
<div class="row">
<div class="col-sm-12 titlebar">
<h3><?=$lang['titulo']?></h3>
<h2><?=$lang['maissobre']?></h2>
</div>
</div>
<!-- TABS HOLDER -->
<div class="col-xs-6 col-sm-6 col-md-3 contact-info text-center triggerAnimation animated" data-animate="bounceIn" data-animation-delay="300">
<i class="fa fa-lock"></i>
<h4 class="contact_title"><?=$lang['topico1']?></h4>
<p class="contact_description"><?=$lang['desc1']?></p>
</div>
<div class="col-xs-6 col-sm-6 col-md-3 contact-info text-center triggerAnimation animated" data-animate="bounceIn" data-animation-delay="400">
<i class="fa fa-bank"></i>
<h4 class="contact_title"><?=$lang['topico2']?></h4>
<p class="contact_description"><?=$lang['desc2']?></p>
</div>
<div class="col-xs-6 col-sm-6 col-md-3 contact-info text-center triggerAnimation animated" data-animate="bounceIn" data-animation-delay="500">
<i class="fa fa-certificate"></i>
<h4 class="contact_title"><?=$lang['topico3']?></h4>
<p class="contact_description"><?=$lang['desc3']?></p>
</div>
<div class="col-xs-6 col-sm-6 col-md-3 contact-info text-center triggerAnimation animated" data-animate="bounceIn" data-animation-delay="600">
<i class="fa fa-money"></i>
<h4 class="contact_title"><?=$lang['topico4']?></h4>
<p class="contact_description"><?=$lang['desc4']?></p>
</div>
</div>	<!-- End row -->

<div class="row" style="margin-top:30px;">
<!-- SECTION TITLE -->
<div class="row">
<div class="col-sm-12 titlebar">
<h3><?=$lang['titulo']?></h3>
<h2><?=$lang['dadosimportantes']?></h2>
</div>
</div>
<!-- TABS HOLDER -->
<div class="col-xs-6 col-sm-6 col-md-2 contact-info text-center triggerAnimation animated" data-animate="bounceIn" data-animation-delay="300">
<i class="fa fa-line-chart"></i>
<h4 class="contact_title"><?=display_money($entrada)?></h4>
<p class="contact_description"><?=$lang['desc5']?></p>
</div>
<div class="col-xs-6 col-sm-6 col-md-2 contact-info text-center triggerAnimation animated" data-animate="bounceIn" data-animation-delay="400">
<i class="fa fa-sort-amount-asc"></i>
<h4 class="contact_title"><?=display_money($saida)?></h4>
<p class="contact_description"><?=$lang['desc6']?></p>
</div>
<div class="col-xs-6 col-sm-6 col-md-2 contact-info text-center triggerAnimation animated" data-animate="bounceIn" data-animation-delay="500">
<i class="fa fa-level-up"></i>
<h4 class="contact_title"><?=display_money($uentrada)?></h4>
<p class="contact_description"><?=$lang['desc7']?></p>
</div>
<div class="col-xs-6 col-sm-6 col-md-2 contact-info text-center triggerAnimation animated" data-animate="bounceIn" data-animation-delay="600">
<i class="fa fa-level-down"></i>
<h4 class="contact_title"><?=display_money($usaida)?></h4>
<p class="contact_description"><?=$lang['desc8']?></p>
</div>

<div class="col-xs-6 col-sm-6 col-md-2 contact-info text-center triggerAnimation animated" data-animate="bounceIn" data-animation-delay="700">
<i class="fa fa-child"></i>
<h4 class="contact_title"><?=$onlines?></h4>
<p class="contact_description"><?=$lang['desc9']?></p>
</div>

<div class="col-xs-6 col-sm-6 col-md-2 contact-info text-center triggerAnimation animated" data-animate="bounceIn" data-animation-delay="800">
<i class="fa fa-group"></i>
<h4 class="contact_title"><?=$jogadores?></h4>
<p class="contact_description"><?=$lang['desc10']?></p>
</div>

<br>
<h3><?=$lang['realtime']?></h3>
</div>	<!-- End row -->

<!--<div class="row" style="margin-top: 30px;">
<h3></?=$lang['saibamaisplano']?></h3>

<div id="myCarousel" class="carousel slide" data-ride="carousel">
<!-- Indicators -->
<!--<ol class="carousel-indicators">
<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
<li data-target="#myCarousel" data-slide-to="1"></li>
<li data-target="#myCarousel" data-slide-to="2"></li>
<li data-target="#myCarousel" data-slide-to="3"></li>
<li data-target="#myCarousel" data-slide-to="4"></li>
<li data-target="#myCarousel" data-slide-to="5"></li>
<li data-target="#myCarousel" data-slide-to="6"></li>
<li data-target="#myCarousel" data-slide-to="7"></li>
<li data-target="#myCarousel" data-slide-to="8"></li>
<li data-target="#myCarousel" data-slide-to="9"></li>
<li data-target="#myCarousel" data-slide-to="10"></li>
<li data-target="#myCarousel" data-slide-to="11"></li>
<li data-target="#myCarousel" data-slide-to="12"></li>
<li data-target="#myCarousel" data-slide-to="13"></li>
<li data-target="#myCarousel" data-slide-to="14"></li>
<li data-target="#myCarousel" data-slide-to="15"></li>
<li data-target="#myCarousel" data-slide-to="16"></li>
<li data-target="#myCarousel" data-slide-to="17"></li>
<li data-target="#myCarousel" data-slide-to="18"></li>
</ol>

<!-- Wrapper for slides -->
<!--<div class="carousel-inner" role="listbox">
<div class="item active">
<img src="</?=base_url('assets/img');?>/apresentacao/img1.jpg" alt="</?=$lang['planodenegocios']?>">
</div>

<div class="item">
<img src="</?=base_url('assets/img');?>/apresentacao/img2.jpg" alt="</?=$lang['planodenegocios']?>">
</div>

<div class="item">
<img src="</?=base_url('assets/img');?>/apresentacao/img3.jpg" alt="</?=$lang['planodenegocios']?>">
</div>

<div class="item">
<img src="</?=base_url('assets/img');?>/apresentacao/img4.jpg" alt="</?=$lang['planodenegocios']?>">
</div>

<div class="item">
<img src="</?=base_url('assets/img');?>/apresentacao/img5.jpg" alt="</?=$lang['planodenegocios']?>">
</div>

<div class="item">
<img src="</?=base_url('assets/img');?>/apresentacao/img6.jpg" alt="</?=$lang['planodenegocios']?>">
</div>

<div class="item">
<img src="</?=base_url('assets/img');?>/apresentacao/img7.jpg" alt="</?=$lang['planodenegocios']?>">
</div>

<div class="item">
<img src="</?=base_url('assets/img');?>/apresentacao/img8.jpg" alt="</?=$lang['planodenegocios']?>">
</div>

<div class="item">
<img src="</?=base_url('assets/img');?>/apresentacao/img9.jpg" alt="</?=$lang['planodenegocios']?>">
</div>

<div class="item">
<img src="</?=base_url('assets/img');?>/apresentacao/img10.jpg" alt="</?=$lang['planodenegocios']?>">
</div>

<div class="item">
<img src="</?=base_url('assets/img');?>/apresentacao/img11.jpg" alt="</?=$lang['planodenegocios']?>">
</div>

<div class="item">
<img src="</?=base_url('assets/img');?>/apresentacao/img12.jpg" alt="</?=$lang['planodenegocios']?>">
</div>

<div class="item">
<img src="</?=base_url('assets/img');?>/apresentacao/img13.jpg" alt="</?=$lang['planodenegocios']?>">
</div>

<div class="item">
<img src="</?=base_url('assets/img');?>/apresentacao/img14.jpg" alt="</?=$lang['planodenegocios']?>">
</div>

<div class="item">
<img src="</?=base_url('assets/img');?>/apresentacao/img15.jpg" alt="</?=$lang['planodenegocios']?>">
</div>

<div class="item">
<img src="</?=base_url('assets/img');?>/apresentacao/img16.jpg" alt="</?=$lang['planodenegocios']?>">
</div>

<div class="item">
<img src="</?=base_url('assets/img');?>/apresentacao/img17.jpg" alt="</?=$lang['planodenegocios']?>">
</div>

<div class="item">
<img src="</?=base_url('assets/img');?>/apresentacao/img18.jpg" alt="</?=$lang['planodenegocios']?>">
</div>

<div class="item">
<img src="</?=base_url('assets/img');?>/apresentacao/img19.jpg" alt="</?=$lang['planodenegocios']?>">
</div>

</div>
<!-- Left and right controls -->
<!--<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
<span class="fa fa-arrow-left glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
<span class="sr-only"></?=$lang['anterior']?></span>
</a>
<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
<span class="fa fa-arrow-right glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
<span class="sr-only"></?=$lang['proxima']?></span>
</a>
</div>
<br><br><br>
</div>-->


</div><!-- End container -->
</section><!-- END ABOUT -->
<!-- FEATURES -->
<section id="features">
<div class="container">
<!-- SECTION TITLE -->
<div class="row">
<div class="col-sm-12 titlebar">
<h3><?=$lang['bonificacoes']?></h3>
<h2><?=$lang['comoganhar']?></h2>
</div>
</div>
<div class="row">
<!-- FEATURE BOX -->
<div class="col-sm-6 col-md-6 animated" data-animation="fadeInLeft" data-animation-delay="300">
<div class="features-box">
<!-- Feature Icon -->
<div class="icon-box img-circle">
<i class="fa fa-star"></i>
</div>
<!-- Feature Box Text -->
<div class="features-text">
<h4><?=$lang['bonus1']?></h4>
<?=$lang['descbonus1']?>
</div>
</div>
</div><!-- END FEATURE BOX -->
<!-- FEATURE BOX -->
<div class="col-sm-6 col-md-6 animated" data-animation="fadeInRight" data-animation-delay="300">
<div class="features-box">
<!-- Feature Icon -->
<div class="icon-box img-circle">
<i class="fa fa-star"></i>
</div>
<!-- Feature Box Text -->
<div class="features-text">
<h4><?=$lang['bonus2']?></h4>
<?=$lang['descbonus2']?>
</div>
</div>
</div><!-- END FEATURE BOX -->
</div><!-- End row -->
<div class="row">
<!-- FEATURE BOX -->
<div class="col-sm-6 col-md-6 animated" data-animation="fadeInLeft" data-animation-delay="500">
<div class="features-box">
<!-- Feature Icon -->
<div class="icon-box img-circle">
<i class="fa fa-star"></i>
</div>
<!-- Feature Box Text -->
<div class="features-text">
<h4><?=$lang['bonus3']?></h4>
<?=$lang['descbonus3']?>
</div>
</div>
</div><!-- END FEATURE BOX -->
<!-- FEATURE BOX -->
<div class="col-sm-6 col-md-6 animated" data-animation="fadeInRight" data-animation-delay="500">
<div class="features-box">
<!-- Feature Icon -->
<div class="icon-box img-circle">
<i class="fa fa-star"></i>
</div>
<!-- Feature Box Text -->
<div class="features-text">
<h4><?=$lang['bonus4']?></h4>
<?=$lang['descbonus4']?>
</div>
</div>
</div><!-- END FEATURE BOX -->
</div><!-- End row -->
<div class="row">
<!-- FEATURE BOX -->
<div class="col-sm-6 col-md-6 animated" data-animation="fadeInLeft" data-animation-delay="700">
<div class="features-box">
<!-- Feature Icon -->
<div class="icon-box img-circle">
<i class="fa fa-star"></i>
</div>
<!-- Feature Box Text -->
<div class="features-text">
<h4><?=$lang['bonus5']?></h4>
<?=$lang['descbonus5']?>
</div>
</div>
</div><!-- END FEATURE BOX -->
<!-- FEATURE BOX -->
<div class="col-sm-6 col-md-6 animated" data-animation="fadeInRight" data-animation-delay="700">
<div class="features-box">
<!-- Feature Icon -->
<div class="icon-box">
<i class=""></i>
</div>
<!-- Feature Box Text -->
<div class="features-text">
<h4><?=$lang['bonus6']?></h4>
<?=$lang['descbonus6']?>
</div>
</div>
</div><!-- END FEATURE BOX -->
</div><!-- End row -->
<div class="row">
<div class="col-sm-12 titlebar">
<h3><?=$lang['msgteto']?></h3>
</div>
</div>
</div><!-- End container -->
</section><!-- END FEATURES -->


<!-- CONTACT-INFO -->
<section id="contact-info">
<div class="container">
<!-- SECTION TITLE -->
<div class="row">
<div class="col-sm-12 titlebar">
<h3><?=$lang['faleconosco']?></h3>
<h2><?=$lang['ondeencontrar']?></h2>
</div>
</div>
<div class="row">
<!-- Facebook Location -->
<!--div class="col-xs-6 col-sm-6 col-md-3 contact-info text-center triggerAnimation animated" data-animate="bounceIn">
<i class="fa fa-facebook"></i>
<h4 class="contact_title">Facebook</h4>
<p class="contact_description"><a href="https://bit2coin.club/" target="_blank">link</a></p>
</div-->
<!-- Call/Skype Us -->
<!--div class="col-xs-6 col-sm-6 col-md-3 contact-info text-center triggerAnimation animated" data-animate="bounceIn">
<i class="fa fa-phone"></i>
<h4 class="contact_title"><?=$lang['telefone']?></h4>
<p class="contact_description"><a href="https://chat.whatsapp.com/" target="_blank">+55 00 00000-0000</a></p>
<p class="contact_description">-</p>
</div-->
<!-- Email Address -->
<div class="col-xs-6 col-sm-6 col-md-6 contact-info text-center triggerAnimation animated" data-animate="bounceIn">
<i class="fa fa-envelope-o"></i>
<h4 class="contact_title">Email</h4>
<p class="contact_description"><a href="mailto:support@realforex.club">support@realforex.club</a></p>
</div>
<!-- Working Hours -->
<div class="col-xs-6 col-sm-6 col-md-6 contact-info text-center triggerAnimation animated" data-animate="bounceIn">
<i class="fa fa-clock-o"></i>
<h4 class="contact_title"><?=$lang['atendimento']?></h4>
<p class="contact_description"><?=$lang['hratendimento']?></p>
</div>
</div>	<!-- End row -->
</div><!-- End container -->
</section><!-- END CONTACT-INFO -->

<!-- FOOTER -->
<footer id="footer">
<div class="container">
<!-- FOOTER COPYRIGHT -->
<div class="row">
<div id="footer_copyright" class="col-sm-12 text-center">
<p style="margin-bottom: 0;">
&copy;<?php echo date("Y"); ?> <span><?=$lang['titulo']?></span> | <?=$lang['copyright']?>
<?php /*$lang['creditos']*/ ?>
</p>
</div>
</div>

<!-- EXTERNAL SCRIPTS -->

<script type="text/javascript">
function calculator(formc) {
var amount=formc.amount.value;
var propercent;
var proreturn;

//if (amount<100)   { alert('<?=$lang['valormin']?>'); }
//if (amount>10000) { alert('<?=$lang['valormax']?>');  }

if (amount>=10 && amount<=10000) {propercent=225;}

if (propercent){
proreturn=(amount*propercent)/100;
document.getElementById("profitboxreturn").innerHTML = "<strong>$"+proreturn+" ("+propercent+"%) </strong>";
proreturn2=proreturn/75;
document.getElementById("profitboxreturn2").innerHTML = "<?=$lang['receba']?> <strong>$"+proreturn2+"</strong> <?=$lang['aodia']?>";
document.getElementById("pontos").innerHTML = "<?=$lang['vale']?> <strong>"+amount+"</strong> <?=$lang['pontos']?>";
}else{
document.getElementById("profitboxreturn").innerHTML = "<?=$lang['alertavalor']?>";
document.getElementById("profitboxreturn2").innerHTML = "<?=$lang['alertavalor']?>";
document.getElementById("pontos").innerHTML = "<?=$lang['alertavalor']?>";
}
return false;
}
</script>

<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-39808340-8', 'auto');
ga('send', 'pageview');
</script>

<script src="<?=base_url('assets/js');?>/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="<?=base_url('assets/js');?>/bootstrap.min.js" type="text/javascript"></script>
<script src="<?=base_url('assets/js');?>/modernizr.custom2.js" type="text/javascript"></script>
<script src="<?=base_url('assets/js');?>/jquery.easing.js" type="text/javascript"></script>
<script src="<?=base_url('assets/js');?>/retina.js" type="text/javascript"></script>
<script src="<?=base_url('assets/js');?>/jquery.stellar.min.js" type="text/javascript"></script>
<script src="<?=base_url('assets/js');?>/jquery.superslides.js" type="text/javascript"></script>
<script defer src="<?=base_url('assets/js');?>/jquery.flexslider.js" type="text/javascript"></script>
<script src="<?=base_url('assets/js');?>/jquery.parallax-1.1.3.js" type="text/javascript"></script>
<script defer src="<?=base_url('assets/js');?>/count-to.js"></script>
<script defer src="<?=base_url('assets/js');?>/jquery.appear.js"></script>
<script src="<?=base_url('assets/js');?>/jquery.mixitup.js" type="text/javascript"></script>
<script src="<?=base_url('assets/js');?>/jquery.prettyPhoto.js" type="text/javascript"></script>
<script src="<?=base_url('assets/js');?>/owl.carousel.js" type="text/javascript"></script>
<script src="<?=base_url('assets/js');?>/jquery.easypiechart.min.js"></script>
<script defer src="<?=base_url('assets/js');?>/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?=base_url('assets/js');?>/waypoints.min.js" type="text/javascript"></script>
<script src="<?=base_url('assets/js');?>/custom.js" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function () {
$('#myModal2').modal('show');
});
</script>

<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
</body>
</html>