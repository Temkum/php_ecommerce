<?php $this->view('header', $data); ?>

<?php
if (isset($errors) && count($errors) > 0) {

	foreach ($errors as $error) {
		echo '<div class="alert alert-danger">$errors->error</div>';
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

			<?php
			$name = '';
			$address2 = '';
			$address1 = '';
			$zip = '';
			$mobile_phone = '';
			$home_phone = '';
			$message = '';
			$state = '';
			$country = '';

			if (isset($POST_DATA)) {

				extract($POST_DATA);
			}
			?>

			<form method="POST">
				<div class="shopper-informations">
					<div class="row check-out">
						<div class="col-sm-8 clearfix">
							<div class="bill-to">
								<p>Bill To</p>
								<div class="form-one">
									<input name="name" value="<?= $name ?>" class="form-control mb-5" type="text" placeholder="Name *" autofocus="autofocus" required>

									<input name="address1" value="<?= $address1 ?>" class="form-control mb-5" type="text" placeholder="Address 1 *" required>

									<input name="address2" value="<?= $address2 ?>" class="form-control mb-5" type="text" placeholder="Address 2">

									<input name="zip" value="<?= $zip ?>" class="form-control mb-5" type="text" placeholder="Zip / Postal Code *">
								</div>

								<div class="form-two">
									<select class="form-control mb-5" name="country" class="js-country" oninput="getStates(this.value)" required>
										<?php if ($country == '') {
											# code...
											echo "<option>Country</option>";
										} else {
											echo "<option>$country</option>";
										} ?>
										<?php if (isset($countries) && $countries) : ?>
											<?php foreach ($countries as $row) : ?>

												<option value="<?= $row->country ?>"><?= $row->country ?></option>

											<?php endforeach; ?>
										<?php endif; ?>
									</select>
									<select class="form-control mb-5" value="<?= $state ?>" name="state" class="js-state" required>
										<?php if ($state == '') {
											# code...
											echo "<option>State / Province / Region</option>";
										} else {
											echo "<option>$state</option>";
										} ?>
									</select>

									<input name="mobile_phone" value="<?= $mobile_phone ?>" class="form-control mb-5" type="text" placeholder="Mobile Phone *" required>
									<input name="home_phone" value="<?= $home_phone ?>" class="form-control mb-5" type="text" placeholder="Home Phone">
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="order-message form-three">
								<p>Shipping Order</p>
								<textarea name="message" placeholder="Notes about your order, Special Notes for Delivery" rows="16"><?= $message ?></textarea>
							</div>
						</div>
					</div>

					<a class="btn btn-primary pull-left" href="<?= ROOT ?>/cart">Back to Cart</a>
					<input type="submit" value="Continue to payments" name="" class="btn btn-primary checkout pull-right">
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
	function getStates(country) {
		sendData({
			id: country.trim()
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

		let info = {};
		info.data_type = data_type;
		info.data = data;

		ajax.open('POST', "<?= ROOT ?>ajaxcheckout", true);
		ajax.send(JSON.stringify(info));
	}

	function handleResult(result) {
		console.log(result);

		if (result != "") {
			let obj = JSON.parse(result);

			if (typeof obj.data_type != "undefined") {
				if (obj.data_type == "getStates") {

					let select_input = document.querySelector('.js-state');
					select_input.innerHTML = "<option>State / Province / Region</option>";
					// loop through the array of obj
					for (let i = 0; i < obj.data.length; i++) {

						select_input.innerHTML += "<option value='" + obj.data[i].state + "'>" + obj.data[i].state + "</option>"
					}
				}
			}
		}
	}
</script>

<?php $this->view('footer', $data); ?>