/*
* jquery-match-height 0.7.2 by @liabru
* http://brm.io/jquery-match-height/
* License MIT
*/
!function(t){"use strict";"function"==typeof define&&define.amd?define(["jquery"],t):"undefined"!=typeof module&&module.exports?module.exports=t(require("jquery")):t(jQuery)}(function(t){var e=-1,o=-1,n=function(t){return parseFloat(t)||0},a=function(e){var o=1,a=t(e),i=null,r=[];return a.each(function(){var e=t(this),a=e.offset().top-n(e.css("margin-top")),s=r.length>0?r[r.length-1]:null;null===s?r.push(e):Math.floor(Math.abs(i-a))<=o?r[r.length-1]=s.add(e):r.push(e),i=a}),r},i=function(e){var o={
byRow:!0,property:"height",target:null,remove:!1};return"object"==typeof e?t.extend(o,e):("boolean"==typeof e?o.byRow=e:"remove"===e&&(o.remove=!0),o)},r=t.fn.matchHeight=function(e){var o=i(e);if(o.remove){var n=this;return this.css(o.property,""),t.each(r._groups,function(t,e){e.elements=e.elements.not(n)}),this}return this.length<=1&&!o.target?this:(r._groups.push({elements:this,options:o}),r._apply(this,o),this)};r.version="0.7.2",r._groups=[],r._throttle=80,r._maintainScroll=!1,r._beforeUpdate=null,
r._afterUpdate=null,r._rows=a,r._parse=n,r._parseOptions=i,r._apply=function(e,o){var s=i(o),h=t(e),l=[h],c=t(window).scrollTop(),p=t("html").outerHeight(!0),u=h.parents().filter(":hidden");return u.each(function(){var e=t(this);e.data("style-cache",e.attr("style"))}),u.css("display","block"),s.byRow&&!s.target&&(h.each(function(){var e=t(this),o=e.css("display");"inline-block"!==o&&"flex"!==o&&"inline-flex"!==o&&(o="block"),e.data("style-cache",e.attr("style")),e.css({display:o,"padding-top":"0",
"padding-bottom":"0","margin-top":"0","margin-bottom":"0","border-top-width":"0","border-bottom-width":"0",height:"100px",overflow:"hidden"})}),l=a(h),h.each(function(){var e=t(this);e.attr("style",e.data("style-cache")||"")})),t.each(l,function(e,o){var a=t(o),i=0;if(s.target)i=s.target.outerHeight(!1);else{if(s.byRow&&a.length<=1)return void a.css(s.property,"");a.each(function(){var e=t(this),o=e.attr("style"),n=e.css("display");"inline-block"!==n&&"flex"!==n&&"inline-flex"!==n&&(n="block");var a={
display:n};a[s.property]="",e.css(a),e.outerHeight(!1)>i&&(i=e.outerHeight(!1)),o?e.attr("style",o):e.css("display","")})}a.each(function(){var e=t(this),o=0;s.target&&e.is(s.target)||("border-box"!==e.css("box-sizing")&&(o+=n(e.css("border-top-width"))+n(e.css("border-bottom-width")),o+=n(e.css("padding-top"))+n(e.css("padding-bottom"))),e.css(s.property,i-o+"px"))})}),u.each(function(){var e=t(this);e.attr("style",e.data("style-cache")||null)}),r._maintainScroll&&t(window).scrollTop(c/p*t("html").outerHeight(!0)),
this},r._applyDataApi=function(){var e={};t("[data-match-height], [data-mh]").each(function(){var o=t(this),n=o.attr("data-mh")||o.attr("data-match-height");n in e?e[n]=e[n].add(o):e[n]=o}),t.each(e,function(){this.matchHeight(!0)})};var s=function(e){r._beforeUpdate&&r._beforeUpdate(e,r._groups),t.each(r._groups,function(){r._apply(this.elements,this.options)}),r._afterUpdate&&r._afterUpdate(e,r._groups)};r._update=function(n,a){if(a&&"resize"===a.type){var i=t(window).width();if(i===e)return;e=i;
}n?o===-1&&(o=setTimeout(function(){s(a),o=-1},r._throttle)):s(a)},t(r._applyDataApi);var h=t.fn.on?"on":"bind";t(window)[h]("load",function(t){r._update(!1,t)}),t(window)[h]("resize orientationchange",function(t){r._update(!0,t)})});

/**
 * jQuery plugin paroller.js v1.0
 * https://github.com/tgomilar/paroller.js
 * preview: https://tgomilar.github.io/paroller/
 **/
!function($){"use strict";var r=$("[data-paroller-factor]"),t={bgVertical:function(r,t){return r.css({"background-position":"center "+-t+"px"})},bgHorizontal:function(r,t){return r.css({"background-position":-t+"px center"})},vertical:function(r,t){return r.css({"-webkit-transform":"translateY("+t+"px)","-moz-transform":"translateY("+t+"px)",transform:"translateY("+t+"px)"})},horizontal:function(r,t){return r.css({"-webkit-transform":"translateX("+t+"px)","-moz-transform":"translateX("+t+"px)",transform:"translateX("+t+"px)"})}};$.fn.paroller=function(o){var a=$(window).height(),n=$(document).height(),o=$.extend({factor:0,type:"background",direction:"vertical"},o);r.each(function(){var r=$(this),e=r.offset().top,i=r.outerHeight(),c=r.data("paroller-factor"),l=r.data("paroller-type"),s=r.data("paroller-direction"),u=c?c:o.factor,f=l?l:o.type,d=s?s:o.direction,p=Math.round(e*u),h=Math.round((e-a/2+i)*u);"background"==f?"vertical"==d?t.bgVertical(r,p):"horizontal"==d&&t.bgHorizontal(r,p):"foreground"==f&&("vertical"==d?t.vertical(r,h):"horizontal"==d&&t.horizontal(r,h)),$(window).on("scroll",function(){var o=$(this).scrollTop();p=Math.round((e-o)*u),h=Math.round((e-a/2+i-o)*u),"background"==f?"vertical"==d?t.bgVertical(r,p):"horizontal"==d&&t.bgHorizontal(r,p):"foreground"==f&&n>o&&("vertical"==d?t.vertical(r,h):"horizontal"==d&&t.horizontal(r,h))})})}}(jQuery);

/**
 * jquery.slimmenu.js
 * http://adnantopal.github.io/slimmenu/
 * Author: @adnantopal
 * Copyright 2013-2015, Adnan Topal (adnan.co)
 * Licensed under the MIT license.
 */
