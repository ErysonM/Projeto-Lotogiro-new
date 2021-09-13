<?php
/**
 * Golden Bit Shop
 * Arquivo:     modal.php
 * Autor:       Felipe Medeiros
 * Criado em:   25/05/16 03:37
 */
?>
<script type="text/javascript" src="<?=base_url();?>assets/js/ajax.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("form").validator();

		// Button loaded on click
		$(document).on("click", '.button-loader', function(e) {
			var value = $(this).text();
			$(this).html('<i class="fa fa-spinner fa-spin"></i> '+ value);
		});

		// Item-selector
		$('.additem').click(function(e) {
			$('#item-selector').slideUp('fast');
			$('#item-editor').slideDown('slow');
		});

		// Upload button
		$(document).on("change", '#uploadBtn', function(e) {
			var value = $( this ).val().replace(/\\/g, '/').replace(/.*\//, '');
			$("#uploadFile").val(value);
		});

		// Checkbox Plugin
		$(".checkbox").labelauty();
		$('.datepicker').datepicker({"format": 'yyyy-mm-dd', "autoclose": true});
	});
</script>
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
			<h4 class="modal-title"><?=$title;?></h4>
		</div>
		<?=$yield;?>
	</div>
</div>
