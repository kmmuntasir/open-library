<div class="row">
	<div class="col-md-5">
		<form class="lib_form" id="get_copy_details">
		  <!-- Modal content-->
		  <div class="modal-content">
		    <div class="modal-header">
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
          <a href="#" class="history btn btn-sm btn-primary pull-right"><i class="fa fa-book"></i> Issue History</a>
          <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>