(function ($, window, document, undefined) {
    "use strict";

    var pluginName = 'slimmenu',
        oldWindowWidth = 0,
        defaults = {
            resizeWidth: '767',
            initiallyVisible: false,
            collapserTitle: 'Main Menu',
            animSpeed: 'medium',
            easingEffect: null,
            indentChildren: false,
            childrenIndenter: '&nbsp;&nbsp;',
            expandIcon: '<i>&#9660;</i>',
            collapseIcon: '<i>&#9650;</i>'
        };

    function Plugin(element, options) {
        this.element = element;
        this.$elem = $(this.element);
        this.options = $.extend(defaults, options);
        this.init();
    }

    Plugin.prototype = {

        init: function () {
            var $window = $(window),
                options = this.options,
                $menu = this.$elem,
                $collapser = '<div class="menu-collapser">' + options.collapserTitle + '<div class="collapse-button"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></div></div>',
                $menuCollapser;
                
            $menu.before($collapser);
            $menuCollapser = $menu.prev('.menu-collapser');

            $menu.on('click', '.sub-toggle', function (e) {
                e.preventDefault();
                e.stopPropagation();

                var $parentLi = $(this).closest('li');

                if ($(this).hasClass('expanded')) {
                    $(this).removeClass('expanded').html(options.expandIcon);
                    $parentLi.find('>ul').slideUp(options.animSpeed, options.easingEffect);
                } else {
                    $(this).addClass('expanded').html(options.collapseIcon);
                    $parentLi.find('>ul').slideDown(options.animSpeed, options.easingEffect);
                }
            });

            $menuCollapser.on('click', '.collapse-button', function (e) {
                e.preventDefault();
                $menu.slideToggle(options.animSpeed, options.easingEffect);
            });

            this.resizeMenu();
            $window.on('resize', this.resizeMenu.bind(this));
            $window.trigger('resize');
        },

        resizeMenu: function () {
            var self = this,
                $window = $(window),
                windowWidth = $window.width(),
                $options = this.options,
                $menu = $(this.element),
                $menuCollapser = $('body').find('.menu-collapser'),
                menuTimeouts = {};

            if (window['innerWidth'] !== undefined) {
                if (window['innerWidth'] > windowWidth) {
                    windowWidth = window['innerWidth'];
                }
            }

            if (windowWidth != oldWindowWidth) {
                oldWindowWidth = windowWidth;

                $menu.find('li').each(function () {
                    if ($(this).has('ul').length) {
                        if ($(this).addClass('has-submenu').has('.sub-toggle').length) {
                            $(this).children('.sub-toggle').html($options.expandIcon);
                        } else {
                            $(this).addClass('has-submenu').append('<span class="sub-toggle">' + $options.expandIcon + '</span>');
                        }
                    }

                    $(this).children('ul').removeClass('active').end().find('.sub-toggle').removeClass('expanded').html($options.expandIcon);
                });

                if ($options.resizeWidth >= windowWidth) {
                    if ($options.indentChildren) {
                        $menu.find('ul').each(function () {
                            var $depth = $(this).parents('ul').length;
                            if (!$(this).children('li').children('a').has('i').length) {
                                $(this).children('li').children('a').prepend(self.indent($depth, $options));
                            }
                        });
                    }

                    $menu.addClass('collapsed').find('li').has('ul').off('mouseenter mouseleave');
                    $menuCollapser.show();

                    if (!$options.initiallyVisible) {
                        $menu.hide();
                    }
                } else {
                    $menu.find('li').has('ul')
                        .on('mouseenter', function () {
							var thisSubmenu = $(this);
							var menuID = thisSubmenu.attr('id');
	                        clearTimeout(menuTimeouts[menuID]);
		                    thisSubmenu.find('>ul').stop().addClass('active');
                        })
                        .on('mouseleave', function () {
							var thisSubmenu = $(this);
							var menuID = thisSubmenu.attr('id');	                        
	                        menuTimeouts[menuID] = setTimeout( function(){
		                        thisSubmenu.find('>ul').stop().removeClass('active');
		                    }, 500 );
                        });

                    $menu.find('li > a > i').remove();
                    $menu.removeClass('collapsed').show();
                    $menuCollapser.hide();
                }
            }
        },

        indent: function (num, options) {
            var i = 0,
                $indent = '';
            for (; i < num; i++) {
                $indent += options.childrenIndenter;
            }
            return '<i>' + $indent + '</i> ';
        }
    };

    $.fn[pluginName] = function (options) {
        return this.each(function () {
            if (!$.data(this, 'plugin_' + pluginName)) {
                $.data(this, 'plugin_' + pluginName,
                    new Plugin(this, options));
            }
        });
    };

}(jQuery, window, document));

/**
 * ScrollReveal
 * ------------
 * Version : 3.3.4
 * Website : scrollrevealjs.org
 * Repo    : github.com/jlmakes/scrollreveal.js
 * Author  : Julian Lloyd (@jlmakes)
 */
