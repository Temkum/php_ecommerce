<?php $this->view('admin/header', $data); ?>
<?php $this->view('admin/sidebar', $data); ?>

<div class="row mt">
  <style>
    .show {
      display: block;
    }

    .hide {
      display: none;
    }

    .mb {
      margin-bottom: 2rem;
    }

    .mt-2 {
      margin-top: 2rem;
    }

    .ml-3 {
      margin-left: 16px;
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

    .grand-total {
      float: right;
    }

    table *>td {
      cursor: pointer;
    }

    .details-tbl {
      display: flex;
      margin: 4px;
    }

    .details-tbl>table {
      margin: 4px;
    }
  </style>

  <div class="col-md-12">
    <div class="content-panel">
      <table class="table table-striped table-advance table-hover">
        <h3><i class="fa fa-angle-right"></i> Customers </h3>
        <hr>
        <thead>
          <tr>
            <th>User ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Orders count</th>
            <th>Date created</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($users as $user) : ?>
            <tr style="position: relative;">
              <td><?= $user->id ?></td>
              <td><a href="<?= ROOT ?>profile/<?= $user->url_address ?>"><?= $user->name ?></a></td>
              <td><?= $user->email ?></td>
              <td><?= $user->orders_count ?></td>
              <td><?= date('jS M Y H: a', strtotime($user->date)) ?></td>
              <td></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div><!-- /content-panel -->
  </div><!-- /col-md-12 -->
</div><!-- /row -->

<?php $this->view('admin/footer', $data); ?>