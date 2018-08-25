<input type="hidden" id="application_role" value="<?php echo $this->settings->application_role; ?>">
<input type="hidden" id="sync_url" value="<?php echo $controller.'/'; ?>">
<input type="hidden" id="server_id" value="<?php echo $this->server->server_id; ?>">
<input type="hidden" id="server_url" value="<?php echo $this->server_url; ?>">
<input type="hidden" id="server_access_code" value="<?php echo $this->server->server_access_code; ?>">
<input type="hidden" id="local_url" value="<?php echo $this->local_url; ?>">
<input type="hidden" id="sync_limit" value="<?php echo $sync_limit; ?>">


<div class="row">
	<div class="col-xs-12 sync_page">
		<div class="col-sm-3">
			<div class="panel panel-default">
			  <div class="panel-heading">Fetch List</div>
			  <div class="panel-body">

			  </div>
			  <div class="panel-footer">

			  </div>
			</div> <!-- Panel Ends -->
		</div>
		<div class="col-sm-3">
			<div class="panel panel-warning">
			  <div class="panel-heading">Release List</div>
			  <div class="panel-body">

			  </div>
			  <div class="panel-footer">

			  </div>
			</div> <!-- Panel Ends -->
		</div>
		<div class="col-sm-3">
			<div class="panel panel-info">
			  <div class="panel-heading">Confirm List</div>
			  <div class="panel-body">

			  </div>
			  <div class="panel-footer">

			  </div>
			</div> <!-- Panel Ends -->
		</div>
		<div class="col-sm-3">
			<div class="panel panel-success">
			  <div class="panel-heading">Push List</div>
			  <div class="panel-body">

			  </div>
			  <div class="panel-footer">

			  </div>
			</div> <!-- Panel Ends -->
		</div>
	</div>
</div>
