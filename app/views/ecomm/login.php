	<?php $this->view('header', $data); ?>

	<style>
		.txt-center {
			text-align: center;
		}

		.col-display {
			float: none;
			display: inline-block;
		}

		#form {
			margin-top: 5px;
		}

		.error {
			color: red;
			float: none;
			display: block;
			font-size: 1.5rem;
		}
	</style>

	<section id="form">
		<div class="container">
			<div class="row txt-center">
				<span class="error"><?php errorCheck() ?></span>
				<div class="col-sm-4 col-sm-offset-1 col-display">
					<!-- LOGIN FORM -->
					<div class="login-form">
						<h2>Login to your account</h2>
						<form method="POST">
							<input name="email" type="email" placeholder="Email address" />
							<input name="password" type="password" placeholder="Enter password" />
							<span>
								<input type="checkbox" class="checkbox">
								Keep me signed in
							</span>
							<button type="submit" class="btn btn-default">Login</button>
						</form>
						<br>
						<a href="signup">Don't have an account? Signup here.</a>
					</div>
					<!-- end login form-->
				</div>
			</div>
		</div>
	</section>

	<!--/form-->

	<?php $this->view('footer', $data); ?>