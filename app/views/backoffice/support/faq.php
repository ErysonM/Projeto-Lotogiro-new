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
        echo "<script>alert('Este idioma n«ªo est«¡ dispon«¿vel.');</script>";	
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

if (count($faqs) != 0): ?>
	<div class="panel-group panel-group-control panel-group-control-right content-group-lg" id="accordion-control-right">
		<?php foreach ($faqs as $faq): ?>
		<div class="panel panel-white">
			<div class="panel-heading">
				<h6 class="panel-title">
					<a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-<?=$faq->id;?>"><b>#<?=$faq->number;?> -</b> <?=$faq->title;?></a>
				</h6>
			</div>
			<div id="accordion-<?=$faq->id;?>" class="panel-collapse collapse">
				<div class="panel-body">
					<?=nl2br($faq->text);?>
				</div>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
<?php else: ?>
	<div class="alert alert-warning alert-styled-left">
		<span class="text-semibold"><?=$lang['atencao']?>!</span> <?=$lang['nenhuma_faq']?>.
	</div>
<?php endif; ?>