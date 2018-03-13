<?php
  $status = array(8=>'Expired', -1=>'Overdue', 0=>'Confirmed', 1=>'Active', 2=>'Fine Due', 3=>'Completed', 9=>'Requested');
  $status_class = array(8=>'default', -1=>'danger', 0=>'primary', 1=>'warning', 2=>'info', 3=>'success', 9=>'info');
  $user_type = array("Student", "Teacher");
  $user_type_class = array("info", "danger");
?>

<div class="row placeholders">
  <div class="col-xs-6 col-sm-3 placeholder">
    <i class="fa fa-book i_placeholder" style="color:green;"></i>
    <h4>Collection</h4>
    <span class="text-muted"><?php echo $book_count; ?> Books in Collection</span>
  </div>
  <div class="col-xs-6 col-sm-3 placeholder">
    <i class="fa fa-copy i_placeholder" style="color:orange;"></i>
    <h4>Total Copies</h4>
    <span class="text-muted"><?php echo $copy_count; ?> Copies in Stock</span>
  </div>
  <div class="col-xs-6 col-sm-3 placeholder">
    <i class="fa fa-calendar i_placeholder" style="color:red;"></i>
    <h4>Overdue Issues</h4>
    <span class="text-muted"><?php echo $overdue_count; ?> Records</span>
  </div>
  <div class="col-xs-6 col-sm-3 placeholder">
    <i id="last_sync_time_indicator" class="fa fa-spin pause-spinner fa-refresh i_placeholder" style="color:blue;"></i>
    <h4>Last Sync</h4>
    <span id="last_sync_time" class="text-muted"><?php echo $last_sync; ?></span>
  </div>
</div>
  <hr>

<?php
  $status = array(-3=>'Expired', -1=>'Overdue', 0=>'Confirmed', 1=>'Active', 2=>'Fine Due', 3=>'Completed', 9=>'Requested');
  $status_class = array(-3=>'default', -1=>'danger', 0=>'primary', 1=>'warning', 2=>'info', 3=>'success', 9=>'info');
