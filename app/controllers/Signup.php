<?php

class Signup extends Controller
{
  public function index()
  {
    $data['page_title'] = 'Signup';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      # code...
      show($_POST);
      
      $User = $this->load_model('User');
    }

    $this->view('signup', $data);
  }
}
