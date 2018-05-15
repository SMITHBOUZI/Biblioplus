<div class="row" id="forum_view">
	<div class="columns large-12 medium-12" id="entete">
		<h3 >Forum Biblioplus</h3>
	</div>

	<div class=" columns large-12 medium-12 small-12" id="corps">
		<table>
			<div class="columns large-12 medium-12 small-12">
			<thead>
				<div class="columns large-12 medium-12 small-12">
					<tr>
						<div class=" columns large-6 medium-6 small-6">
							<th>Sujet</th>
						</div>
						<div class=" columns large-3 medium-3 small-3">
							<th>Categorie</th>
						</div>
						<div class=" columns large-3 medium-3 small-3">
							<th>Date de creation</th>
						</div>						
					</tr>
				</div>				
			</thead>
			</div>

			<div class="columns large-12 medium-12 small-12">
			<tbody>
				<div class="columns large-12 medium-12 small-12">
					<?php $req = $this->forum->lister_sujet(); ?>
						<?php foreach ($req as $rows): ?>
							<tr>
								<div class=" columns large-6 medium-6 small-6">
									<td>
										<p> <?php echo $rows->sujet; ?></p>
									</td>
								</div>
								<div class=" columns large-3 medium-3 small-3">
									<td>
										<p><?php echo $rows->contenu_c; ?></p>
									</td>
								</div>
								<div class=" columns large-3 medium-3 small-3">
									<td>
										<p><?php echo $rows->date_hres_creation; ?></p>
									</td>
								</div>						
							</tr>
						<?php endforeach ?>
					<?php // endif ?>
				</div>				
			</tbody>
			</div>
        </table>
	</div>
</div>