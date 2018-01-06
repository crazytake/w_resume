;(function(undefined){
  "use strict"
  var _global;
  function extend(o,n,override) {
    for(var key in n){
        if(n.hasOwnProperty(key) && (!o.hasOwnProperty(key) || override)){
            o[key]=n[key];
        }
    }
    return o;
  }
  if(!('getElementsByClass' in HTMLElement)){
    HTMLElement.prototype.getElementsByClass = function(n, tar){
        var el = [],
            _el = (!!tar ? tar : this).getElementsByTagName('*');
        for (var i=0; i<_el.length; i++ ) {
            if (!!_el[i].className && (typeof _el[i].className == 'string') && _el[i].className.indexOf(n) > -1 ) {
                el[el.length] = _el[i];
            }
        }
        return el;
    };
    ((typeof HTMLDocument !== 'undefined') ? HTMLDocument : Document).prototype.getElementsByClass = HTMLElement.prototype.getElementsByClass;
  }


  function timeSelector(opt){
    this._init(opt);
  }
  timeSelector.prototype = {
    constructor: this,
    _init: function(opt){
      var defaultConfig = {
        begin: true,
        begin_txt: '开始',
        end: false,
        end_txt: '结束',
        s_year: 1990,
        e_year: 2017,
        dom: null,
        confirm: function(){},
        close: function(){},
      }
      this.defaultConfig = extend(defaultConfig, opt, true);
      this.panel = this._createP(this.defaultConfig.dom);
    },
    show: function(){},
    hide: function(){}
  }
}())
