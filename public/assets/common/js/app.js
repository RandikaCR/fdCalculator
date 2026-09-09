
function csrf_token() {
    return $('#_csrf_token').val();
}

function userId() {
    return $('#_user_id').val();
}
function authToken() {
    return $('#_auth_token').val();
}
function userEmail() {
    return $('#_auth_email').val();
}
function userFirstName() {
    return $('#_auth_first_name').val();
}
function userLastName() {
    return $('#_auth_last_name').val();
}
function userFullName() {
    return $('#_auth_full_name').val();
}
function dealerId() {
    return $('#_auth_switched_dealer_id').val();
}
function motordatId() {
    return $('#_auth_switched_dealer_motordat_id').val();
}
function commonAssetsPath() {
    return $('#common_assets_path').val();
}

function allowedNumberOnly($class = '.number-only') {
    $(document).on('keypress change', $class, function ($event) {
        if (( $event.which != 46 || $(this).val().indexOf('.') != -1) && ( $event.which != 45 || $(this).val().indexOf('-') != -1) && ($event.which < 48 || $event.which > 57)) {
            $event.preventDefault();
        }
    });
    $(document).on('paste', $class, function ($event) {
        if ($event.originalEvent.clipboardData.getData('Text').match(/[^\d]/)) {
            $event.preventDefault();
        }
    });
}

