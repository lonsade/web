<div class="content">
	<?php 
	if ($id == 'home' || $id == '')
		include('content.home.inc.php');
	else if ($id == 'create')
		include('content.create.inc.php');
	else 
		include('content.show.inc.php');
	?>	
</div>