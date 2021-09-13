<?php
/**

 * Author:      Felipe Medeiros

 * File:        linear.php

 * Created in:  24/06/2016 - 17:04

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

	<div class="panel-heading border-bottom-primary-800">

		<h5 class="panel-title"><i class="icon-tree5 position-left"></i> <?=$lang['rede_linear']?></h5>

	</div>


	<?=count_inlevels($this->user->id);?>


	<div class="table-responsive no-border">

		<table class="table table-xs data">

			<thead><tr>

				<th width="10">Nv.</th>

				<th><?=$lang['nome']?></th>

				<th><?=$lang['email']?></th>

				<th width="140"><?=$lang['celular']?></th>

				<th width="20"><?=$lang['status']?></th>

			</tr></thead>

			<tbody>

				<?=make_linear($this->user->id);?>

			</tbody>

		</table>

	</div>

</div>

<script type="text/javascript">

	$(document).ready(function () {

		$('.data').dataTable();

	})

</script>

