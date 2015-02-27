var edict_response = "";
var edict_boxdiv = "";
var edict_widthBox = 500;
var edict_flag = false;

document.onmousemove = eventMouseMove;
function eventMouseMove() {
    edict_flag = false;
}

document.onclick = eventClick;
function eventClick() {
    if (edict_flag == false) {
        removeDiv(document.getElementById("edict_showWidget"));
    }
}

function getRealLeft(el) {
    xPos = document.getElementById(el).offsetLeft;
    tempEl = document.getElementById(el).offsetParent;
    while (tempEl != null) {
        xPos += tempEl.offsetLeft;
        tempEl = tempEl.offsetParent;
    }
    return xPos;
}

function getRealTop(el) {
    yPos = document.getElementById(el).offsetTop;
    tempEl = document.getElementById(el).offsetParent;
    while (tempEl != null) {
        yPos += tempEl.offsetTop;
        tempEl = tempEl.offsetParent;
    }
    return yPos;
}

function move_box(an, box) {
    var cleft = 0;
    var ctop = 0;
    var cWidth = document.body.clientWidth;
    cleft += getRealLeft("edict_Input");
    ctop += getRealTop("edict_Input");
    ctop += an.offsetHeight + 8;
    if ((edict_widthBox + cleft) >= cWidth) {
        var leftnew = cWidth - edict_widthBox;
        edict_boxdiv.style.left = leftnew + "px";
    }
    else {
        edict_boxdiv.style.left = ( cleft - 83 ) + "px";
    }
    box.style.top = ( ctop - 2 ) + 'px';
}

function showword(word) {
    var para = word;
    para = decodeURIComponent(para);
    var obj = document.getElementById('edict_Input');
    obj.value = para;
    Call(obj);
    obj.focus();
}
function visibleIframe() {
    document.getElementById("iframeResult").style.backgroundColor = "#fff"
    document.getElementById("iframeResult").style.visibility = "visible"
}
function isSet(variable) {
    return (typeof (variable) != 'undefined');
}
function showcont(a) {
    var w = document.getElementById('edict_Input').value;
    w = encodeURIComponent(w);
    var response = "";
    var url = "";
    var dict = "";
    setupDiv(a);
    if (typeof edict_d != "undefined") {
        dict = edict_d;
    }
    else if (typeof d != "undefined") {
        dict = d;
    }

    var url =geDictURL+ "/eDictUtilities/edict_script.cshtml?w=" + w + "&d=" + edict_d; /*Tu dien Anh - Viet*/
    document.getElementById('edict_Input').focus();
    response = '<iframe id="iframeResult" frameborder="0" marginwidth="0px" src ="' + url + '" width="100%" height="500" scrolling="no" style="visibility:hidden" onload="visibleIframe()" ></iframe>';
    if (response != "") {
        document.getElementById('edict_showWidget').innerHTML = response;
    }
}
function removeDiv(div) {

    if (div != null) {
        try {
            document.body.removeChild(div);
        }
        catch (err) { }
        div = null;
    }
}
function checkPosition(x, w) {
    var cWidth = content.document.body.clientWidth;
    if ((w + x) >= cWidth) {
        edict_boxdiv.style.left = (cWidth - w) + "px";
    }
    else {
        edict_boxdiv.style.left = x + "px";
    }
    return edict_boxdiv.style.left;
}
function setupDiv(a) {
    edict_boxdiv = document.createElement('div');
    edict_boxdiv.setAttribute('id', "edict_showWidget");
    edict_boxdiv.style.display = 'block';
    edict_boxdiv.style.position = 'absolute';
    edict_boxdiv.style.zIndex = "99999";
    edict_boxdiv.style.width = edict_widthBox + 'px';
    edict_boxdiv.onclick = function () { edict_flag = true; }
    document.body.appendChild(edict_boxdiv);
}

function Call(a) {
    removeDiv(edict_boxdiv);
    var w = document.getElementById('edict_Input').value;
    if (w != "") {
        showcont(a);
        move_box(a, edict_boxdiv);
        return true;
    }
    else {
        return false;
    }
}
function WriteJS() {
    var str = "";
    str += '<style type="text\/css">';

    str += 'form, input, div {';
    str += '	margin:0px;';
    str += '	padding:0px;';
    str += '}';

    str+='#container{width:225px;}';
    str+='#xx_header,#xx_header_L,#xx_header_R{float:left;width:100%;height:29px;}';
    str += '#xx_header{background :transparent url("' + geDictURL + '/Content/images/bm_header_bg.png") repeat-x scroll top left;}';
    str += '#xx_header_L{background:transparent url("' + geDictURL + '/Content/images/bm_header_left.png") no-repeat 0 0;width:59px;}';
    str += '#xx_header_L:hover{background  : transparent url("' + geDictURL + '/Content/images/bm_header_left.png") no-repeat -67px 0;}';
    str += '#xx_header_R{background  : transparent url("' + geDictURL + '/Content/images/bm_header_right.png") no-repeat top right;margin-left:27px;width:4px;}';
    str+='#xx_header_search{float: left;margin-left: 6px;margin-top: 5px;padding: 0;width: 129px;}';
    str+='#xx_header_search_input,#search_center,#search_left,#search_right{float:left;width:100%;height:26px;}';
    str+='#xx_header_search_input{float:left;margin-left:0px;margin-right:0px;margin-top:0px;}';
    str += '#search_center{background: url("' + geDictURL + '/Content/images/bm_search_center.png") repeat-x scroll left top transparent;}';
    str += '#search_left{background: url("' + geDictURL + '/Content/images/bm_search_left.png") no-repeat scroll 0 0 transparent;}';
    str += '#search_right{background: url("' + geDictURL + '/Content/images/bm_search_right.png") no-repeat scroll top right transparent;}';
    str+='#search_input{float: left;margin-left: 7px;margin-top: 0px;padding-top: 0px;width:90%;}';
    str+='#Word{border: medium none;height: 5px;margin-top: 2px;margin-bottom: 2px;width: 100%;}';
    str+='#xx_header_x{float:right;margin-right:10px;margin-top:2px;}';

    str += '<\/style>';
    str += '<div id="container"><div id="xx_header"><div id="xx_header_L"></div><div id="xx_header_search"><div id="xx_header_search_input"><div id="search_center"><div id="search_left"><div id="search_right"><div id="search_input"><input type="text" id="edict_Input" value="" onkeyup="return Call(this);" style="border:0;width:100%;font-weight:bold;color:#000000;" /></div></div></div></div></div></div><div id="xx_header_R"></div></div></div></div>';
    document.write(str);
}
function edict_attachBehaviors() {
    var e;
    if (e = document.getElementById('edict_Input')) {
        e.onfocus = function () {
            this.className = 'edict_focused';
        }
        e.onblur = function () {
            if (e.value == "") {
                this.className = 'edict_blurred';
            }
        }
    }
}

function edict_init() {
    edict_attachBehaviors();
    var e = document.getElementById('edict_Input');
    e.onblur();
}
if (window.attachEvent)
    window.attachEvent("onload", edict_init)
else
    window.onload = edict_init

WriteJS();
