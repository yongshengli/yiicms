$('#menu-keyword').autocomplete({
    source: function (request, response) {
        var result = [];
        var limit = 10;
        var term = request.term.toLowerCase();
        $.each(_menu_opts.menus, function () {
            var menu = this;
            if (term == '' || menu.label.toLowerCase().indexOf(term) >= 0 ||
                (menu.label && menu.label.toLowerCase().indexOf(term) >= 0)) {
                result.push(menu);
                limit--;
                if (limit <= 0) {
                    return false;
                }
            }
        });
        response(result);
    },
    focus: function (event, ui) {
        $('#menu-keyword').val(ui.item.label);
        return false;
    },
    select: function (event, ui) {
        $('#menu-keyword').val(ui.item.label);
        return false;
    },
    search: function (event, ui) {
        // console.log(ui);
        // $('#menu-keyword').val(ui.item.label);
    }
}).autocomplete("instance")._renderItem = function (ul, item) {
    console.log(item);
    return $("<li>")
        .append($('<a>').append($('<b>').text(item.label)).append('<br>')
        .append($('<i>').text(item.label)))
        .appendTo(ul);
};