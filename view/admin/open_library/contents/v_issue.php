<div class="row">
  <div class="col-sm-12 table-responsive">
  <?php if($subpage == 'issue_by_user') { ?><h3>Showing all Issue History for "<?php echo $user; ?>"</h3><?php } ?>
  <?php if($subpage == 'issue_by_book') { ?><h3>Showing all Issue History for Book "<?php echo $book_title; ?>"</h3><?php } ?>
  <?php if($subpage == 'issue_by_book_copy') { ?><h3>Showing all Issue History for "<?php echo $book; ?>"</h3><?php } ?>
    <table class="table table-striped datatable" data-page="<?php echo $data_page; ?>" data-source="<?php echo $source; ?>">
      <thead>
        <tr>
          <th class="dt_xs">Code</th>
          <?php if($subpage != 'issue_by_user') { ?><th>User</th><?php } ?>
          <?php if($subpage != 'issue_by_book' && $subpage != 'issue_by_book_copy') { ?><th>Book</th><?php } ?>
          <th class="dt_sm">Date</th>
          <?php if($subpage == 'requests' || $subpage == 'all' || $subpage == 'issue_by_user' || $subpage == 'issue_by_book' || $subpage == 'issue_by_book_copy') { ?><th class="dt_sm">Auto Expire</th> <?php } ?>
          <?php if($subpage == 'active' || $subpage == 'overdue' || $subpage == 'all' || $subpage == 'issue_by_user' || $subpage == 'issue_by_book' || $subpage == 'issue_by_book_copy') { ?><th class="dt_sm">Deadline</th> <?php } ?>
          <?php if($subpage == 'overdue' || $subpage == 'all' || $subpage == 'issue_by_user' || $subpage == 'issue_by_book' || $subpage == 'issue_by_book_copy') { ?><th class="dt_xs">Fine</th><?php } ?>
          <?php if($subpage == 'completed' || $subpage == 'all' || $subpage == 'issue_by_user' || $subpage == 'issue_by_book' || $subpage == 'issue_by_book_copy') { ?><th class="dt_sm">Returned</th> <?php } ?>
          <?php if($subpage == 'all' || $subpage == 'requests' || $subpage == 'issue_by_user' || $subpage == 'issue_by_book' || $subpage == 'issue_by_book_copy') { ?><th class="dt_xs">Status</th> <?php } ?>
          <th class="opt_column">Options</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <td>Code</td>
          <?php if($subpage != 'issue_by_user') { ?><td>User</td><?php } ?>
          <?php if($subpage != 'issue_by_book' && $subpage != 'issue_by_book_copy') { ?><td>Book</td><?php } ?>
          <td class="dt_sm">Date</td>
          <?php if($subpage == 'requests' || $subpage == 'all' || $subpage == 'issue_by_user' || $subpage == 'issue_by_book' || $subpage == 'issue_by_book_copy') { ?><td>Auto Expire</td> <?php } ?>
          <?php if($subpage == 'active' || $subpage == 'overdue' || $subpage == 'all' || $subpage == 'issue_by_user' || $subpage == 'issue_by_book' || $subpage == 'issue_by_book_copy') { ?><td>Deadline</td> <?php } ?>
          <?php if($subpage == 'overdue' || $subpage == 'all' || $subpage == 'issue_by_user' || $subpage == 'issue_by_book' || $subpage == 'issue_by_book_copy') { ?><td>Fine</td><?php } ?>
          <?php if($subpage == 'completed' || $subpage == 'all' || $subpage == 'issue_by_user' || $subpage == 'issue_by_book' || $subpage == 'issue_by_book_copy') { ?><td>Returned</td> <?php } ?>
          <?php if($subpage == 'all' || $subpage == 'requests' || $subpage == 'issue_by_user' || $subpage == 'issue_by_book' || $subpage == 'issue_by_book_copy') { ?><td>Status</td> <?php } ?>
          <td class="opt_column">Options</td>
        </tr>
      </tfoot>
    </table>
  </div>
</div>


