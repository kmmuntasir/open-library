<input type="hidden" id="application_role" value="<?php echo $this->settings->application_role; ?>">
<input type="hidden" id="sync_url" value="<?php echo $controller.'/'; ?>">
<input type="hidden" id="server_id" value="<?php echo $this->server->server_id; ?>">
<input type="hidden" id="server_url" value="<?php echo $this->server_url; ?>">
<input type="hidden" id="server_access_code" value="<?php echo $this->server->server_access_code; ?>">
<input type="hidden" id="sync_limit" value="<?php echo $sync_limit; ?>">
<input type="hidden" id="sync_interval" value="<?php echo $this->sync_interval; ?>">

<div class="row">
	<div class="col-xs-12">
		<div class="col-xs-12">
			<div class="progress">
			  <div id="wait_indicator" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
			  </div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 sync_page">
		<div class="col-sm-3">
			<div class="panel panel-default">
			  <div class="panel-heading">Fetch List</div>
			  <div class="panel-body" id="fetch_list">

			  </div>
			  <div class="panel-footer">

			  </div>
			</div> <!-- Panel Ends -->
		</div>
		<div class="col-sm-3">
			<div class="panel panel-warning">
			  <div class="panel-heading">Release List</div>
			  <div class="panel-body" id="release_list">

			  </div>
			  <div class="panel-footer">

			  </div>
			</div> <!-- Panel Ends -->
		</div>
		<div class="col-sm-3">
			<div class="panel panel-info">
			  <div class="panel-heading">Confirm List</div>
			  <div class="panel-body" id="confirm_list">

			  </div>
			  <div class="panel-footer">

			  </div>
			</div> <!-- Panel Ends -->
		</div>
		<div class="col-sm-3">
			<div class="panel panel-success">
			  <div class="panel-heading">Push List</div>
			  <div class="panel-body" id="push_list">

			  </div>
			  <div class="panel-footer">

			  </div>
			</div> <!-- Panel Ends -->
		</div>
	</div>
</div>


<style type="text/css">
	.progress-bar {
	    -webkit-transition: none !important;
	    transition: none !important;
	}
</style>