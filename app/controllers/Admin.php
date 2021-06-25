<?php

class Admin extends Controller
{
  public function index()
  {
    $User = $this->loadModel('User');
    $user_data = $User->checkLogin(true, ['admin']);

    // check if user is logged in
    if (is_object($user_data)) {
      // code...
      $data['user_data'] = $user_data;
    }

    $data['page_title'] = 'Admin';
    $this->view('admin/index', $data);
  }

  public function categories()
  {
    $User = $this->loadModel('User');
    $user_data = $User->checkLogin(true, ['admin']);

    // check if user is logged in
    if (is_object($user_data)) {
      // code...
      $data['user_data'] = $user_data;
    }

    $DB = Database::newInstance();
    $all_categories = $DB->read('SELECT * FROM `categories` ORDER BY id DESC');
    $categories = $DB->read('SELECT * FROM `categories` WHERE disabled=0 ORDER BY id DESC');

    $category = $this->loadModel('Category');
    $tbl_rows = $category->makeTable($all_categories);
    $data['tbl_rows'] = $tbl_rows;
    $data['categories'] = $categories;

    $data['page_title'] = 'Admin - Categories';
    $this->view('admin/categories', $data);
  }

  public function products()
  {
    $User = $this->loadModel('User');
    $user_data = $User->checkLogin(true, ['admin']);

    // check if user is logged in
    if (is_object($user_data)) {
      // code...
      $data['user_data'] = $user_data;
    }

    $DB = Database::newInstance();
    $products = $DB->read("SELECT * FROM `products` ORDER BY id DESC");

    $categories = $DB->read("SELECT * FROM `categories` WHERE disabled=0 ORDER BY id DESC");

    $product = $this->loadModel('Product');
    $category = $this->loadModel('Category');

    $tbl_rows = $product->makeTable($products, $category);
    // $tbl_rows = $this->makeTable($products, $category);
    $data['tbl_rows'] = $tbl_rows;
    $data['categories'] = $categories;

    $data['page_title'] = 'Admin - Products';
    $this->view('admin/products', $data);
  }

  public function orders()
  {
    $User = $this->loadModel('User');
    $Order = $this->loadModel('Order');
    $user_data = $User->checkLogin(true, ['admin']);

    // check if user is logged in
    if (is_object($user_data)) {
      // code...
      $data['user_data'] = $user_data;
    }

    // retrieve order data
    $orders = $Order->getAllOrders();

    # add order details to each order
    if (is_array($orders)) {
      foreach ($orders as $key => $row) {
        $details = $Order->getOrderDetails($row->id);
        $orders[$key]->grand_total = 0;

        if (is_array($details)) {

          $totals = array_column($details, 'total');
          $grand_total = array_sum($totals);
          $orders[$key]->grand_total = $grand_total;
        }

        $orders[$key]->details = $details;
        $user = $User->getUser($row->user_url);
        $orders[$key]->user = $user;
      }
    }

    $data['orders'] = $orders;

    $data['page_title'] = 'Admin - Orders';
    $this->view('admin/orders', $data);
  }
}
