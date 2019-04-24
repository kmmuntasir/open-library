<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#user_details"><i class="fa fa-user"></i> User Details</a></li>
  <li><a data-toggle="tab" href="#library_card"><i class="fa fa-credit-card"></i> Library Card</a></li>
</ul>

<div class="tab-content">
  <div id="user_details" class="tab-pane fade in active">
  	<div class="row">
  		<div class="col-sm-6 table-responsive">
  			<!-- Modal content-->
  			<div class="modal-content">
  			  <div class="modal-header">
  			    <h4 class="modal-title">
              Profile Information
              <button type="button" id="user_edit_modal_button" class="btn btn-primary btn-md pull-right"><i class="fa fa-edit"></i> Edit Contact Info</button>
            </h4>
  			  </div>
  			  <div class="modal-body">
  			      <table class="table table-striped">
  			      	<tbody>
  			      		<tr>
  			      			<th>ID</th>
  			      			<td><?php echo $user->user_id; ?></td>
  			      		</tr>
  			      		<tr>
  			      			<th>Name</th>
  			      			<td><?php echo $user->user_name; ?></td>
  			      		</tr>
  			      		<tr>
  			      			<th>Username</th>
  			      			<td><?php echo $user->user_username; ?></td>
  			      		</tr>
  			      		<tr>
  			      			<th>Program</th>
  			      			<td><?php echo $user->user_dept; ?></td>
  			      		</tr>
  			      		<?php if($user->is_teacher == 0) { ?>
  			      		<tr>
  			      			<th>Roll</th>
  			      			<td><?php echo $user->user_roll; ?></td>
  			      		</tr>
  			      		<tr>
  			      			<th>Session</th>
  			      			<td><?php echo $user->user_session.' - '.($user->user_session + 1); ?></td>
  			      		</tr>
  			      		<?php } else { ?>
  			      		<tr>
  			      			<th>Designation</th>
  			      			<td><?php echo $user->teacher_designation; ?></td>
  			      		</tr>
  			      		<?php } ?>
  			      		<tr>
  			      			<th>Email</th>
  			      			<td><?php echo $user->user_email; ?></td>
  			      		</tr>
  			      		<tr>
  			      			<th>Phone</th>
  			      			<td><?php echo $user->user_phone; ?></td>
  			      		</tr>
  			      	</tbody>
  			      </table>
  			  </div>
  			  <div class="modal-footer">
					<br />
  			      <div class="clearfix"></div>
  			  </div>
  			</div>
  		</div>
  		<div class="col-sm-6">
  			<form class="lib_form" id="change_pass_form" action="<?php echo $controller.'/change_pass'; ?>" method="post">
  			  <!-- Modal content-->
  			  <div class="modal-content">
  			    <div class="modal-header">
  			      <h4 class="modal-title">Change Password</h4>
  			    </div>
  			    <div class="modal-body">
  			    	<label for="old_pass">Current Password</label>
  			        <input id="old_pass" autofocus="" required type="password" class="form-control" name="old_pass" placeholder="Current Password"/>
  			    	<label for="pass_1">New Password</label>
  			        <input id="pass_1" required type="password" class="form-control" name="pass_1" placeholder="New Password"/>
  			        <label for="pass_2">Confirm Password</label>
  			        <input id="pass_2" required type="password" class="form-control" name="pass_2" placeholder="Confirm Password"/>
  			    </div>
  			    <div class="modal-footer">
  			        <button type="submit" class="btn btn-sm btn-success pull-right"><i class="fa fa-check"></i> Submit</button>
  			        <div class="clearfix"></div>
  			    </div>
  			  </div>
  			</form>
  		</div>
  	</div>
  </div>
  <div id="library_card" class="tab-pane fade in">
    <div class="col-sm-6">
    	<div class="modal-content">
		    <div class="modal-header">
		      <h4 class="modal-title">Your Library Card</h4>
		    </div>
    	  <div class="modal-body library_card_wrap">
    	  	<div class="card_head">
    	  		<h3>INSTITUTE OF SCIENCE AND TECHNOLOGY</h3>
    	  		<h4>LIBRARY CARD</h4>
    	  		<div class="clearfix"></div>
    	  	</div><!-- card_head ends -->
    	  	<div class="user_info_left">
            <div class="user_info">
              <img class="campus_logo" src="<?php echo base_url('images/'.$this->settings->institute_logo); ?>">
              <table class="card_table">
              <tr>
                <th>Name</th>
                <td class="colon-td">:</td>
                <td><?php echo $user->user_name; ?></td>
              </tr>
              <tr>
                <th>Program</th>
                <td class="colon-td">:</td>
                <td><?php echo $user->user_dept; ?></td>
              </tr>
              <?php if($user->is_teacher == 0) { ?>
              <tr>
                <th>Session</th>
                <td class="colon-td">:</td>
                <td><?php echo $user->user_session; ?></td>
              </tr>
              <tr>
                <th>Roll</th>
                <td class="colon-td">:</td>
                <td><?php echo $user->user_roll; ?></td>
              </tr>
              <?php } else { ?>
              <tr>
                <th>Designation</th>
                <td class="colon-td">:</td>
                <td><?php echo $user->teacher_designation; ?></td>
              </tr>
              <?php } ?>
              <tr>
                <th>Username</th>
                <td class="colon-td">:</td>
                <td><?php echo $user->user_username; ?></td>
              </tr>
              <tr>
                <th>Library ID</th>
                <td class="colon-td">:</td>
                <td><?php echo $user->user_id; ?></td>
              </tr>
              </table>
            </div><!-- user_info ends -->
          </div>
          <div class="user_info_right">
            <div class="barcode">
              <img src="<?php echo $barcode_url; ?>" />
              <div class="clearfix"></div>
            </div><!-- barcode ends -->
          </div>
          <div class="clearfix"></div>
    	  </div>
  	    <div class="modal-footer">
  	        <a target="_blank" href="<?php echo site_url('user/profile/print_view'); ?>" class="btn btn-sm btn-primary pull-right"><i class="fa fa-sign-out"></i> Print View</a>
  	        <div class="clearfix"></div>
  	    </div>
    	</div>
    </div>
    <div class="col-sm-6">
    	<form class="lib_form" id="new_code_form" action="<?php echo $controller.'/new_code'; ?>" method="post">
    	  <!-- Modal content-->
    	  <div class="modal-content">
    	    <div class="modal-header">
    	      <h4 class="modal-title">Generate New Library Code</h4>
    	    </div>
    	    <div class="modal-body">
    	    	<label for="user_pass">Current Password</label>
    	        <input autofocus="" required type="password" class="form-control" name="user_pass" placeholder="Current Password"/>
    	    </div>
    	    <div class="modal-footer">
    	        <button type="submit" class="btn btn-sm btn-success pull-right"><i class="fa fa-check"></i> Submit</button>
    	        <div class="clearfix"></div>
    	    </div>
    	  </div>
    	</form>
    </div>
  </div>
</div>

<!-- Modal for adding Users -->
<div id="user_edit_modal" class="modal hide" role="dialog">
  <div class="modal-dialog">
  <form id="user_editform" class="lib_form" action="<?php echo $controller.'/update'; ?>" method="post">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Contact Info</h4>
      </div>
      <div class="modal-body modal-scroll">
          <label for="user_phone">Phone</label>
          <input id="user_phone" required type="text" class="form-control" name="user_phone" placeholder="Phone" autofocus="" />
          <label for="user_email">Email</label>
          <input id="user_email" required type="email" class="form-control" name="user_email" placeholder="Email"/>
      </div>
      <div class="modal-footer">
          <button type="submit" class="btn btn-sm btn-primary pull-right"><i class="fa fa-check"></i> Save changes</button>
          <div class="clearfix"></div>
      </div>
    </div>
    </form>
  </div>
</div>
