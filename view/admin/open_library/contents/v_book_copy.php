<div class="row">
	<div class="col-md-5">
		<form class="lib_form" id="get_copy_details">
		  <!-- Modal content-->
		  <div class="modal-content">
		    <div class="modal-header">
		      <button type="button" class="close" data-dismiss="modal">&times;</button>
		      <h4 class="modal-title">View Single Copy Details</h4>
		    </div>
		    <div class="modal-body">
		        <input id="book_copy_accession_no" autofocus="" required type="text" class="form-control" name="book_copy_accession_no" placeholder="Enter the Accession No."/>
		    </div>
		    <div class="modal-footer">
		        <button type="submit" class="btn btn-sm btn-primary pull-right"><i class="fa fa-check"></i> Get Details</button>
		        <div class="clearfix"></div>
		    </div>
		  </div>
		</form>
		<br />
	</div>
	<div class="col-md-7">
		<form id="delete_copy_range_form" class="lib_form" action="<?php echo $controller.'/delete_copy_range'; ?>" method="post">
		  <!-- Modal content-->
		  <div class="modal-content">
		    <div class="modal-header">
		      <button type="button" class="close" data-dismiss="modal">&times;</button>
		      <h4 class="modal-title">Delete A Copy Range</h4>
		    </div>
		    <div class="modal-body">
		    	<div class="col-sm-3">
		        	<input required type="text" class="form-control" name="book_id" placeholder="Book Code"/>
		        </div>
		        <div class="col-sm-9">
			    	<div class="col-sm-6">
			        	<input required type="text" class="form-control" name="book_copy_accession_no_1" placeholder="Starting Accession No."/>
			        </div>
			        <div class="col-sm-6">
			        	<input required type="text" class="form-control" name="book_copy_accession_no_2" placeholder="Ending Accession No."/>
			        </div>
		        </div>
		        <div class="clearfix"></div>
		    </div>
		    <div class="modal-footer">
		        <button type="submit" class="btn btn-sm btn-danger pull-right"><i class="fa fa-trash"></i> Delete Range</button>
		        <div class="clearfix"></div>
		    </div>
		  </div>
		</form>
	</div>
</div>

<!-- Modal for Viewing Single Copy -->
<div id="viewModal" class="modal hide" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title view_title">Book Title Here</h4>
      </div>
      <div class="modal-body modal-scroll book_copy_view_modal">
          <table class="table table-striped">
            <tr>
              <td class="prop_column">Accession No.</td>
              <td class="view_accession_no">Book Title</td>
            </tr>
            <tr>
              <td>ISBN</td>
              <td class="view_isbn">Book ISBN</td>
            </tr>
            <tr>
              <td class="prop_column">Title</td>
              <td class="view_title">Book Title</td>
            </tr>
            <tr>
              <td>Edition</td>
              <td class="view_edition">Book Edition</td>
            </tr>
            <tr>
              <td>Author(s)</td>
              <td class="view_author">
                Author one, two and three
              </td>
            </tr>
            <tr>
              <td>Category(s)</td>
              <td class="view_category">
                One, Two, Three
              </td>
            </tr>
            <tr>
              <td>Publisher</td>
              <td class="view_publication">Book Publisher</td>
            </tr>
            <tr>
              <td>Copy Type</td>
              <td class="view_copy_type">Book Copy type</td>
            </tr>
            <tr>
              <td>Year of Publication</td>
              <td class="view_year_of_publication">Book Year of Publication</td>
            </tr>
            <tr>
              <td>Place of Publication</td>
              <td class="view_place_of_publication">Book Place of Publication</td>
            </tr>
            <tr>
              <td>Total Pages</td>
              <td class="view_total_pages">Book Total Pages</td>
            </tr>
            <tr>
              <td>Copy Status</td>
              <td class="view_copy_status">Book Copy Status</td>
            </tr>
            <tr>
              <td>Copy Added By</td>
              <td class="view_copy_manager">Book Copy Manager</td>
            </tr>
            <tr>
              <td>Copy Add Date</td>
              <td class="view_copy_date">Book Copy Add Date</td>
            </tr>
            <tr>
              <td>Price</td>
              <td class="view_copy_price">Book Copy Price</td>
            </tr>
            <tr>
              <td>Source</td>
              <td class="view_copy_source">Book Copy Source</td>
            </tr>
            <tr>
              <td>Copy Remarks</td>
              <td class="view_copy_remarks">Book Copy Remarks</td>
            </tr>
            <tr><td></td><td></td></tr>
            <tr>
              <td>Book Add Date</td>
              <td class="view_add_date">Book Add Date</td>
            </tr>
            <tr>
              <td>Book Status</td>
              <td class="view_status">Book Status</td>
            </tr>
            <tr>
              <td>Book Remarks</td>
              <td class="view_remarks">Book Remarks</td>
            </tr>
            <tr>
              <td>Stock</td>
              <td class="view_stock">40</td>
            </tr>
            <tr>
              <td>Available</td>
              <td class="view_available">37</td>
            </tr>
          </table>
      </div>
      <div id="view_copy_footer" class="modal-footer">
          <a href="#" class="delete btn btn-sm btn-danger pull-right"><i class="fa fa-trash"></i> Delete</a>
          <button book_copy_accession_no="book_copy_accession_no" type="button" class="editCopy btn btn-sm btn-info pull-right"><i class="fa fa-pencil"></i> Modify</button>
          <a href="#" class="history btn btn-sm btn-primary pull-right"><i class="fa fa-book"></i> Issue History</a>
          <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>


<!-- Modal for editing copies -->
<div id="copyEditModal" class="modal hide" role="dialog">
  <div class="modal-dialog">
  <form class="lib_form edit_copy_form" action="#" method="post">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 id="edit_copy_modal_title" class="modal-title add_copy_book_title">Edit Copy: </h4>
      </div>
      <div class="modal-body modal-scroll add_copy_modal">
        <table class="table table-striped">
          <tr>
            <td>
              <label class="col-sm-12" for="book_copy_type">Copy Type</label>
            </td>
            <td>
              <select id="edit_copy_type" class="col-sm-12" name="book_copy_type" required="">
                <option class="book_copy_type_normal" value="1">Normal Copy</option>
                <option class="book_copy_type_reference" value="0">Reference Copy</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>
              <label class="col-sm-12" for="book_copy_remarks">Remarks</label>
            </td>
            <td>
              <textarea id="edit_copy_remarks" class="col-sm-12" name="book_copy_remarks"></textarea>
            </td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
          <button type="submit" class="btn btn-sm btn-primary pull-right"><i class="fa fa-refresh"></i> Update</button>
          <div class="clearfix"></div>
      </div>
    </div>
    </form>
  </div>
</div>

