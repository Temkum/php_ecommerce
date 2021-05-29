<?php $this->view('admin/header', $data);

$this->view('admin/sidebar', $data); ?>

<!-- ****************
      MAIN CONTENT
      ******************* -->
<!--main content start-->
<section id="main-content">
    <style>
        .txt {
            text-transform: uppercase;
        }
    </style>
    <section class="wrapper site-min-height">
        <h3 class="txt"><i class="fa fa-angle-right"></i> <?= $data['page_title'] ?> Dashboard</h3>
        <div class="row mt">
            <div class="col-lg-12">
                <p>Place your content here.</p>
            </div>
        </div>

    </section>
    <! --/wrapper -->
</section><!-- /MAIN CONTENT -->
<!--main content end-->

<?php $this->view('admin/footer', $data); ?>