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