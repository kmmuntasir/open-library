<div class="row">
	<div class="col-sm-12 table-responsive">
		<table class="table table-striped datatable">
			<thead>
				<tr>
					<th>Publication Name</th>
					<th class="opt_column">Options</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$pubs = array('Shcaums Series', 'IDG Books', 'Times Warner');
					foreach($publications as $publication) {
				?>
				<tr>
					<td><a href="<?php echo site_url().'/admin/book/book_by_filter/3/'.$publication->publication_id; ?>" title="View All Books by this Publisher"><?php echo $publication->publication_name; ?></a></td>
					<td>
            <a href="#" publication="<?php echo $publication->publication_name; ?>" publication_id="<?php echo $publication->publication_id; ?>" class="edit edit_publication btn btn-sm btn-info">
              <i class="fa fa-pencil"></i>
            </a>
            <a href="<?php echo $controller.'/delete/'.$publication->publication_id; ?>" class="delete btn btn-sm btn-danger">
              <i class="fa fa-remove"></i>
            </a>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>


<!-- Modal for adding Publications -->
<div id="myModal" class="modal hide" role="dialog">
  <div class="modal-dialog">
	<form class="lib_form" action="<?php echo $controller.'/add'; ?>" method="post">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add a New Publisher</h4>
      </div>
      <div class="modal-body">
      		<input autofocus="" required type="text" class="form-control" name="publication_name" placeholder="Publisher Name"/>
      </div>
      <div class="modal-footer">
      		<button type="submit" class="btn btn-sm btn-primary pull-right"><i class="fa fa-plus"></i> Add</button>
      		<div class="clearfix"></div>
      </div>
    </div>
    </form>
  </div>
</div>


<!-- Modal for editing Publications -->
<div id="editModal" class="modal hide" role="dialog">
  <div class="modal-dialog">
	<form class="lib_form" action="#" method="post">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Publisher</h4>
      </div>
      <div class="modal-body edit_form_inputs">
      		<input autofocus="" required type="text" class="form-control" name="publication_name" placeholder="Publisher Name"/>
      </div>
      <div class="modal-footer">
      		<button type="submit" class="btn btn-sm btn-primary pull-right"><i class="fa fa-refresh"></i> Update</button>
      		<div class="clearfix"></div>
      </div>
    </div>
    </form>
  </div>
</div>