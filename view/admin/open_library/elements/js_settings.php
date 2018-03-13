// Functions for changing options when application role is changed.
$(document).on('change', '#app_role_selection', function() {
    var role = $('#app_role_selection').val();
    if(role == 1) {
        $('.local_options').removeClass('show').addClass('hide');
        $('.remote_options').addClass('show').removeClass('hide');
    }
    else {
        $('.remote_options').removeClass('show').addClass('hide');
        $('.local_options').addClass('show').removeClass('hide');
    }
});

