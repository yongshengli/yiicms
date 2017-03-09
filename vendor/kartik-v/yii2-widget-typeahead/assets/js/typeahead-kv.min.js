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
 */var kvSubstringMatcher=function(){},kvInitTA=function(){};!function(n){"use strict";kvSubstringMatcher=function(e){return function(t,a){var i=[],c=new RegExp(t,"i");n.each(e,function(n,e){c.test(e)&&i.push(e)}),a(i)}},kvInitTA=function(e,t,a){n("#"+e).typeahead(t,a).on("typeahead:asyncrequest",function(){n(this).removeClass("loading").addClass("loading")}).on("typeahead:asynccancel typeahead:asyncreceive",function(){n(this).removeClass("loading")})}}(window.jQuery);