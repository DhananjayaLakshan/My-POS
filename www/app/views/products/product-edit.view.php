<?php require views_path('partials/header');// views/partials/header.view.php ?>

<div class="container-fluid border rounded p-4 m-2 col-lg-4 mx-auto shadow">
		<?php if(!empty($row)):?>
			<center> <h3 class="text-primary fw-bold"><i class="fa fa-burger"></i> Edit Product</h3> </center>
		
		<form method="post" enctype="multipart/form-data">

			<div class="mt-4 mb-3">		
			  <label for="productControlInput1" class="form-label">Product description</label>
			  <input value="<?=set_value('description',$row['description'])?>" name="description" type="text" class="form-control <?=!empty($errors['description']) ? 'border-danger':'' ?>" id="productControlInput1" placeholder="Product description">

			  <?php if(!empty($errors['description'])):?>
			  	<small class="text-danger"><?=$errors['description']?></small>
			  <?php endif;?>
			</div>	

			<div class="mb-3">		
			  <label for="barcodeControlInput1" class="form-label">Barcode</label>
			  <input value="<?=set_value('barcode',$row['barcode'])?>" name="barcode" type="text" class="form-control <?=!empty($errors['barcode']) ? 'border-danger':'' ?>" id="barcodeControlInput1" placeholder="Barcode">

			  <?php if(!empty($errors['barcode'])):?>
			  	<small class="text-danger"><?=$errors['barcode']?></small>
			  <?php endif;?>
			</div>	

			<div class="input-group mb-3">
			  <span class="input-group-text">Quantity : </span>	
			  <input value="<?=set_value('qty',$row['qty'])?>" name="qty" min="1" type="number" class="form-control <?=!empty($errors['qty']) ? 'border-danger':'' ?>" placeholder="Quantity" aria-label="Quantity">

			  <span class="input-group-text">Amount : </span>
			  <input name="amount" value="<?=set_value('amount',$row['amount'])?>" type="number" class="form-control <?=!empty($errors['amount']) ? 'border-danger':'' ?>" placeholder="Amount" aria-label="Amount">
			  
			</div>

			<?php if(!empty($errors['qty'])):?>
			  	<small class="text-danger"><?=$errors['qty']?></small>
			 <?php endif;?>

			 <?php if(!empty($errors['amount'])):?>
			  	<small class="text-danger"><?=$errors['amount']?></small>
			 <?php endif;?>
			 <br>

			<div class="mb-3">
			  <label for="formFile" class="form-label">Product Image</label>
			  <input name="image" class="form-control <?=!empty($errors['image']) ? 'border-danger':'' ?>" type="file" id="formFile">

			  <?php if(!empty($errors['image'])):?>
			  	<small class="text-danger"><?=$errors['image']?></small>
			  <?php endif;?>
			</div>
			<br>
			<img class="mx-auto d-block" src="<?=$row['image']?>" style="width:50%;">
			<br>
			<button class="btn btn-success float-end ">Save</button>
			<a href="index.php?pg=admin&tab=products">
				<button type="button" class="btn btn-primary">Cancel</button>
			</a>

		</form>
	<?php else:?>
		Product was not found <br><br>
		<a href="index.php?pg=admin&tab=products">
			<button type="button" class="btn btn-primary">Back to produts</button>
		</a>
		<?php endif;?>
	

</div>
















<?php require views_path('partials/footer'); ?>