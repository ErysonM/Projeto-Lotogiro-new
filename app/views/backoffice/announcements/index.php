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

if (count($announcements) != 0): ?>
	<div class="row"><?php foreach($announcements as $announcement): ?>
		<div class="col-sm-6 col-lg-4 col-xs-12">
			<div class="panel panel-white border-left-lg border-left-<?php
				if ($announcement->priority <= 1)		echo 'primary';
				elseif ($announcement->priority <= 2)	echo 'warning';
				elseif ($announcement->priority >= 3)	echo 'danger';
			?>">
				<div class="panel-heading p-10">
					<h6 class="panel-title"><b><i class="icon-info3 position-left"></i> <?=$announcement->title;?></b></h6>
				</div>
				<div class="panel-body p-10" style="min-height: 190px;">
					<p class="text-justify"><?=character_limiter(nl2br($announcement->body), 300);?></p>
					<p class="text-right no-margin"><a href="<?=site_url('backoffice/announcements/view/' . $announcement->slug);?>">
						<?=$lang['continuar_lendo']?> <i class="icon-arrow-right15"></i></a></p>
				</div>
				<div class="panel-footer panel-footer-condensed text-right p-10">
				<span class="heading-text"><?=$lang['prioridade']?>: <span class="text-semibold">
				<?php
				   if($announcement->priority == 1)  echo $lang['baixa'];
				elseif($announcement->priority == 2) echo $lang['media'];
				elseif($announcement->priority == 3) echo $lang['alta'];
				?>
				</span></span> - 
					<span class="heading-text"><?=$lang['publicado_em']?>: <span class="text-semibold"><?=date($this->settings->date_format, strtotime($announcement->date));?></span> <?=$lang['as']?> <span class="text-semibold"><?=date($this->settings->date_time_format, strtotime($announcement->date));?></span></span>
				</div>
			</div>
		</div>
	<?php endforeach; ?></div>
	<div class="mb-20"><?=$paginator;?></div>
<?php else: ?>
	<div class="alert alert-warning alert-styled-left">
		<span class="text-semibold"><?=$lang['atencao']?>!</span> <?=$lang['sem_comunicado']?>.
	</div>
<?php endif; ?>