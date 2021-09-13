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
	Prioridade: <span class="text-semibold"><?php
	if($announcement->priority == 1)  echo 'Baixa';
	elseif($announcement->priority == 2) echo 'Média';
	elseif($announcement->priority == 3) echo 'Alta';
	?></span> - 
		<span class="heading-text">Publicado em: <span class="text-semibold"><?=date($this->settings->date_format, strtotime($announcement->date));?></span> às <span class="text-semibold"><?=date($this->settings->date_time_format, strtotime($announcement->date));?></span></span>
	</div>
</div>