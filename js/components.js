Function.prototype.pzkImpl = function(props) {
	this.prototype = $.extend(this.prototype || {}, props);
	return this;
};

Function.prototype.pzkExt = function(props) {
	var that = this;
	var func = function() {that.apply(this, arguments);};
	func.prototype = $.extend({}, this.prototype || {}, props);
	return func;
};

String.pzkImpl({
	ucfirst: function() {
		return this.substr(0, 1).toUpperCase() + this.substr(1);
	}
});

jQuery.fn.serializeForm = function() {
	var arr = this.serializeArray();
	var rslt = {};
	var indexJ = {};
	for(var i = 0; i < arr.length; i++) {
		var elem = arr[i];
		if (elem.name.indexOf('[') ==-1) {
			rslt[elem.name] = elem.value;
		} else {
			elem.name = elem.name.replace(/\]\[/g, '.');
			elem.name = elem.name.replace(/\[/g, '.');
			elem.name = elem.name.replace(/\]/g, '');
			var parts = elem.name.split('.');

			var cur = rslt;
			
			for(var j = 0; j < parts.length - 1; j++){
				if (typeof indexJ[j] == 'undefined') indexJ[j] = 0;
				var part = parts[j];
				if(part == '') {
					part = indexJ[j];
					indexJ[j]++;
				}
				if (typeof cur[part] == 'undefined') 
				{
					cur[part] = {};
					indexJ[j+1] = 0;
				}
				cur = cur[part];
			}
			if (typeof indexJ[parts.length-1] == 'undefined') indexJ[parts.length-1] = 0;
			var part = parts[parts.length-1];
			if(part == '') {
				part = indexJ[parts.length-1];
				indexJ[parts.length-1]++;
			}
			cur[part] = elem.value;
		}
	}
	return rslt;
};

pzk = {
	page: 'index',
	elements: {},
	service: function(service, data, callback, options) {
		$.ajax($.extend({
			url: '/service/run/' + service,
			data: data,
			success: callback
		}, options));
	},
	load: function(urls, callback, nocache) {
		if(typeof urls == 'string') {
			urls = [urls];
		}
        if (typeof nocache=='undefined') nocache=false; // default don't refresh
        $.when(
            $.each(urls, function(i, url){
                if (nocache) url += '?_ts=' + new Date().getTime(); // refresh? 
                if (pzk._urls.indexOf(url) == -1) {
					$.get(url, function(){
						if(pzk.ext(url) == 'css') {
							$('<link>', {rel:'stylesheet', type:'text/css', 'href':url}).appendTo('head');
						} else if(pzk.ext(url) == 'js') {
							$('<script>', {type:'text/javascript', 'src':url}).appendTo('head');
						}
						pzk._urls.push(url);
					});
				}
            })
        ).then(function(){
            if (typeof callback=='function') callback();
        });
	},
	ext: function(url) {
		var re = /(?:\.([^.]+))?$/;
		return re.exec(url)[1];
	},
	_urls: []
};
PzkObj = (function(props) { $.extend (this, props || {}); }).pzkImpl({
	init: function() {
	},
	$: function(selector) {
		if (typeof selector == 'undefined') return $('#' + this.id);
		return $(selector, '#' + this.id);
	},
	toJson: function() {
		var rs = {};
		for(var k in this) {
			if ((typeof this[k] != 'function') && (typeof this[k] != 'object')) {
				rs[k] = this[k];
			}
		}
		return rs;
	}
});

PzkController = function(props) {$.extend (this, props || {});}; 

function pzk_init(instances) {
	for(var i = 0; i < instances.length;i++) {
		var props = instances[i];
		var inst = null;
		eval('inst = new ' + props['className'].ucfirst() + '(props);');
		pzk.elements[inst.id] = inst;
		inst.init(); 
	}
}
