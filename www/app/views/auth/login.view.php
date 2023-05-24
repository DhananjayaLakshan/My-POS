
<?php require views_path('partials/header');// views/partials/header.view.php ?>



<div class="container-fluid border col-lg-5 col-md-6 mt-5 p-4 shadow">

	<center>
		<h1><i class="fa fa-user"></i></h1>
		<h3> User Login</h3>
		<div> <?=esc(APP_NAME)?> </div>
	</center><br>

	<form method="post">

		<div class="mb-3">
		  <input type="email" name="email" class="form-control <?=!empty($errors['email']) ? 'border-danger':'' ?>" id="exampleFormControlInput1" placeholder="Email" value="<?=set_value('email');?>">

		  <?php if(!empty($errors['email'])):?>
		  	<small class="text-danger"><?=$errors['email']?></small>
		  <?php endif;?>
		</div>

		<div class="mb-3">
		  <input type="password" name="password" class="form-control <?=!empty($errors['password']) ? 'border-danger':'' ?>" id="exampleFormControlInput1" placeholder="Password">

  		  <?php if(!empty($errors['password'])):?>
		  	<small class="text-danger"><?=$errors['password']?></small>
		  <?php endif;?>
		</div><br>

		
		<div class="row">		
			<button  class="btn btn-primary float-end" style="font-size: 20px;">Login</button>
		</div>	

	</form>
	
</div>




<?php require views_path('partials/footer'); ?>