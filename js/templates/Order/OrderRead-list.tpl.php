<!-- 
/*
 * @author : Jean-Michel Bruneau
 * @version : 1.0
 * 
 * Create order view template
 * 
 */
 -->
<h3 class="alert alert-success" role="alert">Bon de Commande List</h3>
<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Nom</th>
				<th scope="col">Prénom</th>
				<th scope="col">Email</th>
				<th scope="col">Marque</th>
				<th scope="col">Modèle</th>
				<th scope="col">Prix</th>
				<th scope="col">…</th>
			</tr>
		</thead>
		<tbody>
		<?php for ($n = 0; $n < count( $data); $n++) { ?>
		<tr>
				<td scope="row"><?= $data[$n]['id'] ?></a></td>
				<td><?= $data[$n]['lastname'] ?></td>
				<td><?= $data[$n]['firstname'] ?></td>
				<td><?= $data[$n]['email'] ?></td>
				<td><?= $data[$n]['brand'] ?></td>
				<td><?= $data[$n]['model'] ?></td>
				<td><?= $data[$n]['total_price'] ?></td>
				<td scope="row">
					<!-- Display -->
					<a href="index.php?model=<?= $model ?>&action=read&id=<?= $data[$n]['id'] ?>" class="btn btn-success ls-modal">Display</a>
					 <!-- Update -->
					<a href="index.php?model=<?= $model ?>&action=update&id=<?= $data[$n]['id'] ?>" class="btn btn-primary ls-modal">Update</a>
					 <!-- Delete -->
					<a href="index.php?model=<?= $model ?>&action=delete&id=<?= $data[$n]['id'] ?>" class="btn btn-danger ls-modal">Delete</a>
				</td>
			</tr>
			<?php } ?>
	</tbody>
	</table>
	<!-- View Modal -->
	<div class="modal fade" role="dialog">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-body">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</div>
