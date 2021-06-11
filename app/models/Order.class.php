<?php
class Order
{
  public function saveOrder($POST, $ROWS, $user_url, $session_id)
  {
    // instantiate db
    $db = Database::newInstance();
    $data = [];

    $data['user_url'] = $user_url;
    $data['session_id'] = $session_id;
    $data['delivery_address'] = $POST['delivery_address'];
    $data['total'] = $POST['total'];
    $data['state'] = $POST['state'];
    $data['zip'] = $POST['zip'];
    $data['country'] = $POST['country'];
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
