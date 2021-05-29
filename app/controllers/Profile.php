<?php

class Profile extends Controller
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

    $data['page_title'] = 'Profile';
    $this->view('profile', $data);
  }
}
