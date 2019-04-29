// Make Holmes work in IE 11
if (typeof Object.assign != 'function') {
  Object.assign = function (target, varArgs) {
    'use strict';
    if (target == null) {
      throw new TypeError('Cannot convert undefined or null to object');
    }

    var to = Object(target);

    for (var index = 1; index < arguments.length; index++) {
      var nextSource = arguments[index];

      if (nextSource != null) {
        for (var nextKey in nextSource) {
          if (Object.prototype.hasOwnProperty.call(nextSource, nextKey)) {
            to[nextKey] = nextSource[nextKey];
          }
        }
      }
    }
    return to;
  };
}

if (!String.prototype.includes) {
    String.prototype.includes = function() {
        'use strict';
        return String.prototype.indexOf.apply(this, arguments) !== -1;
    };
}

/*
Name: Holmes
Author: Haroen Viaene
URL: https://haroen.me/holmes/
*/
var _global='undefined'==typeof window?global:window;function toFactory(j){var k=function(){for(var l,m=arguments.length,n=Array(m),o=0;o<m;o++)n[o]=arguments[o];return l='undefined'!=typeof this&&this!==_global?j.call.apply(j,[this].concat(n)):new(Function.prototype.bind.apply(j,[null].concat(n))),l};return k.__proto__=j,k.prototype=j.prototype,k}var stringIncludes=function(j,k){return-1!==j.indexOf(k)},_typeof='function'==typeof Symbol&&'symbol'==typeof Symbol.iterator?function(j){return typeof j}:function(j){return j&&'function'==typeof Symbol&&j.constructor===Symbol&&j!==Symbol.prototype?'symbol':typeof j},classCallCheck=function(j,k){if(!(j instanceof k))throw new TypeError('Cannot call a class as a function')},createClass=function(){function j(k,l){for(var n,m=0;m<l.length;m++)n=l[m],n.enumerable=n.enumerable||!1,n.configurable=!0,'value'in n&&(n.writable=!0),Object.defineProperty(k,n.key,n)}return function(k,l,m){return l&&j(k.prototype,l),m&&j(k,m),k}}(),Holmes=function(){function j(k){var l=this;classCallCheck(this,j);var m=!1;if('object'!==('undefined'==typeof k?'undefined':_typeof(k)))throw new Error('The options need to be given inside an object like this:\n\nnew Holmes({\n  find:".result"\n});\n\nsee also https://haroen.me/holmes/doc/holmes.html');if('string'!=typeof k.find)throw new Error('A find argument is needed. That should be a querySelectorAll for each of the items you want to match individually. You should have something like:\n\nnew Holmes({\n  find:".result"\n});\n\nsee also https://haroen.me/holmes/doc/holmes.html');var n={input:'input[type=search]',find:'',placeholder:void 0,mark:!1,class:{visible:void 0,hidden:'hidden'},dynamic:!1,minCharacters:0,hiddenAttr:!1,onHidden:void 0,onVisible:void 0,onEmpty:void 0,onFound:void 0,onInput:void 0};this.options=Object.assign({},n,k),this.options.class=Object.assign({},n.class,k.class),this.hidden=0,this.running=!1,window.addEventListener('DOMContentLoaded',function(){l.start()}),this._inputHandler=function(){l.running=!0;var o=!1;l.searchString=l.inputString(),l.options.minCharacters&&0!==l.searchString.length&&l.options.minCharacters>l.searchString.length||(l.options.dynamic&&(l.elements=document.querySelectorAll(l.options.find),l.elementsLength=l.elements.length,l.elementsArray=Array.prototype.slice.call(l.elements)),l.options.mark&&(l._regex=new RegExp('('+l.searchString+')(?![^<]*>)','gi')),l.elementsArray.forEach(function(p){stringIncludes(p.textContent.toLowerCase(),l.searchString)?(l._showElement(p),m&&'function'==typeof l.options.onFound&&l.options.onFound(l.placeholderNode),o=!0):l._hideElement(p)}),'function'==typeof l.options.onInput&&l.options.onInput(l.searchString),o?l.options.placeholder&&l._hideElement(l.placeholderNode):(l.options.placeholder&&l._showElement(l.placeholderNode),!1==m&&(m=!0,'function'==typeof l.options.onEmpty&&l.options.onEmpty(l.placeholderNode))))}}return createClass(j,[{key:'_hideElement',value:function(l){this.options.class.visible&&l.classList.remove(this.options.class.visible),l.classList.contains(this.options.class.hidden)||(l.classList.add(this.options.class.hidden),this.hidden++,'function'==typeof this.options.onHidden&&this.options.onHidden(l)),this.options.hiddenAttr&&l.setAttribute('hidden','true'),this.options.mark&&(l.innerHTML=l.innerHTML.replace(/<\/?mark>/g,''))}},{key:'_showElement',value:function(l){this.options.class.visible&&l.classList.add(this.options.class.visible),l.classList.contains(this.options.class.hidden)&&(l.classList.remove(this.options.class.hidden),this.hidden--,'function'==typeof this.options.onVisible&&this.options.onVisible(l)),this.options.hiddenAttr&&l.removeAttribute('hidden'),this.options.mark&&(l.innerHTML=l.innerHTML.replace(/<\/?mark>/g,''),this.searchString.length&&(l.innerHTML=l.innerHTML.replace(this._regex,'<mark>$1</mark>')))}},{key:'inputString',value:function(){if(this.input instanceof HTMLInputElement)return this.input.value.toLowerCase();if(this.input.contentEditable)return this.input.textContent.toLowerCase();throw new Error('The Holmes input was no <input> or contenteditable.')}},{key:'setInput',value:function(l){if(this.input instanceof HTMLInputElement)this.input.value=l;else if(this.input.contentEditable)this.input.textContent=l;else throw new Error('The Holmes input was no <input> or contenteditable.')}},{key:'start',value:function(){var l=document.querySelector(this.options.input);if(l instanceof HTMLElement)this.input=l;else throw new Error('Your Holmes.input didn\'t match a querySelector');if('string'==typeof this.options.find)this.elements=document.querySelectorAll(this.options.find);else throw new Error('A find argument is needed. That should be a querySelectorAll for each of the items you want to match individually. You should have something like:\n\nnew Holmes({\n  find:".result"\n});\n\nsee also https://haroen.me/holmes/doc/holmes.html');if(this.elementsLength=this.elements.length,this.elementsArray=Array.prototype.slice.call(this.elements),this.hidden=0,'string'==typeof this.options.placeholder){var m=this.options.placeholder;if(this.placeholderNode=document.createElement('div'),this.placeholderNode.id='holmes-placeholder',this._hideElement(this.placeholderNode),this.placeholderNode.innerHTML=m,this.elements[0].parentNode instanceof Element)this.elements[0].parentNode.appendChild(this.placeholderNode);else throw new Error('The Holmes placeholder couldn\'t be put; the elements had no parent.')}if(this.options.class.visible){var n=this.options.class.visible;this.elementsArray.forEach(function(o){o.classList.add(n)})}this.input.addEventListener('input',this._inputHandler)}},{key:'stop',value:function(){var l=this;return new Promise(function(m,n){try{if(l.input.removeEventListener('input',l._inputHandler),l.options.placeholder)if(l.placeholderNode.parentNode)l.placeholderNode.parentNode.removeChild(l.placeholderNode);else throw new Error('The Holmes placeholderNode has no parent.');l.options.mark&&l.elementsArray.forEach(function(o){o.innerHTML=o.innerHTML.replace(/<\/?mark>/g,'')}),l.running=!1,m('This instance of Holmes has been stopped.')}catch(o){n(o)}})}},{key:'clear',value:function(){var l=this;this.setInput(''),this.elementsArray.forEach(function(m){l._showElement(m)}),this.options.placeholder&&this._hideElement(this.placeholderNode),this.hidden=0}},{key:'count',value:function(){return{all:this.elementsLength,hidden:this.hidden,visible:this.elementsLength-this.hidden}}}]),j}(),holmes=toFactory(Holmes);