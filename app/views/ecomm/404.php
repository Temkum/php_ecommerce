<?php $this->view('header', $data); ?>

<div class="container text-center">
    <style>
        .content-404 h2 a {
            background: #FE980F;
            color: #FFFFFF;
            font-family: 'Roboto', sans-serif;
            font-size: 16px;
            font-weight: 300;
            padding: 8px 40px;
        }

        .content-404 h2 {
            margin-bottom: 30px;
            margin-top: 10px;
        }

        .content-404 img {
            max-width: 300px;
        }

        .logo-404 {
            margin-top: 10px;
        }
    </style>

    <div class="logo-404">
        <a href="<?= ROOT ?>index"><img src="<?= ASSETS ?>images/home/logo.png" alt="" /></a>
    </div>
    <div class="content-404">
        <img src="<?= ASSETS ?>images/404/404.png" class="img-responsive" alt="" />
        <h2><b>OPPS!</b> We Couldn’t find this Page</h2>
        <p>Uh... So it looks like something is broken.</p>
        <h2><a href="<?= ROOT ?>index">Go back Home</a></h2>
    </div>
</div>


<?php $this->view('footer', $data); ?>