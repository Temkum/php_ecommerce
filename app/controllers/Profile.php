<?php

class Profile extends Controller
{
  public function index($url_address = null)
  {
    $User = $this->loadModel('User');
    $Order = $this->loadModel('Order');
    $user_data = $User->checkLogin(true);

    // get personal profile of user
    if ($url_address) {
      $profile_data = $User->getUser($url_address);
    } else {
      $profile_data = $user_data;
    }

    // check if user is logged in
    if (is_object($user_data)) {
      # code...
      $data['user_data'] = $user_data;
    }

    // retrieve order data of user
    if (is_array($profile_data)) {
      $orders = $Order->getOrdersByUser($profile_data->url_address);
    } else {
      $orders = false;
    }

    # add order details to each order
    if (is_array($orders)) {
      foreach ($orders as $key => $row) {
        $details = $Order->getOrderDetails($row->id);
        $totals = array_column([$details], 'total');
        $grand_total = array_sum($totals);

        $orders[$key]->details = $details;
        $orders[$key]->grand_total = $grand_total;
      }
    }

    $data['profile_data'] = $profile_data;
    $data['page_title'] = 'Profile';
    $data['orders'] = $orders;

    $this->view('profile', $data);
  }
}
