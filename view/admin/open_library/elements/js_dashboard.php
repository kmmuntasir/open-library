<?php require_once('js_issue.php'); ?>

// Function for Changing the last sync time on the dashboard page
$(document).ready(function() {
    function sync_time_update() {
        $('#last_sync_time_indicator').removeClass('pause-spinner');
        var url = "<?php echo site_url('user/sync/last_sync_time') ?>";
        $.post( url, function( data ) { 
            if(data) {
                $('#last_sync_time').html(data);
            }
            setTimeout(function(){ $('#last_sync_time_indicator').addClass('pause-spinner'); }, 1000);
        });
    }
    
    var sync_time = function() {if(!busy) sync_time_update();};
    var sync_time_interval = <?php echo $this->sync_interval*1500; ?>;
    setInterval(sync_time, sync_time_interval);
});

$(document).on('click', '#restore_backup', function() {
    $('#restoreModal').removeClass('hide');
    $('#restoreModal').addClass('show');
});