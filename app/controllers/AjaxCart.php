<?php

class AjaxCart extends Controller
{
  public function index()
  {
    # code...
  }
  public function editQuantity($data = "")
  {
    $obj = json_decode($data);

    $quantity = esc($obj->quantity);
    $id = esc($obj->id);

    if (isset($_SESSION['CART'])) {
      foreach ($_SESSION['CART'] as $key => $item) {
        // increase qty
        if ($item['id'] == $id) {
          $_SESSION['CART'][$key]['qty'] += (int)$quantity;

          break;
        }
      }
    }

    $obj->data_type = 'editQuantity';
    echo json_encode($obj);
  }

  public function deleteItem($data = "")
  {
    $obj = json_decode($data);
    $id = esc($obj->id);

    $id = esc($id);

    // check if item is present
    if (isset($_SESSION['CART'])) {
      foreach ($_SESSION['CART'] as $key => $item) {
        // remove item
        if ($item['id'] == $id) {
          unset($_SESSION['CART'][$key]);
          // reset array values after removing an item
          $_SESSION['CART'] = array_values($_SESSION['CART']);

          break;
        }
      }
    }

    $obj->data_type = 'deleteItem';
    echo json_encode($obj);
  }
}