if (!jQuery("body").hasClass("ie9")) {
!function(){"use strict";function e(n){return"undefined"==typeof this||Object.getPrototypeOf(this)!==e.prototype?new e(n):(O=this,O.version="3.3.4",O.tools=new E,O.isSupported()?(O.tools.extend(O.defaults,n||{}),O.defaults.container=t(O.defaults),O.store={elements:{},containers:[]},O.sequences={},O.history=[],O.uid=0,O.initialized=!1):"undefined"!=typeof console&&null!==console,O)}function t(e){if(e&&e.container){if("string"==typeof e.container)return window.document.documentElement.querySelector(e.container);if(O.tools.isNode(e.container))return e.container}return O.defaults.container}function n(e,t){return"string"==typeof e?Array.prototype.slice.call(t.querySelectorAll(e)):O.tools.isNode(e)?[e]:O.tools.isNodeList(e)?Array.prototype.slice.call(e):[]}function i(){return++O.uid}function o(e,t,n){t.container&&(t.container=n),e.config?e.config=O.tools.extendClone(e.config,t):e.config=O.tools.extendClone(O.defaults,t),"top"===e.config.origin||"bottom"===e.config.origin?e.config.axis="Y":e.config.axis="X"}function r(e){var t=window.getComputedStyle(e.domEl);e.styles||(e.styles={transition:{},transform:{},computed:{}},e.styles.inline=e.domEl.getAttribute("style")||"",e.styles.inline+="; visibility: visible; ",e.styles.computed.opacity=t.opacity,t.transition&&"all 0s ease 0s"!==t.transition?e.styles.computed.transition=t.transition+", ":e.styles.computed.transition=""),e.styles.transition.instant=s(e,0),e.styles.transition.delayed=s(e,e.config.delay),e.styles.transform.initial=" -webkit-transform:",e.styles.transform.target=" -webkit-transform:",a(e),e.styles.transform.initial+="transform:",e.styles.transform.target+="transform:",a(e)}function s(e,t){var n=e.config;return"-webkit-transition: "+e.styles.computed.transition+"-webkit-transform "+n.duration/1e3+"s "+n.easing+" "+t/1e3+"s, opacity "+n.duration/1e3+"s "+n.easing+" "+t/1e3+"s; transition: "+e.styles.computed.transition+"transform "+n.duration/1e3+"s "+n.easing+" "+t/1e3+"s, opacity "+n.duration/1e3+"s "+n.easing+" "+t/1e3+"s; "}function a(e){var t,n=e.config,i=e.styles.transform;t="top"===n.origin||"left"===n.origin?/^-/.test(n.distance)?n.distance.substr(1):"-"+n.distance:n.distance,parseInt(n.distance)&&(i.initial+=" translate"+n.axis+"("+t+")",i.target+=" translate"+n.axis+"(0)"),n.scale&&(i.initial+=" scale("+n.scale+")",i.target+=" scale(1)"),n.rotate.x&&(i.initial+=" rotateX("+n.rotate.x+"deg)",i.target+=" rotateX(0)"),n.rotate.y&&(i.initial+=" rotateY("+n.rotate.y+"deg)",i.target+=" rotateY(0)"),n.rotate.z&&(i.initial+=" rotateZ("+n.rotate.z+"deg)",i.target+=" rotateZ(0)"),i.initial+="; opacity: "+n.opacity+";",i.target+="; opacity: "+e.styles.computed.opacity+";"}function l(e){var t=e.config.container;t&&O.store.containers.indexOf(t)===-1&&O.store.containers.push(e.config.container),O.store.elements[e.id]=e}function c(e,t,n){var i={target:e,config:t,interval:n};O.history.push(i)}function f(){if(O.isSupported()){y();for(var e=0;e<O.store.containers.length;e++)O.store.containers[e].addEventListener("scroll",d),O.store.containers[e].addEventListener("resize",d);O.initialized||(window.addEventListener("scroll",d),window.addEventListener("resize",d),O.initialized=!0)}return O}function d(){T(y)}function u(){var e,t,n,i;O.tools.forOwn(O.sequences,function(o){i=O.sequences[o],e=!1;for(var r=0;r<i.elemIds.length;r++)n=i.elemIds[r],t=O.store.elements[n],q(t)&&!e&&(e=!0);i.active=e})}function y(){var e,t;u(),O.tools.forOwn(O.store.elements,function(n){t=O.store.elements[n],e=w(t),g(t)?(t.config.beforeReveal(t.domEl),e?t.domEl.setAttribute("style",t.styles.inline+t.styles.transform.target+t.styles.transition.delayed):t.domEl.setAttribute("style",t.styles.inline+t.styles.transform.target+t.styles.transition.instant),p("reveal",t,e),t.revealing=!0,t.seen=!0,t.sequence&&m(t,e)):v(t)&&(t.config.beforeReset(t.domEl),t.domEl.setAttribute("style",t.styles.inline+t.styles.transform.initial+t.styles.transition.instant),p("reset",t),t.revealing=!1)})}function m(e,t){var n=0,i=0,o=O.sequences[e.sequence.id];o.blocked=!0,t&&"onload"===e.config.useDelay&&(i=e.config.delay),e.sequence.timer&&(n=Math.abs(e.sequence.timer.started-new Date),window.clearTimeout(e.sequence.timer)),e.sequence.timer={started:new Date},e.sequence.timer.clock=window.setTimeout(function(){o.blocked=!1,e.sequence.timer=null,d()},Math.abs(o.interval)+i-n)}function p(e,t,n){var i=0,o=0,r="after";switch(e){case"reveal":o=t.config.duration,n&&(o+=t.config.delay),r+="Reveal";break;case"reset":o=t.config.duration,r+="Reset"}t.timer&&(i=Math.abs(t.timer.started-new Date),window.clearTimeout(t.timer.clock)),t.timer={started:new Date},t.timer.clock=window.setTimeout(function(){t.config[r](t.domEl),t.timer=null},o-i)}function g(e){if(e.sequence){var t=O.sequences[e.sequence.id];return t.active&&!t.blocked&&!e.revealing&&!e.disabled}return q(e)&&!e.revealing&&!e.disabled}function w(e){var t=e.config.useDelay;return"always"===t||"onload"===t&&!O.initialized||"once"===t&&!e.seen}function v(e){if(e.sequence){var t=O.sequences[e.sequence.id];return!t.active&&e.config.reset&&e.revealing&&!e.disabled}return!q(e)&&e.config.reset&&e.revealing&&!e.disabled}function b(e){return{width:e.clientWidth,height:e.clientHeight}}function h(e){if(e&&e!==window.document.documentElement){var t=x(e);return{x:e.scrollLeft+t.left,y:e.scrollTop+t.top}}return{x:window.pageXOffset,y:window.pageYOffset}}function x(e){var t=0,n=0,i=e.offsetHeight,o=e.offsetWidth;do isNaN(e.offsetTop)||(t+=e.offsetTop),isNaN(e.offsetLeft)||(n+=e.offsetLeft),e=e.offsetParent;while(e);return{top:t,left:n,height:i,width:o}}function q(e){function t(){var t=c+a*s,n=f+l*s,i=d-a*s,y=u-l*s,m=r.y+e.config.viewOffset.top,p=r.x+e.config.viewOffset.left,g=r.y-e.config.viewOffset.bottom+o.height,w=r.x-e.config.viewOffset.right+o.width;return t<g&&i>m&&n>p&&y<w}function n(){return"fixed"===window.getComputedStyle(e.domEl).position}var i=x(e.domEl),o=b(e.config.container),r=h(e.config.container),s=e.config.viewFactor,a=i.height,l=i.width,c=i.top,f=i.left,d=c+a,u=f+l;return t()||n()}function E(){}var O,T;e.prototype.defaults={origin:"bottom",distance:"20px",duration:500,delay:0,rotate:{x:0,y:0,z:0},opacity:0,scale:.9,easing:"cubic-bezier(0.6, 0.2, 0.1, 1)",container:window.document.documentElement,mobile:!0,reset:!1,useDelay:"always",viewFactor:.2,viewOffset:{top:0,right:0,bottom:0,left:0},beforeReveal:function(e){},beforeReset:function(e){},afterReveal:function(e){},afterReset:function(e){}},e.prototype.isSupported=function(){var e=document.documentElement.style;return"WebkitTransition"in e&&"WebkitTransform"in e||"transition"in e&&"transform"in e},e.prototype.reveal=function(e,s,a,d){var u,y,m,p,g,w;if(void 0!==s&&"number"==typeof s?(a=s,s={}):void 0!==s&&null!==s||(s={}),u=t(s),y=n(e,u),!y.length)return O;a&&"number"==typeof a&&(w=i(),g=O.sequences[w]={id:w,interval:a,elemIds:[],active:!1});for(var v=0;v<y.length;v++)p=y[v].getAttribute("data-sr-id"),p?m=O.store.elements[p]:(m={id:i(),domEl:y[v],seen:!1,revealing:!1},m.domEl.setAttribute("data-sr-id",m.id)),g&&(m.sequence={id:g.id,index:g.elemIds.length},g.elemIds.push(m.id)),o(m,s,u),r(m),l(m),O.tools.isMobile()&&!m.config.mobile||!O.isSupported()?(m.domEl.setAttribute("style",m.styles.inline),m.disabled=!0):m.revealing||m.domEl.setAttribute("style",m.styles.inline+m.styles.transform.initial);return!d&&O.isSupported()&&(c(e,s,a),O.initTimeout&&window.clearTimeout(O.initTimeout),O.initTimeout=window.setTimeout(f,0)),O},e.prototype.sync=function(){if(O.history.length&&O.isSupported()){for(var e=0;e<O.history.length;e++){var t=O.history[e];O.reveal(t.target,t.config,t.interval,!0)}f()}return O},E.prototype.isObject=function(e){return null!==e&&"object"==typeof e&&e.constructor===Object},E.prototype.isNode=function(e){return"object"==typeof window.Node?e instanceof window.Node:e&&"object"==typeof e&&"number"==typeof e.nodeType&&"string"==typeof e.nodeName},E.prototype.isNodeList=function(e){var t=Object.prototype.toString.call(e),n=/^\[object (HTMLCollection|NodeList|Object)\]$/;return"object"==typeof window.NodeList?e instanceof window.NodeList:e&&"object"==typeof e&&n.test(t)&&"number"==typeof e.length&&(0===e.length||this.isNode(e[0]))},E.prototype.forOwn=function(e,t){if(!this.isObject(e))throw new TypeError('Expected "object", but received "'+typeof e+'".');for(var n in e)e.hasOwnProperty(n)&&t(n)},E.prototype.extend=function(e,t){return this.forOwn(t,function(n){this.isObject(t[n])?(e[n]&&this.isObject(e[n])||(e[n]={}),this.extend(e[n],t[n])):e[n]=t[n]}.bind(this)),e},E.prototype.extendClone=function(e,t){return this.extend(this.extend({},e),t)},E.prototype.isMobile=function(){return/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)},T=window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame||function(e){window.setTimeout(e,1e3/60)},"function"==typeof define&&"object"==typeof define.amd&&define.amd?define(function(){return e}):"undefined"!=typeof module&&module.exports?module.exports=e:window.ScrollReveal=e}();
}

