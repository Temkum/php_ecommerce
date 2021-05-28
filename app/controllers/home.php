<?php

class Home extends Controller
{
  public function index()
  {
    $User = $this->loadModel('User');
    $user_data = $User->checkLogin();

    // check if user is logged in
    if (is_array($user_data)) {
      # code...
      $data['user_data'] = $user_data;
    }

    $data['page_title'] = 'Home';
    $this->view('index', $data);
  }
}
