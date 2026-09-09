
var $loadingImage = $('#ajax-loader').val();
var $routeDashboard = $('#routeDashboard').val();
var $routeLogIn = $('#routeLogIn').val();
var $routeLogOut = $('#routeLogOut').val();
var $switchUserDefaultDealer = $('#switchUserDefaultDealer').val();

function getIntValue($value, $defaultValue = 0) {
    if (typeUnd($value)) {
        if (!Number.isNaN(parseInt($value))) {
            return parseInt($value);
        }
    }
    return $defaultValue;
}

function getDecimalValue($value, $defaultValue = 0, $decimalPoints = 2) {
    if (typeUnd($value)) {
        $value = ($value != null) ? $value.toString().replace(',', '') : $value;
        $value = Number($value);
        $spArr = $value.toString().split(".");
        if ($spArr.length > 0) {
            if (typeUnd($spArr[1])) {
                $decimalCount = $spArr[1].length;
                if (!Number.isNaN(parseInt($decimalCount)) && parseInt($decimalCount) < $decimalPoints) {
                    $decimalPoints = $decimalCount;
                }
            }
        }
        $value = parseFloat($value).toFixed($decimalPoints);
        if (!Number.isNaN(parseFloat($value))) {
            if (parseFloat($value) == parseInt($value)) {
                return Number(parseInt($value));
            } else {
                $addedVal = false;
                if (parseInt($value) == 0) {
                    $value = parseFloat($value) + 1;
                    $addedVal = true;
                }

                $power = (!Number.isNaN(parseFloat($decimalPoints))) ? Math.pow(10, parseFloat($decimalPoints)) : Math.pow(10, 2);
                $newVal = Math.ceil($value * $power) / $power;

                if ($addedVal) {
                    $newVal = parseFloat($newVal - 1).toFixed($decimalPoints);
                }

                return Number($newVal);
            }
        }
    }
    return $defaultValue;
}

function getCurrencyValue($value, $decimalPoints = 2) {
    // $currencyValue = getDecimalValue($value).toFixed($decimalPoints).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
    $currencyValue = getDecimalValue($value).toFixed($decimalPoints);
    return $currencyValue;
}

function getDecimalValueWithFixedDecimals($value, $decimalPoints = 2) {
    $newVal = getDecimalValue($value).toFixed($decimalPoints);
    return $newVal;
}

function getCurrentDateTime() {
    return moment().format("MM.DD.YYYY HH:mm:ss");
}

function getCurrentDate() {
    return moment().format("MM.DD.YYYY");
}

function getCurrentTime() {
    return moment().format("HH:mm:ss");
}

function formatDate($date, $format = "DD-MMM-YYYY") {
    if ($date == '0000-00-00' || moment($date).format('YYYY-MM-DD') == '1970-01-01') {
        $date = '';
    }
    return moment($date).format($format);
}

function formatTime($dateTime, $format = "hh:mm A") {
    if ($dateTime == '0000-00-00' || moment($dateTime).format('YYYY-MM-DD') == '1970-01-01') {
        $dateTime = '';
    }
    //return $res = formatDateTime($dateTime, false, "hh:mm A");
    return moment($dateTime, "HH:mm:ss").format($format);
}

function formatDateTime($date, $showTimeToo = true, $format = "") {
    if ($date) {
        if ($date == '0000-00-00' || moment($date).format('YYYY-MM-DD') == '1970-01-01') {
            $date = '';
        }
        if (!$format) {
            if ($showTimeToo) {
                $format = "DD-MMM-YYYY hh:mm A"
            } else {
                $format = "DD-MMM-YYYY"
            }
        }
        return moment($date).format($format);
    }
    return '';
}


function typeUnd($val) {
    if (typeof ($val) == 'undefined' || typeof $val == 'undefined') {
        return false;
    }
    return true;
}

function log(data) {
    if (true) {
        console.log(data);
    }
}

function redirectToDashboard() {
    window.location.href = $routeDashboard;
}
function redirectToLogin() {
    window.location.href = $routeLogIn;
}

