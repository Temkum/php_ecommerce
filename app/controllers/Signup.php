<?php

class Signup extends Controller
{
  public function index()
  {
    $data['page_title'] = 'Signup';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      /* instantiate the user  */
      $user = $this->loadModel('User');
      $user->signup($_POST);
    }

    $this->view('signup', $data);
  }
}
