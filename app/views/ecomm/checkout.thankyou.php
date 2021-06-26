<?php $this->view('header', $data); ?>

<div class="thank-you">
  <style>
    .thank-you {
      padding: 2rem;
      text-align: center;

    }

    .img-responsive {
      position: relative;
      height: 300px;
      /* top: 10px; */
      left: 28%;
      align-items: center;

    }

    .action>a {
      margin-top: 20px;
      margin-left: 5px;
      margin-top: 1rem;
      margin: 10px 20px 0 0;
    }

    .txt {
      color: green;
    }

    .btn {
      border-radius: 5px !important;
    }

    h1 {
      text-transform: uppercase;
      margin-bottom: 5rem;
      font-size: 4rem;
    }
  </style>

  <!-- <img src="<?= ASSETS ?>images/Thank-you-page.jpg" alt="" class="img-responsive"> -->
  <h1>Thank you for shopping with us!</h1>
  <h2 class="txt">Your order was successful!</h2>

  <div class="action">What would you like to do next? <br>
    <a href="<?= ROOT ?>shop">
      <input type="button" value="Continue shopping" class="btn btn-primary">
    </a>
    <a href="<?= ROOT ?>profile">
      <input type="button" value="View your orders" class="btn btn-primary">
    </a>
  </div>
</div>

<?php $this->view('footer', $data); ?>