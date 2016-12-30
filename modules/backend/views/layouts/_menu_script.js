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
    }
});