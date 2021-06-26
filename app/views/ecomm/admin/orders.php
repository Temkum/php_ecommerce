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
        <h3><i class="fa fa-angle-right"></i> Orders </h3>
        <hr>
        <thead>
          <tr>
            <th>Order No</th>
            <th>Customer</th>
            <th>Total</th>
            <th>Order Date</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody onclick="showDetails(event)">
          <?php foreach ($orders as $order) : ?>
            <tr style="position: relative;">
              <td><?= $order->id ?></td>
              <td><a href="<?= ROOT ?>profile/<?= $order->user->url_address ?>"><?= $order->user->name ?></a></td>
              <td>$<?= $order->total ?></td>
              <td><?= date('jS M Y H: a', strtotime($order->date)) ?></td>
              <td><i class="fa fa-arrow-down"></i>
                <!-- Order details -->
                <div class="js-order-details details hide">
                  <a style="float: right; cursor:pointer;">Close</a>
                  <h4>Order #<?= $order->id ?></h4>
                  <h5>Customer: <?= $order->user->name ?></h5>
                  <div class="details-tbl">
                    <table class="table">
                      <tr>
                        <th>Country</th>
                        <td><?= $order->country ?></td>
                      </tr>
                      <tr>
                        <th>State</th>
                        <td><?= $order->state ?></td>
                      </tr>
                      <tr>
                        <th>Delivery Address</th>
                        <td><?= $order->delivery_address ?></td>
                      </tr>
                    </table>
                    <table class="table">
                      <tr>
                        <th>Home Phone</th>
                        <td><?= $order->home_phone ?></td>
                      </tr>
                      <tr>
                        <th>Mobile Phone</th>
                        <td><?= $order->mobile_phone ?></td>
                      </tr>
                      <tr>
                        <th>Date</th>
                        <td><?= $order->date ?></td>
                      </tr>
                    </table>
                  </div>
                  <!-- orders -->
                  <br>
                  <h4>Order Summary</h4>
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
                  <h3 class="grand-total">Grand Total: <?= $order->grand_total ?></h3>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div><!-- /content-panel -->
  </div><!-- /col-md-12 -->
</div><!-- /row -->

<script type="text/javascript">
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

<?php $this->view('admin/footer', $data); ?>