<!-- Modal for Issuing Books -->
<div id="myModal" class="modal hide" role="dialog">
  <div class="modal-dialog">
  <form autocomplete="off" id="add_issue_form" class="lib_form" action="<?php echo $controller.'/add_issue'; ?>" method="post">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Issue Book</h4>
      </div>
      <div class="modal-body modal-scroll add_form_inputs">
          <div class="col-xs-12">
            <input id="secret_code_method_changer" class="form-input" type="checkbox" name="secret_code_method_changer">
            <label for="secret_code_method_changer">Use PIN instead of Barcode?</label>
          </div>
          <div class="clearfix"></div>
          <label id="secret_code_input_label" class="col-sm-4" for="secret_code_input">User Library Code</label>
          <div class="col-sm-8 library_code_curtain_box">
            <input id="secret_code_input" required="" oncopy="return false" type="text" class="col-xs-12" name="user_library_code" autocomplete="off" placeholder="User Library Code (use barcode machine)"/>
            <div class="library_code_curtain">****</div>
            <div class="clearfix"></div>
          </div>

          <div id="user_id_box" style="display: none;">
            <label class="col-sm-4" for="user_id_text_input">User Library ID</label>
            <div class="col-sm-8">
              <input id="user_id_text_input" type="text" name="user_id" class="col-xs-12" autocomplete="off" placeholder="User Library ID">
            </div>
          </div>

          <input type="hidden" name="num_of_books" value="1">
          <div class="book_box">
            <label class="col-sm-4" for="book_1">Acc. No.(s)<button type="button" id="book_plus" class="inline_plus btn btn-xs btn-primary pull-right"><i class="fa fa-plus"></i></button><button type="button"  id="book_minus" class="inline_minus btn btn-xs btn-danger pull-right"><i class="fa fa-minus"></i></button></label>
            <input autofocus="" required type="text" class="col-sm-8" name="book_1" placeholder="Book Accession No."/>
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
    <form autocomplete="off" id="activateModal_form" action="<?php echo site_url('admin/issue/activate');?>" method="post">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Request Activation</h4>
      </div>
      <div class="modal-body modal-scroll add_form_inputs">
        <div class="col-sm-12">
          <label class="col-sm-4" for="user_library_code">User Library Code</label>

          <div class="col-sm-8 library_code_curtain_box">
            <input required="" id="user_library_code_input" type="text" class="col-xs-12" name="user_library_code" autocomplete="off" placeholder="User Library Code (use barcode machine)"/>
            <div class="library_code_curtain">****</div>
            <div class="clearfix"></div>
          </div>

        </div>
        <div class="col-sm-12">
          <br />
          <label class="col-sm-4" for="issue_book_copy_accession_no">Accession No.</label>
          <input autofocus="" required="" id="issue_book_copy_accession_no_input" type="text" class="col-sm-8" name="issue_book_copy_accession_no" placeholder="Book Copy Accession Number"/>
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
    <form autocomplete="off" id="renewModal_form" action="#" method="post">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Issue Renewal</h4>
      </div>
      <div class="modal-body modal-scroll add_form_inputs">
        <div class="col-sm-12">
          <label class="col-sm-4" for="user_library_code">User Library Code</label>

          <div class="col-sm-8 library_code_curtain_box">
            <input autofocus="" required="" type="text" class="col-xs-12" name="user_library_code" autocomplete="off" placeholder="User Library Code (use barcode machine)"/>
            <div class="library_code_curtain">****</div>
            <div class="clearfix"></div>
          </div>

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



<!-- Modal for Issuing Books -->
<div id="issue_add_super_admin_modal" class="modal hide" role="dialog">
  <div class="modal-dialog">
  <form autocomplete="off" id="issue_add_super_admin_form" class="lib_form" action="<?php echo $controller.'/issue_add_super_admin'; ?>" method="post">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Issue Book</h4>
      </div>
      <div class="modal-body modal-scroll add_form_inputs">
          <label class="col-sm-4" for="user_roll">User Library ID</label>
          <div class="col-sm-8 library_code_curtain_box">
            <input required="" type="text" class="col-xs-12" name="user_id" autocomplete="off" placeholder="User Library ID"/>
            <!-- <div class="library_code_curtain">****</div> -->
            <div class="clearfix"></div>
          </div>
          <input type="hidden" name="num_of_books" value="1">
          <div class="book_box">
            <label class="col-sm-4" for="book_1">Acc. No.(s)<button type="button" id="book_plus" class="inline_plus btn btn-xs btn-primary pull-right"><i class="fa fa-plus"></i></button><button type="button"  id="book_minus" class="inline_minus btn btn-xs btn-danger pull-right"><i class="fa fa-minus"></i></button></label>
            <input autofocus="" required type="text" class="col-sm-8" name="book_1" placeholder="Book Accession No."/>
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

