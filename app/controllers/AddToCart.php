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
    show($_SESSION);

    // header('Location: ' . ROOT . 'shop');

    // exit;
  }
}
