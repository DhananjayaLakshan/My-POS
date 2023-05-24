<?php require views_path('partials/header');// views/partials/header.view.php ?>

<div class="container-fluid border rounded p-4 m-2 col-lg-4 mx-auto shadow">
		<?php if(!empty($row)):?>
			<center> <h3 class="text-danger fw-bold"><i class="fa fa-burger"></i> Delete Sale</h3> </center>
			<div class="alert alert-danger text-center">Are you sure you want to delete this sale??!!</div>
		
	<form method="post" enctype="multipart/form-data">

		<div class="mt-4 mb-3">		
			<label for="saleControlInput1" class="form-label">Sale description</label>
			<input disabled value="<?=set_value('description',$row['description'])?>" name="description" type="text" class="form-control <?=!empty($errors['description']) ? 'border-danger':'' ?>" id="saleControlInput1" placeholder="Sale description">
		</div>	

		<div class="mb-3">		
		  <label for="barcodeControlInput1" class="form-label">Barcode</label>
		  <input disabled value="<?=set_value('barcode',$row['barcode'])?>" name="barcode" type="text" class="form-control <?=!empty($errors['barcode']) ? 'border-danger':'' ?>" id="barcodeControlInput1" placeholder="Barcode">
		</div>	

		<div class="mb-3">		
		  <label for="barcodeControlInput1" class="form-label">Total</label>
		  <input disabled value="<?=set_value('total',$row['total'])?>" name="total" type="text" class="form-control <?=!empty($errors['total']) ? 'border-danger':'' ?>" id="barcodeControlInput1" placeholder="Barcode">
		</div>	
				
		<div class="mb-3">		
		  <label for="barcodeControlInput1" class="form-label">Date</label>
		  <input disabled value="<?=set_value('date',$row['date'])?>" name="date" type="text" class="form-control <?=!empty($errors['date']) ? 'border-danger':'' ?>" id="barcodeControlInput1" placeholder="Barcode">
		</div>	
			
		<button class="btn btn-danger float-end ">Delete</button>
		<a href="index.php?pg=admin&tab=sales">
			<button type="button" class="btn btn-primary">Cancel</button>
		</a>

	</form>
	<?php else:?>
		That record was not found <br><br>
		<a href="index.php?pg=admin&tab=sales">
			<button type="button" class="btn btn-primary">Back to sales</button>
		</a>
		<?php endif;?>
	

</div>
















<?php require views_path('partials/footer'); ?>