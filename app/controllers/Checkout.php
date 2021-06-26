<?php

class Checkout extends Controller
{
  public function index()
  {
    $User = $this->loadModel('User');
    $image_class = $this->loadModel('Image');
    $user_data = $User->checkLogin();

    // check if user is logged in
    if (is_object($user_data)) {
      // code...
      $data['user_data'] = $user_data;
    }

    // get all products from db
    $DB = Database::newInstance();
    $ROWS = false;
    $item_ids = [];

    // get cart item ids
    if (isset($_SESSION['CART'])) {
      $item_ids = array_column($_SESSION['CART'], 'id');
      // convert array to string
      $id_strings = "'" . implode("','", $item_ids) . "'";

      $ROWS = $DB->read("SELECT * FROM products WHERE id in ({$id_strings})");
    }

    if (is_array($ROWS)) {
      foreach ($ROWS as $key => $row) {
        foreach ($_SESSION['CART'] as $item) {
          if ($row->id == $item['id']) {
            $ROWS[$key]->cart_qty = $item['qty'];

            break;
          }
        }
      }
    }

    $data['page_title'] = 'Checkout';

    // subtotal
    $data['sub_total'] = 0;

    if ($ROWS) {
      foreach ($ROWS as $key => $row) {
        // edit actual row & create thumbnail
        $ROWS[$key]->image = $image_class->get_thumb_post($ROWS[$key]->image);
        $mytotal = $row->price * $row->cart_qty;
        $data['sub_total'] += $mytotal;
      }
    }

    // prevent error if there are no rows to display
    if (is_array($ROWS)) {
      rsort($ROWS); // sort by newly added
    }
    $data['ROWS'] = $ROWS;

    // get countries
    $countries = $this->loadModel('Countries');
    $data['countries'] = $countries->getCountries();

    // check if old POST data exist
    if (isset($_SESSION['POST_DATA'])) {

      $data['POST_DATA'] = $_SESSION['POST_DATA'];
    }

    if (count($_POST) > 0) {
      $order = $this->loadModel('Order');
      $order->validate($_POST);
      $data['errors'] = $order->errors;

      // save data to session && $data obj
      $_SESSION['POST_DATA'] = $_POST;
      $data['POST_DATA'] = $_POST;

      // check if errors exist & exit
      if (count($order->errors) == 0) {
        # code...
        header('Location: ' . ROOT . "checkout/summary");

        exit;
      }
    }

    $this->view('checkout', $data);
  }

  public function summary()
  {
    $User = $this->loadModel('User');
    $user_data = $User->checkLogin();

    if (is_object($user_data)) {
      $data['user_data'] = $user_data;
    }

    // get data
    // get all products from db
    $DB = Database::newInstance();
    $ROWS = false;
    $item_ids = [];

    // get cart item ids
    if (isset($_SESSION['CART'])) {
      $item_ids = array_column($_SESSION['CART'], 'id');
      // convert array to string
      $id_strings = "'" . implode("','", $item_ids) . "'";

      $ROWS = $DB->read("SELECT * FROM products WHERE id in ({$id_strings})");
    }

    if (is_array($ROWS)) {
      foreach ($ROWS as $key => $row) {
        foreach ($_SESSION['CART'] as $item) {
          if ($row->id == $item['id']) {
            $ROWS[$key]->cart_qty = $item['qty'];

            break;
          }
        }
      }
    }

    $data['sub_total'] = 0;

    if ($ROWS) {
      foreach ($ROWS as $key => $row) {
        $mytotal = $row->price * $row->cart_qty;

        $data['sub_total'] += $mytotal;
      }
    }

    // order details
    $data['order_details'] = $ROWS;
    $data['orders'][] = $_SESSION['POST_DATA'];

    $data['page_title'] = 'Checkout Summary';

    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['POST_DATA'])) {
      // run checkout as guest
      $sessionid = session_id();
      $user_url = '';

      if (isset($_SESSION['user_url'])) {
        $user_url = $_SESSION['user_url'];
      }

      $order = $this->loadModel('Order');
      $order->saveOrder($_SESSION['POST_DATA'], $ROWS, $user_url, $sessionid);
      $data['errors'] = $order->errors;

      // header('Location:' . ROOT. 'thank_you)
    }

    $this->view('checkout.summary', $data);
  }
}
