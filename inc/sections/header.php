	<div class="header">
		<img src="<?php echo $baseurl?>assets/img/FATASlogo.png">
	</div>
		<div class="menu">
		<ul>
 		 <li><a class="<?php if($active == 1){ echo "active";} ?>" href="<?php echo $baseurl?>">Home</a></li>
 		 <li><a class="<?php if($active == 2){ echo "active";} ?>" href="<?php echo $baseurl?>lista-serie">Serie</a></li>
 		 <li><a class="<?php if($active == 3){ echo "active";} ?>" href="<?php echo $baseurl?>lista-film">Film</a></li>
		 <li class="search"><form action="<?php echo $baseurl?>search" method="post"><input type="text" name="s" placeholder="Cerca film e serie..."></form></li>
		</ul>
		<!-- logged in user information -->
		<div class="profile_info" align="right"> 

			<div>
				<?php  if (isset($_SESSION['user'])) : ?>
					<a href="profile" class="profile"><strong><?php echo $_SESSION['user']['username']; ?></strong></a>

					<small>
						<!--<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> -->
						<br>
						<a href="?logout='1'" style="color: red;">logout</a>
					</small>

				<?php else : ?>
				<ul class="login">
 		 		<li class="login"><a href="<?php echo $baseurl?>login">Login</a></li>
  		 		<li class="login"><a href="<?php echo $baseurl?>register">Signup</a></li>
				</ul>

				<?php endif ?>
			</div>
		</div>
	</div>