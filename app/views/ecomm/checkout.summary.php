<?php $this->view('header', $data); ?>

<?php
if (isset($errors) && count($errors) > 0) {

  foreach ($errors as $error) {
    echo '<div class="alert alert-danger">$errors->error</div>';
  }
}

?>
<section id="cart_items">
  <style>
    .breadcrumbs .breadcrumb {
      margin-bottom: 30px;
    }

    .register-req {
      margin-top: 3px;
    }

    .register-req p {
      text-align: center;
    }

    .msg {
      text-align: center;
      border-left: 2px solid #FE980F;
      border-right: 2px solid #FE980F;

    }


    /* .details-tbl {
      display: flex !important;
      margin: 4px;
    } */

    /* .details-tbl>table {
      margin: 4px;
    } */
  </style>

  <div class="container">
    <div class="breadcrumbs">
      <ol class="breadcrumb">
        <li><a href="<?= ROOT ?>home">Home</a></li>
        <li class="active text-capitalize">Checkout</li>
      </ol>
    </div>
    <!--/breadcrumbs-->

    <?php if (is_array($orders)) : ?>
      <div class="register-req">
        <p>Please confirm the information below</p>
      </div>
      <!--/register-req-->

      <table class="table table-striped table-advance table-hover">
        <h3><i class="fa fa-angle-right"></i> Orders </h3>
        <thead>
          <?php foreach ($orders as $order) : ?>
            <?php
            //convert array to object
            $order = (object)$order;
            ?>

            <!-- Order details -->
            <div class="js-order-details details">
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
                    <th>Address 1</th>
                    <td><?= $order->address1 ?></td>
                  </tr>
                  <tr>
                    <th>Address 2</th>
                    <td><?= $order->address2 ?></td>
                  </tr>
                </table>
                <table class="table">
                  <tr>
                    <th>Postal Code</th>
                    <td><?= $order->zip ?></td>
                  </tr>
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
                    <td><?= date('Y-m-d') ?></td>
                  </tr>
                </table>
                <div class="msg">
                  <?= $order->message ?>
                </div>

                <div class="summary">
                  <!-- order summary-->
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
                    <?php if (isset($order_details) && is_array($order_details)) : ?>
                      <?php foreach ($order_details as $detail) : ?>
                        <tbody>
                          <tr>
                            <td><?= $detail->cart_qty ?></td>
                            <td><?= $detail->description ?></td>
                            <td><?= $detail->price ?></td>
                            <td><?= $detail->cart_qty * $detail->price ?></td>
                          </tr>
                        </tbody>
                      <?php endforeach; ?>

                    <?php else : ?>
                      <div>No order details found for this order!</div>
                    <?php endif; ?>
                  </table>
                  <h3 class="grand-total pull-right">Grand Total: <?= $sub_total ?></h3>
                  <hr style="clear: both;">

                  <div>
                    <div class="row">
                      <div class="col-md-6"><a href="<?= ROOT ?>checkout" class="btn btn-primary ml-3">Back to checkout</a></div>
                      <div class="col-md-6">
                        <form method="post">
                          <input type="submit" value="Pay" name="" class="btn btn-primary pull-right">
                        </form>
                      </div>
                    </div>
                  </div>

                  <br>
                </div>
              </div>
            </div>

          <?php endforeach; ?>
        <?php else : ?>
          <div class="no-products">Please add items in cart before checkout!</div>
        <?php endif; ?>
  </div>
</section>
<!-- end cart_items-->
<br> <br>

<script>
  function getStates(id) {
    sendData({
      id: id.trim()
    }, 'getStates');
  }

  function sendData(data = {}, data_type) {
    // create new ajax object
    let ajax = new XMLHttpRequest();

    ajax.addEventListener('readystatechange', function() {
      if (ajax.readyState == 4 && ajax.status == 200) {
        handleResult(ajax.responseText);
      }
    });

    ajax.open('POST', "<?= ROOT ?>ajaxcheckout/" + data_type + "/" + JSON.stringify(data), true); //true here is to tell it to run in the background
    ajax.send();
  }

  function handleResult(result) {
    console.log(result);

    if (result != "") {
      let obj = JSON.parse(result);

      if (typeof obj.data_type != "undefined") {
        if (obj.data_type == "getStates") {

          let select_input = document.querySelector('.js-state');
          select_input.innerHTML = "<option>State / Province / Region</option>";
          // loop through the array of obj
          for (let i = 0; i < obj.data.length; i++) {

            select_input.innerHTML += "<option value='" + obj.data[i].id + "'>" + obj.data[i].state + "</option>"
          }
        }
      }
    }
  }
</script>

<?php $this->view('footer', $data); ?>