?>
<div class="row">
  <?php if(count($issues)) { ?>
  <div class="col-sm-12 table-responsive">
    <table class="table table-striped datatable" style="font-size:12px;">
      <thead>
        <tr>
          <th>Code</th>
          <th>User</th>
          <th>Book</th>
          <th>Date</th>
          <th>Auto Expire</th>
          <th class="opt_column">Options</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($issues as $key=> $issue) { ?>
        <tr>
          <td><?php echo $issue->issue_id; ?></td>
          <td><span class="btn btn-xs btn-<?php echo $user_type_class[$issue->is_teacher]; ?>"><?php echo $user_type[$issue->is_teacher]; ?></span>  <a title="View Issue History for this User" href="<?php echo $controller.'/issue_by_user/'.$issue->user_id; ?>"><?php echo $issue->user_name; ?></a></td>
          <td><a href="<?php echo $controller.'/issue_by_book/'.$issue->book_id; ?>" title="View History for this Book"><?php echo '('.$issue->book_id.')'.' (#'.$issue->issue_book_copy_accession_no.') '.$issue->book_title; ?></a></td>
          <td><?php echo date('M d, Y', strtotime($issue->issue_datetime)).'<br />'.date('h:i a', strtotime($issue->issue_datetime)); ?></td>
          <td><?php if($issue->issue_auto_expire_datetime != '') echo date('M d, Y', strtotime($issue->issue_auto_expire_datetime)).'<br />'.date('h:i a', strtotime($issue->issue_auto_expire_datetime)); ?></td>
          <td>
            <a href="#" title="View Issue Details" issue_id="<?php echo $issue->issue_id; ?>" class="view_issue btn btn-xs btn-primary">
              <i class="fa fa-eye"></i>
            </a>
            <!--<a href="<?php echo $controller.'/delete/'.$issue->issue_id; ?>" class="delete delete_issue btn btn-xs btn-danger">
              <i class="fa fa-remove"></i>
            </a>-->
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
  <?php } ?>
</div>


<!-- Modal for Issuing Books -->
<div id="myModal" class="modal hide" role="dialog">
  <div class="modal-dialog">
  <form id="add_issue_form" class="lib_form" action="<?php echo site_url($module).'/issue/add_issue'; ?>" method="post">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Issue Book</h4>
      </div>
      <div class="modal-body modal-scroll add_form_inputs">
          <label class="col-sm-4" for="user_roll">User Library Code</label>
          <input type="password" class="col-sm-8" name="user_library_code_primary" placeholder="User Library Code"/>
          <input type="hidden" class="col-sm-8" name="user_library_code" placeholder="User Library Code"/>

          <input type="hidden" name="num_of_books" value="1">
          <div class="book_box">
            <label class="col-sm-4" for="book_1">Acc. No.(s)<button type="button" id="book_plus" class="inline_plus btn btn-xs btn-primary pull-right"><i class="fa fa-plus"></i></button><button type="button"  id="book_minus" class="inline_minus btn btn-xs btn-danger pull-right"><i class="fa fa-minus"></i></button></label>
            <input required type="text" class="col-sm-8" name="book_1" placeholder="Book Accession No."/>
          </div>

      </div>
      <div class="modal-footer">
          <button type="submit" class="btn btn-sm btn-primary pull-right"><i class="fa fa-plus"></i> Add</button>
          <div class="clearfix"></div>
      </div>
    </div>
    </form>
  </div>
</div>



<!-- Modal for Viewing Issue -->
<div id="viewModal" class="modal hide " role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 id="issue_id" class="modal-title">Issue #143</h4>
      </div>
      <div class="modal-body modal-scroll">
          <table class="table table-striped">
            <tr>
              <td>Issue Date</td>
              <td id="issue_datetime">June 5, 2016</td>
            </tr>
            <tr>
              <td>Request Auto <br />Expire Date</td>
              <td id="issue_auto_expire_datetime">N/A</td>
            </tr>
            <tr>
              <td>Return Date</td>
              <td id="issue_return_datetime">N/A</td>
            </tr>
            <tr>
              <td>Deadline</td>
              <td id="issue_deadline">N/A</td>
            </tr>
            <tr>
              <td>Overdue</td>
              <td id="issue_overdue">N/A</td>
            </tr>
            <tr>
              <td>User Details</td>
              <td id="user_details">
                Mr. John Doe<br />
                CSE-0000 (09-10)<br />
                01XXXXXXXXX<br />
                user@mail.com
              </td>
            </tr>
            <tr>
              <td>Book Details</td>
              <td id="book_details"><strong>(#126) Programming in ANSI C</strong> by <em>E. Balagurusamy</em></td>
            </tr>
            <tr>
              <td>Issued By</td>
              <td id="manager_details">Khalil</td>
            </tr>
            <tr>
              <td>Issue Status</td>
              <td id="issue_status">

                   <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-ban"></i> Overdue</button>
                
                   <button type="button" class="btn btn-default btn-sm"><i class="fa fa-hand-paper-o"></i> Requested</button>
                
                   <button type="button" class="btn btn-warning btn-sm"><i class="fa fa-refresh"></i> Active</button>
                
                   <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-calendar-times-o"></i> Received Without Fine</button>
                
                   <button type="button" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Completed</button>
                
                   <button type="button" class="btn btn-default btn-sm"><i class="fa fa-thumbs-up"></i> Confirmed but not Issued</button>
              </td>
            </tr>
            <tr>
              <td>Fine</td>
              <td id="issue_fine">N/A</td>
            </tr>
            <!-- <tr>
              <td>Remarks</td>
              <td id="issue_remarks">There is no remarks for this issue</td>
            </tr> -->
          </table>
          <hr />
          <div class="row secret_codes">
            <div class="col-xs-6">
              <table class="table table-striped">
                <tr>
                  <th>User Code</th>
                  <th>#</th>
                </tr>
                <tr>
                  <td>Lend Code</td>
                  <td id="issue_lend_user_code">N/A</td>
                </tr>
                <tr>
                  <td>Receive Code</td>
                  <td id="issue_receive_user_code">N/A</td>
                </tr>
                <tr>
                  <td>Fine Code</td>
                  <td id="issue_fine_user_code">N/A</td>
                </tr>
                <tr>
                  <td>Renew Code</td>
                  <td id="issue_renew_user_code">N/A</td>
                </tr>
              </table>
            </div>
            <div class="col-xs-6">
              <table class="table table-striped">
                <tr>
                  <th>Admin Code</th>
                  <th>#</th>
                </tr>
                <tr>
                  <td>Receive Code</td>
                  <td id="issue_receive_admin_code">N/A</td>
                </tr>
                <tr>
                  <td>Fine Code</td>
                  <td id="issue_fine_admin_code">N/A</td>
                </tr>
              </table>
            </div>
          </div>
      </div>
      <div class="modal-footer" id="issue_view_modal_footer">
          
          
      </div>
    </div>
  </div>
</div>



<!-- Modal for Activating Issue -->
<div id="activateModal" class="modal hide" role="dialog">
  <div class="modal-dialog">
    <form id="activateModal_form" action="<?php echo site_url('admin/issue/activate');?>" method="post">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Request Activation</h4>
      </div>
      <div class="modal-body modal-scroll add_form_inputs">
        <div class="col-sm-12">
          <label class="col-sm-4" for="user_roll">Issue Lend Code</label>
          <input required="" id="lend_code_input" type="text" class="col-sm-8" name="issue_lend_user_code" placeholder="Issue Lend Code (Example: 41@CN#iR)"/>
        </div>
        <div class="col-sm-12">
          <br />
          <label class="col-sm-4" for="issue_book_copy_accession_no">Accession No.</label>
          <input required="" id="issue_book_copy_accession_no_input" type="text" class="col-sm-8" name="issue_book_copy_accession_no" placeholder="Book Copy Accession Number"/>
        </div>
      </div>
      <div class="modal-footer">
          <button id="lend_code_submit" type="submit" class="btn btn-sm btn-primary pull-right"><i class="fa fa-plus"></i> Add</button>
          <div class="clearfix"></div>
      </div>
    </div>
    </form>
  </div>
</div>
