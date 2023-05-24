<?php require views_path('partials/header');// views/partials/header.view.php ?>

<style type="text/css">

	.hide{
		display: none;
	}

	@keyframes appear{
		0%{opacity: 0;transform: translateY(-100px);}
		100%{opacity: 1;transform: translateY(0px);}
	}

</style>
<div class="d-flex">
	<div style="min-height: 600px;" class="shadow-sm col-7 p-4">

		<!-- Search bar -->
			<div class="input-group mb-3"><h3>Items</h3>
			  <input onkeyup="check_for_enter_key(event);" oninput="search_item(event);" type="text" class="ms-4 form-control js-search" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1" autofocus>
			  <span class="input-group-text" id="basic-addon1"> <i class="fa fa-search"></i> </span>
			</div>
		<!-- end-Search bar -->

		<!-- start-CARD container-->			
		<div onclick="add_item(event)" class="js-products d-flex ms-4" style="flex-wrap: wrap; height: 90%; overflow-y: scroll;">
		
		</div>
		<!-- end-CARD container-->

	</div>

	<div class="col-5 bg-light p-2">

		<div><center><h3>Cart <div class="js-item-count badge bg-primary rounded-circle">0</div></h3></center></div>

		<!-- Table - start -->
		<div class="table-responsive" style="height: 400px; overflow-y: scroll;">
			<table class="table table-striped table-hover">
				<tr>
					<th>Image</th>
					<th>Description</th>
					<th>Amount</th>
				</tr>

				<tbody class="js-items">
		
				</tbody>
			</table>
		</div>
		<!-- end - Table -->

		<div class="js-gTotal alert alert-danger" style="font-size: 25px;">Total : Rs.0.00 </div>

		<div class="">
			<button onclick="show_model('amount-paid')" class="btn btn-success my-2 w-100 py-3">Checkout</button>
			<button onclick="clear_all()" class="btn btn-primary my-2 w-100">Clear All</button>
		</div>
	</div>
</div>

<!--modals-->

	<!--enter amount modals-->
	<div role="close-button" onclick="hide_model(event,'amount-paid')" class="js-amount-paid-model hide" style="animation: appear 0.5s ease;  background-color: #000000aa ; width:100%; height: 100%; position: fixed; left: 0px; top: 0px; z-index: 5;">

		<div style="width:500px; min-height: 200px; background-color:white; padding: 10px;margin: auto; margin-top: 100px;">
			<h5>Checkout <button role="close-button" onclick="hide_model(event,'amount-paid')" class="btn btn-danger float-end p-0 px-2" >X</button> </h5>
			<br>
			<input autocomplete="off" onkeyup="if(event.keyCode == 13)validate_amount_paid(event)" class="js-amount-paid-input form-control" type="text" placeholder="Enter amount paid" name="paid_amount">
			<br>

			<button role="close-button" onclick="hide_model(event,'amount-paid')" class="btn btn-danger">Cancel</button>	
			<button onclick="validate_amount_paid(event)" class="btn btn-success float-end">Next</button>	
		</div>
	</div>
	<!--end enter amount modals-->

<!--change amount modals-->
	<div role="close-button" onclick="hide_model(event,'change')" class="js-change-model hide" style="animation: appear 0.5s ease;  background-color: #000000aa ; width:100%; height: 100%; position: fixed; left: 0px; top: 0px; z-index: 5;">

		<div style="width:500px; min-height: 200px; background-color:white; padding: 10px;margin: auto; margin-top: 100px;">
			<h5>Change : <button role="close-button" onclick="hide_model(event,'change')" class="btn btn-danger float-end p-0 px-2" >X</button> </h5>
			<br>
			<div class="js-change-input form-control text-center" style="font-size:60px;" >Rs. 0.00</div>
			<br>
			<center>
				<button role="close-button" onclick="hide_model(event,'change')" class="js-btn-close-change btn btn-lg btn-danger">Continue</button>	
			</center>
		</div>
	</div>
	<!--end change amount modals-->

<!--end-modals-->


