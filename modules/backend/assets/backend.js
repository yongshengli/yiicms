$(document).on('ajaxError', function(event, xhr, options, exc) {
    if (xhr.status === 403) {
        var msg = xhr.responseText || '您没有权限执行此操作';
        alert(msg);
    }
});