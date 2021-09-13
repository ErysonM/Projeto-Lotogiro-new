<?php
/**
 * Project:    mmn.dev
 * File:       ads.php
 * Author:     Felipe Medeiros
 * Createt at: 27/05/2016 - 20:48
 */

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
<div class="panel">
	<div class="panel-heading p-10 border-bottom-indigo">
		<h5 class="panel-title"><i class="icon-flags3 position-left"></i> <?=$lang['material_apoio']?></h5>
	</div>
<br><br>

<div class="table-responsive no-border">
<table class="table table-xs data">
<thead><tr>
<th class="text-center"><h2><?=$lang['ativar_corretora']?><br><a href="https://my.roboforex.com/pt/?a=mptc" target="_blank" rel="noopener">RealForex </a></h2></th>
<th class="text-center"><h2><?=$lang['ativar_script']?><br><a href="https://www.copyfx.com/pt/ratings/rating-all/show/88319/" target="_blank" rel="noopener">RealForex</a></h2></th>
</tr></thead>
<tbody>
<tr>

<td class="text-center"><iframe width="100%" height="780" src="https://realforex.club/assets/uploads/<?=$lang['pdftutorial']?>" frameborder="0" allowfullscreen></iframe></td>
<td class="text-center"><iframe width="100%" height="780" src="https://realforex.club/assets/uploads/<?=$lang['ativacao']?>" frameborder="0" allowfullscreen></iframe></td>
</tr>
<tr>
<td class="text-center">RealForex</td>

</tr>
</tbody>
</table>
</div>
<br><br>
</div>