$('#menu-keyword').autocomplete({
    source: function (request, response) {
        var result = [];
        var limit = 10;
        var term = request.term.toLowerCase();
        $.each(_menu_opts.menus, function (index,menu) {
            if (term == '' || menu.label.toLowerCase().indexOf(term) >= 0 ||
                (menu.label && menu.label.toLowerCase().indexOf(term) >= 0)) {
                result.push({name:menu.label,"url":menu.url});
                limit--;
                if (limit <= 0) {
                    return false;
                }
            }
        });
        response(result);
    }
}).autocomplete("instance")._renderItem = function (ul, item) {
    return $("<li>")
        .append($('<a>').append($('<b>').text(item.name)))
        .appendTo(ul);
};