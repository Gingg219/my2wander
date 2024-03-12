function showToastSuccess(data) {
    $('#titleSuccess').text(data.title);
    $('#contentSuccess').text(data.message);
    $('#toastSuccess').toast('show');
}
    
function showToastFail(data) {
    $('#titleFail').text(data.title);
    $('#contentFail').text(data.message);
    $('#toastFail').toast('show');
}

function printErrorMsg(msg) {
    $(".print-error-msg").html('');
    $(".print-error-msg").css('display', 'block');
    $.each(msg, function(key, value) {
        $("#" + key).text(value[0]);
    });
}

document.getElementById('logoutLink').addEventListener('click', function(event) {
    event.preventDefault(); 
    document.getElementById('logoutForm').submit();
});