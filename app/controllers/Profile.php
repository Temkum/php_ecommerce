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

    # add order details to each order
    if (is_array($orders)) {
      foreach ($orders as $key => $row) {
        $details = $Order->getOrderDetails($row->id);
        $totals = array_column($details, 'total');
        $grand_total = array_sum($totals);

        $orders[$key]->details = $details;
        $orders[$key]->grand_total = $grand_total;
      }
    }

    $data['page_title'] = 'Profile';
    $data['orders'] = $orders;

    $this->view('profile', $data);
  }
}
