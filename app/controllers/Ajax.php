<?php

class Ajax extends Controller
{
  public function index()
  {
    $data = file_get_contents('php://input');

    $data = json_decode($data); //add true to convert to an array instead of stdObject

    if (is_object($data)) {
      # code...
      if ($data->data_type == 'add_category') {
        # add new category
        $category = $this->loadModel('Category');
        $category->create($data);
        $check = $category->create($data);

        if ($_SESSION['error'] != '') {
          # code...
          $arr['msg'] = $_SESSION['error'];
          $_SESSION['error'] = '';
          $arr['msg_type'] = 'error';
          $arr['data'] = '';

          echo json_encode($arr);
        } else {
          $arr['msg'] = 'Category added successfully!';
          $arr['msg_type'] = 'success';
          $arr['data'] = '';

          echo json_encode($arr);
        }
      }
    }
  }
}
