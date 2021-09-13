<?php 
if(isset($_GET['lang']) && $_GET['lang'] != null){
    $novoidioma = $_GET['lang'];
    $path = "langs/backoffice/".$novoidioma.".php";
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
?>

<div class="panel panel-<?php
	if ($announcement->priority <= 1)		echo 'primary';
	elseif ($announcement->priority <= 2)	echo 'warning';
	elseif ($announcement->priority >= 3)	echo 'danger';
?> panel-bordered">
	<div class="panel-heading p-10">
		<h6 class="panel-title"><b><i class="icon-info3 position-left"></i> <?=$announcement->title;?></b></h6>
	</div>
	<div class="panel-body p-10"><?=nl2br($announcement->body);?></div>
	<div class="panel-footer panel-footer-condensed text-right p-10">
	<?=$lang['prioridade']?>: <span class="text-semibold"><?php
	if($announcement->priority == 1)  echo $lang['baixa'];
	elseif($announcement->priority == 2) echo $lang['media'];
	elseif($announcement->priority == 3) echo $lang['alta'];
	?></span> - 
		<span class="heading-text"><?=$lang['publicado_em']?>: <span class="text-semibold"><?=date($this->settings->date_format, strtotime($announcement->date));?></span> <?=$lang['as']?> <span class="text-semibold"><?=date($this->settings->date_time_format, strtotime($announcement->date));?></span></span>
	</div>
</div>