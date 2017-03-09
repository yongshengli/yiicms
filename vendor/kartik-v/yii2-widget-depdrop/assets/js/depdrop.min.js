/*!
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2016
 * @package yii2-widgets
 * @subpackage yii2-widget-depdrop
 * @version 1.0.3
 *
 * Extensions to dependent dropdown for Yii:
 * - Initializes dependent dropdown for Select2 widget
 * 
 * For more JQuery plugins visit http://plugins.krajee.com
 * For more Yii related demos visit http://demos.krajee.com
 */var initDepdropS2;!function(e){"use strict";initDepdropS2=function(n,o){var a=e("#"+n),i=e("#select2-"+n+"-container"),t="...";a.on("depdrop.beforeChange",function(){a.find("option").attr("value",t).html(o),a.val(t),a.select2("val",t),i.removeClass("kv-loading").addClass("kv-loading")}).on("depdrop.afterChange",function(){a.trigger("change"),i.removeClass("kv-loading")})}}(window.jQuery);