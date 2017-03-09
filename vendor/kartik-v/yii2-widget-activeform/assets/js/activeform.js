/*!
 * @package   yii2-widget-activeform
 * @author    Kartik Visweswaran <kartikv2@gmail.com>
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2015 - 2016
 * @version   1.4.8
 *
 * Active Field Hints Display Module
 *
 * Author: Kartik Visweswaran
 * Copyright: 2015, Kartik Visweswaran, Krajee.com
 * For more JQuery plugins visit http://plugins.krajee.com
 * For more Yii related demos visit http://demos.krajee.com
 */
(function ($) {
    "use strict";
    var isEmpty = function (value, trim) {
            return value === null || value === undefined || value === [] || value === '' || trim && $.trim(value) === '';
        },
        NAMESPACE = '.kvActiveField',
        ActiveFieldHint = function (element, options) {
            var self = this;
            self.$element = $(element);
            $.each(options, function (key, val) {
                self[key] = val;
            });
            self.init();
        };

    ActiveFieldHint.prototype = {
        constructor: ActiveFieldHint,
        init: function () {
            var self = this, $el = self.$element, $block = $el.find('.kv-hint-block'), content = $block.html(),
                $hints = $el.find('.kv-hintable'), $span;
            $block.hide();
            if (isEmpty(content)) {
                return;
            }
            if (!isEmpty(self.contentCssClass)) {
                $span = $(document.createElement('span')).addClass(self.contentCssClass).append(content);
                $span = $(document.createElement('span')).append($span);
                content = $span.html();
                $span.remove();
            }
            $hints.each(function () {
                var $src = $(this);
                if ($src.hasClass('kv-type-label')) {
                    $src.removeClass(self.labelCssClass).addClass(self.labelCssClass);
                } else {
                    $src.removeClass('hide ' + self.iconCssClass).addClass(self.iconCssClass);
                }
                if ($src.hasClass('kv-hint-click')) {
                    self.listen('click', $src, content);
                }
                if ($src.hasClass('kv-hint-hover')) {
                    self.listen('hover', $src, content);
                }
            });
            if (self.hideOnEscape) {
                $(document).on('keyup', function (e) {
                    $hints.each(function () {
                        var $src = $(this);
                        if (e.which === 27) {
                            $src.popover('hide');
                        }
                    });
                });
            }
            if (self.hideOnClickOut) {
                $('body').on('click', function (e) {
                    $hints.each(function () {
                        var $src = $(this);
                        if (!$src.is(e.target) && $src.has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                            $src.popover('hide');
                        }
                    });
                });
            }
        },
        listen: function (event, $src, content) {
            var self = this, opts = {
                html: true,
                trigger: 'manual',
                content: content,
                title: self.title,
                placement: self.placement,
                container: self.container || false,
                animation: !!self.animation,
                delay: self.delay,
                selector: self.selector
            };
            if (!isEmpty(self.template)) {
                opts.template = self.template;
            }
            if (!isEmpty(self.viewport)) {
                opts.viewport = self.viewport;
            }
            $src.popover(opts);
            if (event === 'click') {
                self.raise($src, 'click', function (e) {
                    e.preventDefault();
                    $src.popover('toggle');
                });
                return;
            }
            self.raise($src, 'mouseenter', function () {
                $src.popover('show');
            });
            self.raise($src, 'mouseleave', function () {
                $src.popover('hide');
            });
        },
        raise: function ($elem, event, callback) {
            event = event + NAMESPACE;
            $elem.off(event).on(event, callback);
        }
    };

    //ActiveFieldHint plugin definition
    $.fn.activeFieldHint = function (option) {
        var args = Array.apply(null, arguments);
        args.shift();
        return this.each(function () {
            var $this = $(this),
                data = $this.data('activeFieldHint'),
                options = typeof option === 'object' && option;

            if (!data) {
                $this.data('activeFieldHint',
                    (data = new ActiveFieldHint(this, $.extend({}, $.fn.activeFieldHint.defaults, options, $(this).data()))));
            }

            if (typeof option === 'string') {
                data[option].apply(data, args);
            }
        });
    };

    $.fn.activeFieldHint.defaults = {
        labelCssClass: 'kv-hint-label',
        iconCssClass: 'kv-hint-icon',
        contentCssClass: 'kv-hint-content',
        hideOnEscape: false,
        hideOnClickOut: false,
        title: '',
        placement: 'right',
        container: 'form',
        delay: 0,
        animation: true,
        selector: false,
        template: '',
        viewport: ''
    };
})(window.jQuery);