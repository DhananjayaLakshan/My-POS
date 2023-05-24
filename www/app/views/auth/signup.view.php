
<?php require views_path('partials/header');// views/partials/header.view.php ?>



<div class="container-fluid border col-lg-5 col-md-6 mt-5 p-4">

	<center>
		<h3><i class="fa fa-user"></i> Create User</h3>
		<div> <?=esc(APP_NAME)?> </div>
	</center><br>

	<form method="post">

		<div class="mb-3">
		  <label for="exampleFormControlInput1" class="form-label">Username</label>
		  <input type="text" name="username" class="form-control <?=!empty($errors['username']) ? 'border-danger':'' ?>" id="exampleFormControlInput1" placeholder="Username" value="<?=set_value('username');?>" autofocus>

		  <?php if(!empty($errors['username'])):?>
		  	<small class="text-danger"><?=$errors['username']?></small>
		  <?php endif;?>
		</div>

		<div class="mb-3">
		  <label for="exampleFormControlInput1" class="form-label">Email address</label>
		  <input type="text" name="email" class="form-control  <?=!empty($errors['email']) ? 'border-danger':'' ?>" id="exampleFormControlInput1" placeholder="name@example.com" value="<?=set_value('email');?>">

		  <?php if(!empty($errors['email'])):?>
		  	<small class="text-danger"><?=$errors['email']?></small>
		  <?php endif;?>
		</div>

		<div class="mb-3">
		  <label for="exampleFormControlInput1" class="form-label">Gender</label>

		  <select name="gender" class="form-control <?=!empty($errors['gender']) ? 'border-danger':'' ?>" >
		   	<option>male</option>
		  	<option>female</option>
		  </select>

		  <?php if(!empty($errors['gender'])):?>
		  	<small class="text-danger"><?=$errors['gender']?></small>
		  <?php endif;?>
		</div>

		<div class="mb-3">
		  <label for="exampleFormControlInput1" class="form-label">Password</label>
		  <input type="password" name="password" class="form-control  <?=!empty($errors['password']) ? 'border-danger':'' ?>" id="exampleFormControlInput1" placeholder="Password" value="<?=set_value('password');?>">

		  <?php if(!empty($errors['password'])):?>
		  	<small class="text-danger"><?=$errors['password']?></small>
		  <?php endif;?>
		</div>

		<div class="mb-3">
		  <label for="exampleFormControlInput1" class="form-label">Re-enter password</label>
		  <input type="password" name="password_retype" class="form-control  <?=!empty($errors['password_retype']) ? 'border-danger':'' ?>" id="exampleFormControlInput1" placeholder="Re-enter here" value="<?=set_value('password_retype');?>">

		  <?php if(!empty($errors['password_retype'])):?>
		  	<small class="text-danger"><?=$errors['password_retype']?></small>
		  <?php endif;?>
		</div><br>

		<a href="index.php?pg=admin&tab=users">
			<button type="button" class="btn btn-danger" >Cancel</button>
		</a>

		<button class="btn btn-primary float-end" >Create</button>
	</form>
	
</div>




<?php require views_path('partials/footer'); ?>