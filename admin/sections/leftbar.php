<div class="sx no-print">
	<ul class="sx_menu" style="height:30%; ">
	<li class="parent">
		<a class="menu_element product <?php if($activepage == "addep"){ echo "active"; } else { echo ""; } ?> " href="addep.php">Aggiungi Episodio</a>
	</li>
	<li class="parent">
		<a class="menu_element <?php if($activepage == "addserie"){ echo "active"; } ?>" href="addserie.php">Aggiungi Serie</a>
	</li>
	<li class="parent">
		<a class="menu_element <?php if($activepage == "addfilm"){ echo "active"; } ?>" href="addfilm.php">Aggiungi Film</a>
	</li>
	<li class="parent">
		<a class="menu_element product <?php if($activepage == "editep"){ echo "active"; } ?> " href="editep.php?action=view">Modifica Episodi</a>
	</li>
	<li class="parent">
		<a class="menu_element product <?php if($activepage == "editfilm"){ echo "active"; } ?> " href="editfilm.php?action=view">Modifica Film</a>
	</li>
	<li class="parent">
		<a class="menu_element product <?php if($activepage == "editserie"){ echo "active"; } ?> " href="editserie.php?action=view">Modifica Serie</a>
	</li>
	</ul>
	<div style="float: left; height: 65%; margin: 2px; padding: 10px; width: 100%; position:relative; ">
	<ul class="sx_menu" >

	<div class='torna-leftmenu'>
		<a class="menu_element product torna-leftmenu" href="../">Torna al sito</a>
	</div>
	

	</ul>
	</div>
</div>