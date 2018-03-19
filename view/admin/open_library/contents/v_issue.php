<div class="row">
  <div class="col-sm-12 table-responsive">
  <?php if($subpage == 'issue_by_user') { ?><h3>Showing all Issue History for "<?php echo $user; ?>"</h3><?php } ?>
  <?php if($subpage == 'issue_by_book') { ?><h3>Showing all Issue History for Book "<?php echo $book_title; ?>"</h3><?php } ?>
  <?php if($subpage == 'issue_by_book_copy') { ?><h3>Showing all Issue History for "<?php echo $book; ?>"</h3><?php } ?>
    <table class="table table-striped datatable" data-page="<?php echo $data_page; ?>" data-source="<?php echo $source; ?>">
      <thead>
        <tr>
          <th>Code</th>
          <?php if($subpage != 'issue_by_user') { ?><th>User</th><?php } ?>
          <?php if($subpage != 'issue_by_book' && $subpage != 'issue_by_book_copy') { ?><th>Book</th><?php } ?>
          <th class="issue_datetime_th">Date</th>
          <?php if($subpage == 'requests' || $subpage == 'all' || $subpage == 'issue_by_user' || $subpage == 'issue_by_book' || $subpage == 'issue_by_book_copy') { ?><th>Auto Expire</th> <?php } ?>
          <?php if($subpage == 'active' || $subpage == 'overdue' || $subpage == 'all' || $subpage == 'issue_by_user' || $subpage == 'issue_by_book' || $subpage == 'issue_by_book_copy') { ?><th>Deadline</th> <?php } ?>
          <?php if($subpage == 'overdue' || $subpage == 'all' || $subpage == 'issue_by_user' || $subpage == 'issue_by_book' || $subpage == 'issue_by_book_copy') { ?><th>Fine</th><?php } ?>
          <?php if($subpage == 'completed' || $subpage == 'all' || $subpage == 'issue_by_user' || $subpage == 'issue_by_book' || $subpage == 'issue_by_book_copy') { ?><th>Returned</th> <?php } ?>
          <?php if($subpage == 'all' || $subpage == 'issue_by_user' || $subpage == 'issue_by_book' || $subpage == 'issue_by_book_copy') { ?><th>Status</th> <?php } ?>
          <th class="opt_column">Options</th>
        </tr>
      </thead>
    </table>
  </div>
</div>


<!-- Modal for Issuing Books -->
<div id="myModal" class="modal hide" role="dialog">
  <div class="modal-dialog">
  <form id="add_issue_form" class="lib_form" action="<?php echo $controller.'/add_issue'; ?>" method="post">
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


<!-- Modal for Receiving Fine -->
<div id="fineModal" class="modal hide" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="receiving_title">Receive Issue</h4>
      </div>
      <div class="modal-body modal-scroll" id="fineModal_body">
        <div class="col-xs-6 user_details"></div>
        <div class="col-xs-6 book_details"></div>
        <div class="clearfix"></div>
      </div>
      <div class="modal-footer">
          <button id="receive_issue_final" class="btn btn-sm btn-primary pull-right"><i class="fa fa-book"></i> Receive Only Book</button>
        <div class="clearfix"></div>
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
          <label class="col-sm-4" for="user_library_code">User Library Code</label>
          <input required="" id="user_library_code_input" type="password" class="col-sm-8" name="user_library_code" placeholder="User Library Code (use barcode machine)"/>
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

<!-- Modal for Renewing Issue -->
<div id="renewModal" class="modal hide" role="dialog">
  <div class="modal-dialog">
    <form id="renewModal_form" action="#" method="post">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Issue Renewal</h4>
      </div>
      <div class="modal-body modal-scroll add_form_inputs">
        <div class="col-sm-12">
          <label class="col-sm-4" for="user_library_code">User Library Code</label>
          <input required="" id="user_library_code_input" type="password" class="col-sm-8" name="user_library_code" placeholder="User Library Code (use barcode machine)"/>
          <div class="clearfix"></div><br />
          <div id="renew_alert" class="alert alert-md alert-danger">Are you sure you want to renew this issue? Any fine will be wiped out if the issue is renewed. Please clear out all fine before proceeding</div>
        </div>
      </div>
      <div class="modal-footer">
          <button id="renew_code_submit" type="submit" class="btn btn-sm btn-primary pull-right"><i class="fa fa-plus"></i> Add</button>
          <div class="clearfix"></div>
      </div>
    </div>
    </form>
  </div>
</div>
