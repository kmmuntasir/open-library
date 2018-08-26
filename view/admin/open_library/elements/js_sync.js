var syncing = false;
var locked = false;
var application_role = null;
var sync_limit = 10;
var ret = true;
var server_id = '';
var server_url = '';
var sync_url = '';
var server_access_code = '';
var sync_limit = '';
var access_post_data = '';
var applied_queries = '';

$(document).ready(function() {
	application_role = $('#application_role').val();
	server_id = $('#server_id').val();
	server_url = $('#server_url').val();
	sync_url = $('#sync_url').val();
	server_access_code = $('#server_access_code').val();
	access_post_data = {'access_code': server_access_code};
	sync_limit = $('#sync_limit').val();
	if(application_role == 0) {
		sync();
	}
	else {
		// Show message
	}
});

function sync() {
	if(syncing) return;
	syncing = true;
	$.post(sync_url+'is_sync_ready', function(data) {
		if(data == 'yes') start_sync();
		else syncing = false;
	});
}

function start_sync() {
	confirm_server_connection();
}

function confirm_server_connection() {
	$.post(server_url+'confirm_server_connection', access_post_data, function(data) {
		if(data == $.md5(server_access_code)) lock_server(server_id);
		else syncing = false;
	});
}

function lock_server(s_id) {
	$.post(sync_url+'lock_server/'+s_id, function(data) {
		if(data == '1') {
			locked = true;
			fetch_queries(sync_limit);
		}
		else syncing = false;
	});
}

function fetch_queries(limit=0) {
	if(limit == 0) finish_sync();
	$('#fetch_list').html('');
	$.post(server_url+'feed_queries/'+limit, access_post_data, function(data) {
		if(isJSON(data)) {
			var queries = $.parseJSON(data);
			if(queries.length == 0) {
				$('#fetch_list').html('Nothing to Fetch');
				release();
			}
			else {
				$.post(sync_url+'receive_local_log', {'access_code': server_access_code, 'queries':queries}, function(entry_ids) {
					if(isJSON(entry_ids)) {
						$.post(server_url+'update_log_as_synced', {'access_code': server_access_code, 'entry_ids':entry_ids}, function(data) {
							$('#fetch_list').html(data);
							release();
						});
					}
					else {
						$('#fetch_list').html('Logs Fetched but Wasn\'t Added in Local Server');
						release();
					}
				});
			}
		}
		else {
			$('#fetch_list').html('Remote Server Feed Error');
			release();
		}
	});
}

function release() {
	$.post(sync_url+'release', function(data) {
		$('#release_list').html(data);
		confirm();
	});
}

function confirm() {
	$.post(sync_url+'confirm', function(data) {
		$('#confirm_list').html(data);
		push_queries(sync_limit);
	});
}

function push_queries(limit=0) {
	if(limit == 0) finish_sync();
	$('#push_list').html('');
	$.post(sync_url+'feed_queries/'+limit, access_post_data, function(data) {
		if(isJSON(data)) {
			var queries = $.parseJSON(data);
			if(queries.length == 0) {
				$('#push_list').html('Nothing to Push');
				return;
			}
			$.post(server_url+'receive_local_log', {'access_code': server_access_code, 'queries':queries}, function(entry_ids) {
				if(isJSON(entry_ids)) {
					$.post(sync_url+'update_log_as_synced', {'access_code': server_access_code, 'entry_ids':entry_ids}, function(data) {
						$('#push_list').html(data);
					});
				}
				else $('#push_list').html('Logs Pushed but Wasn\'t Reveived by Remote Server');
			});
		}
		else $('#push_list').html('Local Server Feed Error');
	});
}

function update_server_connection_time() {
	
}

function unlock_server() {
	locked = false;
}

function finish_sync() {
	if(locked) unlock_server();
	syncing = false;
}

function run(q, callback) {
	postdata = {'query':q.log_query};
	$.post(sync_url+'run_query', postdata, function(data) {
		if(data == '1') callback(q);
	});
}

function add_applied_queries(q) {
	q.log_is_synced = 1;
	applied_queries.push(q);
}
	/* ================================================================= *
	
	$ret = $this->fetch_queries($sync_limit);
	echo 'fetch_queries: '.$ret.'<br>';
	
	$ret &= $this->release();
	echo 'release: '.$ret.'<br>';
	
	$ret &= $this->confirm();
	echo 'confirm: '.$ret.'<br>';
	
	$ret &= $this->push_queries($sync_limit);
	echo 'push_queries: '.$ret.'<br>';
	
	if($ret) $this->update_server_connection_time($this->server->server_id);
	$this->unlock_server($this->server->server_id);

	/* ================================================================= */

	// Finished Work

