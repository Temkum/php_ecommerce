<?php

class Home extends Controller
{
  public function index()
  {
    $User = $this->loadModel('User');
    $image_class = $this->loadModel('Image');
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

    if ($ROWS) {
      # code...
      foreach ($ROWS as $key => $row) {
        # edit actual row
        $ROWS[$key]->image = $image_class->get_thumb_post($ROWS[$key]->image);
      }
    }

    $data['ROWS'] = $ROWS;

    $this->view('index', $data);
  }
}
