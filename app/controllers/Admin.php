<?php

class Admin extends Controller
{
  public function index()
  {
    $User = $this->loadModel('User');
    $user_data = $User->checkLogin(true, ['admin']);

    // check if user is logged in
    if (is_object($user_data)) {
      # code...
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
      # code...
      $data['user_data'] = $user_data;
    }


    $DB = Database::newInstance();
    $categories = $DB->read('SELECT * FROM `categories` ORDER BY id DESC');

    $category = $this->loadModel('Category');
    $tbl_rows = $category->makeTable($categories);
    // get table results as an array
    if (is_array($categories)) {

      $data['tbl_rows'] = $tbl_rows;
    }

    $data['page_title'] = 'Admin';
    $this->view('admin/categories', $data);
  }
}
