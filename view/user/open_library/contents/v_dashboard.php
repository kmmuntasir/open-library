<div class="row placeholders">
  <div class="col-xs-6 col-sm-3 placeholder">
    <i class="fa fa-book i_placeholder" style="color:green;"></i>
    <h4>Collection</h4>
    <span class="text-muted">479 Books in Collection</span>
  </div>
  <div class="col-xs-6 col-sm-3 placeholder">
    <i class="fa fa-copy i_placeholder" style="color:orange;"></i>
    <h4>Total Copies</h4>
    <span class="text-muted">5327 Copies in Stock</span>
  </div>
  <div class="col-xs-6 col-sm-3 placeholder">
    <i class="fa fa-calendar i_placeholder" style="color:red;"></i>
    <h4>Overdue Issues</h4>
    <span class="text-muted">126 Records</span>
  </div>
  <div class="col-xs-6 col-sm-3 placeholder">
    <i class="fa fa-refresh i_placeholder" style="color:blue;"></i>
    <h4>Last Sync</h4>
    <span class="text-muted">4:32 pm, June 9, 2016</span>
  </div>
</div>

<div class="row">
  <h3 class="page-header">Book Issue Requests</h3>
  <div class="col-sm-12 table-responsive">
    <table class="table table-striped datatable">
      <thead>
        <tr>
          <th>Student</th>
          <th>Request Date</th>
          <th># of Books</th>
          <th class="opt_column">Options</th>
        </tr>
      </thead>
      <tbody>
        <?php for($i=0; $i<43; $i++) { ?>
        <tr>
          <td>Muntasir Billah Munna</td>
          <td>May 10, 2016</td>
          <td>4</td>
          <td>
            <a href="#" class="edit_manager btn btn-xs btn-primary">
              <i class="fa fa-eye"></i>
            </a>
            <a href="#" class="edit_manager btn btn-xs btn-info">
              <i class="fa fa-credit-card-alt"></i>
            </a>
            <a href="#" class="edit_manager btn btn-xs btn-danger">
              <i class="fa fa-remove"></i>
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
	<form class="lib_form" action="hello.php">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Issue Book</h4>
      </div>
      <div class="modal-body modal-scroll">
      		<label class="col-sm-4" for="user_email">User Email</label>
      		<input type="text" class="col-sm-8" name="user_email" placeholder="User Email"/>
      		<label class="col-sm-4" for="book_copy_id">Book(s)<button class="inline_plus btn btn-xs btn-primary pull-right"><i class="fa fa-plus"></i></button><button class="inline_minus btn btn-xs btn-danger pull-right"><i class="fa fa-minus"></i></button></label>
      		<input required type="text" class="col-sm-8" name="book_1" placeholder="Book Title"/>
      		<input required type="text" class="col-sm-8 col-sm-offset-4" name="Book_2" placeholder="Book Title"/>
      </div>
      <div class="modal-footer">
      		<button type="submit" class="btn btn-sm btn-primary pull-right"><i class="fa fa-plus"></i> Add</button>
      		<div class="clearfix"></div>
      </div>
    </div>
    </form>
  </div>
</div>



<!-- Modal for Viewing Books -->
<div id="viewModal" class="modal hide" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Issue #143</h4>
      </div>
      <div class="modal-body modal-scroll">
          <table class="table table-striped">
            <tr>
              <td>Issue Request Date</td>
              <td>June 5, 2016</td>
            </tr>
            <tr>
              <td>User ID</td>
              <td>
                Muntasir Billah Munna<br />
                CSE-201057 (09-10)<br />
                01516180603<br />
                kmmuntasir@gmail.com
              </td>
            </tr>
            <tr>
              <td>Books</td>
              <td>
                <ul>
                  <li><strong>Programming in ANSI C</strong> by <em>E. Balagurusamy</em></li>
                  <li><strong>Programming in ANSI C</strong> by <em>E. Balagurusamy</em></li>
                  <li><strong>Programming in ANSI C</strong> by <em>E. Balagurusamy</em></li>
                </ul>
              </td>
            </tr>
          </table>
      </div>
      <div class="modal-footer">
          <button type="submit" class="btn btn-sm btn-primary pull-right"><i class="fa fa-credit-card-alt"></i> Issue</button>
          <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>