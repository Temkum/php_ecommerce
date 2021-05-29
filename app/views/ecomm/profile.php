	<?php $this->view('header', $data); ?>

	<div class="profile container">
	  <style>
	    .profile {
	      min-height: 250px;
	    }
	  </style>

	  <h2 class="text-center">Admin profile</h2>
	  <section class="main-wrapper">
	    <section class="wrapper">
	      <div class="row mt">
	        <div class="col-md-4 mb">
	          <!-- WHITE PANEL - TOP USER -->
	          <div class="white-panel pn">
	            <div class="white-header">
	              <h5>TOP USER</h5>
	            </div>
	            <p><img src="<?= ASSETS ?>admin/img/ui-zac.jpg" class="img-circle" width="80"></p>
	            <p><b>Zac Snider</b></p>
	            <div class="row">
	              <div class="col-md-6">
	                <p class="small mt">MEMBER SINCE</p>
	                <p>2012</p>
	              </div>
	              <div class="col-md-6">
	                <p class="small mt">TOTAL SPEND</p>
	                <p>$ 47,60</p>
	              </div>
	            </div>
	          </div>
	        </div><!-- /col-md-4 -->
	      </div><!-- /row -->
	    </section>
	  </section>
	</div>

	<?php $this->view('footer', $data); ?>