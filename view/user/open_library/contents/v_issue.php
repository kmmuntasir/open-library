<?php
  $status = array(8=>'Expired', -1=>'Overdue', 0=>'Confirmed', 1=>'Active', 2=>'Fine Due', 3=>'Completed', 9=>'Requested');
  $status_class = array(8=>'default', -1=>'danger', 0=>'primary', 1=>'warning', 2=>'info', 3=>'success', 9=>'info');
?>
<div class="row">
  <div class="col-sm-12 table-responsive">
  <?php if($subpage == 'issue_by_student') { ?><h3>Showing all Issue History for <?php if(isset($issues[0])) echo $issues[0]->user_name; ?></h3><?php } ?>
  <?php if($subpage == 'issue_by_book') { ?><h3>Showing all Issue History for Book <?php if(isset($issues[0])) echo '('.$issues[0]->book_id.') '.$issues[0]->book_title; ?></h3><?php } ?>
  <?php if($subpage == 'issue_by_book_copy') { ?><h3>Showing all Issue History for <?php if(isset($issues[0])) echo '('.$issues[0]->book_id.') (#'.$issues[0]->issue_book_copy_accession_no.') '.$issues[0]->book_title; ?></h3><?php } ?>
    <table class="table table-striped datatable" style="font-size:12px;">
      <thead>
        <tr>
          <th>Code</th>
          <?php if($subpage != 'issue_by_student') { ?><th>Student</th><?php } ?>
          <?php if($subpage != 'issue_by_book' && $subpage != 'issue_by_book_copy') { ?><th>Book</th><?php } ?>
          <th class="issue_datetime_th">Date</th>
          <?php if($subpage == 'requests' || $subpage == 'all' || $subpage == 'issue_by_student' || $subpage == 'issue_by_book' || $subpage == 'issue_by_book_copy') { ?><th>Auto Expire</th> <?php } ?>
          <?php if($subpage == 'active' || $subpage == 'overdue' || $subpage == 'all' || $subpage == 'issue_by_student' || $subpage == 'issue_by_book' || $subpage == 'issue_by_book_copy') { ?><th>Deadline</th> <?php } ?>
          <?php if($subpage == 'overdue' || $subpage == 'all') { ?><th>Fine</th><?php } ?>
          <?php if($subpage == 'completed' || $subpage == 'all' || $subpage == 'issue_by_student' || $subpage == 'issue_by_book' || $subpage == 'issue_by_book_copy') { ?><th>Returned</th> <?php } ?>
          <?php if($subpage == 'all' || $subpage == 'issue_by_student' || $subpage == 'issue_by_book' || $subpage == 'issue_by_book_copy' || $subpage == 'requests') { ?><th>Status</th> <?php } ?>
          <th class="opt_column">Options</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($issues as $key=> $issue) { ?>
        <tr>
          <td><?php echo $issue->issue_id; ?></td>
          <?php if($subpage != 'issue_by_student') { ?><td><a title="View Issue History for this Student" href="<?php echo $controller.'/issue_by_student/'.$issue->user_id; ?>"><?php echo $issue->user_name; ?></a></td><?php } ?>
          <?php if($subpage != 'issue_by_book' && $subpage != 'issue_by_book_copy') { ?><td><a href="<?php echo $controller.'/issue_by_book/'.$issue->book_id; ?>" title="View History for this Book"><?php echo '('.$issue->book_id.')'.' (#'.$issue->issue_book_copy_accession_no.') '.$issue->book_title; ?></a></td><?php } ?>
          <td><?php echo date('M d, Y', strtotime($issue->issue_datetime)).'<br />'.date('h:i a', strtotime($issue->issue_datetime)); ?></td>
          <?php if($subpage == 'requests' || $subpage == 'all' || $subpage == 'issue_by_student' || $subpage == 'issue_by_book' || $subpage == 'issue_by_book_copy') { ?><td><?php if($issue->issue_auto_expire_datetime != '') echo date('M d, Y', strtotime($issue->issue_auto_expire_datetime)).'<br />'.date('h:i a', strtotime($issue->issue_auto_expire_datetime)); ?></td> <?php } ?>
          <?php if($subpage == 'active' || $subpage == 'overdue' || $subpage == 'all' || $subpage == 'issue_by_user' || $subpage == 'issue_by_book' || $subpage == 'issue_by_book_copy') { ?><td><?php if($issue->issue_deadline != '' && !$issue->is_teacher) echo date('M d, Y', strtotime($issue->issue_deadline)).'<br />'.date('h:i a', strtotime($issue->issue_deadline)); ?></td> <?php } ?>
          <?php if($subpage == 'overdue' || $subpage == 'all') { ?><td><?php echo $issue->issue_fine; ?></td><?php } ?>
          <?php if($subpage == 'completed' || $subpage == 'all' || $subpage == 'issue_by_student' || $subpage == 'issue_by_book' || $subpage == 'issue_by_book_copy') { ?><td><?php if($issue->issue_return_datetime != '') echo date('M d, Y', strtotime($issue->issue_return_datetime)).'<br />'.date('h:i a', strtotime($issue->issue_return_datetime)); ?></td> <?php } ?>
          <?php if($subpage == 'all' || $subpage == 'issue_by_student' || $subpage == 'issue_by_book' || $subpage == 'issue_by_book_copy' || $subpage == 'requests') { ?>
            <td>
              <button type="button" class="btn btn-xs btn-<?php echo $status_class[$issue->issue_status]; ?>">
                <?php echo $status[$issue->issue_status]; ?>
              </button>
            </td>
          <?php } ?>
          <td>
            <a href="#" title="View Issue Details" issue_id="<?php echo $issue->issue_id; ?>" class="view_issue btn btn-xs btn-primary">
              <i class="fa fa-eye"></i>
            </a>
          </td>
        </tr>
        <?php } ?>
      </tbody>
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
        <h4 class="modal-title">Type and then select from the dropdown</h4>
        <h5 class="">You can type Book title, Book code or even Author names, but remember to select from the dropdown</h5>
      </div>
      <div class="modal-body modal-scroll add_form_inputs">
          <!-- <label class="col-sm-4" for="user_roll">User Library Code</label>
          <input type="password" class="col-sm-8" name="user_library_code_primary" placeholder="User Library Code"/>
          <input type="hidden" class="col-sm-8" name="user_library_code" placeholder="User Library Code"/> -->
          <input type="hidden" name="num_of_books" value="1">
          <div class="book_box">
            <label class="col-sm-4" for="book_1">Book Code(s)<button type="button" id="book_plus" title="Another Book" class="inline_plus btn btn-xs btn-primary pull-right"><i class="fa fa-plus"></i></button><button type="button" title="Decrease a Book Field"  id="book_minus" class="inline_minus btn btn-xs btn-danger pull-right"><i class="fa fa-minus"></i></button></label>
            <input autofocus="" list="booklist" required type="text" class="col-sm-8 book_code_field" name="book_1" placeholder="Book Code"/>
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

<datalist id="booklist">
  <?php
    foreach($books as $book) {
      $seperator = ' ';
      $book_description = $book->book_id.'-'.$book->book_title.' ('.$book->book_edition.') -';
      foreach($book->authors as $author) {
        $book_description .= $seperator.$author->author_name;
        $seperator = ', ';
      }
  ?>
    <option value="<?php echo $book_description; ?>">
  <?php } ?>
</datalist>