<script>

	var PRODUCTS 	= [];
	var ITEMS		= [];
	var BARCODE 	= false;
	var GTOTAL 		= 0;
	var CHANGE 		= 0;
	var RECEIPT_WINDOW = null;

	var main_input = document.querySelector(".js-search");
	function search_item(e)
	{

		var text = e.target.value.trim();
	
		var data = {};
		data.data_type = "search";
		data.text = text;
		send_data(data)

	}

	
	function send_data(data)
	{
		var ajax = new XMLHttpRequest();
		
		ajax.addEventListener('readystatechange',function(e){

			if (ajax.readyState == 4) 
			{



				if (ajax.status == 200) 
				{
					if (ajax.responseText.trim() != "")
					{
						handle_result(ajax.responseText);
					}else
					{
						if(BARCODE)
						{
							alert("That item was not found");
						}
					}
				}else{
					console.log("An error occured. Error code: " + ajax.status + "Error message: " + ajax.statusText);
					console.log(ajax);
				}

				//crear main input if enter was prossed
				if (BARCODE) 
				{
					main_input.value = "";
					main_input.focus();
				}

				BARCODE 	= false;

			}

			
		});

		ajax.open('post','index.php?pg=ajax',true);
		ajax.send(JSON.stringify(data));
	}

	function handle_result(result)
	{ //console.log(result);

		var obj = JSON.parse(result);

		if(typeof obj != "undefined")
		{
			//valid json		
			if(obj.data_type == "search")
			{
				var mydiv = document.querySelector(".js-products");

				mydiv.innerHTML = "";
				PRODUCTS = [];

				var mydiv = document.querySelector(".js-products");

				if(obj.data != "")
				{
					PRODUCTS = obj.data;

					for(var i = 0; i < obj.data.length; i++)
					{
						mydiv.innerHTML += product_html(obj.data[i],i);
					}

					if(BARCODE && PRODUCTS.length == 1)
					{
						add_item_from_index(0);
					}
				}
				
			}
			
		}

	}


function product_html(data,index)
{
	return `
	<!-- start-CARD Item-->
		<div class="card border-0" style="max-width: 200px; min-width: 200px;">
			<a href="#">
				<img index="${index}" src="${data.image}" class="w-75 rounded border">
			</a>
			<div class="p-2" >
				<div class="text-muted">${data.description}</div>
				<div style="font-size: 20px;"> <b>${data.amount}</b> </div>
			</div>
		</div>
	<!-- end-CARD Item-->`;
}

function item_html(data,index)
{
	return `
	
		<!-- start - Cart Item -->
		<tr>	

			<td style="width:110px;"><img src="${data.image}" class="rounded border" style="width:100px; height:100px;"></td>

				<td class="text-primary">
					${data.description}

					<div class="input-group my-3" style="max-width:130px;">

						<span index="${index}" onclick="change_qty('down',event)" class="input-group-text" style="cursor: pointer;"> 
							  	<i class="fa fa-minus text-primary"></i> 
							  </span>

						<input index="${index}" onblur="change_qty('input',event)" type="text" class="form-control text-primary" placeholder="1" value="${data.qty}">

						<span index="${index}" onclick="change_qty('up',event)" class="input-group-text" style="cursor: pointer;"> 
							<i class="fa fa-plus text-primary"></i> 
						</span>

					</div>

				</td>

			<td style="font-size: 20px;">
				<b>Rs.${data.amount}</b>
				<button onclick="clear_item(${index})" class="float-end btn btn-danger btn-small"><i class="fa fa-times"></i></button>
			</td>

		</tr>
	<!-- end - Cart Item -->`;
}

function add_item_from_index(index)//ADD ITEMS to CART search by BARCODE
{
	//check if item exists
		for (var i = 0; i < ITEMS.length; i++) 
		{

			if(ITEMS[i].id == PRODUCTS[index].id)
			{
				ITEMS[i].qty += 1;
				refresh_items_display();
				return;
			}
		}

		var temp = PRODUCTS[index];
		temp.qty = 1;

		ITEMS.push(temp);//update item by adding what we are clicking
		refresh_items_display();

}


function add_item(e)//ADD ITEMS to CART
{

	if (e.target.tagName == "IMG") 
	{
		var index = e.target.getAttribute("index");//get index what clicking

		add_item_from_index(index);
	}
}