/**
* Float Labels
* floatlabels.min.js
* http://clubdesign.github.io/floatlabels.js/
* License: MIT
*/
(function(e,t,n,r){function o(t,n){this.$element=e(t);this.settings=e.extend({},s,n);this.init()}var i="floatlabel",s={slideInput:true,labelStartTop:"0px",labelEndTop:"0px",paddingOffset:"12px",transitionDuration:.1,transitionEasing:"ease-in-out",labelClass:"",typeMatches:/text|password|email|number|search|url|tel/};o.prototype={init:function(){var e=this,n=this.settings,r=n.transitionDuration,i=n.transitionEasing,s=this.$element;var o={"-webkit-transition":"all "+r+"s "+i,"-moz-transition":"all "+r+"s "+i,"-o-transition":"all "+r+"s "+i,"-ms-transition":"all "+r+"s "+i,transition:"all "+r+"s "+i};if(s.prop("tagName").toUpperCase()!=="INPUT"){return}if(!n.typeMatches.test(s.attr("type"))){return}var u=s.attr("id");if(!u){u=Math.floor(Math.random()*100)+1;s.attr("id",u)}var a=s.attr("placeholder");var f=s.data("label");var l=s.data("class");if(!l){l=""}if(!a||a===""){a="You forgot to add placeholder attribute!"}if(!f||f===""){f=a}this.inputPaddingTop=parseFloat(s.css("padding-top"))+parseFloat(n.paddingOffset);s.wrap('<div class="floatlabel-wrapper" style="position:relative"></div>');s.before('<label for="'+u+'" class="label-floatlabel '+n.labelClass+" "+l+'">'+f+"</label>");this.$label=s.prev("label");this.$label.css({position:"absolute",top:n.labelStartTop,left:"8px",display:"none","-moz-opacity":"0","-khtml-opacity":"0","-webkit-opacity":"0",opacity:"0","font-size":"11px","font-weight":"bold",color:"#838780"});if(!n.slideInput){s.css({"padding-top":this.inputPaddingTop})}s.on("keyup blur change",function(t){e.checkValue(t)});s.on("blur",function(){s.prev("label").css({color:"#838780"})});s.on("focus",function(){s.prev("label").css({color:"#2996cc"})});t.setTimeout(function(){e.$label.css(o);e.$element.css(o)},100);this.checkValue()},checkValue:function(e){if(e){var t=e.keyCode||e.which;if(t===9){return}}var n=this.$element,r=n.data("flout");if(n.val()!==""){n.data("flout","1")}if(n.val()===""){n.data("flout","0")}if(n.data("flout")==="1"&&r!=="1"){this.showLabel()}if(n.data("flout")==="0"&&r!=="0"){this.hideLabel()}},showLabel:function(){var e=this;e.$label.css({display:"block"});t.setTimeout(function(){e.$label.css({top:e.settings.labelEndTop,"-moz-opacity":"1","-khtml-opacity":"1","-webkit-opacity":"1",opacity:"1"});if(e.settings.slideInput){e.$element.css({"padding-top":e.inputPaddingTop})}e.$element.addClass("active-floatlabel")},50)},hideLabel:function(){var e=this;e.$label.css({top:e.settings.labelStartTop,"-moz-opacity":"0","-khtml-opacity":"0","-webkit-opacity":"0",opacity:"0"});if(e.settings.slideInput){e.$element.css({"padding-top":parseFloat(e.inputPaddingTop)-parseFloat(this.settings.paddingOffset)})}e.$element.removeClass("active-floatlabel");t.setTimeout(function(){e.$label.css({display:"none"})},e.settings.transitionDuration*1e3)}};e.fn[i]=function(t){return this.each(function(){if(!e.data(this,"plugin_"+i)){e.data(this,"plugin_"+i,new o(this,t))}})}})(jQuery,window,document);


