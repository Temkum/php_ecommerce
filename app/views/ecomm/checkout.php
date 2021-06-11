<?php $this->view('header', $data); ?>

<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
				<li><a href="<?= ROOT ?>home">Home</a></li>
				<li class="active">Checkout</li>
			</ol>
		</div>
		<!--/breadcrumbs-->

		<div class="register-req">
			<p>Please Register an account to Checkout easily and get access to your order history, or use Checkout as Guest</p>
		</div>
		<!--/register-req-->

		<div class="shopper-informations">
			<div class="row check-out">
				<!-- <div class="col-sm-3">
					<div class="shopper-info">
						<p>Shopper Information</p>
						<form>
							<input type="text" placeholder="Display Name">
							<input type="text" placeholder="User Name">
							<input type="password" placeholder="Password">
							<input type="password" placeholder="Confirm password">
						</form>
						<a class="btn btn-primary" href="">Get Quotes</a>
						<a class="btn btn-primary" href="">Continue</a>
					</div>
				</div> -->
				<div class="col-sm-8 clearfix">
					<div class="bill-to">
						<p>Bill To</p>
						<div class="form-one">
							<form>
								<input type="text" placeholder="Name *" autofocus="autofocus" required>
								<input type="text" placeholder="Address 1 *" required>
								<input type="text" placeholder="Address 2">
								<input type="text" placeholder="Zip / Postal Code *">
							</form>
						</div>

						<div class="form-two">
							<form method="POST">
								<select name="country" class="js-country" oninput="getCountries(this.value)">
									<option>-- Country --</option>
									<?php if (isset($countries) && $countries) : ?>
										<?php foreach ($countries as $row) : ?>
											<option value="<?= $row->id ?>"><?= $row->country ?></option>
										<?php endforeach; ?>
									<?php endif; ?>
								</select>

								<select name="state" class="js-state" required>
									<option>-- State / Province / Region --</option>
								</select>

								<input type="text" placeholder="Phone *" required>
								<input type="text" placeholder="Mobile Phone">
							</form>
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
		</div>

		<a class="btn btn-primary pull-left" href="<?= ROOT ?>/cart">Back to Cart</a>
		<a href="<?= ROOT ?>checkout">
			<input type="button" value="Pay" name="" class="btn btn-primary checkout pull-right">
		</a>
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
					select_input.innerHTML = `<option>-- State / Province / Region --</option>`;

					for (let i = 0; i < obj.data.length; i++) {
						select_input.innerHTML += '<option value="' + obj.data[i].id + '">"' + obj.data[i].state + '"</option>';

					}
				}
			}

		}
	}
</script>



<?php $this->view('footer', $data); ?>