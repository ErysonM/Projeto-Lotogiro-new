<div class="alert alert-info alert-styled-left alert-bordered">
	<span class="text-semibold">Aqui você personaliza seu avatar!</span>
	<br>Existem diversos tipos de avatares no PacMoney. São versões frees, premiums e limitadas!  ;)
	 <br>Adquira mais avatares em <a href="<?=site_url('backoffice/recharge');?>" target="_blank">LINK</a>. 
</div>
<div class="panel">
	<div class="panel-heading p-10 border-bottom-indigo">
		<h5 class="panel-title"><i class="icon-user fa-fw position-left"></i> Avatar</h5>
	</div>

	<style>
	.panel-body{
    background: gray; /* For browsers that do not support gradients */
    background: -webkit-linear-gradient(gray, white); /* For Safari 5.1 to 6.0 */
    background: -o-linear-gradient(gray, white); /* For Opera 11.1 to 12.0 */
    background: -moz-linear-gradient(gray, white); /* For Firefox 3.6 to 15 */
    background: linear-gradient(gray, white); /* Standard syntax */
    }
    </style>

	<div class="panel-body">
		<form method="post" class="form-horizontal">


		<table width="100%" cellspacing="0">
		<tr><td class="shadow" align="center">
			<?php foreach ($avatarsavaible as $row): ?>
				<label>
					<img src="<?=base_url('assets/images/avatar/' . $row->id . '.png');?>" id="<?=$row->id;?>" width="140" style="opacity: <?php if($row->id != $this->user->avatar) echo '.5';  else echo 1; ?>" class="avatar_select" data-toggle="tooltip" title="<?=$row->name;?> - <?php if($row->geral == 'Y') echo 'FREE'; else echo 'PREMIUM'; ?> <?php if($row->temporary == 'Y') echo ' - Limitado'; ?>"/>

					<input type="radio" name="avatar" value="<?=$row->id;?>" style="display: none;" <?php if($row->id == $this->user->avatar) echo 'checked'; ?>/>
				</label>
		<?php endforeach; ?>
			<?php foreach ($avatars as $premiums): ?>
				<?php $row = Avataravaible::find_by_id($premiums->avatar_id); ?>
				<label>
					<img src="<?=base_url('assets/images/avatar/' . $row->id . '.png');?>" id="<?=$row->id;?>" width="140" style="opacity: <?php if($row->id != $this->user->avatar) echo '.5';  else echo 1; ?>" class="avatar_select" data-toggle="tooltip" title="<?=$row->name;?> - <?php if($row->geral == 'Y') echo 'FREE'; else echo 'PREMIUM'; ?> <?php if($premiums->temporary == 'Y') echo ' - Limitado'; ?><?php /*if($premiums->temporary == 'Y'){ ?> - Inicio: <?=date($this->settings->date_format, strtotime($premiums->starts));?> às <?=date($this->settings->date_time_format, strtotime($premiums->starts));?> - Fim: <?=date($this->settings->date_format, strtotime($premiums->ends));?> às <?=date($this->settings->date_time_format, strtotime($premiums->ends));?><?php }*/ ?>" data-html="true"/>

					<input type="radio" name="avatar" value="<?=$row->id;?>" style="display: none;" <?php if($row->id == $this->user->avatar) echo 'checked'; ?>/>
				</label>
		<?php endforeach; ?>
		</td></tr>
		<tr><td><div class="separator"></div></td></tr>
	</table>




<script type="text/javascript">
	$(document).ready(function($) {
		$("*.avatar_select").click(function() {
			var avatar_id = $(this).parent().find('input').val();
			//$("*#my_avatar").css({'background-image':'url(\'<?=base_url('assets/images/avatar/');?>' + avatar_id + '.png\')'});
			document.getElementById('my_avatar').src = '<?=base_url('assets/images/avatar/');?>/' + avatar_id + '.png'; 
			document.getElementById('my_avatar2').src = '<?=base_url('assets/images/avatar/');?>/' + avatar_id + '.png'; 
			$(this).rotate({ angle: 0, animateTo:360 })
			$("*.avatar_select").css('opacity', '.5');
			$(this).css('opacity', '1');
			/*$('html, body').animate({
				scrollTop: $("#my_avatar").offset().top
			}, 300);*/
		});
	});
</script>	
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip({html: true});   
});
</script>

			<div class="text-right">
				<button type="submit" class="btn btn-primary btn-labeled">
					<b><i class="icon-floppy-disk"></i></b>
					Salvar alterações 
				</button>
			</div>
		</form>
	</div>
</div>		