/*!
 * Easy Responsive Tabs Plugin
 * http://webthemez.com/demo/easy-responsive-tabs/Index.html
 */
(function($){$.fn.extend({easyResponsiveTabs:function(options){var defaults={type:'default',width:'auto',fit:true,closed:false,tabidentify:'tab_identifier_child',activetab_bg:'white',inactive_bg:'#F5F5F5',active_border_color:'#c1c1c1',active_content_border_color:'#c1c1c1',activate:function(){}}
var options=$.extend(defaults,options);var opt=options,jtype=opt.type,jfit=opt.fit,jwidth=opt.width,vtabs='vertical',accord='accordion';var hash=window.location.hash;var historyApi=!!(window.history&&history.replaceState);$(this).bind('tabactivate',function(e,currentTab){if(typeof options.activate==='function'){options.activate.call(currentTab,e)}});this.each(function(){var $respTabs=$(this);var $respTabsList=$respTabs.find('ul.resp-tabs-list.'+options.tabidentify);var respTabsId=$respTabs.attr('id');$respTabs.find('ul.resp-tabs-list.'+options.tabidentify+' li').addClass('resp-tab-item').addClass(options.tabidentify);$respTabs.css({'display':'block','width':jwidth});if(options.type=='vertical')
$respTabsList.css('margin-top','3px');$respTabs.find('.resp-tabs-container.'+options.tabidentify).css('border-color',options.active_content_border_color);$respTabs.find('.resp-tabs-container.'+options.tabidentify+' > div').addClass('resp-tab-content').addClass(options.tabidentify);jtab_options();function jtab_options(){if(jtype==vtabs){$respTabs.addClass('resp-vtabs').addClass(options.tabidentify);}
if(jfit==true){$respTabs.css({width:'100%',margin:'0px'});}
if(jtype==accord){$respTabs.addClass('resp-easy-accordion').addClass(options.tabidentify);$respTabs.find('.resp-tabs-list').css('display','none');}}
var $tabItemh2;$respTabs.find('.resp-tab-content.'+options.tabidentify).before("<h2 class='resp-accordion "+options.tabidentify+"' role='tab'><span class='resp-arrow'></span></h2>");$respTabs.find('.resp-tab-content.'+options.tabidentify).prev("h2").css({'background-color':options.inactive_bg,'border-color':options.active_border_color});var itemCount=0;$respTabs.find('.resp-accordion').each(function(){$tabItemh2=$(this);var $tabItem=$respTabs.find('.resp-tab-item:eq('+itemCount+')');var $accItem=$respTabs.find('.resp-accordion:eq('+itemCount+')');$accItem.append($tabItem.html());$accItem.data($tabItem.data());$tabItemh2.attr('aria-controls',options.tabidentify+'_tab_item-'+(itemCount));itemCount++;});var count=0,$tabContent;$respTabs.find('.resp-tab-item').each(function(){$tabItem=$(this);$tabItem.attr('aria-controls',options.tabidentify+'_tab_item-'+(count));$tabItem.attr('role','tab');$tabItem.css({'background-color':options.inactive_bg,'border-color':'none'});var tabcount=0;$respTabs.find('.resp-tab-content.'+options.tabidentify).each(function(){$tabContent=$(this);$tabContent.attr('aria-labelledby',options.tabidentify+'_tab_item-'+(tabcount)).css({'border-color':options.active_border_color});tabcount++;});count++;});var tabNum=0;if(hash!=''){var matches=hash.match(new RegExp(respTabsId+"([0-9]+)"));if(matches!==null&&matches.length===2){tabNum=parseInt(matches[1],10)-1;if(tabNum>count){tabNum=0;}}}
$($respTabs.find('.resp-tab-item.'+options.tabidentify)[tabNum]).addClass('resp-tab-active').css({'background-color':options.activetab_bg,'border-color':options.active_border_color});if(options.closed!==true&&!(options.closed==='accordion'&&!$respTabsList.is(':visible'))&&!(options.closed==='tabs'&&$respTabsList.is(':visible'))){$($respTabs.find('.resp-accordion.'+options.tabidentify)[tabNum]).addClass('resp-tab-active').css({'background-color':options.activetab_bg+' !important','border-color':options.active_border_color,'background':'none'});$($respTabs.find('.resp-tab-content.'+options.tabidentify)[tabNum]).addClass('resp-tab-content-active').addClass(options.tabidentify).attr('style','display:block');}
else{}
$respTabs.find("[role=tab]").each(function(){var $currentTab=$(this);$currentTab.click(function(){setTimeout( function() { $(window).trigger('resize').trigger('scroll'); }, 50);var $currentTab=$(this);var $tabAria=$currentTab.attr('aria-controls');if($currentTab.hasClass('resp-accordion')&&$currentTab.hasClass('resp-tab-active')){$respTabs.find('.resp-tab-content-active.'+options.tabidentify).slideUp('',function(){$(this).addClass('resp-accordion-closed');});$currentTab.removeClass('resp-tab-active').css({'background-color':options.inactive_bg,'border-color':'none'});return false;}
if(!$currentTab.hasClass('resp-tab-active')&&$currentTab.hasClass('resp-accordion')){$respTabs.find('.resp-tab-active.'+options.tabidentify).removeClass('resp-tab-active').css({'background-color':options.inactive_bg,'border-color':'none'});$respTabs.find('.resp-tab-content-active.'+options.tabidentify).slideUp().removeClass('resp-tab-content-active resp-accordion-closed');$respTabs.find("[aria-controls="+$tabAria+"]").addClass('resp-tab-active').css({'background-color':options.activetab_bg,'border-color':options.active_border_color});$respTabs.find('.resp-tab-content[aria-labelledby = '+$tabAria+'].'+options.tabidentify).slideDown().addClass('resp-tab-content-active');}else{console.log('here');$respTabs.find('.resp-tab-active.'+options.tabidentify).removeClass('resp-tab-active').css({'background-color':options.inactive_bg,'border-color':'none'});$respTabs.find('.resp-tab-content-active.'+options.tabidentify).removeAttr('style').removeClass('resp-tab-content-active').removeClass('resp-accordion-closed');$respTabs.find("[aria-controls="+$tabAria+"]").addClass('resp-tab-active').css({'background-color':options.activetab_bg,'border-color':options.active_border_color});$respTabs.find('.resp-tab-content[aria-labelledby = '+$tabAria+'].'+options.tabidentify).addClass('resp-tab-content-active').attr('style','display:block');}
$currentTab.trigger('tabactivate',$currentTab);if(historyApi){var currentHash=window.location.hash;var tabAriaParts=$tabAria.split('tab_item-');var newHash=respTabsId+(parseInt(tabAriaParts[1],10)+1).toString();if(currentHash!=""){var re=new RegExp(respTabsId+"[0-9]+");if(currentHash.match(re)!=null){newHash=currentHash.replace(re,newHash);}
else{newHash=currentHash+"|"+newHash;}}
else{newHash='#'+newHash;}
history.replaceState(null,null,newHash);}});});$(window).resize(function(){$respTabs.find('.resp-accordion-closed').removeAttr('style');});});}});})(jQuery);

