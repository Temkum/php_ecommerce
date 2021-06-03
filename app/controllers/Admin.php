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
    $categories = $DB->read('SELECT * FROM `categories` ORDER BY id DESC');

    $category = $this->loadModel('Category');
    $tbl_rows = $category->makeTable($categories);
    $data['tbl_rows'] = $tbl_rows;

    $data['page_title'] = 'Admin';
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
    $tbl_rows = $product->makeTable($products);
    $data['tbl_rows'] = $tbl_rows;
    $data['categories'] = $categories;

    $data['page_title'] = 'Admin';
    $this->view('admin/products', $data);
  }
}
