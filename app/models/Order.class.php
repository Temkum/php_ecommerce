<?php
class Order extends Controller
{
  public function saveOrder($POST, $ROWS, $user_url, $sessionid)
  {
    $total = 0;
    foreach ($ROWS as $key => $row) {
      $total += $row->cart_qty * $row->price;
    }

    // instantiate db
    $db = Database::newInstance();

    if (is_array($ROWS)) {

      $countries = $this->loadModel('Countries');

      // show($POST);

      $data = [];
      $data['user_url'] = $user_url;
      $data['sessionid'] = $sessionid;
      $data['delivery_address'] = $POST['address1'] . '' . $POST['address2'];
      $data['total'] = $total;
      $data['zip'] = $POST['zip'];
      $country_obj = $countries->getCountry($POST['country']);
      $data['country'] = $country_obj->country;
      $state_obj = $countries->getState($POST['state']);
      $data['state'] = $state_obj->state;
      $data['tax'] = 0;
      $data['shipping'] = 0;
      $data['date'] = date('Y-m-d H:i:s');
      $data['home_phone'] = $POST['home_phone'];
      $data['mobile_phone'] = $POST['mobile_phone'];

      $sql = 'INSERT INTO orders (user_url, delivery_address, total, state, zip, country, tax, shipping, date, sessionid, home_phone, mobile_phone) VALUES (:user_url, :delivery_address, :total, :state, :zip, :country, :tax, :shipping, :date, :sessionid, :home_phone, :mobile_phone)';

      $result = $db->write($sql, $data);

      // save details

      $order_id = 0;
      $query = 'SELECT id FROM orders ORDER BY id DESC LIMIT 1';
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

        $sql = 'INSERT INTO order_details (order_id, qty, description, amount, total,product_id) VALUES (:order_id, :qty, :description, :amount, :total,:product_id)';
        $result = $db->write($sql, $data);
      }
    }
  }
}

//BUG fix country and state names 
//TODO fix edit product in admin 
