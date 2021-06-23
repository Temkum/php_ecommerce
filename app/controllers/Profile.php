<?php

class Profile extends Controller
{
  public function index()
  {
    $User = $this->loadModel('User');
    $Order = $this->loadModel('Order');
    $user_data = $User->checkLogin(true);

    // check if user is logged in
    if (is_object($user_data)) {
      # code...
      $data['user_data'] = $user_data;
    }

    // retrieve order data
    $orders = $Order->getOrdersByUser($user_data->url_address);

    $data['page_title'] = 'Profile';
    $data['orders'] = $orders;

    $this->view('profile', $data);
  }
}
