<div class="row">
	<div class="col-sm-12 table-responsive">
		<table data-page="books" class="table table-striped datatable" data-source="<?php echo $source; ?>">
			<thead>
				<tr>
          <th>#</th>
					<th>Title</th>
					<th>Author(s)</th>
					<th class="narrow_column">Edition</th>
          <th>ISBN</th>
					<th>Publisher</th>
					<th class="narrow_column">Stock</th>
					<th class="narrow_column">Available</th>
          <th class="narrow_column">Online Reading</th>
          <th class="narrow_column">URL Unlocked</th>
					<th class="opt_column">Options</th>
				</tr>
			</thead>
		</table>
	</div>
</div>

<!-- Modal for adding books -->
<div id="myModal" class="modal hide" role="dialog">
  <div class="modal-dialog">
	<form class="lib_form" action="<?php echo $controller.'/add'; ?>" method="post">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add a New Book</h4>
      </div>
      <div class="modal-body modal-scroll add_form_inputs">
          <label class="col-sm-4 col-xs-12" for="book_title">Book Title</label>
          <input autofocus required type="text" class="col-sm-8 col-xs-12" name="book_title" placeholder="Book Title"/>
          <label class="col-sm-4 col-xs-12" for="book_isbn">ISBN</label>
          <input type="text" class="col-sm-8 col-xs-12" name="book_isbn" placeholder="ISBN"/>
          <input type="hidden" name="num_of_authors" value="1">
          <div class="author_box">
            <label class="col-sm-4 col-xs-12" for="author">Author(s)<button type="button" id="add_author_plus" class="inline_plus btn btn-xs btn-primary pull-right"><i class="fa fa-plus"></i></button><button type="button"  id="add_author_minus" class="inline_minus btn btn-xs btn-danger pull-right"><i class="fa fa-minus"></i></button></label>
            <input list="author_names" required type="text" class="col-sm-8 col-xs-12" name="author_1" placeholder="Type Author name here"/>
          </div>

          <input type="hidden" name="num_of_categories" value="1">
          <div class="category_box">
            <label class="col-sm-4 col-xs-12" for="category">Category(s)<button type="button" id="add_category_plus" class="inline_plus btn btn-xs btn-primary pull-right"><i class="fa fa-plus"></i></button><button type="button"  id="add_category_minus" class="inline_minus btn btn-xs btn-danger pull-right"><i class="fa fa-minus"></i></button></label>
            <input list="category_names" required type="text" class="col-sm-8 col-xs-12" name="category_1" placeholder="Type Category name here"/>
          </div>

          <label class="col-sm-4 col-xs-12" for="publication_id">Publisher</label>
          <input list="publication_names" required type="text" class="col-sm-8 col-xs-12" name="publication_name" placeholder="Publisher"/>
          <input required type="hidden" class="col-sm-8 col-xs-12" name="publication_id" />
          <label class="col-sm-4 col-xs-12" for="book_edition">Edition</label>
          <input required type="text" class="col-sm-8 col-xs-12" name="book_edition" placeholder="Edition"/>
          <label class="col-sm-4 col-xs-12" for="book_place_of_pub">Place of Publication</label>
          <input type="text" class="col-sm-8 col-xs-12" name="book_place_of_pub" placeholder="Place of Publication"/>
          <label class="col-sm-4 col-xs-12" for="book_year_of_pub">Year of Publication</label>
          <input type="number" class="col-sm-8 col-xs-12" name="book_year_of_pub" placeholder="Year of Publication" />
          <label class="col-sm-4 col-xs-12" for="book_pages">Total Pages</label>
          <input type="number" class="col-sm-8 col-xs-12" name="book_pages" placeholder="Total Pages"/>
          <label class="col-sm-4 col-xs-12" for="book_status">Status</label>
          <select class="col-sm-8 col-xs-12" name="book_status" required="">
            <option class="active_book" value="1">Active</option>
            <option class="inactive_book" value="0">Inactive</option>
          </select>

          <div class="clearfix"></div>

          <br>
          <label class="col-sm-4 col-xs-12" for="book_url">Online Reading URL</label>
          <input type="text" class="col-sm-8 col-xs-12" name="book_url" placeholder="Online Reading URL"/>
          <label class="col-sm-4 col-xs-12" for="book_url_unlocked">User Ability to Update Online Reading URL</label>
          <select class="col-sm-8 col-xs-12" name="book_url_unlocked" required="">
            <option class="active_url" value="1" checked="checked">Enabled</option>
            <option class="inactive_url" value="0">Disabled</option>
          </select>
          <div class="clearfix"></div>


          <label class="col-sm-4 col-xs-12" for="book_remarks">Remarks</label>
          <textarea class="col-sm-8 col-xs-12" name="book_remarks"></textarea>
          <div class="clearfix"></div>
      </div>
      <div class="modal-footer">
      		<button type="submit" class="btn btn-sm btn-primary pull-right"><i class="fa fa-plus"></i> Add</button>
      		<div class="clearfix"></div>
      </div>
    </div>
    </form>
  </div>