/*!
 * animsition v4.0.2
 * A simple and easy jQuery plugin for CSS animated page transitions.
 * http://blivesta.github.io/animsition
 * License : MIT
 * Author : blivesta (http://blivesta.com/)
 */
!function(t){"use strict";"function"==typeof define&&define.amd?define(["jquery"],t):"object"==typeof exports?module.exports=t(require("jquery")):t(jQuery)}(function(t){"use strict";var n="animsition",i={init:function(a){a=t.extend({inClass:"fade-in",outClass:"fade-out",inDuration:1500,outDuration:800,linkElement:".animsition-link",loading:!0,loadingParentElement:"body",loadingClass:"animsition-loading",loadingInner:"",timeout:!1,timeoutCountdown:5e3,onLoadEvent:!0,browser:["animation-duration","-webkit-animation-duration"],overlay:!1,overlayClass:"animsition-overlay-slide",overlayParentElement:"body",transition:function(t){window.location.href=t}},a),i.settings={timer:!1,data:{inClass:"animsition-in-class",inDuration:"animsition-in-duration",outClass:"animsition-out-class",outDuration:"animsition-out-duration",overlay:"animsition-overlay"},events:{inStart:"animsition.inStart",inEnd:"animsition.inEnd",outStart:"animsition.outStart",outEnd:"animsition.outEnd"}};var o=i.supportCheck.call(this,a);if(!o&&a.browser.length>0&&(!o||!this.length))return"console"in window||(window.console={},window.console.log=function(t){return t}),this.length||console.log("Animsition: Element does not exist on page."),o||console.log("Animsition: Does not support this browser."),i.destroy.call(this);var e=i.optionCheck.call(this,a);return e&&t("."+a.overlayClass).length<=0&&i.addOverlay.call(this,a),a.loading&&t("."+a.loadingClass).length<=0&&i.addLoading.call(this,a),this.each(function(){var o=this,e=t(this),s=t(window),r=t(document),l=e.data(n);l||(a=t.extend({},a),e.data(n,{options:a}),a.timeout&&i.addTimer.call(o),a.onLoadEvent&&s.on("load."+n,function(){i.settings.timer&&clearTimeout(i.settings.timer),i["in"].call(o)}),s.on("pageshow."+n,function(t){t.originalEvent.persisted&&i["in"].call(o)}),s.on("unload."+n,function(){}),r.on("click."+n,a.linkElement,function(n){n.preventDefault();var a=t(this),e=a.attr("href");2===n.which||n.metaKey||n.shiftKey||-1!==navigator.platform.toUpperCase().indexOf("WIN")&&n.ctrlKey?window.open(e,"_blank"):i.out.call(o,a,e)}))})},addOverlay:function(n){t(n.overlayParentElement).prepend('<div class="'+n.overlayClass+'"></div>')},addLoading:function(n){t(n.loadingParentElement).append('<div class="'+n.loadingClass+'">'+n.loadingInner+"</div>")},removeLoading:function(){var i=t(this),a=i.data(n).options,o=t(a.loadingParentElement).children("."+a.loadingClass);o.fadeOut().remove()},addTimer:function(){var a=this,o=t(this),e=o.data(n).options;i.settings.timer=setTimeout(function(){i["in"].call(a),t(window).off("load."+n)},e.timeoutCountdown)},supportCheck:function(n){var i=t(this),a=n.browser,o=a.length,e=!1;0===o&&(e=!0);for(var s=0;o>s;s++)if("string"==typeof i.css(a[s])){e=!0;break}return e},optionCheck:function(n){var a,o=t(this);return a=n.overlay||o.data(i.settings.data.overlay)?!0:!1},animationCheck:function(i,a,o){var e=t(this),s=e.data(n).options,r=typeof i,l=!a&&"number"===r,d=a&&"string"===r&&i.length>0;return l||d?i=i:a&&o?i=s.inClass:!a&&o?i=s.inDuration:a&&!o?i=s.outClass:a||o||(i=s.outDuration),i},"in":function(){var a=this,o=t(this),e=o.data(n).options,s=o.data(i.settings.data.inDuration),r=o.data(i.settings.data.inClass),l=i.animationCheck.call(a,s,!1,!0),d=i.animationCheck.call(a,r,!0,!0),u=i.optionCheck.call(a,e),c=o.data(n).outClass;e.loading&&i.removeLoading.call(a),c&&o.removeClass(c),u?i.inOverlay.call(a,d,l):i.inDefault.call(a,d,l)},inDefault:function(n,a){var o=t(this);o.css({"animation-duration":a+"ms"}).addClass(n).trigger(i.settings.events.inStart).animateCallback(function(){o.removeClass(n).css({opacity:1}).trigger(i.settings.events.inEnd)})},inOverlay:function(a,o){var e=t(this),s=e.data(n).options;e.css({opacity:1}).trigger(i.settings.events.inStart),t(s.overlayParentElement).children("."+s.overlayClass).css({"animation-duration":o+"ms"}).addClass(a).animateCallback(function(){e.trigger(i.settings.events.inEnd)})},out:function(a,o){var e=this,s=t(this),r=s.data(n).options,l=a.data(i.settings.data.outClass),d=s.data(i.settings.data.outClass),u=a.data(i.settings.data.outDuration),c=s.data(i.settings.data.outDuration),m=l?l:d,g=u?u:c,f=i.animationCheck.call(e,m,!0,!1),v=i.animationCheck.call(e,g,!1,!1),h=i.optionCheck.call(e,r);s.data(n).outClass=f,h?i.outOverlay.call(e,f,v,o):i.outDefault.call(e,f,v,o)},outDefault:function(a,o,e){var s=t(this),r=s.data(n).options;s.css({"animation-duration":o+1+"ms"}).addClass(a).trigger(i.settings.events.outStart).animateCallback(function(){s.trigger(i.settings.events.outEnd),r.transition(e)})},outOverlay:function(a,o,e){var s=this,r=t(this),l=r.data(n).options,d=r.data(i.settings.data.inClass),u=i.animationCheck.call(s,d,!0,!0);t(l.overlayParentElement).children("."+l.overlayClass).css({"animation-duration":o+1+"ms"}).removeClass(u).addClass(a).trigger(i.settings.events.outStart).animateCallback(function(){r.trigger(i.settings.events.outEnd),l.transition(e)})},destroy:function(){return this.each(function(){var i=t(this);t(window).off("."+n),i.css({opacity:1}).removeData(n)})}};t.fn.animateCallback=function(n){var i="animationend webkitAnimationEnd";return this.each(function(){var a=t(this);a.on(i,function(){return a.off(i),n.call(this)})})},t.fn.animsition=function(a){return i[a]?i[a].apply(this,Array.prototype.slice.call(arguments,1)):"object"!=typeof a&&a?void t.error("Method "+a+" does not exist on jQuery."+n):i.init.apply(this,arguments)}});

