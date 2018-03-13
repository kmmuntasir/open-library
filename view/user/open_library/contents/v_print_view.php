<div class="modal-body library_card_wrap">
	<div class="card_head">
		<img class="campus_logo" src="<?php echo base_url('images/logo.png'); ?>">
		<h3>INSTITUTE OF SCIENCE AND TECHNOLOGY</h3>
		<h4>LIBRARY CARD</h4>
		<div class="clearfix"></div>
	</div><!-- card_head ends -->
	<div class="user_info">
		<table class="card_table">
			<tr>
				<th>Name</th>
				<td class="colon-td">:</td>
				<td><?php echo $user->user_name; ?></td>
			</tr>
			<tr>
				<th>Department</th>
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
		</table>
	</div><!-- user_info ends -->
	<div class="barcode">
		<img src="<?php echo $barcode_url; ?>" />
	</div><!-- barcode ends -->
</div>