</div>


<!-- Modal for editing books -->
<div id="editModal" class="modal hide" role="dialog">
  <div class="modal-dialog">
  <form class="lib_form" action="#" method="post">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Book</h4>
      </div>
      <div class="modal-body modal-scroll edit_form_inputs">
          <label class="col-sm-4 col-xs-12" for="book_title">Book Title</label>
          <input autofocus required type="text" class="col-sm-8 col-xs-12" name="book_title" placeholder="Book Title"/>
          <div class="clearfix"></div>
          <label class="col-sm-4 col-xs-12" for="book_isbn">ISBN</label>
          <input type="text" class="col-sm-8 col-xs-12" name="book_isbn" placeholder="ISBN"/>
          <div class="clearfix"></div>

          <input type="hidden" name="num_of_authors" value="">
          <div class="author_box">
            <label class="col-sm-4 col-xs-12" for="author">Author(s)<button type="button" id="author_plus" class="inline_plus btn btn-xs btn-primary pull-right"><i class="fa fa-plus"></i></button><button type="button"  id="author_minus" class="inline_minus btn btn-xs btn-danger pull-right"><i class="fa fa-minus"></i></button></label>
            <input list="author_names" required type="text" class="col-sm-8 col-xs-12" name="author_1" placeholder="Type Author name here"/>
          </div>
          <div class="clearfix"></div>

          <input type="hidden" name="num_of_categories" value="">
          <div class="category_box">
            <label class="col-sm-4 col-xs-12" for="category">Category(s)<button type="button" id="category_plus" class="inline_plus btn btn-xs btn-primary pull-right"><i class="fa fa-plus"></i></button><button type="button"  id="category_minus" class="inline_minus btn btn-xs btn-danger pull-right"><i class="fa fa-minus"></i></button></label>
            <input list="category_names" required type="text" class="col-sm-8 col-xs-12" name="category_1" placeholder="Type Category name here"/>
          </div>
          <div class="clearfix"></div>

          <label class="col-sm-4 col-xs-12" for="publication_id">Publisher</label>
          <input list="publication_names" required type="text" class="col-sm-8 col-xs-12" name="publication_name" placeholder="Publisher"/>
          <div class="clearfix"></div>
          <input required type="hidden" class="col-sm-8 col-xs-12" name="publication_id" />
          <label class="col-sm-4 col-xs-12" for="book_edition">Edition</label>
          <input required type="text" class="col-sm-8 col-xs-12" name="book_edition" placeholder="Edition"/>
          <div class="clearfix"></div>
          <label class="col-sm-4 col-xs-12" for="book_place_of_pub">Place of Publication</label>
          <input type="text" class="col-sm-8 col-xs-12" name="book_place_of_pub" placeholder="Place of Publication"/>
          <div class="clearfix"></div>
          <label class="col-sm-4 col-xs-12" for="book_year_of_pub">Year of Publication</label>
          <input type="number" class="col-sm-8 col-xs-12" name="book_year_of_pub" placeholder="Year of Publication" value="1998" />
          <div class="clearfix"></div>
          <label class="col-sm-4 col-xs-12" for="book_pages">Total Pages</label>
          <input type="number" class="col-sm-8 col-xs-12" name="book_pages" placeholder="Total Pages"/>
          <div class="clearfix"></div>
          <label class="col-sm-4 col-xs-12" for="book_status">Status</label>
          <select class="col-sm-8 col-xs-12" name="book_status" required="">
            <option class="active_book" value="1">Active</option>
            <option class="inactive_book" value="0">Inactive</option>
          </select>
          <div class="clearfix"></div>

          <br>
          <label class="col-sm-4 col-xs-12" for="book_url">Online Reading URL</label>
          <input type="text" class="col-sm-8 col-xs-12" name="book_url" placeholder="Online Reading URL"/>
          <label class="col-sm-4 col-xs-12" for="book_url_unlocked">User Ability to Update Online Reading URL</label>
          <select class="col-sm-8 col-xs-12" name="book_url_unlocked" required="">
            <option class="active_url" value="1" checked="checked">Enabled</option>
            <option class="inactive_url" value="0">Disabled</option>
          </select>
          <div class="clearfix"></div>

            <label class="col-sm-4 col-xs-12" for="book_remarks">Remarks</label>
            <textarea class="col-sm-8 col-xs-12" name="book_remarks"></textarea>
          <div class="clearfix"></div>
      </div>
      <div class="modal-footer">
          <button type="submit" class="btn btn-sm btn-primary pull-right"><i class="fa fa-refresh"></i> Update</button>
          <div class="clearfix"></div>
      </div>
    </div>
    </form>
  </div>
</div>

