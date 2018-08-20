<?php
  $auth = array("Manager", "Admin");
?>
<div class="row">
	<div class="col-sm-12 table-responsive">
		<table class="table table-striped datatable" data-page="managers" data-source="<?php echo $source; ?>">
			<thead>
				<tr>
					<th>Name</th>
					<th class="dt_sm">Phone</th>
					<th class="dt_sm">Email</th>
					<th class="dt_sm">Username</th>
          <th class="dt_xs">Authorization</th>
					<th class="opt_column">Options</th>
				</tr>
			</thead>
      <tfoot>
        <tr>
          <td>Name</td>
          <td>Phone</td>
          <td>Email</td>
          <td>Username</td>
          <td>Autdorization</td>
          <td class="opt_column">Options</td>
        </tr>
      </tfoot>
		</table>
	</div>
</div>

<!-- Modal for adding managers -->
<div id="myModal" class="modal hide" role="dialog">
  <div class="modal-dialog">
	<form class="lib_form manager_addform" action="<?php echo $controller.'/add'; ?>" method="post">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add a New Manager</h4>
      </div>
      <div class="modal-body modal-scroll">
      		<label for="manager_name">Name</label>
      		<input autofocus required type="text" class="form-control" name="manager_name" placeholder="Name"/>
      		<label for="manager_phone">Phone</label>
      		<input required type="text" class="form-control" name="manager_phone" placeholder="Phone"/>
      		<label for="manager_email">Email</label>
      		<input required type="email" class="form-control" name="manager_email" placeholder="Email"/>
      		<label for="manager_user">Username</label>
      		<input required type="text" class="form-control" name="manager_user" placeholder="Username"/>
      		<label for="manager_pass_1">Password</label>
      		<input required type="password" class="form-control add_pass_1" name="manager_pass_1" placeholder="Password"/>
      		<label for="manager_pass_2">Confirm Password</label>
      		<input required type="password" class="form-control add_pass_2" name="manager_pass_2" placeholder="Confirm Password"/>
          <label for="is_admin">Authorization Level</label><br>
          <input type="radio" name="is_admin" value="0" checked> Manager<br>
          <input type="radio" name="is_admin" value="1"> Admin
      </div>
      <div class="modal-footer">
      		<button type="submit" class="btn btn-sm btn-primary pull-right manager_add"><i class="fa fa-plus"></i> Add</button>
      		<div class="clearfix"></div>
      </div>
    </div>
    </form>
  </div>
</div>


<!-- Modal for adding managers -->
<div id="editModal" class="modal hide" role="dialog">
  <div class="modal-dialog">
  	<form class="lib_form manager_updateform" action="<?php echo $controller.'/update'; ?>" method="post">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Manager</h4>
        </div>
        <div class="modal-body modal-scroll edit_form_inputs">
        		<label for="manager_name">Name</label>
        		<input autofocus required type="text" class="form-control" name="manager_name" placeholder="Name"/>
        		<label for="manager_phone">Phone</label>
        		<input required type="text" class="form-control" name="manager_phone" placeholder="Phone"/>
        		<label for="manager_email">Email</label>
        		<input required type="email" class="form-control" name="manager_email" placeholder="Email"/>
        		<label for="manager_user">Username</label>
        		<input required type="text" class="form-control" name="manager_user" placeholder="Username"/>
        		<label for="manager_pass_1">Password</label>
        		<input type="password" class="form-control update_pass_1" name="manager_pass_1" placeholder="New Password (Leave empty to keep unchanged)"/>
        		<label for="manager_pass_2">Confirm Password</label>
        		<input type="password" class="form-control update_pass_2" name="manager_pass_2" placeholder="Confirm Password (Leave empty to keep unchanged)"/>
            <label>Authorization Level</label><br>
            <input type="radio" id="manager_radio_button" name="is_admin" value="0"> Manager<br>
            <input type="radio" id="admin_radio_button" name="is_admin" value="1"> Admin
        </div>
        <div class="modal-footer">
        		<button type="submit" class="btn btn-sm btn-primary pull-right manager_update"><i class="fa fa-refresh"></i> Update</button>
        		<div class="clearfix"></div>
        </div>
      </div>
    </form>
  </div>
</div>