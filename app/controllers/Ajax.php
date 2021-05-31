<?php

class Ajax extends Controller
{
  public function index()
  {
    $data = file_get_contents('php://input');

    $data = json_decode($data); //add true to convert to an array instead of stdObject

    if (is_object($data) && isset($data->data_type)) {
      # code...
      $DB = Database::getInstance();
      $category = $this->loadModel('Category');

      if ($data->data_type == 'add_category') {
        # add new category
        // $category->create($data);
        $check = $category->create($data);

        if ($_SESSION['error'] != '') {
          # code...
          $arr['msg'] = $_SESSION['error'];
          $_SESSION['error'] = '';
          $arr['msg_type'] = 'error';
          $arr['data'] = '';
          $arr['data_type'] = 'add_new';

          echo json_encode($arr);
        } else {
          $arr['msg'] = 'Category added successfully!';
          $arr['msg_type'] = 'success';
          $cats = $category->getAll();
          $arr['data'] =  $category->makeTable($cats);
          $arr['data_type'] = 'add_new';

          echo json_encode($arr);
        }
      } else
      if ($data->data_type == 'disable_row') {
        // check current state
        $disabled = ('Enabled' == $data->current_state) ? 1 : 0;
        $id = $data->id;

        $sql = "UPDATE `categories` SET disabled = '$disabled' WHERE `id` ='$id' LIMIT 1";
        $DB->write($sql);

        $arr['msg'] = '';
        $_SESSION['error'] = '';
        $arr['msg_type'] = 'success';

        $cats = $category->getAll();
        $arr['data'] = $category->makeTable($cats);

        $arr['data_type'] = 'disable_row';

        echo json_encode($arr);
      } else 
        if ($data->data_type == 'delete_row') {
        $arr['msg'] = $_SESSION['Row successfully deleted!'];
        $_SESSION['error'] = '';
        $arr['msg_type'] = 'success';
        $arr['data'] = '';
        $arr['data_type'] = 'delete_row';

        echo json_encode($arr);
      }
    }
  }
}
