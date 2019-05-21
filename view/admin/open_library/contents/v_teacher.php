<?php
	$data_source = site_url('admin/user/all_teachers');
	if($page_title == 'Deactivated Teachers') $data_source .= '/1';
?>
<div class="row">
	<div class="col-sm-12 table-responsive">
		<table data-page="teachers" class="table table-striped datatable" data-source="<?php echo $data_source; ?>">
			<thead>
				<tr>
					<th class="dt_xs">ID</th>
					<th>Name</th>
					<th class="dt_xs">Username</th>
					<th class="dt_sm">Designation</th>
					<th class="dt_xs">Dept</th>
					<th class="dt_sm">Email</th>
					<th class="dt_sm">Phone</th>
					<th class="opt_column">Options</th>
				</tr>
			</thead>
      <tfoot>
        <tr>
          <td>ID</td>
          <td>Name</td>
          <td>Username</td>
          <td>Designation</td>
          <td>Dept</td>
          <td>Email</td>
          <td>Phone</td>
          <td class="opt_column">Options</td>
        </tr>
      </tfoot>
		</table>
	</div>
</div>
<!-- Modal for adding Users -->
<div id="myModal" class="modal hide" role="dialog">
  <div class="modal-dialog">
  <form class="lib_form user_addform" action="<?php echo $controller.'/add/teachers'; ?>" method="post">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add a New Teacher</h4>
      </div>
      <div class="modal-body modal-scroll">
          <label for="user_name">Name</label>
          <input autofocus required type="text" class="form-control" name="user_name" placeholder="Name"/>
          <label for="user_dept">Department</label>
          <select id="user_dept_add" required class="form-control" name="user_dept">
          	<option selected="selected" value="nothing">--Please select a Department--</option>
          	<option value="CSE">CSE</option>
          	<option value="ECE">ECE</option>
          	<option value="BBA">BBA</option>
          	<option value="Diploma">Diploma</option>
      		<option value="CT">CT</option>
      		<option value="ET">ET</option>
      		<option value="CMT">CMT</option>
      		<option value="TCT">TCT</option>
          </select>
          <label for="teacher_designation">Designation</label>
          <input required type="text" class="form-control" name="teacher_designation" placeholder="Designation"/>
          <label for="user_phone">Phone</label>
          <input required type="text" class="form-control" name="user_phone" placeholder="Phone"/>
          <label for="user_email">Email</label>
          <input required type="email" class="form-control" name="user_email" placeholder="Email"/>
          <label for="user_username">Username</label>
          <input required type="text" class="form-control" name="user_username" placeholder="Username"/>
          <label for="user_pass_1">Password</label>
          <input required type="password" class="form-control add_pass_1" name="user_pass_1" placeholder="Password"/>
          <label for="user_pass_2">Confirm Password</label>
          <input required type="password" class="form-control add_pass_2" name="user_pass_2" placeholder="Confirm Password"/>
      </div>
      <div class="modal-footer">
          <button type="submit" class="btn btn-sm btn-primary pull-right"><i class="fa fa-plus"></i> Add</button>
          <div class="clearfix"></div>
      </div>
    </div>
    </form>
  </div>
</div>


<!-- Modal for editing Users -->
<div id="editModal" class="modal hide" role="dialog">
  <div class="modal-dialog">
  	<form class="lib_form user_updateform" action="#" method="post">
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Edit Teacher</h4>
	      </div>
	      <div class="modal-body edit_form_inputs modal-scroll">
	      	<label for="user_name">Name</label>
	      	<input autofocus required type="text" class="form-control" name="user_name" placeholder="Name"/>
	      	<label for="user_dept">Department</label>
	      	<select id="user_dept_update" required class="form-control" name="user_dept">
	      		<option id="select_dept" value="nothing">--Please select a Department--</option>
	      		<option id="CSE" value="CSE">CSE</option>
	      		<option id="ECE" value="ECE">ECE</option>
	      		<option id="BBA" value="BBA">BBA</option>
            <option value="Diploma">Diploma</option>
	      		<option id="CT" value="CT">CT</option>
	      		<option id="ET" value="ET">ET</option>
	      		<option id="CMT" value="CMT">CMT</option>
	      		<option id="TCT" value="TCT">TCT</option>
	      	</select>
	      	<label for="teacher_designation">Designation</label>
	      	<input required type="text" class="form-control" name="teacher_designation" placeholder="Designation"/>
	      	<label for="user_phone">Phone</label>
	      	<input required type="text" class="form-control" name="user_phone" placeholder="Phone"/>
	      	<label for="user_email">Email</label>
	      	<input required type="email" class="form-control" name="user_email" placeholder="Email"/>
	      	<label for="user_username">Username</label>
	      	<input required type="text" class="form-control" name="user_username" placeholder="Username"/>
	      	<label for="user_pass_1">Password</label>
	      	<input type="password" class="form-control add_pass_1" name="user_pass_1" placeholder="New Password (Leave empty to keep current password)"/>
	      	<label for="user_pass_2">Confirm Password</label>
	      	<input type="password" class="form-control add_pass_2" name="user_pass_2" placeholder="Confirm Password (Leave empty to keep current password)"/>
	      </div>
	      <div class="modal-footer">
	          <button type="submit" class="btn btn-sm btn-primary pull-right"><i class="fa fa-refresh"></i> Update</button>
	          <div class="clearfix"></div>
	      </div>
	    </div>
    </form>
  </div>
</div>


<!-- --------------------------- Import Modal ------------------------------ -->
<div class="modal" id="importModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <form id="importform" action="<?php echo $import_action; ?>" method="post" enctype="multipart/form-data" class="was-validated">
            <div class="modal-header">

              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Upload Your CSV file.</h4>

            </div>
            <div class="modal-body">
                <div class="alert bg-warning h3">
                    Please note that the import file should be <span class="text-danger">EXACTLY</span> in the format shown in the sample file.
                    <br><br>
                    <a class="btn btn-sm btn-danger pull-right" href="<?php echo $sample_file_link; ?>">Download Sample File</a>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="csv_file" id="csv_file" required>
                        <label class="custom-file-label" for="csv_file">Please select your import file and click Import</label>
                    </div>
                </div>

                <br>

                <button type="submit" class="float-right btn btn-primary btn-sm" ><i class="fa fa-upload"></i> Import</button>
                <div class="clearfix"></div>
            </div>
        </form>
        </div>
    </div>
</div>