function refresh_items_display()
{
	var item_count = document.querySelector(".js-item-count");
	item_count.innerHTML = ITEMS.length;//display array length in item count top of the cart

	var item_div = document.querySelector(".js-items");
	item_div.innerHTML = "";

	var grandTotal = 0;

	for (var i = ITEMS.length - 1; i >= 0; i--) 
	{
		item_div.innerHTML += item_html(ITEMS[i],i);//display adding cart items
		
		grandTotal += (ITEMS[i].qty * ITEMS[i].amount);//calculate grand total
	}

	var gtotal_div = document.querySelector(".js-gTotal");
	gtotal_div.innerHTML = "Total : Rs." + grandTotal.toFixed(2);//display garnd total

	GTOTAL = grandTotal;

}

function clear_all()
{
	if (!confirm("Are you sure you want to clear all items in the list??!!")) 
	{
		return;
	}

	ITEMS = [];
	refresh_items_display();

}


function clear_item(index)
{
	if (!confirm("Remove item??!!")) 
	{
		return;
	}

	ITEMS.splice(index,1);//remove one item from the array
	refresh_items_display();

}

function change_qty(direction,e)
{
	var index = e.currentTarget.getAttribute("index");

	if(direction == "up")
	{
		ITEMS[index].qty += 1;

	}else if(direction == "down")
	{
		ITEMS[index].qty -= 1;
	}else
	{
		ITEMS[index].qty = parseInt(e.currentTarget.value);
	}

	//make sure qty is not mines 
	if(ITEMS[index].qty < 1)
	{
		ITEMS[index].qty = 1;
	}

	refresh_items_display();
}

function check_for_enter_key(e)//check if press ENTER KEY
{
	if (e.keyCode == 13) 
	{
		BARCODE = true;
		search_item(e);
	}
}

function show_model(modal)
{
	if(modal == "amount-paid")
	{

		if (ITEMS.length == 0)
		{
			alert("Please add at least one item to the cart!!");
			return;
		}

		var mydiv = document.querySelector(".js-amount-paid-model");
		mydiv.classList.remove("hide");

		mydiv.querySelector(".js-amount-paid-input").value = "";
		mydiv.querySelector(".js-amount-paid-input").focus();

	}else if(modal == "change")
	{
		var mydiv = document.querySelector(".js-change-model");
		mydiv.classList.remove("hide");

		mydiv.querySelector(".js-change-input").innerHTML = "Rs. " + CHANGE;
		mydiv.querySelector(".js-btn-close-change").focus();
	}
	

	

}

function hide_model(e,modal)
{

	if( e == true || e.target.getAttribute("role") == "close-button")
	{
		if(modal == "amount-paid")
		{
			var mydiv = document.querySelector(".js-amount-paid-model");
			mydiv.classList.add("hide");
		}else if(modal == "change")
		{
			var mydiv = document.querySelector(".js-change-model");
			mydiv.classList.add("hide");
		}

	}
	
}

function validate_amount_paid(e)
{

	var amount = e.currentTarget.parentNode.querySelector(".js-amount-paid-input").value.trim();

	if (amount == "")
	{
		alert("Please Enter amount");
		document.querySelector(".js-amount-paid-input").focus();
		return;		
	}

	 amount = parseFloat(amount);

	if(amount < GTOTAL)
	{
		alert("Amount must be higher or equal to the total");
		return;
	}

	CHANGE = amount - GTOTAL;//calculate change
	CHANGE = CHANGE.toFixed(2);//set change to 2 decimal points

	hide_model(true,'amount-paid');
	show_model('change');

	//remove unwanted information
	var ITEMS_NEW = [];
	for (var i = 0; i < ITEMS.length; i++) {
		
		var tmp = {};
		tmp.id 	= ITEMS[i]['id'];
		tmp.qty = ITEMS[i]['qty'];

		ITEMS_NEW.push(tmp);		
	}

	//send cart data throught ajax
	send_data({

		data_type:"checkout",
		text:ITEMS_NEW

	});

	//open receipt page
	print_receipt({

		company:'My POS',
		amount:amount,
		change:CHANGE,
		gtotal:GTOTAL,
		data:ITEMS
	});

	//clear items after calculate change
	ITEMS = [];
	refresh_items_display();

	//reload products
	send_data({

	data_type:"search",
	text:""

	});

}

function print_receipt(obj)
{

	var vars = JSON.stringify(obj);

	RECEIPT_WINDOW = window.open('index.php?pg=print&vars='+vars,'printpage',"width=500px;");

	setTimeout(function(){

		RECEIPT_WINDOW.close();

	},3000);
	

}


send_data({

	data_type:"search",
	text:""

});





</script>



<?php require views_path('partials/footer'); ?>