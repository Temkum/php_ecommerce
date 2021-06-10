<?php $this->view('header', $data); ?>

<section id="cart_items">
	<style>
		.no-products {
			text-align: center !important;
			border: 0;
		}

		.table {
			margin-top: 20px !important;
		}
	</style>
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
				<li><a href="#">Home</a></li>
				<li class="active">Shopping Cart</li>
			</ol>
		</div>
		<div class="table-responsive cart_info">
			<table class="table table-condensed">
				<thead>
					<tr class="cart_menu">
						<td class="image">Item</td>
						<td class="description"></td>
						<td class="price">Price</td>
						<td class="quantity">Quantity</td>
						<td class="total">Total</td>
						<td></td>
					</tr>
				</thead>
				<tbody>
					<?php if ($ROWS) : ?>
						<?php foreach ($ROWS as $row) : ?>
							<tr>
								<td class="cart_product">
									<a href=""><img src="<?= ROOT ?><?= $row->image ?>" alt="<?= $row->description ?>" width="50" height="50"></a>
								</td>
								<td class="cart_description">
									<h4><a href=""><?= $row->description ?></a></h4>
								</td>
								<td class="cart_price">
									<p>$<?= $row->price ?></p>
								</td>
								<td class="cart_quantity">
									<div class="cart_quantity_button">
										<a class="cart_quantity_down" href="<?= ROOT ?>addtocart/decreaseQty/<?= $row->id ?>"> - </a>
										<input oninput="editQuantity(this.value, '<?= $row->id ?>')" class="cart_quantity_input" type="text" name="quantity" value="<?= $row->cart_qty ?>" autocomplete="off" size="2">
										<a class="cart_quantity_up" href="<?= ROOT ?>addtocart/addQty/<?= $row->id ?>"> + </a>
									</div>
								</td>
								<td class="cart_total">
									<p class="cart_total_price">$<?= $row->price * $row->cart_qty ?></p>
								</td>
								<td class="cart_delete">
									<a onclick="deleteItem(this.getAttribute('delete_id'))" delete_id="<?= $row->id ?>" class="cart_quantity_delete" href="<?= ROOT ?>addtocart/removeCartItem/<?= $row->id ?>"><i class="fa fa-times"></i></a>
								</td>
							</tr>
						<?php endforeach; ?>
					<?php else : ?>
						<div class="no-products">Cart is empty!</div>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</section>
<!-- end cart_items-->

<section id="do_action">
	<div class="container">
		<div class="heading">
			<h3>What would you like to do next?</h3>
			<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="chose_area">
					<ul class="user_option">
						<li>
							<input type="checkbox">
							<label>Use Coupon Code</label>
						</li>
						<li>
							<input type="checkbox">
							<label>Use Gift Voucher</label>
						</li>
						<li>
							<input type="checkbox">
							<label>Estimate Shipping & Taxes</label>
						</li>
					</ul>
					<ul class="user_info">
						<li class="single_field">
							<label>Country:</label>
							<select>
								<option>United States</option>
								<option>Bangladesh</option>
								<option>UK</option>
								<option>India</option>
								<option>Pakistan</option>
								<option>Ucrane</option>
								<option>Canada</option>
								<option>Dubai</option>
							</select>

						</li>
						<li class="single_field">
							<label>Region / State:</label>
							<select>
								<option>Select</option>
								<option>Dhaka</option>
								<option>London</option>
								<option>Dillih</option>
								<option>Lahore</option>
								<option>Alaska</option>
								<option>Canada</option>
								<option>Dubai</option>
							</select>

						</li>
						<li class="single_field zip-field">
							<label>Zip Code:</label>
							<input type="text">
						</li>
					</ul>
					<a class="btn btn-default update" href="">Get Quotes</a>
					<a class="btn btn-default check_out" href="">Continue</a>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="total_area">
					<ul>
						<li>Cart Sub Total <span>$59</span></li>
						<li>Eco Tax <span>$2</span></li>
						<li>Shipping Cost <span>Free</span></li>
						<li>Total <span>$61</span></li>
					</ul>
					<a class="btn btn-default update" href="">Update</a>
					<a class="btn btn-default check_out" href="">Check Out</a>
				</div>
			</div>
		</div>
	</div>
</section>
<!--/#do_action-->

<script>
	function editQuantity(quantity, id) {
		if (isNaN(quantity))
			return;

		sendData({
			quantity: quantity.trim(),
			id: id.trim()
		}, 'editQuantity');
	}

	function deleteItem(id) {
		sendData({
			id: id.trim()
		}, 'deleteItem');
	}

	function sendData(data = {}, data_type) {
		// create new ajax object
		let ajax = new XMLHttpRequest();

		ajax.addEventListener('readystatechange', function() {
			if (ajax.readyState == 4 && ajax.status == 200) {
				handleResult(ajax.responseText);
			}
		});

		ajax.open('POST', "<?= ROOT ?>ajaxcart/" + data_type + "/" + JSON.stringify(data), true); //true here is to tell it to run in the background
		ajax.send();
	}

	function handleResult(result) {

		console.log(result);
		if (result != "") {
			let obj = JSON.parse(result);

			if (typeof obj.data_type != "undefined") {
				if (obj.data_type == "deleteItem") {
					windows.location.href = windows.location.href;
				} else
				if (obj.data_type == 'editQuantity') {
					windows.location.href = windows.location.href; //refresh active window
				}
			}

		}
	}
</script>

<?php $this->view('footer', $data); ?>