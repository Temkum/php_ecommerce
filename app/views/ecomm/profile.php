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
				margin-top: 3rem;
			}
		</style>

		<h2 class="text-center">Admin profile</h2>

		<section class="main-wrapper">
			<section class="wrapper">
				<div class="row mt">
					<div class="order">
						<div class="col-md-4 mb">
							<!-- WHITE PANEL - TOP USER -->
							<div class="white-panel pn">
								<div class="white-header">
									<h5 class="my-header">My account</h5>
								</div>
								<p><img src="<?= ASSETS ?>admin/img/ui-zac.jpg" class="img-circle" width="80"></p>
								<p class="mt"><b><?= $data['user_data']->name ?></b></p>
								<div class="row">
									<div class="col-md-6">
										<p class="small mt">MEMBER SINCE</p>
										<p><?= date('jS M Y', strtotime($data['user_data']->date)) ?></p>
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

						<section class="col-md-8 mt-5">
							<?php if (is_array($orders)) : ?>
								<div class="order-table">
									<table class="table">
										<thead>
											<tr>
												<th>Order No</th>
												<th>Amount</th>
												<th>Order Date</th>
												<th>Delivery Address</th>
												<th>Country</th>
												<th>State/City</th>
												<th>Mobile Phone</th>
												<th>Action</th>
											</tr>
										</thead>

										<tbody>
											<?php foreach ($orders as $order) : ?>
												<tr>
													<td><?= $order->id ?></td>
													<td>$<?= $order->total ?></td>
													<td><?= date('jS M Y H: a', strtotime($order->date)) ?></td>
													<td><?= $order->delivery_address ?></td>
													<td><?= $order->country ?></td>
													<td><?= $order->state ?></td>
													<td><?= $order->mobile_phone ?></td>
												<?php endforeach; ?>
												</tr>
										</tbody>
									</table>
								</div>
							<?php else : ?>
								<div>This user has no orders yet</div>
							<?php endif; ?>
						</section>
					</div>

				</div><!-- /row -->
			</section>
		</section>
	</div>

	<?php $this->view('footer', $data); ?>