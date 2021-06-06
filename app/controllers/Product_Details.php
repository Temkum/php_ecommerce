<?php

class Product_Details extends Controller
{
  public function index($id)
  {
    $id = (int) $id;

    $User = $this->loadModel('User');
    $user_data = $User->checkLogin();

    // check if user is logged in
    if (is_object($user_data)) {
      # code...
      $data['user_data'] = $user_data;
    }

    // get all products from db
    $DB = Database::newInstance();
    $ROW = $DB->read('SELECT * FROM products WHERE id=:id', ['id' => $id]);

    $data['page_title'] = 'Product Details';
    $data['ROW'] = $ROW[0];

    $this->view('product_details', $data);
  }
}
