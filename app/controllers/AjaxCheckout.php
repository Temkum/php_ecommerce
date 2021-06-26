<?php

class AjaxCheckout extends Controller
{
  public function index($data_type = '', $id = '')
  {
    $info = file_get_contents("php://input"); //get data from input
    $info = json_decode($info); //convert to array

    $id = $info->data->id;

    $countries = $this->loadModel('Countries');
    $data = $countries->getStates($id);

    // create obj to return
    $info = (object)[];
    $info->data = $data;
    $info->data_type = "getStates";

    // convert array to str since we can't echo an array
    echo json_encode($info);
  }
}
