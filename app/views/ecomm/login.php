	<?php $this->view('header', $data); ?>

	<section id="form">
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<!-- LOGIN FORM -->
					<div class="login-form">
						<h2>Login to your account</h2>
						<form action="#">
							<input type="text" placeholder="Name" />
							<input type="email" placeholder="Email Address" />
							<span>
								<input type="checkbox" class="checkbox">
								Keep me signed in
							</span>
							<button type="submit" class="btn btn-default">Login</button>
						</form>
						<br>
						<a href="signup">Don't have an account? Signup here</a>
					</div>
					<!-- end login form-->
				</div>
			</div>
		</div>
	</section>
	<!--/form-->

	<?php $this->view('footer', $data); ?>