function ReplaceNumberWithCommas($yourNumber) {
    if (typeUnd($yourNumber)) {
        //Seperates the components of the number
        var n = $yourNumber.toString().split(".");
        //Comma-fies the first part
        n[0] = n[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        //Combines the two sections
        return n.join(".");
    } else {
        return 0;
    }
}


function getNextArrayIndex($array, $default = 0) {
    if (!typeUnd($array)) {
        $array = [];
    }
    $keys = [];
    if (Object.keys($array).length > 0) {
        for (var $index of Object.keys($array)) {
            $keys.push(getIntValue($index));
        }
    }
    if ($keys.length > 0) {
        $max = Math.max.apply(null, $keys);
        return $max + 1;
    }
    return $default;
}

function currenciesOnly() {
    $('.currency_only').on('keypress', function (e) {
        var unicode = e.charCode ? e.charCode : e.keyCode
        if (unicode == 9) {
            return true;
        }
        if (unicode != 8 && unicode != 9) { //if the key isn't the backspace key or tab key (which we should allow)
            if (unicode < 46 || unicode > 57) { //if not a number
                return false //disable key press
            }
        }
        return true;
    })
}

// Add Autocomplete off to all elements
function disableAutocomplete($element = document) {
    $($element).find(':input').each(function () {
        if (!$(this).attr('autocomplete')) {
            $(this).attr('autocomplete', 'off');
        }
    });
}

// Add Padding left
function padLeft($str, $max) {
    $str = $str.toString();
    return $str.length < $max ? padLeft("0" + $str, $max) : $str;
}

// Tab key pressed
function isTabKeyPressed($e) {
    $keyCode = $e.keyCode || $e.which;
    if ($keyCode == 9) {
        return true;
    } else {
        return false;
    }
}

// Get Invert Color
function invertColor($hex, $bw) {
    if ($hex.indexOf('#') === 0) {
        $hex = $hex.slice(1);
    }
    // convert 3-digit hex to 6-digits.
    if ($hex.length === 3) {
        $hex = $hex[0] + $hex[0] + $hex[1] + $hex[1] + $hex[2] + $hex[2];
    }
    if ($hex.length !== 6) {
        throw new Error('Invalid HEX color.');
    }
    var $r = parseInt($hex.slice(0, 2), 16),
        $g = parseInt($hex.slice(2, 4), 16),
        $b = parseInt($hex.slice(4, 6), 16);
    if ($bw) {
        // https://stackoverflow.com/a/3943023/112731
        return ($r * 0.299 + $g * 0.587 + $b * 0.114) > 186
            ? '#000000'
            : '#FFFFFF';
    }
    // invert color components
    $r = (255 - $r).toString(16);
    $g = (255 - $g).toString(16);
    $b = (255 - $b).toString(16);
    // pad each with zeros and return
    return "#" + padZero($r) + padZero($g) + padZero($b);
}

function padZero($str, $len) {
    $len = $len || 2;
    var $zeros = new Array($len).join('0');
    return ($zeros + $str).slice(-$len);
}


function alertSuccess($message, $title = 'Success'){

    $alert = $('<div></div>').addClass('alert alert-success alert-dismissible alert-label-icon rounded-label shadow fade show mb-xl-0 mt-2').attr('role', 'alert')
        .append($('<i></i>').addClass('ri-check-double-line label-icon'))
        .append($('<strong></strong>').addClass('me-1').html($title))
        .append($('<span></span>').html($message))
        .append($('<button></button>').addClass('btn-close').attr('type', 'button').attr('data-bs-dismiss', 'alert').attr('aria-label', 'close'));

    return $alert;
}
function alertDanger($message, $title = 'Error'){

    $alert = $('<div></div>').addClass('alert alert-danger alert-dismissible alert-label-icon rounded-label shadow fade show mb-xl-0 mt-2').attr('role', 'alert')
        .append($('<i></i>').addClass('ri-error-warning-line label-icon'))
        .append($('<strong></strong>').addClass('me-1').html($title))
        .append($('<span></span>').html($message))
        .append($('<button></button>').addClass('btn-close').attr('type', 'button').attr('data-bs-dismiss', 'alert').attr('aria-label', 'close'));

    return $alert;
}

function alertDangerMultiple($errors, $element){

    if (Object.keys($errors).length > 0){
        $.each($errors, function ($title, $items){
            $el = $('<ul></ul>');
            $.each($items, function ($tIndex, $tItem){
                $('<li></li>').html($tItem).appendTo($el);
            });

            $alert = alertDanger($el, $title);
            $($element).append($alert);
        })
    }




    return $alert;
}

function alertProcessing($message = null, $title = 'Saving...'){

    if ($message == null || $message == ''){
        $message = '';
    }

    $alert = $('<div></div>').addClass('alert alert-info alert-dismissible alert-label-icon rounded-label shadow fade show mb-xl-0 mt-2').attr('role', 'alert')
        .append($('<span></span>').addClass('label-icon')
            .append($('<i></i>').addClass('ri-refresh-line icon-rotate-right'))
        )
        .append($('<strong></strong>').addClass('me-1').html($title))
        .append($('<span></span>').html($message))
        .append($('<button></button>').addClass('btn-close').attr('type', 'button').attr('data-bs-dismiss', 'alert').attr('aria-label', 'close'));

    return $alert;
}

function swalSuccess($header,$msg){
    Swal.fire($header, $msg, 'success');
}

function swalError($header,$msg){
    Swal.fire($header, $msg, 'error');
}

function swalWarning($header,$msg){
    Swal.fire($header, $msg, 'warning');
}

function swalInfo($header,$msg){
    Swal.fire($header, $msg, 'info');
}

function setDataLoaderSmall($el = '', $class = 'primary'){

    $loader = $('<div></div>').addClass('loader-small d-flex justify-content-center').append($('<div></div>').addClass('spinner-border text-' + $class).attr('role', 'status').append($('<span></span>').addClass('sr-only').text('Loading...')));

    if (typeUnd($el)){
        return $(document).find($el).append($loader);
    }else{
        return $laoder;
    }
}

function removeDataLoaderSmall($el = ''){
    $(document).find($el).html('');
}
