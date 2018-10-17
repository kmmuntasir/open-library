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
var sync_interval = '';
var interval = 0;
var last_updated = '';
var sms_gateway_url = '';
var sms_access_token = '';
var sms_sending_status = '';
var counter = 0;
var sms_locked = false;

$(document).ready(function() {

	application_role = $('#application_role').val();
	server_id = $('#server_id').val();
	server_url = $('#server_url').val();
	sync_url = $('#sync_url').val();
	server_access_code = $('#server_access_code').val();
	access_post_data = {'access_code': server_access_code};
	sync_limit = $('#sync_limit').val();
	sync_interval = $('#sync_interval').val();
	sms_gateway_url = $('#sms_gateway_url').val();
	sms_access_token = $('#sms_access_token').val();
	sms_sending_status = $('#sms_sending_status').val();
	last_updated = Date.now();
	if(application_role == 0) {
		// var sync_trigger = function() {if(!syncing) sync();};
		// var request_timeout_handler_trigger = function() {request_timeout_handler();};
	    interval = sync_interval*1000;
	    sync();
	    setInterval(sync, interval);
	    setInterval(request_timeout_handler, interval*3);
	}
	else {
		// Show message
	}

});

function sync() {
	if(syncing) return;
	syncing = true;
	$.post(sync_url+'is_sync_ready', function(data) {
		if(data == 'yes') {
			start_sync();
			reset_wait_indicator(start_sync_indicator);
		}
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
				$('#fetch_list').html('Nothing to Fetch<br> ');
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
				clean_old_logs();
				update_remote_server_connection_time();
			}
			else {
				$.post(server_url+'receive_local_log', {'access_code': server_access_code, 'queries':queries}, function(entry_ids) {
					if(isJSON(entry_ids)) {
						$.post(sync_url+'update_log_as_synced', {'access_code': server_access_code, 'entry_ids':entry_ids}, function(data) {
							$('#push_list').html(data);
							clean_old_logs();
						});
					}
					else {
						$('#push_list').html('Logs Pushed but Wasn\'t Reveived by Remote Server');
						clean_old_logs();
					}
				});
			}
		}
		else {
			$('#push_list').html('Local Server Feed Error');
			clean_old_logs();
		}
	});
}

function clean_old_logs() {
	$.post(sync_url+'clean_old_logs/'+(sync_limit * 10), function(data) {
		$('#log_clean_panel').html(data);
		update_local_server_connection_time();
	});
}

function update_local_server_connection_time() {
	$.post(sync_url+'update_server_connection_time/'+server_id, function(data) {
		var now = "Last Sync: " + formatDate(null, 'h:mm:ss a, MMMM d, yyyy');
		last_updated = Date.now();
		$('#sync_page_time').html(now);
		finish_sync();
	});
}

function update_remote_server_connection_time() {
	$.post(server_url+'update_server_connection_time/'+server_id, function(data) {
		// Some action
	});
}

function unlock_server(s_id) {
	$.post(sync_url+'unlock_server/'+s_id, function(data) {
		locked = false;
	});
}

function finish_sync() {
	fire_sms();

	if(locked) unlock_server(server_id);
	syncing = false;
	++counter;
	if(counter >= 10 && !sms_locked) reload(); // Reloading page to get rid of excessive dom memory load
	else reset_sync_indicator(start_wait_indicator);
}


// ======================= Animation Functions =======================

function start_wait_indicator() {
	$("#wait_indicator").animate({
	    width: "100%"
	}, interval-1000);
}
	
// function reset_wait_indicator(callback) {
// 	$("#wait_indicator").animate({
// 	    width: "0%"
// 	}, 0);
// 	callback();
// }

function reset_wait_indicator(callback) {
	$("#wait_indicator").animate({
	    width: "0%"
	}, 0, function() {
		callback();
	});
}

function start_sync_indicator() {
	$('#sync_indicator i').addClass('fa-spin');
	$('#sync_indicator').removeClass('btn-default');
	$('#sync_indicator').addClass('btn-success');
}

function reset_sync_indicator(callback) {
	$('#sync_indicator i').removeClass('fa-spin');
	$('#sync_indicator').removeClass('btn-success');
	$('#sync_indicator').addClass('btn-default');
	callback();
}


// ======================= Request Time Out Handler ==================


function request_timeout_handler() {
	var now = Date.now();
	var diff = now - last_updated;
	if(diff > (interval * 3)) {
		reload();
	}
}

function reload(forceget=false) {
	location.reload(forceget);
}

// ======================= SMS Functions =============================

function lock_sms() {
	sms_locked = true;
}

function unlock_sms() {
	sms_locked = false;
}

function send_sms(to=null, message=null, id=null) {
    if(sms_sending_status == 0) {
    	$('#sms_monitor_panel').append('<br><br><div class="alert alert-md alert-danger"><b>SMS Sending Turned Off By Admin</b></div>');
    	unlock_sms();
    	return;
    }

    // Returns 'success' if succeeded, returns API Reply if SMS is not sent.
    
    if(!to || to=='' || !message || message=='' || !id || id=='') {
    	$('#sms_monitor_panel').append('<br><br><div class="alert alert-md alert-danger"><b>Recipient and Message Text is Required</b></div>');
    	unlock_sms();
    	return;
    }

    $('#sms_monitor_panel').append('<br><br>Sending SMS......<br>');
    $.post(sms_gateway_url, {'to': to, 'message':message, 'token':sms_access_token}, function(api_reply) {

    	var sms_stat = api_reply.split(":")[0];

    	// var sms_stat = res[0];

    	if(sms_stat == 'Ok') {
    		$('#sms_monitor_panel').append('<br><br><div class="alert alert-md alert-success"><b>SMS Sent Successfully</b></div>');
    		$.post(sync_url+'delete_sms', {'sms_id': id}, function(data) {
    			if(data == 'success')
    				$('#sms_monitor_panel').append('<div class="alert alert-md alert-success"><b>SMS Deleted Successfully</b></div>');
    			else
    				$('#sms_monitor_panel').append('<div class="alert alert-md alert-danger"><b>'+data+'</b></div>');
    			unlock_sms();
    		});
    	}
    	else {
    		$('#sms_monitor_panel').append('<br><br><div class="alert alert-md alert-danger"><b>'+api_reply+'</b></div>');
    		unlock_sms();
    	}


    });



}

function fire_sms(limit=1) {
	// First, fetch sms from database
	if(sms_locked) return;
	lock_sms();
	$.post(sync_url+'feed_sms/'+limit, function(data) {
		if(data) {
			if(isJSON(data)) {
				var sms = $.parseJSON(data);

				if(sms.length == 0) $('#sms_monitor_panel').html("No SMS to Send");
				else {
					for(var i=0; i<sms.length; ++i) {
						$('#sms_monitor_panel').html(sms[i].sms_phone + ' -> "' + sms[i].sms_text + '"<br>');









						send_sms(sms[i].sms_phone, sms[i].sms_text, sms[i].id);
						


















					}
				}
				
			}
			else $('#sms_monitor_panel').html("SMS Fetching Error");
		}
		else $('#sms_monitor_panel').html("SMS Fetching Error");
	});




	// if phone number and sms text is not null or empty string, send the sms
}
