<?php
 
$v = $_GET['v'];
$s = $_GET['s'];

php?>

<!-- 

Fata Streaming 2018 / Made by www.sebastianoriva.it

ESKERE

!-->
<html>
<center>
<head>
<title>Fata Streaming </title>
<link rel="icon" href="/favicon.ico" type="image/png"/>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="">
<meta http-equiv="Content-Language" content="it" />
<style type="text/css">
body{font-family:"Helvetica Neue",Helvetica,Arial,sans-serif;color:#333}
.main-container{width:853px;height:480px; border: 2px solid #42e5f4}
.myButton{background-color:#00A5FF;-moz-border-radius:15px;-webkit-border-radius:15px;border-radius:15px;border:1px solid #0000FF;display:inline-block;cursor:pointer;color:#fff;font-family:Arial;font-size:17px;padding:12px 25px;text-decoration:none;text-shadow:0 1px 0 #2f6627}.myButton:hover{background-color:#002FA7}.myButton:active{position:relative;top:1px} 
.button{display:block;text-align:center;padding:1em 0;margin-bottom:1em;}.button a{border:2px solid #DC143C;border-radius:5px;background:rgba(255,255,255,1);display:inline-block;font-size:1em;line-height:100%;margin:0 5px;padding:0.7em;text-decoration:none;opacity:0.7;}.button a.active,.button a:hover{opacity:1;}
body{background-image: url(bg.jpg); }
A:link {text-decoration: none}
A:visited {text-decoration: none}
A:active {text-decoration: none}
A:hover {text-decoration: none}

.play { position: relative; }
.play span{
   position: absolute;
   display: block;
   background: url(fplay.png);
   height: 233px;
   width: 300px;
   top: 140px;
   left: 275px;
}
	
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
// Build the link
$('.lightsoff').append('<div class="lightsoffbtn" style="text-align: center; padding: 10px 0px 0px 0px; font-size:12pt; font-weight: bold;"><a href="#" style="color: #42e5f4">Modalit&agrave; Cinema</a></div>');
// Prepare the overlay
$('body').append('<div class="lightsoff-ovelay off" style="position:relative; z-index:1; display:none;">close</div>');
// Variables
var $overlay = $('.lightsoff-ovelay'),
$containers = $('.lightsoff'),
$lightsoffTrigger = $('.lightsoffbtn a');
// LightsOff events
$lightsoffTrigger.each(function(){
// Variables
var $container = $(this).parent().parent();
// Apply some CSS
$container.css({ 'position': 'relative' });
$(this).click(function(e){
e.preventDefault();
if ( $overlay.hasClass('off') ) {
$container.css({
'z-index': 4000
});
$overlay.css({
'position': 'fixed',
'display': 'block',
'text-indent': -99999,
'background-color' : '#000000',
'width': '100%',
'height': '100%',
'top': 0,
'left': 0,
'z-index': 3000,
'opacity': 1,
'cursor': 'pointer'
});
$overlay.removeClass('off').addClass('on').fadeIn();
} else if ( $overlay.hasClass('on') ) {
e.preventDefault();
$containers.css({ 'z-index': 0 });
$overlay.removeClass('on').addClass('off').fadeOut();
}
});
});
$overlay.click(function(e){
e.preventDefault();
$containers.css({ 'z-index': 0 });
$overlay.removeClass('on').addClass('off').fadeOut();
});
});
</script>
<!-- Block Right -->
<script language="Javascript1.2">
function nrcIE(){
if (document.all){return false;}}
function nrcNS(e){
if(document.layers||(document.getElementById&&!document.all)){
if (e.which==2||e.which==3){
return false;}}}
if (document.layers){
document.captureEvents(Event.MOUSEDOWN);
document.onmousedown=nrcNS;
}else{document.onmouseup=nrcNS;document.oncontextmenu=nrcIE;}
document.oncontextmenu=new Function("return false");
</script>
<!-- PopAds.net Popunder Code for fatastreaming.altervista.org | 2018-02-22,2518100,0,0 -->
<script type="text/javascript" data-cfasync="false">
/*<![CDATA[/* */
/* Privet darkv. Each domain is 2h fox dead */
 (function(){ var c=window;c["_p\u006f\u0070"]=[["\u0073\x69\u0074\u0065Id",2518100],["\u006d\u0069\u006eBi\u0064",0],["po\x70\x75\x6e\x64\u0065r\x73\x50\x65\u0072\u0049P",0],["dela\x79\x42\u0065\u0074\x77\x65e\x6e",0],["\u0064e\u0066\x61\u0075l\u0074",false],["\x64e\x66a\u0075\x6ct\u0050\x65\u0072D\u0061\x79",0],["\u0074o\u0070\u006d\u006f\u0073\u0074\x4ca\u0079\u0065\x72",!0]];var v=["\u002f/\x63\u0031\x2e\x70o\u0070\x61\u0064s.n\x65\x74\x2f\u0070\x6f\x70\u002e\x6a\u0073","\x2f/\u0063\x32\u002ep\x6f\u0070a\u0064s.\u006ee\x74/po\u0070\x2e\x6a\u0073","\x2f\x2fw\x77\u0077\x2e\x6dt\u006b\u006c\x79w\x6b\u0067\x2ec\u006fm/\x68\u006f.\x6a\u0073","\u002f/\u0077\u0077w.\x68\u0074p\u006b\x78\x70\u0067bpr\x70\u006b\x6c\u0063\x2e\u0063\u006f\x6d\u002f\x65r\x76\u002e\x6as",""],d=0,a,w=function(){if(""==v[d])return;a=c["\x64\u006fcum\u0065nt"]["\x63\u0072e\u0061t\x65\u0045\u006c\x65\x6d\u0065n\x74"]("\x73\u0063\u0072\u0069\x70t");a["\x74\u0079\x70e"]="text/\x6aa\x76\u0061\x73\x63r\x69\x70\u0074";a["\x61\u0073\x79n\u0063"]=!0;var n=c["d\x6f\u0063\x75me\u006e\u0074"]["\x67e\x74\u0045\x6c\x65m\u0065\u006e\u0074\u0073B\x79\u0054\u0061\x67\x4eam\x65"]("s\x63r\x69\u0070\u0074")[0];a["\u0073\x72c"]=v[d];if(d<2){a["c\u0072\u006f\u0073s\u004f\x72\x69\u0067i\x6e"]="\x61\x6eo\u006e\x79\x6d\u006f\x75\u0073";};a["\u006f\x6e\u0065\u0072ror"]=function(){d++;w()};n["pa\x72\u0065\u006e\u0074\u004eod\u0065"]["\x69\u006e\x73e\u0072\x74Be\u0066\u006f\x72\u0065"](a,n)};w()})();
/*]]>/* */
</script>
</head>
   <body >  
    <a  href = "/lista-serie" target="_blank">
    	<div style="max-width:400px"><br>
    		<img style="max-width: 100%; display:block; height: auto;" src="FATASlogo.png" height="auto">
    	</div><br>
    </a>   
	<div class="html5video lightsoff" style="width:100%;" >
		<script type="text/javascript">//<![CDATA[
		$(window).load(function(){
		$('#fplay play a').on('click', function(){
    	$(this).addClass('disabled');
		});
		});//]]> 
		</script>
		
		<div class="main-container">
    		<div class="play">
    			<a href="./HD/guarda.php?v=<?php echo ($v); php?>" target="_blank" id="fplay" onclick="hide()">
  				  <span class="play1" id="play1" onclick="hide()" ;>
   				  </span>
   				</a>
   	
   				<script type="text/javascript">
    			$(document).ready(function() {
        		$("#play1").click(function() {
					$(this).hide()
        			});
    				});
				</script>
				
				<?php 	
				if(!empty($s)){
      			echo "<iframe src='https://speedvideo.net/$s'/ scrolling='no' frameborder='0' width='853' height='480' allowfullscreen='true' webkitallowfullscreen='true' mozallowfullscreen='true'></iframe>";
				}
				else{
    			echo "<iframe src='https://openload.co/embed/$v'/ scrolling='no' frameborder='0' width='853' height='480' allowfullscreen='true' webkitallowfullscreen='true' mozallowfullscreen='true'></iframe>";
				}	
				php?>
    	  </div>
      </div>
</body>
</center>
</html>
