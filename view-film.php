<?php

// variabile player utilizzato

$v = $_GET['v']; // openload
$s = $_GET['s']; // streamango
$p = $_GET['p']; // speedvideo
$sv = $_GET['sv']; // speedvideo
$md = $_GET['md']; // mixdrop
$gu = $_GET['gu']; // gounl


include('functions.php');
$idutente = $_SESSION['user']['id'];
if(!empty($v)){
$filmdetailsquery = "SELECT id, titolo, descr, poster FROM film where link='$v'";
}
if(!empty($p)){
$filmdetailsquery = "SELECT id, titolo, descr, poster FROM film where linksv='$p'";
}
if(!empty($sv)){
$filmdetailsquery = "SELECT id, titolo, descr, poster FROM film where linksv='$sv'";
}
if(!empty($md)){
$filmdetailsquery = "SELECT id, titolo, descr, poster FROM film where linkmd='$md'";
}
if(!empty($gu)){
$filmdetailsquery = "SELECT id, titolo, descr, poster FROM film where linkgu='$gu'";
}

$filmdetailsresult = mysqli_query($db, $filmdetailsquery);
    while($row = mysqli_fetch_assoc($filmdetailsresult)) {
	$filmid = $row["id"];
	$descr = $row["descr"];
	$poster = $row["poster"];
	$titolo = $row["titolo"];
	} 

 ?>
<!-- 

Fata Streaming 2018 / Made by www.sebastianoriva.it

ESKERE

!-->
<html>
<center>
<head>
<title><?php echo $titolo; ?> - Fata Streaming</title>
<link rel="icon" href="favicon.ico" type="image/png"/>
<link href="assets/css/fatastyle.css?1.2.1" rel="stylesheet" type="text/css">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Guarda online gratuitamente le tue serie preferite su Fata Streaming">
<meta http-equiv="Content-Language" content="it" />

<!-- Block Right 
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
</script> -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!--  Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-101768560-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-101768560-3');
</script>

</head>
   <body >  
    	<a href="/"><div style="max-width:400px"><br>
    		<img style="max-width: 100%; display:block; height: auto;" src="assets/img/FATASlogo.png" height="auto">
    	</div></a>
    
    <h3 style="color:#d6d6d6; font-family: 'PT Sans', sans-serif;">LE TUE SERIE COME PER MAGIA</h3><br>
    
    
    <div align="center"><script type="text/javascript">
	/* <![CDATA[ */
	document.write('<s'+'cript type="text/javascript" src="//ad.altervista.org/js.ad/size=300X250/?ref='+encodeURIComponent(location.hostname+location.pathname)+'&r='+new Date().getTime()+'"></s'+'cript>');
	/* ]]> */
	</script>	
	</div><br>
         
	 <?php if(!empty($v)): ?>
     <script>	
	$.get( "https://api.openload.co/1/file/info?file=<?php echo $v; ?>&login=7f53b6aa27b38c73&key=euZmu1Un", function( response ) {
	$("#msg").text(response.msg);
    $("#status").text(response.status);
    $("#episodio").text(response.result.<?php echo $v; ?>.name);
	}, "json" );
	  </script>
	<?php endif; ?>
	   
	<?php if(!empty($vs)): ?>
	 <script>	
	$.get( "https://api.verystream.com/file/info?file=<?php echo $vs; ?>&login=920e4e64bfafd40ac359&key=9Z9vL2iQtFX", function( response ) {
	$("#msg").text(response.msg);
    $("#status").text(response.status);
    $("#episodio").text(response.result.<?php echo $vs; ?>.name);
	}, "json" );
	  </script>
	<?php endif; ?>

	<div class="titlewrap">
		<h1 style="color: darkgray"><?php echo $titolo ?></h2>
		<p id="episodio" style="color: darkgray"></h2>
    </div>
          
	<div class="html5video lightsoff" style="width:100%;" >
		<script type="text/javascript">//<![CDATA[
		$(window).load(function(){
		$('#fplay play a').on('click', function(){
    	$(this).addClass('disabled');
		});
		});//]]> 
		</script>
		
		<?php 	
				if(!empty($s || $v || $vs|| $md|| $gu)){
      			echo "<div class='main-container'>";
				}
				else{
					echo "<div align='center''>";
				}
				?>
   		   		
    		<!--<div class="play">
    			<a href="./HD/guarda.php?v=<?php //echo ($v); php?>" target="_blank" id="fplay" onclick="hide()">				
   	  
   				<script type="text/javascript">
    			$(document).ready(function() {
        		$("#play1").click(function() {
					$(this).hide()
        			});
    				});
				</script>-->
				
				<?php 	

				if(!empty($s || $v || $p || $sv || $md || $gu)){
				if(!empty($s)){
      			echo "<span class='play1' id='play1' onclick='hide()' ;>
   				  </span><iframe src='https://streamango.com/embed/$s'/ scrolling='no' frameborder='0' width='100%' height='100%' allowfullscreen='true' webkitallowfullscreen='true' mozallowfullscreen='true'></iframe></a><bold></bold>";
				}
				if(!empty($p)){
      			echo "<span class='play1' id='play1' onclick='hide()' ;>
   				  </span><iframe src='https://speedvideo.net/embed-$p-607x360.html' scrolling='no' frameborder='0' width='800px' height='400px'  allowfullscreen='true' webkitallowfullscreen='true' mozallowfullscreen='true'></iframe></a><bold></bold>";
				}
				if(!empty($v)){ // openload
      			echo "<span class='play1' id='play1' onclick='hide()' ;>
   				  </span><iframe src='https://supervideo.tv/embed-$v.html' scrolling='no' frameborder='0' width='100%' height='100%' allowfullscreen='true' webkitallowfullscreen='true' mozallowfullscreen='true'></iframe></a><bold></bold>";
				}
				if(!empty($sv)){ // speedvideo
      			echo "<span class='play1' id='play1' onclick='hide()' ;>
   				  </span><iframe src='https://speedvideo.net/embed-$sv-607x360.html'/ scrolling='no' frameborder='0' width='100%' height='100%' allowfullscreen='true' webkitallowfullscreen='true' mozallowfullscreen='true' style='width:45%!important;height:50%!important'></iframe></a><bold></bold>";
				}
				if(!empty($md)){ //mixdrop
      			echo "<span class='play1' id='play1' onclick='hide()' ;>
   				  </span><iframe src='http://mixdrop.co/e/$md'/ scrolling='no' frameborder='0' width='100%' height='100%' allowfullscreen='true' webkitallowfullscreen='true' mozallowfullscreen='true'></iframe></a><bold></bold>";
				}
				if(!empty($gu)){ // go unlimited
      			echo "<span class='play1' id='play1' onclick='hide()' ;>
   				  </span><iframe src='https://gounlimited.to/embed-$gu.html'/ scrolling='no' frameborder='0' width='100%' height='100%' allowfullscreen='true' webkitallowfullscreen='true' mozallowfullscreen='true'></iframe></a><bold></bold>";
				}}
				else{
					echo "</a><h1 style='color:fff'>Si &egrave verificato un errore</h1>
					<h3 style='color:fff'>Probabilmente hai seguito un collegamento sbagliato.</h3></div>";
				}
				?>
    	  <!--</div>-->
		<div class="footer" style="height: 200px;"> </div>
      </div>
</body>
</center>
</html>
