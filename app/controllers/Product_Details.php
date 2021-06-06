<?php

class Product_Details extends Controller
{
  public function index($slug)
  {
    $slug = esc($slug);

    $User = $this->loadModel('User');
    $user_data = $User->checkLogin();

    // check if user is logged in
    if (is_object($user_data)) {
      # code...
      $data['user_data'] = $user_data;
    }

    // get all products from db
    $DB = Database::newInstance();
    $ROW = $DB->read('SELECT * FROM products WHERE slug=:slug', ['slug' => $slug]);

    $data['page_title'] = 'Product Details';

    // check if product is available
    $data['ROW'] = is_array($ROW) ? $ROW[0] : false;

    $this->view('product_details', $data);
  }
}
