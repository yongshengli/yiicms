// $(document).on('pjax:send', function() {
//     $('#loading').show()
// });
$(document).on('pjax:complete', function(xhr, textStatus, error, options) {
    if(textStatus.status=='403'){
        alert(textStatus.responseText);
        return;
    }
});
// $(document).on('pjax:error', function(xhr, textStatus, error, options) {
//     $('#loading').hide();
// });