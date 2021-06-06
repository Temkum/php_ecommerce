<?php

class Home extends Controller
{
  public function index()
  {
    $User = $this->loadModel('User');
    $user_data = $User->checkLogin();

    // check if user is logged in
    if (is_object($user_data)) {
      # code...
      $data['user_data'] = $user_data;
    }

    // get all products from db
    $DB = Database::newInstance();
    $ROWS = $DB->read('SELECT * FROM products');

    $data['page_title'] = 'Home';
    $data['ROWS'] = $ROWS;
    $this->view('index', $data);
  }
}
