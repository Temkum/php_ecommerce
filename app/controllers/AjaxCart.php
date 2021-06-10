<?php

class AjaxCart extends Controller
{
  public function index()
  {
    # code...
  }
  public function editQuantity($data="")
  {
    $obj = json_decode($data);
    $obj->data_type = 'editQuantity';
    
  }
 
}
