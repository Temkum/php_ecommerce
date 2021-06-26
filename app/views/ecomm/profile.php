	<?php $this->view('header', $data); ?>

	<div class="profile container">
		<style>
			.profile {
				min-height: 500px;
				margin: auto;
			}

			.col-md-6 {
				color: #6e93ce;
			}

			.col-md-4 {
				background-color: #eee;
				text-align: center;
				box-shadow: 0px 0px 20px #aaa;
				border: solid thin #ddd;
				max-width: 30rem !important;
			}

			.mt {
				color: #000 !important;
				font-size: 1rem;
			}

			.amt {
				color: #6e93ce !important;
				font-size: 1.3rem;
			}

			.my-header {
				text-transform: uppercase;
				color: #000 !important;
			}

			.text-success,
			.text-danger {
				font-size: 1.3rem;
				cursor: pointer;
			}

			.text-info {
				color: #6e93ce !important;
			}

			.text-danger {
				color: red !important;
			}

			.order {
				display: flex;
			}

			.order-table {
				margin-left: 3rem;
			}

			.mt-5 {
				margin-top: 5rem;
			}

			.details {
				background-color: #eee;
				box-shadow: 0px 0px 10px #aaa;
				width: 100%;
				position: absolute;
				min-height: 100px;
				left: 0px;
				padding: 10px;
				z-index: 20;
			}

			.hide {
				display: none;
			}

			.order-detail {
				width: 100%;
			}

			.grand-total {
				float: right;
			}

			tbody {
				cursor: pointer;
			}

			.no-order {
				font-size: 2rem;
				background-color: #aaa;
				padding: 1.5rem;
				font-weight: 400;
			}

			.no-profile {
				margin-top: 20px;
				flex-direction: column !important;
				margin-left: 30rem;
			}
		</style>

		<h2 class="text-center">Admin profile</h2>

		<section class="main-wrapper">
			<section class="wrapper">
				<div class="row mt">
					<div class="order">
						<?php if (is_object($profile_data)) : ?>

							<div class="col-md-4 mb">
								<!-- WHITE PANEL - TOP USER -->
								<div class="white-panel pn">
									<div class="white-header">
										<h5 class="my-header">My account</h5>
									</div>
									<p><img src="<?= ASSETS ?>admin/img/ui-zac.jpg" class="img-circle" width="80"></p>
									<p class="mt"><b><?= $profile_data->name ?></b></p>
									<div class="row">
										<div class="col-md-6">
											<p class="small mt">MEMBER SINCE</p>
											<p><?= date('jS M Y', strtotime($profile_data->date)) ?></p>
										</div>
										<div class="col-md-6">
											<p class="small mt">TOTAL SPEND</p>
											<p class="amt">$ 47,60</p>
										</div>
									</div>
									<hr>
									<div class="row">
										<div class="col-md-6">
											<p class="btn btn-small text-info">Edit</p>
										</div>
										<div class="col-md-6">
											<p class="btn btn-small text-danger"><i class="fa fa-trash"></i> Delete</p>
										</div>
									</div>
								</div>
							</div><!-- end profile data -->
					</div>
				</div><!-- /row -->
			</section>

			<section class="col-md-8 mt-5 order-detail">
				<?php if (is_array($orders)) : ?>
					<div class="order-table">
						<!-- order table -->
						<table class="table">
							<thead>
								<tr>
									<th>Order No</th>
									<th>Total</th>
									<th>Order Date</th>
									<th>Delivery Address</th>
									<th>Country</th>
									<th>State/City</th>
									<th>Mobile Phone</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody onclick="showDetails(event)">
								<?php foreach ($orders as $order) : ?>
									<tr style="position: relative;">
										<td><?= $order->id ?></td>
										<td>$<?= $order->total ?></td>
										<td><?= date('jS M Y H a', strtotime($order->date)) ?></td>
										<td><?= $order->delivery_address ?></td>
										<td><?= $order->country ?></td>
										<td><?= $order->state ?></td>
										<td><?= $order->mobile_phone ?></td>
										<td><i class="fa fa-arrow-down"></i>

											<div class="js-order-details details hide">
												<a style="float: right; cursor:pointer;">Close</a>
												<h3>Order #<?= $order->id ?></h3>
												<table class="table">
													<thead>
														<tr>
															<th>Quantity</th>
															<th>Description</th>
															<th>Amount</th>
															<th>Total</th>
														</tr>
													</thead>
													<?php if (isset($order->details) && is_array($order->details)) : ?>
														<?php foreach ($order->details as $detail) : ?>
															<tbody>
																<tr>
																	<td><?= $detail->qty ?></td>
																	<td><?= $detail->description ?></td>
																	<td><?= $detail->amount ?></td>
																	<td><?= $detail->total ?></td>
																</tr>
															</tbody>
														<?php endforeach; ?>

													<?php else : ?>
														<div>No order details found for this order!</div>
													<?php endif; ?>
												</table>
												<h3 class="grand-total">Grand Total: <?= $order->total ?></h3>
											</div>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>

					<?php else : ?>
						<div class="text-center no-order">This user has no orders yet</div>
					<?php endif; ?>

				<?php else : ?>
					<div class="no-profile no-order">Oops! That profile could not be found!</div>
				<?php endif; ?>
					</div>
			</section>
		</section>
	</div>

	<script>
		function showDetails(e) {
			let row = e.target.parentNode;
			if (row.tagName != 'TR') row = row.parentNode;
			let details = row.querySelector('.js-order-details');
			// details.classList.toggle('hide');

			// get all rows
			const all = e.currentTarget.querySelectorAll('.js-order-details')
			for (let i = 0; i < all.length; i++) {
				const element = all[i];

				if (element != details) {
					element.classList.add('hide');
				}
			}

			// alternative
			if (details.classList.contains('hide')) {
				details.classList.remove('hide');
			} else {
				details.classList.add('hide');
			}
		}
	</script>

	<?php $this->view('footer', $data); ?>