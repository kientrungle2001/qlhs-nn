{children all}
<!--
<script language=JavaScript> var message="Chức năng bị khóa!"; function clickIE4(){ if (event.button==2){ alert(message); return false; } } function clickNS4(e){ if (document.layers||document.getElementById&&!document.all){ if (e.which==2||e.which==3){ alert(message); return false; } } } if (document.layers){ document.captureEvents(Event.MOUSEDOWN); document.onmousedown=clickNS4; } else if (document.all&&!document.getElementById){ document.onmousedown=clickIE4; } document.oncontextmenu=new Function("alert(message);return false") </script>
<script language=JavaScript> var message="Chức năng bị khóa!"; function clickIE4(){ if (event.button==2){ alert(message); return false; } } function clickNS4(e){ if (document.layers||document.getElementById&&!document.all){ if (e.which==2||e.which==3){ alert(message); return false; } } } if (document.layers){ document.captureEvents(Event.MOUSEDOWN); document.onmousedown=clickNS4; } else if (document.all&&!document.getElementById){ document.onmousedown=clickIE4; } document.oncontextmenu=new Function("alert(message);return false") </script>
-->
<script type="text/javascript">
setTimeout(function() {
	var gridWidth = 0;
	$(window).resize(function() {
		var gw = $('#header').width();
		if(gridWidth != gw) {
			$('#footer td').css('font-size', '9px');
			gridWidth = gw;
			if(gridWidth == 1170) {
				$('#staticbar').show();
				$('#adbar').show();
				$('.banner p').css('font-size', '13px').css('line-height', '27px');
				$('.banner p').show();
				$('.banner h2').css('font-size', '20px');
				$('#sidebar').show();
				$('.avatar-img').show();
				$('.toggle-menu').hide();
				$('.menu .nav').show();
				$('#loginbar form').parent().show();
				$('#loginbar .col-md-2').css('height', '35px');
			} else if (gridWidth == 970) {
				$('#staticbar').show();
				$('#adbar').show();
				$('.banner p').css('font-size', '11px').css('line-height', '18px');
				$('.banner p').show();
				$('.banner h2').css('font-size', '20px');
				$('#sidebar').show();
				$('.avatar-img').show();
				$('.toggle-menu').hide();
				$('.menu .nav').show();
				$('#loginbar form').parent().show();
				$('#loginbar .col-md-2').css('height', '35px');
			} else if (gridWidth == 750) {
				$('#staticbar').hide();
				$('#adbar').hide();
				$('.banner p').show();
				$('.banner p').css('font-size', '11px').css('line-height', '12px');
				$('.banner h2').css('font-size', '16px');
				$('#sidebar').show();
				$('.avatar-img').show();
				$('.toggle-menu').hide();
				$('.menu .nav').show();
				$('#loginbar form').parent().show();
				$('#loginbar .col-md-2').css('height', '35px');
			} else {
				$('.banner h2').css('font-size', '12px');
				$('.banner p').css('font-size', '8px').css('line-height', '13px');
				$('#sidebar').hide();
				$('.banner p').show();
				$('#staticbar').hide();
				$('.avatar-img').hide();
				$('#adbar').hide();
				$('.toggle-menu').show();
				$('.menu .nav').hide();
				$('#loginbar form').parent().hide();
				$('#loginbar .col-md-2').css('height', '25px');
				
			}
			$('.core_db_content img').css('width', '100%').css('height', 'auto');
		}
	});
	$(window).resize();
}, 100);
</script>