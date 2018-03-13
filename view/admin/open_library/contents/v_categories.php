<div class="row">
	<div class="col-sm-12 table-responsive">
		<table class="table table-striped datatable">
			<thead>
				<tr>
					<th>Category Name</th>
					<th class="opt_column">Options</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach($categories as $category) {
				?>
				<tr>
					<td><a href="<?php echo site_url().'/admin/book/book_by_filter/2/'.$category->category_id; ?>" title="View All Books of this Category"><?php echo $category->category_name; ?></a></td>
					<td>
            <a href="#" category="<?php echo $category->category_name; ?>" category_id="<?php echo $category->category_id; ?>" class="edit edit_category btn btn-sm btn-info">
              <i class="fa fa-pencil"></i>
            </a>
            <a href="<?php echo $controller.'/delete/'.$category->category_id; ?>" class="delete btn btn-sm btn-danger">
              <i class="fa fa-remove"></i>
            </a>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>

<!-- Modal for adding Categories -->
<div id="myModal" class="modal hide" role="dialog">
  <div class="modal-dialog">
	<form class="lib_form" action="<?php echo $controller.'/add'; ?>" method="post">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add a New Category</h4>
      </div>
      <div class="modal-body">
      		<input autofocus="" required type="text" class="form-control" name="category_name" placeholder="Category Name"/>
      </div>
      <div class="modal-footer">
      		<button type="submit" class="btn btn-sm btn-primary pull-right"><i class="fa fa-plus"></i> Add</button>
      		<div class="clearfix"></div>
      </div>
    </div>
    </form>
  </div>
</div>


<!-- Modal for adding Categories -->
<div id="editModal" class="modal hide" role="dialog">
  <div class="modal-dialog">
	<form class="lib_form" action="#" method="post">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Category</h4>
      </div>
      <div class="modal-body edit_form_inputs">
      		<input autofocus="" required type="text" class="form-control" name="category_name" placeholder="Category Name"/>
      </div>
      <div class="modal-footer">
      		<button type="submit" class="btn btn-sm btn-primary pull-right"><i class="fa fa-refresh"></i> Update</button>
      		<div class="clearfix"></div>
      </div>
    </div>
    </form>
  </div>
</div>