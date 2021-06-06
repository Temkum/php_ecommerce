<?php

class AjaxProduct extends Controller
{
  public function index()
  {
    /* $data = file_get_contents('php://input');
    $data = json_decode($data); */ //add true to convert to an array instead of stdObject

    $data = (object) $_POST;

    if (is_object($data) && isset($data->data_type)) {
      # code...
      $DB = Database::getInstance();
      $product = $this->loadModel('Product');
      $category = $this->loadModel('Category');

      if ($data->data_type == 'add_product') {
        # add new product
        $check = $product->create($data, $_FILES);

        if ($_SESSION['error'] != '') {
          # code...
          $arr['msg'] = $_SESSION['error'];
          $_SESSION['error'] = '';
          $arr['msg_type'] = 'error';
          $arr['data'] = '';
          $arr['data_type'] = 'add_new';

          echo json_encode($arr);
        } else {
          $arr['msg'] = 'Product added successfully!';
          $arr['msg_type'] = 'success';
          $cats = $product->getAll();
          $arr['data'] =  $product->makeTable($cats, $category);
          $arr['data_type'] = 'add_new';

          echo json_encode($arr);
        }
      } else
      if ($data->data_type == 'disable_row') {
        // check current state
        $disabled = ('Enabled' == $data->current_state) ? 1 : 0;
        $id = $data->id;

        $sql = "UPDATE `products` SET disabled = '$disabled' WHERE `id` ='{$id}' LIMIT 1";
        $DB->write($sql);

        $arr['msg'] = '';
        $_SESSION['error'] = '';
        $arr['msg_type'] = 'success';

        $cats = $product->getAll();
        $arr['data'] = $product->makeTable($cats);

        $arr['data_type'] = 'disable_row';

        echo json_encode($arr);
      } else 
        if ($data->data_type == 'edit_product') {
        $product->edit($data, $_FILES);
        $arr['msg'] = $_SESSION['Modified successfully!'];
        $_SESSION['error'] = '';
        $arr['msg_type'] = 'success';

        $cats = $product->getAll();
        $arr['data'] = $product->makeTable($cats, $category);

        $arr['data_type'] = 'edit_product';

        echo json_encode($arr);
      } else 
        if ($data->data_type == 'delete_row') {
        $product->delete($data->id);
        $arr['msg'] = $_SESSION['Row successfully deleted!'];
        $_SESSION['error'] = '';
        $arr['msg_type'] = 'success';

        $cats = $product->getAll();
        $arr['data'] = $product->makeTable($cats);

        $arr['data_type'] = 'delete_row';

        echo json_encode($arr);
      }
    }
  }
}
