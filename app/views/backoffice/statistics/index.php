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

<div class="row">
	<div class="col-sm-6">
		<div class="panel">
			<div class="panel-heading p-10 border-bottom-orange">
				<h5 class="panel-title"><i class="icon-users position-left"></i> <?=$lang['ultimos_cadastros']?></h5>
			</div>
			<!-- <div class="panel-body no-padding pl-10 pr-10"> -->
				<div class="table-responsive no-border">
					<table class="table table-xs table-striped">
						<thead><tr>
							<th class="text-center"><?=$lang['data']?></th>
							<th><?=$lang['nome']?></th>
						</tr></thead>
						<tbody><?php foreach ($users as $user):?>
							<tr>
								<td class="text-center"><?=(!$user->create_date ? '-' : date($this->settings->date_format, strtotime($user->create_date)));?> <?=$lang['as']?> <?=date($this->settings->date_time_format, strtotime($user->create_date));?></td>
								<td><?=$user->firstname . ' ' . $user->lastname;?></td>
							</tr>
						<?php endforeach; ?></tbody>
					</table>
				</div>
			<!-- </div> -->
		</div>
	</div>
	<!--<div class="col-sm-6">
		<div class="panel">
			<div class="panel-heading p-10 border-bottom-indigo">
				<h5 class="panel-title"><i class="icon-list3 position-left"></i> Últimos Saques</h5>
			</div>
				<div class="table-responsive no-border">
					<table class="table table-xs table-striped">
						<thead><tr>
							<th class="text-center">Data</th>
							<th>Nome</th>
							<th>Valor</th>
						</tr></thead>
						<tbody><?php foreach ($withdrawals as $withdrawal):
						$user = User::find_by_id($withdrawal->user_id); ?>
							<tr>
								<td class="text-center"><?=date($this->settings->date_format, strtotime($withdrawal->date));?> ás <?=date($this->settings->date_time_format, strtotime($withdrawal->date));?></td>
								<td><?=$user->firstname . ' ' . $user->lastname;?></td>
								<td><?=display_money($withdrawal->value);?></a></td>
							</tr>
						<?php endforeach; ?></tbody>
					</table>
				</div>
		</div>
	</div>-->
	
	
		<div class="col-sm-6">
		<div class="panel">
			<div class="panel-heading p-10 border-bottom-indigo">
				<h5 class="panel-title"><i class="icon-list3 position-left"></i> <?=$lang['ultimos_investimentos']?></h5>
			</div>
				<div class="table-responsive no-border">
					<table class="table table-xs table-striped">
						<thead><tr>
							<th class="text-center"><?=$lang['data']?></th>
							<th><?=$lang['nome']?></th>
							<th><?=$lang['valor']?></th>
						</tr></thead>
						<tbody><?php foreach ($invoices as $invoice): 
						$user = User::find_by_id($invoice->user_id); ?>
							<tr>
								<td class="text-center"><?=(!$invoice->date ? '-' : date($this->settings->date_format, strtotime($invoice->date)));?> <?=$lang['as']?> <?=date($this->settings->date_time_format, strtotime($invoice->date));?></td>
								<td><?=$user->firstname . ' ' . $user->lastname;?></td>
								<td><?=display_money($invoice->sum);?></a></td>
							</tr>
						<?php endforeach; ?></tbody>
					</table>
				</div>
		</div>
	</div>
	
	
	
</div>



<!--
<div class="row">
	<div class="col-sm-6">
		<div class="panel">
			<div class="panel-heading p-10 border-bottom-indigo">
				<h5 class="panel-title"><i class="icon-list3 position-left"></i> Últimos Investimentos</h5>
			</div>
				<div class="table-responsive no-border">
					<table class="table table-xs table-striped">
						<thead><tr>
							<th class="text-center">Data</th>
							<th>Nome</th>
							<th>Valor</th>
						</tr></thead>
						<tbody><?php foreach ($invoices as $invoice): 
						$user = User::find_by_id($invoice->user_id); ?>
							<tr>
								<td class="text-center"><?=(!$invoice->date ? '-' : date($this->settings->date_format, strtotime($invoice->date)));?> ás <?=date($this->settings->date_time_format, strtotime($invoice->date));?></td>
								<td><?=$user->firstname . ' ' . $user->lastname;?></td>
								<td><?=display_money($invoice->sum);?></a></td>
							</tr>
						<?php endforeach; ?></tbody>
					</table>
				</div>
		</div>
	</div>
</div>
-->