/*! device.js 0.2.7 */
/* https://github.com/matthewhudson/device.js */
(function(){var a,b,c,d,e,f,g,h,i,j;b=window.device,a={},window.device=a,d=window.document.documentElement,j=window.navigator.userAgent.toLowerCase(),a.ios=function(){return a.iphone()||a.ipod()||a.ipad()},a.iphone=function(){return!a.windows()&&e("iphone")},a.ipod=function(){return e("ipod")},a.ipad=function(){return e("ipad")},a.android=function(){return!a.windows()&&e("android")},a.androidPhone=function(){return a.android()&&e("mobile")},a.androidTablet=function(){return a.android()&&!e("mobile")},a.blackberry=function(){return e("blackberry")||e("bb10")||e("rim")},a.blackberryPhone=function(){return a.blackberry()&&!e("tablet")},a.blackberryTablet=function(){return a.blackberry()&&e("tablet")},a.windows=function(){return e("windows")},a.windowsPhone=function(){return a.windows()&&e("phone")},a.windowsTablet=function(){return a.windows()&&e("touch")&&!a.windowsPhone()},a.fxos=function(){return(e("(mobile;")||e("(tablet;"))&&e("; rv:")},a.fxosPhone=function(){return a.fxos()&&e("mobile")},a.fxosTablet=function(){return a.fxos()&&e("tablet")},a.meego=function(){return e("meego")},a.cordova=function(){return window.cordova&&"file:"===location.protocol},a.nodeWebkit=function(){return"object"==typeof window.process},a.mobile=function(){return a.androidPhone()||a.iphone()||a.ipod()||a.windowsPhone()||a.blackberryPhone()||a.fxosPhone()||a.meego()},a.tablet=function(){return a.ipad()||a.androidTablet()||a.blackberryTablet()||a.windowsTablet()||a.fxosTablet()},a.desktop=function(){return!a.tablet()&&!a.mobile()},a.television=function(){var a;for(television=["googletv","viera","smarttv","internet.tv","netcast","nettv","appletv","boxee","kylo","roku","dlnadoc","roku","pov_tv","hbbtv","ce-html"],a=0;a<television.length;){if(e(television[a]))return!0;a++}return!1},a.portrait=function(){return window.innerHeight/window.innerWidth>1},a.landscape=function(){return window.innerHeight/window.innerWidth<1},a.noConflict=function(){return window.device=b,this},e=function(a){return-1!==j.indexOf(a)},g=function(a){var b;return b=new RegExp(a,"i"),d.className.match(b)},c=function(a){var b=null;g(a)||(b=d.className.replace(/^\s+|\s+$/g,""),d.className=b+" "+a)},i=function(a){g(a)&&(d.className=d.className.replace(" "+a,""))},a.ios()?a.ipad()?c("ios ipad tablet"):a.iphone()?c("ios iphone mobile"):a.ipod()&&c("ios ipod mobile"):a.android()?c(a.androidTablet()?"android tablet":"android mobile"):a.blackberry()?c(a.blackberryTablet()?"blackberry tablet":"blackberry mobile"):a.windows()?c(a.windowsTablet()?"windows tablet":a.windowsPhone()?"windows mobile":"desktop"):a.fxos()?c(a.fxosTablet()?"fxos tablet":"fxos mobile"):a.meego()?c("meego mobile"):a.nodeWebkit()?c("node-webkit"):a.television()?c("television"):a.desktop()&&c("desktop"),a.cordova()&&c("cordova"),f=function(){a.landscape()?(i("portrait"),c("landscape")):(i("landscape"),c("portrait"))},h=Object.prototype.hasOwnProperty.call(window,"onorientationchange")?"orientationchange":"resize",window.addEventListener?window.addEventListener(h,f,!1):window.attachEvent?window.attachEvent(h,f):window[h]=f,f(),"function"==typeof define&&"object"==typeof define.amd&&define.amd?define(function(){return a}):"undefined"!=typeof module&&module.exports?module.exports=a:window.device=a}).call(this);

/**
 * Back To Top - CodyHouse
 * http://codyhouse.co/gem/back-to-top/
 */
jQuery(document).ready(function($){var offset=300,offset_opacity=1200,scroll_top_duration=700,$back_to_top=jQuery('.cd-top');jQuery(window).scroll(function(){(jQuery(this).scrollTop()>offset)?$back_to_top.addClass('cd-is-visible'):$back_to_top.removeClass('cd-is-visible cd-fade-out');if(jQuery(this).scrollTop()>offset_opacity){$back_to_top.addClass('cd-fade-out')}});$back_to_top.on('click',function(event){event.preventDefault();jQuery('body,html').animate({scrollTop:0,},scroll_top_duration)})});


