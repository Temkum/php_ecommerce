<?php

class Login extends Controller
{
  public function index()
  {
    $data['page_title'] = 'Login';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      /* instantiate the user  */
      $user = $this->loadModel('User');
      $user->login($_POST);
    }

    show($_POST);

    $this->view('login', $data);
  }
}
