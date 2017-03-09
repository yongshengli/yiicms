/*!
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2015
 * @version 1.0.1
 *
 * Krajee's extensions to the Typeahead library 
 * 
 * Author: Kartik Visweswaran
 * Copyright: 2014, Kartik Visweswaran, Krajee.com
 * For more JQuery plugins visit http://plugins.krajee.com
 * For more Yii related demos visit http://demos.krajee.com
 */
var kvSubstringMatcher = function () {
}, kvInitTA = function () {
};
(function ($) {
    "use strict";
    kvSubstringMatcher = function (strs) {
        return function findMatches(q, cb) {
            var matches = [], substrRegex = new RegExp(q, 'i');
            $.each(strs, function (i, str) {
                if (substrRegex.test(str)) {
                    matches.push(str);
                }
            });
            cb(matches);
        };
    };
    kvInitTA = function (id, opts, dataset) {
        $('#' + id).typeahead(opts, dataset).on('typeahead:asyncrequest', function () {
            $(this).removeClass('loading').addClass('loading');
        }).on('typeahead:asynccancel typeahead:asyncreceive', function () {
            $(this).removeClass('loading');
        });
    };
})(window.jQuery);