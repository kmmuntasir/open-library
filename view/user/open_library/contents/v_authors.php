<div class="row">
	<div class="col-sm-12 table-responsive">
		<table class="table table-striped datatable">
			<thead>
				<tr>
					<th>Author Name</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach($authors as $author) {
				?>
				<tr>
					<td><a href="<?php echo site_url().'/user/book/book_by_filter/1/'.$author->author_id; ?>" title="View All Books by this Author"><?php echo $author->author_name; ?></a></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