<!-- Modal for Viewing Single Book -->
<div id="viewModal" class="modal hide" role="dialog">
  <div class="modal-dialog">
  <form class="lib_form" action="hello.php">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title view_title">Book Title Here</h4>
      </div>
      <div class="modal-body modal-scroll book_view_modal">
          <table class="table table-striped">
            <tr>
              <td>Book Code</td>
              <td class="view_code">Book Code</td>
            </tr>
            <tr>
              <td class="prop_column">Title</td>
              <td class="view_title">Book Title</td>
            </tr>
            <tr>
              <td>ISBN</td>
              <td class="view_isbn">Book ISBN</td>
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
              <td>Edition</td>
              <td class="view_edition">Book Edition</td>
            </tr>
            <tr>
              <td>Place of Publication</td>
              <td class="view_place_of_publication">Book Place of Publication</td>
            </tr>
            <tr>
              <td>Year of Publication</td>
              <td class="view_year_of_publication">Book Year of Publication</td>
            </tr>
            <tr>
              <td>Total Pages</td>
              <td class="view_total_pages">Book Total Pages</td>
            </tr>
            <tr>
              <td>Status</td>
              <td class="view_status">Book Status</td>
            </tr>
            <tr>
              <td>Stock</td>
              <td class="view_stock">40</td>
            </tr>
            <tr>
              <td>Available</td>
              <td class="view_available">37</td>
            </tr>
            <tr>
              <td>Online Reading URL</td>
              <td class="view_url">Book URL</td>
            </tr>
            <tr>
              <td>User Ability to Update Online Reading URL</td>
              <td class="view_url_unlocked">Enabled</td>
            </tr>
            <tr>
              <td>Remarks</td>
              <td class="view_remarks">Book Remarks</td>
            </tr>
          </table>
          <table class="table table-striped book_copy_details_box">
            <thead>
              <tr>
                <th>Acc. No.</th>
                <th>Copy Type</th>
                <th>Status</th>
                <th>Added Date</th>
                <th>Price</th>
                <th>Source</th>
                <th>Remarks</th>
              </tr>
            </thead>
            <tbody>
              
            </tbody>
          </table>
      </div>
      <div class="modal-footer">
          <button id="addCopyModalButton" type="button" class="addCopy btn btn-sm btn-primary pull-right"><i class="fa fa-copy"></i> Add Copies</button>
          <div class="clearfix"></div>
      </div>
    </div>
    </form>
  </div>
</div>

<!-- Modal for adding copies -->
<div id="copyModal" class="modal hide" role="dialog">
  <div class="modal-dialog">
  <form class="lib_form add_copy_form" action="#" method="post">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title add_copy_book_title">Add Copies</h4>
      </div>
      <div class="modal-body modal-scroll add_copy_modal">
        <table class="table table-striped">
          <tr>
            <td class="col-xs-4">
              <label class="col-sm-12" for="book_copy_num">Number of Copies</label>
            </td>
            <td class="col-xs-8">
              <input autofocus required type="number" class="col-sm-12" name="book_copy_num" value="1" placeholder="Number of Copies"/>
            </td>
          </tr>
          <tr>
            <td>
              <label class="col-sm-12" for="book_copy_accession_no">Starting Accession No.</label>
            </td>
            <td>
              <input id="starting_accession" required type="text" class="col-sm-12" name="book_copy_accession_no" placeholder="Starting Accession No."/>
            </td>
          </tr>
          <tr>
            <td>
              <label class="col-sm-12" for="book_copy_price">Price</label>
            </td>
            <td>
              <input required type="text" class="col-sm-12" name="book_copy_price" placeholder="Price"/>
            </td>
          </tr>
          <tr>
            <td>
              <label class="col-sm-12" for="book_copy_type">Copy Type</label>
            </td>
            <td>
              <select class="col-sm-12" name="book_copy_type" required="">
                <option value="1">Normal</option>
                <option value="0">Reference</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>
              <label class="col-sm-12" for="book_copy_source">Source</label>
            </td>
            <td>
              <select class="col-sm-12" name="book_copy_source" required="">
                <option value="1">Purchase</option>
                <option value="2">Donation</option>
                <option value="3">Other</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>
              <label class="col-sm-12" for="book_copy_remarks">Remarks</label>
            </td>
            <td>
              <textarea class="col-sm-12" name="book_copy_remarks"></textarea>
            </td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
          <button type="submit" class="btn btn-sm btn-primary pull-right"><i class="fa fa-plus"></i> Add</button>
          <div class="clearfix"></div>
      </div>
    </div>
    </form>
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


<!-- Modal for Viewing Single Copy -->
<div id="viewCopyModal" class="modal hide" role="dialog">
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


<datalist id="author_names">
  <?php foreach($authors as $author) { ?>
    <option value="<?php echo $author->author_name; ?>">
  <?php } ?>
</datalist>

<datalist id="category_names">
  <?php foreach($categories as $category) { ?>
    <option value="<?php echo $category->category_name; ?>">
  <?php } ?>
</datalist>

<datalist id="publication_names">
  <?php foreach($publications as $publication) { ?>
    <option value="<?php echo $publication->publication_name; ?>">
  <?php } ?>
</datalist>