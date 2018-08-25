var syncing = false;
var application_role = null;
var sync_limit = 10;
var ret = true;
var server_id = '';
var server_url = '';
var sync_url = '';
var server_access_code = '';
var sync_limit = '';

$(document).ready(function() {
	application_role = $('#application_role').val();
	server_id = $('#server_id').val();
	server_url = $('#server_url').val();
	sync_url = $('#sync_url').val();
	server_access_code = $('#server_access_code').val();
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
	check_server_connection();
}

function check_server_connection() {
	var postdata = {'access_code': server_access_code};
	$.post(server_url+'confirm_server_connection', postdata, function(data) {
		if(data = $.md5(server_access_code)) lock_server(server_id);
		else syncing = false;
	});
}

function lock_server(s_id) {
	$.post(sync_url+'lock_server/'+s_id, function(data) {
		if(data == '1') fetch_queries(sync_limit);
		else syncing = false;
	});
}

function fetch_queries() {
	if($sync_limit == 0) return false;
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
	
}

function finish_sync() {
	syncing = false;
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

