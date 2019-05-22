<style type="text/css">

    body {
        padding-top: 0;
    }
    #main_nav, #add_button {
        display: none;
    }
</style>


<div class="modal-dialog" role="document">
    <div class="modal-content">
    <form id="restoreform" action="<?php echo $restore_action; ?>" method="post" enctype="multipart/form-data" class="was-validated">
        <div class="modal-header">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Upload Your Backup Zip/SQL file.</h4>

        </div>
        <div class="modal-body">
            <div class="alert bg-warning h5">
                Please note that restoring a backup file will replace and delete all your system data. We suggest you to please take a new backup first before uploading a backup file, in case anything goes wrong.
            </div>
            <div class="alert bg-danger text-white h6">
                You will be logged out after restoration. So please ensure that you know the username/password of an admin account which exists in the backup.
            </div>
            <div class="form-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="backup_file" id="backup_file" required>
                    <label class="custom-file-label" for="backup_file">Please select your backup file and click Restore</label>
                </div>
            </div>

            <br>

            <button type="submit" class="float-right btn btn-primary btn-sm" ><i class="fa fa-upload"></i> Restore</button>
            <div class="clearfix"></div>
        </div>
    </form>
    </div>
</div>
