<div class="row">
	<div class="col-sm-12 table-responsive">
		<table class="table table-striped datatable">
			<thead>
				<tr>
					<th>Publication Name</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$pubs = array('Shcaums Series', 'IDG Books', 'Times Warner');
					foreach($publications as $publication) {
				?>
				<tr>
					<td><a href="<?php echo site_url().'/user/book/book_by_filter/3/'.$publication->publication_id; ?>" title="View All Books by this Publisher"><?php echo $publication->publication_name; ?></a></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
