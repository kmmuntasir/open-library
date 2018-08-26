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
	applied_queries = [];

	$.post(server_url+'feed_queries/'+limit, access_post_data, function(data) {
		if(isJSON(data)) {
			var queries = $.parseJSON(data);
			var entry_ids = [];
			$('#fetch_list').html();
			for(var i=0; i < queries.length; i++) {
				// $('#fetch_list').append(JSON.stringify(queries[i])+'<br><br><br>');
				$('#fetch_list').append(queries[i].log_entry_id+'<br><br>');
			}

			$('#release_list').html('');
			$.post(sync_url+'add_log', {'queries':queries}, function(entry_ids) {
				if(isJSON(entry_ids)) {
					$.post(server_url+'update_log_as_synced', {'access_code': server_access_code, 'entry_ids':entry_ids}, function(data) {
						$('#release_list').html(data);
					});
				}


			});

		}
	});

	/*
	// Fetching remote log and syncing
	$queries = $this->my_curl($this->server_url.'feed_queries/'.$sync_limit, array('access_code'=>$this->server->server_access_code));
	if($queries == false) return false; // No Server Connection
	if($queries == 'Invalid Access Code') return false;
	$queries = json_decode($queries, true);   // Fetching unsynced log entries
	if(count($queries) == 0) {
	    //echo 'Nothing new to fetch from the remote server<br>';
	    return true;
	}
	// // Fetched
	// echo 'Fetched<br>';
	// $this->printer($queries);
	$entry_ids = array();
	foreach($queries as $key=>$query) {
	    array_push($entry_ids, $queries[$key]['log_entry_id']);
	    unset($queries[$key]['log_id']);
	    $this->db->trans_start();
	    $this->db->query($query['log_query']); // Running log queries (applying changes into local server)
	    $this->db->trans_complete();
	    $queries[$key]['log_is_synced'] = 1;
	}
	$aff = $this->m_sync->add_log($queries);    // Adding queries in log entry
	if($aff) {
	    $this->my_curl($this->server_url.'update_log_as_synced', array('access_code'=>$this->server->server_access_code, 'data'=>$entry_ids)); // Confirming remote server about the ids which has been synced
	    return true;
	}
	return false;
	*/
}

function release() {
	
}

function confirm() {
	
}

function push_queries() {
	
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

