<?php require_once('js_issue.php'); ?>

// Function for Changing the last sync time on the dashboard page
$(document).ready(function() {

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