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

<div class="alert alert-info alert-styled-left">
	<span class="text-semibold"><?=$lang['atencao']?>!</span> <?=$lang['breve_cont_liberados']?>.
</div>