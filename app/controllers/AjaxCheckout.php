<?php

class AjaxCheckout extends Controller
{
  public function index($data_type = '', $id = '')
  {
    $id = json_decode($id);

    $countries = $this->loadModel('Countries');
    $data = $countries->getStates($id->id);

    // create obj to return
    $info = (object)[];
    $info->data = $data;
    $info->data_type = 'getStates';

    // convert array to str since we can't echo an array
    echo json_encode($data);
  }
}
