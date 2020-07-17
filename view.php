<?php

// variabile player utilizzato

$v = $_GET['v']; // supervideo
$s = $_GET['s']; // streamango
$p = $_GET['p']; // speedvideo
$sv = $_GET['sv']; // speedvideo
$md = $_GET['md']; // mixdrop
$gu = $_GET['gu']; // gounl
$fataplayer = $_GET['fp']; // fata player


include('functions.php');
$idutente = $_SESSION['user']['id'];
if(!empty($v)){
$epdetailsquery = "SELECT id, stagione, episodio, serie, titolo FROM episodi where link='$v'";
}
if(!empty($p)){
$epdetailsquery = "SELECT id, stagione, episodio, serie, titolo FROM episodi where linksv='$p'";
}
if(!empty($sv)){
$epdetailsquery = "SELECT id, stagione, episodio, serie, titolo FROM episodi where linksv='$sv'";
}
if(!empty($md)){
$epdetailsquery = "SELECT id, stagione, episodio, serie, titolo FROM episodi where linkmd='$md'";
}
if(!empty($gu)){
$epdetailsquery = "SELECT id, stagione, episodio, serie, titolo FROM episodi where linkgu='$gu'";
}
if(!empty($fataplayer)){
$epdetailsquery = "SELECT id, stagione, episodio, serie, titolo FROM episodi where fataplayer='$fataplayer'";
}
$epdetailsresult = mysqli_query($db, $epdetailsquery);
    while($row = mysqli_fetch_assoc($epdetailsresult)) {
	$epid = $row["id"];
	$stagione = $row["stagione"];
	$episodio = $row["episodio"];
	$idserie = $row["serie"];
	$titolo = $row["titolo"];
	} 

if(!empty($_GET['fp'])){

	
	
}


// call the seenep() function if seenep_btn is clicked
	if (isset($_POST["seenep_btn"])) {
		seenep();
	}
function seenep() {
	global $db, $idserie, $epid, $time;
	$idutente = $_SESSION['user']['id'];
	$addsenepquery = "INSERT into epseen (user, serie, epid, date) VALUES('$idutente', '$idserie', '$epid', '$time')";
	mysqli_query($db, $addsenepquery);
	$_SESSION['success']  = "Ora puoi guardare i prossimi episodi...";
	header('Location: /');
} ?>
<!-- 

Fata Streaming 2018-2020 / Made by www.sebastianoriva.it

!-->
<html>
<center>
<head>
<title>Fata Streaming - <?php echo $stagione . "X" . $episodio . " - " .$titolo; ?></title>
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

