<?php
class Order extends Controller
{
  public $errors = [];

  public function validate($POST)
  {
    $this->errors = [];

    foreach ($POST as $key => $value) {

      if ($key == 'country') {
        if ($value == '' || $value == 'Country') {
          # code...
          $this->errors[] = "Please enter a valid country!";
        }
      }

      if ($key == 'state') {
        if ($value == '' || $value == "State / Province / Region") {
          # code...
          $this->errors[] = "Please enter a valid state!";
        }
      }
      if ($key == 'address1') {
        if (empty($value)) {
          # code...
          $this->errors[] = "Please enter a valid Address 1";
        }
      }
      if ($key == 'zip') {
        if (empty($value)) {
          # code...
          $this->errors[] = "Please enter a valid Zip/Postal code!";
        }
      }
      if ($key == 'mobile_phone') {
        if (empty($value)) {
          # code...
          $this->errors[] = "Please enter a valid phone number!";
        }
      }
    }
  }

  public function saveOrder($POST, $ROWS, $user_url, $sessionid)
  {

    $total = 0;

    foreach ($ROWS as $key => $row) {
      $total += $row->cart_qty * $row->price;
    }

    // instantiate db
    $db = Database::newInstance();

    if (is_array($ROWS) && count($this->errors) == 0) {

      $countries = $this->loadModel('Countries');

      // show($POST);

      $data = [];
      $data['user_url'] = $user_url;
      $data['sessionid'] = $sessionid;
      $data['delivery_address'] = $POST['address1'] . '' . $POST['address2'];
      $data['total'] = $total;
      $data['zip'] = $POST['zip'];
      // $country_obj = $countries->getCountry($POST['country']);
      $data['country'] = $POST['country'];
      // $state_obj = $countries->getState($POST['state']);
      $data['state'] = $POST['state'];
      $data['tax'] = 0;
      $data['shipping'] = 0;
      $data['date'] = date('Y-m-d H:i:s');
      $data['home_phone'] = $POST['home_phone'];
      $data['mobile_phone'] = $POST['mobile_phone'];

      $sql = "INSERT INTO orders (user_url, delivery_address, total, state, zip, country, tax, shipping, date, sessionid, home_phone, mobile_phone) VALUES (:user_url, :delivery_address, :total, :state, :zip, :country, :tax, :shipping, :date, :sessionid, :home_phone, :mobile_phone)";

      $result = $db->write($sql, $data);

      // save details
      $order_id = 0;
      $query = "SELECT id FROM orders ORDER BY id DESC LIMIT 1";
      $result = $db->read($query);

      if (is_array($result)) {
        $order_id = $result[0]->id;
      }

      foreach ($ROWS as $row) {
        $data = [];
        $data['order_id'] = $order_id;
        $data['qty'] = $row->cart_qty;
        $data['description'] = $row->description;
        $data['amount'] = $row->price;
        $data['total'] = $row->cart_qty * $row->price;
        $data['product_id'] = $row->id;

        $sql = "INSERT INTO order_details (order_id, qty, description, amount, total,product_id) VALUES (:order_id, :qty, :description, :amount, :total,:product_id)";
        $result = $db->write($sql, $data);
      }
    }
  }

  public function getOrdersByUser($user_url)
  {
    $orders = false;
    $db = Database::newInstance();
    $data['user_url'] = $user_url;

    $sql = "SELECT * FROM orders WHERE user_url=:user_url ORDER BY id DESC LIMIT 100";
    $orders = $db->read($sql, $data);

    return $orders;
  }

  public function getOrdersCount($user_url)
  {
    $db = Database::newInstance();
    $data['user_url'] = $user_url;

    $sql = "SELECT id FROM orders WHERE user_url=:user_url";
    $result = $db->read($sql, $data);

    $orders = is_array($result) ? count($result) : 0;

    return $orders;
  }

  public function getAllOrders()
  {
    $orders = false;
    $db = Database::newInstance();

    $sql = "SELECT * FROM orders ORDER BY id DESC LIMIT 100";
    $orders = $db->read($sql);

    return $orders;
  }

  public function getOrderDetails($id)
  {
    $details = false;
    $data['id'] = addslashes($id);
    $db = Database::newInstance();

    $sql = "SELECT * FROM order_details WHERE order_id=:id ORDER BY id DESC";
    $details = $db->read($sql, $data);

    return $details;
  }
}

//BUG fix country and state names 
//TODO fix edit product in admin 
