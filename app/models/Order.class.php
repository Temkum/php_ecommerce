<?php
class Order extends Controller
{
  public function saveOrder($POST, $ROWS, $user_url, $session_id)
  {
    $total = 0;
    foreach ($ROWS as $key => $row) {
      $total += $row->cart_qty * $row->price;
    }

    // instantiate db
    $db = Database::newInstance();

    if (is_array($ROWS)) {

      $countries = $this->loadModel('Countries');
      // $data['countries'] = $countries->getCountries();

      $data = [];
      $data['user_url'] = $user_url;
      $data['session_id'] = $session_id;
      $data['delivery_address'] = $POST['address1'] . '' . $POST['address2'];
      $data['total'] = $total;
      $data['zip'] = $POST['zip'];
      $country_obj = $countries->getCountries($POST['country']);
      $data['country'] = $country_obj->country;
      $state_obj = $countries->getState($POST['state']);
      $data['state'] = $state_obj->state;
      $data['tax'] = 0;
      $data['shipping'] = 0;
      $data['date'] = date('Y-m-d H:i:s');
      $data['home_phone'] = $POST['home_phone'];
      $data['mobile'] = $POST['mobile'];

      $sql = 'INSERT INTO orders (user_url, delivery_address, total, state, zip, country, tax, shipping, date, session_id, home_phone, mobile) 
    VALUES (:user_url, :delivery_address, :total, :state, :zip, :country, :tax, :shipping, :date, :session_id, :home_phone, :mobile)';

      $result = $db->write($sql, $data);
    }
  }
}

//BUG fix country and state names 
//TODO fix edit product in admin 
