<?php if($this->user->first_recharge == 'N'): ?>
<div class="alert alert-success alert-styled-left">
	<span class="text-semibold">Atenção!</span> Você receberá um bônus de primeira recarga de 100% do valor carregado!
</div>
<?php endif; ?>
<?php if(Invoice::count(array('conditions' => array('status = ? and user_id = ?', 'open', $this->user->id))) > 0): ?>
<div class="alert alert-warning alert-styled-left">
	<span class="text-semibold">Atenção!</span> Você já tem pedido(s) em aberto! <a href="<?=base_url('backoffice/invoices/all');?>">Clique aqui para ver.</a>
</div>
<?php endif; ?>

<div class="panel">
	<div class="panel-heading p-10 border-bottom-indigo">
		<h5 class="panel-title"><i class="icon-coins fa-fw position-left"></i> Recarga de Saldo</h5>
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

<h1><b>Escolha o Pacote de Recarga</b></h1>
		<table width="100%" cellspacing="0">
	<tr><td class="shadow">
		<?php foreach ($plans as $row): ?>
			<label>
				<img src="https://placeholdit.imgix.net/~text?txtsize=25&bg=3CB371&txtclr=000000&txt=<?=$row->name;?>&w=100&h=100" id="<?=$row->id;?>" width="140" style="opacity: .5" class="plan_select" data-toggle="tooltip" title="<?=$row->name;?> - <?=$row->description;?>">
				<input type="radio" name="plan" value="<?=$row->id;?>" style="display: none;" />
				<br><center><b><?=display_money($row->value);?></b></center>
			</label>
	<?php endforeach; ?>
	</td></tr>
		</table>


<hr>

<h1><b>Escolha o Avatar</b></h1>
		<table width="100%" cellspacing="0">
	<tr><td class="shadow">
		<?php foreach ($avatars as $row): 
		if(Avatar::count(array('conditions' => array('avatar_id = ? and user_id = ?', $row->id, $this->user->id))) > 0) continue;
		?>
			<label>
				<img src="<?=base_url('assets/images/avatar/' . $row->id . '.png');?>" id="<?=$row->id;?>" width="100" height="100" style="opacity: .5" class="avatar_select" data-toggle="tooltip" title="<?=$row->name;?>">

				<input type="radio" name="avatar" value="<?=$row->id;?>" style="display: none;" />
			</label>
	<?php endforeach; ?>
	</td></tr>
		</table>


<script type="text/javascript">
	$(document).ready(function($) {
		$("*.plan_select").click(function() {
			var plan_id = $(this).parent().find('input').val();
			//$("*#my_avatar").css({'background-image':'url(\'<?=base_url('assets/images/avatar/');?>' + avatar_id + '.png\')'});
			//document.getElementById('my_avatar').src = '<?=base_url('assets/images/avatar/');?>/' + avatar_id + '.png'; 
			//document.getElementById('my_avatar2').src = '<?=base_url('assets/images/avatar/');?>/' + avatar_id + '.png'; 
			$(this).rotate({ angle: 0, animateTo:360 })
			$("*.plan_select").css('opacity', '.5');
			$(this).css('opacity', '1');
			/*$('html, body').animate({
				scrollTop: $("#my_avatar").offset().top
			}, 300);*/
		});
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
					<b><i class="icon-cart"></i></b>
				Gerar pedido e Pagar
				</button>
			</div>
		</form>
	</div>
</div>		