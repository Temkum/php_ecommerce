<?php

class AddToCart extends Controller
{
  public function index($id = '')
  {
    $id = esc($id);

    // get all products from db
    $DB = Database::newInstance();
    $ROWS = $DB->read("SELECT * FROM products WHERE id=:id LIMIT 1", ["id" => $id]);

    if ($ROWS) {

      $ROW = $ROWS[0];
      if (isset($_SESSION['CART'])) {
        # increase item quantity if already in cart
        $ids = array_column($_SESSION['CART'], 'id');

        if (in_array($ROW->id, $ids)) {
          # code...
          $key = array_search($ROW->id, $ids);
          ++$_SESSION['CART'][$key]['qty'];
        } else {
          $arr = [];
          $arr['id'] = $ROW->id;
          $arr['qty'] = 1;

          $_SESSION['CART'][] = $arr;
        }
      } else {
        // add new item to cart
        $arr = [];
        $arr['id'] = $ROW->id;
        $arr['qty'] = 1;

        $_SESSION['CART'][] = $arr;
      }
    }

    // header('Location: ' . ROOT . 'shop');

    // exit;
  }

  public function addQty($id = '')
  {
    # code...
    $id = esc($id);

    if (isset($_SESSION['CART'])) {
      foreach ($_SESSION['CART'] as $key => $item) {
        // increase qty
        if ($item['id'] == $id) {
          $_SESSION['CART'][$key]['qty'] += 1;

          break;
        }
      }
    }
  }

  public function decreaseQty($id = '')
  {
    # code...
    $id = esc($id);

    if (isset($_SESSION['CART'])) {
      foreach ($_SESSION['CART'] as $key => $item) {
        // decrease qty
        if ($item['id'] == $id) {
          $_SESSION['CART'][$key]['qty'] -= 1;

          break;
        }
      }
    }
  }

  public function removeCartItem($id = '')
  {
    # code...
    $id = esc($id);

    if (isset($_SESSION['CART'])) {
      foreach ($_SESSION['CART'] as $key => $item) {
        // remove qty
        if ($item['id'] == $id) {
          unset($_SESSION['CART'][$key]);
          // reset array values after removing an item
          $_SESSION['CART'] = array_values($_SESSION['CART']);

          break;
        }
      }
    }
  }
}
