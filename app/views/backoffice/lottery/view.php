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

if($lottery->status == 'open' AND empty($meustickets)): ?>
<div class="alert alert-info alert-styled-left">
	<span class="text-semibold"><?=$lang['atencao']?>!</span> <?=$lang['sem_tickets_loteria']?>
</div>
<?php endif; ?>
<?php if($lottery->status == 'cancel'): ?>
<div class="alert alert-warning alert-styled-left">
	<span class="text-semibold"><?=$lang['atencao']?>!</span> <?=$lang['reembolso_ticket_can']?>
</div>
<?php endif; ?>
<div class="panel panel-<?php
                            if($lottery->status == 'open')       echo 'primary';
                        elseif($lottery->status == 'paid')       echo 'success';
                        elseif($lottery->status == 'cancel')     echo 'danger';
                        ?> panel-bordered">
    <div class="panel-heading p-10">
        <h6 class="panel-title"><b><i class="icon-ticket position-left"></i> <?php echo $lottery->name?></b> (#<?php echo $lottery->id?>)</h6>
    </div>
    <div class="panel-body p-10">
        <center>
			<?php if($lottery->type == 'fix') $tipoloteria = $lang['loteria_fixa']; else $tipoloteria = $lang['loteria_acumulativa']; ?>
				<h5>
				<?php echo $lottery->name?> (#<?php echo $lottery->id;?>) (<?=$tipoloteria?>)<br>
				<?php echo $lottery->description?><br><br>
				
            <span class="label label-<?php
                            if($lottery->status == 'open')       echo 'primary';
                        elseif($lottery->status == 'paid')       echo 'success';
                        elseif($lottery->status == 'cancel')     echo 'danger';
                        ?> col-md-6 col-md-offset-3" style="font-size: 20px; margin-bottom:20px;">
                        <?php
                            if($lottery->status == 'open')       echo strtoupper($lang['aberta']);
                        elseif($lottery->status == 'paid')       echo strtoupper($lang['paga']);
                        elseif($lottery->status == 'cancel')     echo strtoupper($lang['cancelada']);
                        ?>
            </span>
			
				<br>
			<table class="table table-responsive text-left" style="width: 600px;">
				<tr>
					<td class="field-title"><?=$lang['inicio']?>:</td>
					<td><?php echo date($this->settings->date_format, strtotime($lottery->starts));?> às <?php echo date($this->settings->date_time_format, strtotime($lottery->starts));?></td>
				</tr>
				<tr>
					<td class="field-title"><?=$lang['fim']?>:</td>
					<td><?php echo date($this->settings->date_format, strtotime($lottery->ends));?> às <?php echo date($this->settings->date_time_format, strtotime($lottery->ends));?></td>
				</tr>
				<tr>
					<td class="field-title"><?=$lang['valor_ticket']?>:</td>
					<td><?php echo display_money($lottery->ticket_price);?></td>
				</tr>
				<tr>
					<td class="field-title"><?=$lang['tickets_vendidos']?>:</td>
					<td><?php echo $lottery->buyed_tickets;?></td>
				</tr>				
				<tr>
					<td class="field-title"><?=$lang['maximo_tickets']?>:</td>
					<td><?php echo $lottery->max_tickets;?></td>
				</tr>
				<tr>
					<td class="field-title"><?=$lang['valor_premio']?>:</td>
					<td>
					<?php 
					if($lottery->type == 'fix') echo display_money($lottery->value_initial);
					else echo display_money($lottery->value_initial+($lottery->buyed_tickets*$lottery->ticket_price));
					?> (<?=$lottery->percent_emp?>% Tx. Adm.)
					</td>
				</tr>
			</table>
				</h5>
				
		<div class="row">
	<?php if($lottery->status != 'cancel'): ?>	
	<div class="col-md-6">
		<div class="panel">
			<div class="panel-heading p-10 border-bottom-orange">
				<h5 class="panel-title"><i class="icon-ticket position-left"></i> <?=$lang['meus_tickets']?></h5>
			</div>
			<div class="table-responsive">
				<table class="table table-xs data">
					<thead><tr>
						<th class="text-center" style="width: 10px">#</th>
						<th><?=$lang['data']?></th>
					</tr></thead>
					<tbody>
					<?php foreach ($meustickets as $ticket): ?>
						<tr>
							<td class="text-center"><?=$ticket->id;?></td>
							<td><span class="hidden"><?=strtotime($ticket->date);?></span> <?=date($this->settings->date_format, strtotime($ticket->date));?> <?=$lang['as']?> <?=date($this->settings->date_time_format, strtotime($ticket->date));?></td>
						</tr>
					<?php endforeach;?>
					<?php if(empty($meustickets)) echo "<tr><td colspan=2>".$lang['nenhum_ticket_adquirido'].".</td></tr>"; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<?php if($lottery->status == 'paid'): ?>
	<div class="col-md-6">
		<div class="panel">
			<div class="panel-heading p-10 border-bottom-orange">
				<h5 class="panel-title"><i class="icon-gift position-left"></i> <?=$lang['ganhadores']?></h5>
			</div>
			<div class="table-responsive">
				<table class="table table-xs data">
					<thead><tr>
						<th class="text-center" style="width: 10px">#</th>
						<th><?=$lang['ganhador']?></th>
						<th><?=$lang['ticket']?></th>
						<th><?=$lang['valor']?></th>
					</tr></thead>
					<tbody><?php foreach ($winners as $winner): 
					$namewinner = User::find_by_id($winner->winner_id);
					?>
						<tr>
							<td class="text-center"><?=$winner->position;?></td>
							<td><?=$namewinner->firstname;?> <?=$namewinner->lastname;?></td>
							<td><?=$winner->ticket_id;?></td>
							<td><?=display_money($winner->value_win);?></td>
						</tr>
					<?php endforeach; ?>
					<?php if(empty($winners)) echo "<tr><td colspan=4>".$lang['nenhum_ganhador'].".</td></tr>"; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<?php if($lottery->status == 'open'): ?>	
	<div class="col-md-6">
		<div class="panel">
			<div class="panel-heading p-10 border-bottom-orange">
				<h5 class="panel-title"><i class="icon-coins position-left"></i> <?=$lang['comprar_tickets']?></h5>
			</div>
			<?php
			
			if(($lottery->buyed_tickets >= $lottery->max_tickets) AND ($lottery->max_tickets != 0)) 
				echo "<h2><font color='red'>Tickets esgotados. :(</font></h2>";
			else {
			
			//if($contagemtickets >= $lottery->max_tickets_person) 
				?>
			<div class="table-responsive">
				<table class="table table-xs data">
					<thead>
					<tr>
						<th class="text-center" colspan="2"><?=$lang['voce_tem']?> <?=$contagemtickets?> <?=$lang['tickets']?>.</th>
					</tr>
					<tr>
						<th class="text-center" style="width:50%;"><?=$lang['tickets_vendidos']?>:</th>
						<th class="text-center"><?=$lottery->buyed_tickets?></th>
					</tr>
					<tr>
						<th class="text-center" style="width:50%;"><?=$lang['tickets_restantes']?>:</th>
						<th class="text-center">
						<?php if($lottery->max_tickets == 0): ?>
						<?=$lang['tickets_ilimitados']?>.
						<?php else: ?>
						<?=($lottery->max_tickets-$lottery->buyed_tickets)?>
						<?php endif; ?>
						</th>
					</tr>
					</thead>
					<tbody>
							<?php if(($lottery->max_tickets_person == 0) OR ($lottery->max_tickets_person > $contagemtickets)): ?>
						<tr>
							<?php if($lottery->max_tickets_person == 0): ?>
							<th class="text-center" colspan="2"><?=$lang['sem_limite_compra_ticket']?>.</th>
							<?php else: ?>
							<th class="text-center" colspan="2"><?=$lang['pode_comprar']?> <?=($lottery->max_tickets_person - $contagemtickets)?> <?=$lang['tickets']?>.</th>
							<?php endif; ?>
						</tr>
						<tr>
							<td class="text-center" colspan="2">
							<form action="<?=site_url('backoffice/lotterys/view/'.$lottery->id);?>" method="post">
								<input type="number" name="amount" id="amount" class="form-control" min="0" placeholder="Ex: <?=rand(1, 10);?>" required style="width: 100px; display: inline;" />
								<input type="submit" class="btn btn-xs btn-primary" value="OK"/>
							</form>
							</td>
						</tr>
							<?php else: ?>
						<tr>
							<th class="text-center" colspan="2"><?=$lang['atingiu_limite']?> <?=$lottery->max_tickets_person?> <?=$lang['tickets_part']?>.</th>
						</tr>
							<?php endif; ?>
					</tbody>
				</table>
			</div>
			<?php } ?>
		</div>
	</div>
	<?php endif; ?>
</div>
		
        </center>
    </div>
</div>
