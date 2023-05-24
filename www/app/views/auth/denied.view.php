<?php require views_path('partials/header');// views/partials/header.view.php ?>

<br>
	<center>
		<h1 class="text-danger">Access Denied !!</h1>
		<div><?="*** ".Auth::getMessage()." ***"?></div><!--get send message and display-->
	</center>
<br>

<?php require views_path('partials/footer'); ?>