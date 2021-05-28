<?php

class Logout extends Controller
{
  public function index()
  {
    $User = $this->loadModel('User');
    $User->logout();
  }
}
