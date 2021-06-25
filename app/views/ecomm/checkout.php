<?php $this->view('header', $data); ?>

<?php
if (isset($errors) && count($errors) > 0) {

	foreach ($errors as $error) {
		echo '<div class="alert alert-danger">$errors</div>';
	}
}

?>
<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
				<li><a href="<?= ROOT ?>home">Home</a></li>
				<li class="active text-capitalize">Checkout</li>
			</ol>
		</div>
		<!--/breadcrumbs-->

		<?php if (is_array($ROWS)) : ?>
			<div class="register-req">
				<p>Please Register an account to Checkout easily and get access to your order history, or use Checkout as Guest</p>
			</div>
			<!--/register-req-->
			<form method="POST">
				<div class="shopper-informations">
					<div class="row check-out">
						<div class="col-sm-8 clearfix">
							<div class="bill-to">
								<p>Bill To</p>
								<div class="form-one">
									<input name="name" class="form-control mb-5" type="text" placeholder="Name *" autofocus="autofocus" required>
									<input name="address1" class="form-control mb-5" type="text" placeholder="Address 1 *" required>
									<input name="address2" class="form-control mb-5" type="text" placeholder="Address 2">
									<input name="zip" class="form-control mb-5" type="text" placeholder="Zip / Postal Code *">
								</div>

								<div class="form-two">
									<select class="form-control mb-5" name="country" class="js-country" oninput="getStates(this.value)" required>
										<option>-- Country --</option>
										<?php if (isset($countries) && $countries) : ?>
											<?php foreach ($countries as $row) : ?>

												<option value="<?= $row->id ?>"><?= $row->country ?></option>

											<?php endforeach; ?>
										<?php endif; ?>
									</select>
									<select class="form-control mb-5" name="state" class="js-state" required>
										<option>-- State / Province / Region --</option>
									</select>
									<input name="mobile_phone" class="form-control mb-5" type="text" placeholder="Mobile Phone *" required>
									<input name="home_phone" class="form-control mb-5" type="text" placeholder="Home Phone">
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="order-message form-three">
								<p>Shipping Order</p>
								<textarea name="message" placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>
							</div>
						</div>
					</div>

					<a class="btn btn-primary pull-left" href="<?= ROOT ?>/cart">Back to Cart</a>
					<input type="submit" value="Pay" name="" class="btn btn-primary checkout pull-right">
				</div>
			</form>
		<?php else : ?>
			<div class="no-products">Please add items in cart before checkout!</div>
		<?php endif; ?>
	</div>
</section>
<!-- end cart_items-->
<br> <br>

<script>
	function getStates(id) {
		sendData({
			id: id.trim()
		}, 'getStates');
	}

	function sendData(data = {}, data_type) {
		// create new ajax object
		let ajax = new XMLHttpRequest();

		ajax.addEventListener('readystatechange', function() {
			if (ajax.readyState == 4 && ajax.status == 200) {
				handleResult(ajax.responseText);
			}
		});

		ajax.open('POST', "<?= ROOT ?>ajaxcheckout/" + data_type + "/" + JSON.stringify(data), true); //true here is to tell it to run in the background
		ajax.send();
	}

	function handleResult(result) {
		console.log(result);

		if (result != "") {
			let obj = JSON.parse(result);

			if (typeof obj.data_type != "undefined") {
				if (obj.data_type == "getStates") {

					let select_input = document.querySelector('.js-state');
					select_input.innerHTML = "<option>-- State / Province / Region --</option>";
					// loop through the array of obj
					for (let i = 0; i < obj.data.length; i++) {

						select_input.innerHTML += "<option value='" + obj.data[i].id + "'>" + obj.data[i].state + "</option>"
					}
				}
			}
		}
	}
</script>

<?php $this->view('footer', $data); ?>