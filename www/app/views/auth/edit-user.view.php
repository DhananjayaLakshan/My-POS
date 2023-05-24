<?php 

if (!empty($_SESSION['referer'])) {
	$back_line = $_SESSION['referer'];
}else{
	$back_line = "index.php?pg=admin&tab=users";
}

?>


<?php require views_path('partials/header');// views/partials/header.view.php ?>



<div class="container-fluid border col-lg-5 col-md-6 mt-5 p-4">

	<center>
		<h3><i class="fa fa-user"></i> Edite User</h3>
		<div> <?=esc(APP_NAME)?> </div>
	</center><br>

<?php if (is_array($row)):?>

	<form method="post" enctype="multipart/form-data">

		<div class="mb-3">
			 <label for="formFile" class="form-label">User Image</label>
			 <input name="image" class="form-control <?=!empty($errors['image']) ? 'border-danger':'' ?>" type="file" id="formFile">

			 <?php if(!empty($errors['image'])):?>
			  	<small class="text-danger"><?=$errors['image']?></small>
			 <?php endif;?>
		</div>
		<br>
		<img class="mx-auto d-block" src="<?=$row['image']?>" style="width:50%;">
		<br>

		<div class="mb-3">
		  <label for="exampleFormControlInput1" class="form-label">Username</label>
		  <input type="text" name="username" class="form-control <?=!empty($errors['username']) ? 'border-danger':'' ?>" id="exampleFormControlInput1" placeholder="Username" value="<?=set_value('username',$row['username']);?>" autofocus>

		  <?php if(!empty($errors['username'])):?>
		  	<small class="text-danger"><?=$errors['username']?></small>
		  <?php endif;?>
		</div>

		<div class="mb-3">
		  <label for="exampleFormControlInput1" class="form-label">Email address</label>
		  <input type="text" name="email" class="form-control  <?=!empty($errors['email']) ? 'border-danger':'' ?>" id="exampleFormControlInput1" placeholder="name@example.com" value="<?=set_value('email',$row['email']);?>">

		  <?php if(!empty($errors['email'])):?>
		  	<small class="text-danger"><?=$errors['email']?></small>
		  <?php endif;?>
		</div>


		<div class="mb-3">
		  <label for="exampleFormControlInput1" class="form-label">Gender</label>

		  <select name="gender" class="form-control <?=!empty($errors['gender']) ? 'border-danger':'' ?>" >
		  	<option><?=$row['gender'];?></option>
		  	<option>male</option>
		  	<option>female</option>
		  </select>

		  <?php if(!empty($errors['gender'])):?>
		  	<small class="text-danger"><?=$errors['gender']?></small>
		  <?php endif;?>
		</div>


<?php if (Auth::get('role') == "admin"): ?>
		<div class="mb-3">
		  <label for="exampleFormControlInput1" class="form-label">Role</label>

		  <select name="role" class="form-control <?=!empty($errors['role']) ? 'border-danger':'' ?>">
		  	<option><?=$row['role'];?></option>
		  	<option>admin</option>
		  	<option>supervisor</option>
		  	<option>cashier</option>
		  	<option>user</option>
		  </select>

		  <?php if(!empty($errors['role'])):?>
		  	<small class="text-danger"><?=$errors['role']?></small>
		  <?php endif;?>
		</div>
<?php endif;?>

		<div class="mb-3">
		  <label for="exampleFormControlInput1" class="form-label">Password</label>
		  <input type="password" name="password" class="form-control  <?=!empty($errors['password']) ? 'border-danger':'' ?>" id="exampleFormControlInput1" placeholder="Password" value="<?=set_value('password','');?>">

		  <?php if(!empty($errors['password'])):?>
		  	<small class="text-danger"><?=$errors['password']?></small>
		  <?php endif;?>
		</div>

		<div class="mb-3">
		  <label for="exampleFormControlInput1" class="form-label">Re-enter password</label>
		  <input type="password" name="password_retype" class="form-control  <?=!empty($errors['password_retype']) ? 'border-danger':'' ?>" id="exampleFormControlInput1" placeholder="Re-enter here" value="<?=set_value('password_retype','');?>">

		  <?php if(!empty($errors['password_retype'])):?>
		  	<small class="text-danger"><?=$errors['password_retype']?></small>
		  <?php endif;?>
		</div><br>

<?php if (Auth::get('role') == "admin"): ?>
		<a href="<?=$back_line?>">
			<button type="button" class="btn btn-danger" >Cancel</button>
		</a>
<?php endif;?>

		<button class="btn btn-primary float-end" >Save</button>
	</form>
<div class="clearfix"></div>
<?php else:?>

	<div class="alert alert-danger text-center">That user was not found!!</div>
	<a href="<?=$back_line?>">
		<button type="button" class="btn btn-danger" >Cancel</button>
	</a>

<?php endif;?>
	
</div>




<?php require views_path('partials/footer'); ?>