<script src="https://cdn.plyr.io/3.6.2/plyr.js"></script>
<link rel="stylesheet" href="https://cdn.plyr.io/3.6.2/plyr.css" />
	
	
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
    
    
    <div align="center">
		<script>!function(d,l,e,s,c){e=d.createElement("script");e.src="//ad.altervista.org/js.ad/size=300X250/?ref="+encodeURIComponent(l.hostname+l.pathname)+"&r="+Date.now();s=d.scripts;c=d.currentScript||s[s.length-1];c.parentNode.insertBefore(e,c)}(document,location)</script>
	</div><br>


	<div class="titlewrap">
		<h1 style="color: darkgray"><?php echo $stagione . "X" . $episodio . " - " .$titolo; ?></h2>
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
				if(!empty($s || $v || $p || $sv || $md || $gu || $fataplayer)){
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

				if(!empty($s || $v || $p || $sv || $md || $gu || $fataplayer)){
				if(!empty($s)){
      			echo "<span class='play1' id='play1' onclick='hide()' ;>
   				  </span><iframe src='https://streamango.com/embed/$s' scrolling='no' frameborder='0' width='100%' height='100%' allowfullscreen='true' webkitallowfullscreen='true' mozallowfullscreen='true'></iframe></a><bold></bold>";
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
   				  </span><iframe src='https://speedvideo.net/embed-$sv-607x360.html' scrolling='no' frameborder='0' width='100%' height='100%' allowfullscreen='true' webkitallowfullscreen='true' mozallowfullscreen='true' style='width:45%!important;height:50%!important'></iframe></a><bold></bold>";
				}
				if(!empty($md)){ //mixdrop
      			echo "<span class='play1' id='play1' onclick='hide()' ;>
   				  </span><iframe src='https://mixdrop.co/e/$md' scrolling='no' frameborder='0' width='100%' height='100%' allowfullscreen='true' webkitallowfullscreen='true' mozallowfullscreen='true'></iframe></a><bold></bold>";
				}
				if(!empty($gu)){ // go unlimited
      			echo "<span class='play1' id='play1' onclick='hide()' ;>
   				  </span><iframe src='https://gounlimited.to/embed-$gu.html' scrolling='no' frameborder='0' width='100%' height='100%' allowfullscreen='true' webkitallowfullscreen='true' mozallowfullscreen='true'></iframe></a><bold></bold>";
				}
				
				if(!empty($fataplayer)){
					
					$fpdetails = "SELECT fpposter, fpmp4, fpwebm FROM fataplayer WHERE id='$fataplayer'";
					$fpresult = mysqli_query($db, $fpdetails);
	
					while($row = mysqli_fetch_assoc($fpresult)) {
					$fpposter = $row["fpposter"];
					$fpmp4 = $row["fpmp4"];
					$fpwebm = $row["fpwebm"];
					} 
					
					echo "
					<span class='play1' id='play1' onclick='hide()' ;>
   				  </span><video id='player' playsinline controls data-poster='$fpposter'>
							  <source src='$fpmp4' type='video/mp4' />
  							  <source src='$fpwebm' type='video/webm' />
							</video></a><bold></bold>
					";
				}}
				
				else{
					echo "</a><h1 style='color:fff'>Si &egrave verificato un errore</h1>
					<h3 style='color:fff'>Probabilmente hai seguito un collegamento sbagliato.</h3></div>";
				}
				?>
    	  <!--</div>--><br><br>
				<?php  if (isset($_SESSION['user'])) : ?>
		
		<style>
		.epscontainer {
			width: 90%;
			max-width: 600px;		
		}</style>
					<div class="epscontainer">
					<div class="logged">
						<strong style="color: white;">Ciao, <?php echo $_SESSION['user']['username']; ?></strong>
						<small> <br> <a href="?logout='1'" style="color: red;">logout</a> </small>
					</div>
					<h3>Hai finito di vedere questo episodio?</h3>
					<form action="" method="POST">
						<input type="submit" value="S&igrave" name="seenep_btn">
					</form>
					<div class="seeneps">	
					<?php 
					$epsseen = "SELECT epid, date FROM epseen where SERIE='$idserie' AND user='$idutente' ORDER BY epid ASC";
					$epsseenresult = mysqli_query($db, $epsseen);
					if (mysqli_num_rows($epsseenresult) > 0) {
						echo "<hr><h4>Episodi gi&agrave visti:</h4><small>TIP: Passa il cursore sull'episodio per sapere quando l'hai visto</small><br><br>";
					while($row = mysqli_fetch_assoc($epsseenresult)) { // output data of each row
						$selectid =  $row["epid"];
						$seendate = $row["date"];
						$selectseps = "SELECT stagione, episodio FROM episodi where id='$selectid'";
						$selectsepsresult = mysqli_query($db, $selectseps);
						while($row = mysqli_fetch_assoc($selectsepsresult)) {
							echo "<span title='$seendate'>" . $row["stagione"] . "X" . $row["episodio"] ."</span>";
						}}}?>
					</div>	
					</div>
				<?php else : ?>
				<div class="notlogged">
					<strong style="color: white;">Esegui il <a href="login?goto=<?php if(!empty($v)){$goto = "v=" . $v;} if(!empty($p)){$goto = "p=" . $p;}; echo $goto; ?>" style="color: white; text-decoration: underline;">login</a> per tenere traccia degli episodi visti</strong>
				</div>
				<?php endif ?>
		<div class="footer" style="height: 200px;"> </div>
      </div>
	
	<script>
      const player = new Plyr('#player');
    </script>
</body>
</center>
</html>
