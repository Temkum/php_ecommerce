<?php

class Cart extends Controller
{
  public function index()
  {
    $User = $this->loadModel('User');
    $image_class = $this->loadModel('Image');
    $user_data = $User->checkLogin();

    // check if user is logged in
    if (is_object($user_data)) {
      # code...
      $data['user_data'] = $user_data;
    }

    // get all products from db
    $DB = Database::newInstance();
    $ROWS = false;
    $item_ids = [];

    # get cart item ids
    if (isset($_SESSION['CART'])) {
      $item_ids = array_column($_SESSION['CART'], 'id');
      // convert array to string
      $id_strings = "'" . implode("','", $item_ids) . "'";

      $ROWS = $DB->read("SELECT * FROM products WHERE id in ($id_strings)");
    }

    if (is_array($ROWS)) {
      foreach ($ROWS as $key => $row) {
        foreach ($_SESSION['CART'] as $item) {
          if ($row->id == $item['id']) {
            $ROWS[$key]->cart_qty = $item['qty'];

            break;
          }
        }
      }
    }

    $data['page_title'] = 'Cart';

    if ($ROWS) {
          foreach ($ROWS as $key => $row) {
        # edit actual row
        $ROWS[$key]->image = $image_class->get_thumb_post($ROWS[$key]->image);
      }
    }

    $data['ROWS'] = $ROWS;

    $this->view('cart', $data);
  }
}
