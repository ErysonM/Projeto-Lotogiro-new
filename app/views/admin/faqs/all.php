<?php
/**
 * mmn.dev
 * Arquivo:     all.php
 * Autor:       Felipe Medeiros
 * Criado em:   25/05/16 02:29
 */
?>
<div class="panel">
	<div class="panel-heading p-10 border-bottom-primary-800 border-bottom-lg">
		<h5 class="panel-title"><i class="icon-menu3 position-left"></i> Lista de F.A.Q</h5>
					<div class="text-right">
				<a href="<?=site_url('admin/faqs/create');?>"><span class="btn btn-primary">Adicionar novo <i class="icon-file-plus position-right"></i></span></a>
			</div>
	</div>
	<div class="table-responsive">
		<table class="table data">
			<thead><tr>
				<th width="10px">#</th>
				<th>Titúlo</th>
				<th width="100px">Editar</th>
			</tr></thead>
			<tbody><?php foreach($faqs as $faq): ?>
				<tr>
					<td class="text-center"><?=$faq->number;?></td>
					<td><?=$faq->title;?></td>
					<td class="text-center">
						<ul class="icons-list">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="icon-menu9"></i>
								</a>
								<ul class="dropdown-menu dropdown-menu-right">
									<li><a href="<?=site_url('admin/faqs/edit/' . $faq->id);?>"><i class="icon-pencil"></i> Editar</a></li>
									<li><a href="<?=site_url('admin/faqs/delete/' . $faq->id);?>" onclick="return confirm('Você tem certeza?')"><i class="icon-trash"></i> Excluir</a></li>
								</ul>
							</li>
						</ul>
					</td>
				</tr>
			<?php endforeach;?></tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('.data').dataTable({
			columnDefs: [{ 
				orderable: false,
				width: '100px',
				targets: [ 2 ]
			}],
			drawCallback: function () {
				$(this).find('tbody tr').slice(-2).find('.dropdown, .btn-group').addClass('dropup');
			},
			preDrawCallback: function() {
				$(this).find('tbody tr').slice(-2).find('.dropdown, .btn-group').removeClass('dropup');
			}
		});
	});
</script>