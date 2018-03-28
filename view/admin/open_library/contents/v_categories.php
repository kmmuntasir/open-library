<div class="row">
	<div class="col-sm-6 table-responsive">
		<table class="table table-striped datatable" data-page="categories" data-source="<?php echo $source; ?>">
			<thead>
				<tr>
					<th>Category Name</th>
					<th class="opt_column">Options</th>
				</tr>
			</thead>


		</table>
	</div>
  <div class="col-sm-6">
    <h3>Merge List</h3>
    <div id="merge_list">
      <div class="merge_alert alert alert-info">Click <code>Add to Merge List</code> <button class="btn btn-sm btn-default"><i class="fa fa-compress"></i></button> button beside items to add items to this list. <br>Currently the List is empty.</div>
    </div>
    <button style="display: none;" id="total_merge_button" class="btn btn-md btn-primary">Merge</button>
    <div style="display: none;" id="merge_target_div">
      <h5>Select Merge Target</h5>
      <select id="merge_target_select" class="form-control">
        
      </select>
      <br>
      <button id="back_to_list" class="btn btn-sm btn-danger"><i class="fa fa-chevron-left"></i> Back to list</button>
      <button id="confirm_merge" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Confirm Merge</button>
    </div>
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