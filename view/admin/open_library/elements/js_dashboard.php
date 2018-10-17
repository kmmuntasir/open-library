<?php require_once('js_issue.php'); ?>

// Function for Changing the last sync time on the dashboard page
$(document).ready(function() {

    // Checking SMS Balance
    var sms_gateway_info_url = $('#sms_gateway_info_url').val() + '?token='+'<?php echo $this->settings->sms_access_token; ?>'+'&balance&expiry&rate';
    $.post( sms_gateway_info_url, function( data ) {
        var temp = data.split('</br>');
        var rate = temp[2];
        var balance = temp[0];
        balance /= rate;
        balance = parseInt(balance);
        var expiry_arr = temp[1].split('-');
        var expiry_date = formatDate(expiry_arr[2]+'-'+expiry_arr[1]+'-'+expiry_arr[0], 'MMMM dd, yyyy');

        $('.sms_info_balance').html(balance);
        $('.sms_info_date').html(expiry_date);

        if(balance < 30) $('.sms_info_wrapper').css('background-color', 'orange');

    });

    function sync_time_update() {
        $('#last_sync_time_indicator').removeClass('pause-spinner');
        var url = "<?php echo site_url('user/sync/last_sync_time') ?>";
        $.post( url, function( data ) { 
            if(data) {
                setTimeout(function(){ 
                    $('#last_sync_time_indicator').addClass('pause-spinner'); 
                    $('#last_sync_time').html(data);
                }, 902);
            }
            else {
                setTimeout(function(){ 
                    $('#last_sync_time_indicator').addClass('pause-spinner'); 
                }, 902);
            }
        });
    }
    
    var sync_time = function() { sync_time_update();};
    var sync_time_interval = <?php echo $this->sync_interval*1500; ?>;
    // var sync_time_interval = 3000;
    setInterval(sync_time, sync_time_interval);
});

$(document).on('click', '#restore_backup', function() {
    $('#restoreModal').removeClass('hide');
    $('#restoreModal').addClass('show');
});