/**
* Initialize jQuery Plugins
**/
jQuery( document ).ready(function() {
	jQuery('.gfield input').each(function() {
		if (jQuery(this).attr( "placeholder" ) != undefined) {
			jQuery(this).floatlabel();
		}
	});
	// jQuery('.match-header').matchHeight();
	if (!jQuery( "body" ).hasClass( "no-sr" ) && !jQuery("body").hasClass("ie9")) {
		window.sr = ScrollReveal().reveal('.sr', { viewFactor: 0.05 });
	}
	jQuery('ul.slimmenu').slimmenu( {
	    resizeWidth: '640',
	    collapserTitle: '',
	    animSpeed: 'medium',
	    easingEffect: null,
	    indentChildren: false,
	    childrenIndenter: '&nbsp;',
	    expandIcon: '<svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1683 808l-742 741q-19 19-45 19t-45-19l-742-741q-19-19-19-45.5t19-45.5l166-165q19-19 45-19t45 19l531 531 531-531q19-19 45-19t45 19l166 165q19 19 19 45.5t-19 45.5z"/></svg>',
	    collapseIcon: '<svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1683 1331l-166 165q-19 19-45 19t-45-19l-531-531-531 531q-19 19-45 19t-45-19l-166-165q-19-19-19-45.5t19-45.5l742-741q19-19 45-19t45 19l742 741q19 19 19 45.5t-19 45.5z"/></svg>',
	});

	if (jQuery(".animsition")[0]){
		jQuery(".animsition").animsition({
			inClass: 'fade-in',
			outClass: 'fade-out',
			inDuration: 500,
			outDuration: 500,
			linkElement: '.menu-item a:not([href^="#"])',
			// e.g. linkElement: 'a:not([target="_blank"]):not([href^="#"])'
			loading: true,
			loadingParentElement: 'body', //animsition wrapper element
			loadingClass: 'loading-bg',
			// Other Options for loaders:
			// http://tobiasahlin.com/spinkit/
			// http://github.danielcardoso.net/load-awesome/animations.html
			// https://connoratherton.com/loaders
			// https://codepen.io/patrikhjelm/details/hItqn
			loadingInner: '<div class="loading-inner"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1714.8 680.63"><defs><style>.eurokera-logo-1{fill:#fff;}.eurokera-logo-2{fill:#f89728;}.eurokera-logo-3{fill:#fff;}</style></defs><title>eurokera-logo</title><g id="Layer_2" data-name="Layer 2"><g id="Calque_1" data-name="Calque 1"><rect class="eurokera-logo-3" x="1132.99" y="5.13" width="581.82" height="675.5"/><polygon class="eurokera-logo-2" points="1054.88 351.6 0 351.6 0.11 334.15 1054.88 334.15 1054.88 351.6 1054.88 351.6"/><polygon class="eurokera-logo-2" points="1318.4 5.13 1318.4 497.63 1209.45 497.63 1209.45 497.14 1209.45 5.13 1132.99 5.13 1132.99 680.63 1714.8 680.63 1714.8 5.13 1318.4 5.13"/><polygon class="eurokera-logo-2" points="1622.22 667.68 1343.02 340.49 1606.42 136.68 1634.4 170.33 1452.62 313.57 1701.03 610.99 1622.22 667.68"/><polygon class="eurokera-logo-3" points="1634.4 170.33 1606.42 136.68 1343.02 340.49 1622.22 667.68 1701.03 610.99 1452.62 313.57 1634.4 170.33"/><path class="eurokera-logo-1" d="M187.55,301.38H0V5.13H168.79V44.86H63v80.86H166.56v40.63H63v95.24H187.55Z"/><path class="eurokera-logo-1" d="M467.73,167.62c0,42-1.87,63.3-18.75,89.3-21.74,33-56.93,49.53-108.12,49.53-52.1,0-89.83-16.5-110.66-49.53-15.36-24.43-16.07-53-16.07-89.3V5.13h63V162.54c0,19.19-.63,42.06,6.39,62.9,10.4,30.81,35.44,39.12,59.47,39.12q46.28,0,61.86-39c4.75-11.85,7.12-32.14,7.12-63.18V5.13h55.81Z"/><path class="eurokera-logo-1" d="M750.18,300.9H679L617.38,181.17H580V301.38H517V5.13h91.53c34.93,0,63.62,2.22,84.39,16.45q31.69,22,31.7,63.5,0,53.75-54.48,83.8ZM661.67,89.31c0-36-21-46.14-57.85-46.14H580V144.33h18.55C643.82,144.33,661.67,122.87,661.67,89.31Z"/><path class="eurokera-logo-1" d="M1055.15,150.27q0,66.89-41.72,110.91-42.61,45.3-111.53,45.29-68.39,0-111.46-44.87Q748.71,218,748.71,151.12q0-66.46,43.93-108.8T905,0q64.1,0,107.14,43T1055.15,150.27Zm-66.31,3.81q0-52.89-23.49-82.54T900.59,41.9q-43,0-66.23,36.42-19.77,30.91-19.76,74.9,0,45.32,19.76,75.36,23.7,36,67.55,36,39.94,0,63.45-29.86T988.84,154.07Z"/><path class="eurokera-logo-1" d="M750.18,680.63H679L617.38,560.56H580V680.63H517V384.48h91.53c34.93,0,63.62,2.27,84.39,16.5q31.69,22,31.7,63.5,0,53.75-54.48,83.81ZM661.67,468.71c0-36-21-46.14-57.85-46.14H580V523.73h18.55C643.82,523.73,661.67,502.27,661.67,468.71Z"/><path class="eurokera-logo-1" d="M269.15,680.63H191L63,530.92V680.63H0V384.48H63V513.16L173.68,384.1h64L120.13,517Z"/><path class="eurokera-logo-1" d="M476.19,680.63H288.66V384.48H457.43v39.78H351.62v80.85H455.2v40.63H351.62V641H476.19Z"/><path class="eurokera-logo-1" d="M1054.32,680.63H986.9l-29-80.7H845.46l-32.59,80.7H761.07L888.7,384.48h48.19ZM945.37,563.94,904.3,449.66,858.84,563.94Z"/></g></g></svg><div class="load-awesome la-timer"><div></div></div></div>',
			timeout: false,
			timeoutCountdown: 5000,
			onLoadEvent: true,
			browser: [ 'animation-duration', '-webkit-animation-duration'],
			// "browser" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser.
			// The default setting is to disable the "animsition" in a browser that does not support "animation-duration".
			overlay : false,
			overlayClass : 'animsition-overlay-slide',
			overlayParentElement : 'body',
			transition: function(url){ window.location.href = url; }
		});
	}
	jQuery(window).paroller();	
});