<?php
/**
Felipe Medeiros
 * Author:      Felipe Medeiros

 * File:        my_indicated.php

 * Created in:  24/06/2016 - 14:55

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

		<h5 class="panel-title"><i class="icon-users4 position-left"></i> <?=$lang['meus_indicados']?></h5>

	</div>

	<div class="table-responsive no-border">

		<table class="table table-xs data">

			<thead><tr>

				<th width="10">#</th>

				<th><?=$lang['nome']?></th>

				<th><?=$lang['email']?></th>

				<th width="140"><?=$lang['celular']?></th>

				<th width="20"><?=$lang['status']?></th>

			</tr></thead>

			<tbody>

				<?php foreach ($indicated as $user): ?><tr>

					<td class="text-center"><?=$user->id;?></td>

					<td><?=($user->firstname . ' ' . $user->lastname);?></td>

					<td><?=$user->email;?></td>

					<td class="text-center"><?=$user->mobilephone;?></td>

					<td class="text-center"><span class="label label-<?php 
					if($user->banned == 'Y'):

						echo 'warning';

					elseif($user->status != 'active'):

						echo 'default';

					else:

						echo 'success';

					endif; ?>"><?php 
					
					if($user->banned == 'Y'):

						echo strtoupper($lang['bloqueado']);

					elseif($user->status != 'active'):

						echo strtoupper($lang['pendente']);

					else:

						echo strtoupper($lang['ativo']);

					endif; ?></span></td>

				</tr><?php endforeach; ?>

			</tbody>

		</table>

	</div>

</div>

<script type="text/javascript">

	$(document).ready(function () {

		$('.data').dataTable();

	})

</script>

