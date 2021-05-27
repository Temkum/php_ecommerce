	<?php $this->view('header', $data); ?>

	<style>
	  .txt {
	    text-align: center;
	  }

	  .col-display {
	    float: none;
	    display: inline-block;
	  }

	  #form {
	    margin-top: 5px;
	  }
	</style>

	<section id="form">
	  <div class="container">
	    <div class="row txt">

	      <div class="col-sm-4 col-display">
	        <div class="signup-form">
	          <!--sign up form-->
	          <h2>New User Signup!</h2>
	          <form method="POST">
	            <input name="name" type="text" placeholder="Name" />
	            <input name="email" type="email" placeholder="Email Address" />
	            <input name="password" type="password" placeholder="Password" />
	            <input name="confirm_password" type="password" placeholder="Confirm Password" />
	            <button type="submit" class="btn btn-default">Signup</button>
	          </form>
	        </div> <br>
	        <a href="login">Already have an account? Login here</a>
	      </div>

	    </div>
	  </div>
	</section>
	<!--/form-->

	<?php $this->view('footer', $data); ?>