<style type="text/css">

	@page {
		size: A4 portrait;
		margin: 2rem;
	}

	@media screen {

	}

	@media print {

	}

	@media screen, print {

	}


</style>

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
