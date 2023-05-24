
<?php require views_path('partials/header');// views/partials/header.view.php ?>



<div class="container-fluid border col-lg-5 col-md-6 mt-5 p-4">

	<center>
		<h3 class="text-danger"><i class="fa fa-user"></i> Delete User</h3>
		
		<div> <?=esc(APP_NAME)?> </div>
	</center><br>

<?php if (is_array($row) && $row['deletable']):?>

	<form method="post">

		<div class="mb-3">
		  <label for="exampleFormControlInput1" class="form-label">Username</label>
		  <div class="form-control"><?=esc($row['username'])?> </div>
		</div>

		<div class="mb-3">
		  <label for="exampleFormControlInput1" class="form-label">Email address</label>
		  <div class="form-control"><?=esc($row['email'])?> </div>

		</div>


		<div class="mb-3">
		  <label for="exampleFormControlInput1" class="form-label">Gender</label>
		  <div class="form-control"><?=esc($row['gender'])?> </div>

		</div>


		<div class="mb-3">
		  <label for="exampleFormControlInput1" class="form-label">Role</label>
		  <div class="form-control"><?=esc($row['role'])?> </div>
		</div>

		<br>
		<a href="index.php?pg=admin&tab=users">
			<button type="button" class="btn btn-primary" >Cancel</button>
		</a>

		<button class="btn btn-danger float-end" >Delete</button>
	</form>

<?php else:?>

	<?php if (is_array($row) && !$row['deletable']):?>

		<div class="alert alert-danger text-center">That user can not deletable!!</div>

	<?php else:?>

		<div class="alert alert-danger text-center">That user was not found!!</div>

	<?php endif;?>

	<a href="index.php?pg=admin&tab=users">
		<button type="button" class="btn btn-danger" >Cancel</button>
	</a>

<?php endif;?>
	
</div>




<?php require views_path('partials/footer'); ?>