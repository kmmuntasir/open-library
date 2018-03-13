<div class="row">
	<div class="col-sm-12 table-responsive">
		<table class="table table-striped datatable">
			<thead>
				<tr>
					<th>Category Name</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach($categories as $category) {
				?>
				<tr>
					<td><a href="<?php echo site_url().'/user/book/book_by_filter/2/'.$category->category_id; ?>" title="View All Books of this Category"><?php echo $category->category_name; ?></a></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
