	
	<div class="footer">
		<a href="admin">Admin</a> | &copy <?php echo $year ?> | <a href="api">API</a> | This project is open source on <a href="https://github.com/skebby11/Fata-View/" target="_blank">GitHub</a> | Made by <a href="https://www.sebastianoriva.it" target="_blank">Sebastiano Riva</a>
	</div>

	<?php echo $footeradd ?>

	<script src="https://www.sebastianoriva.it/assets/js/SmoothScroll.js"></script>

	<script type="module">
		import 'https://cdn.jsdelivr.net/npm/@pwabuilder/pwaupdate';

		const el = document.createElement('pwa-update');
		document.body.appendChild(el);
	</script>

</body>
</html>