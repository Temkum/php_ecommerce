<?php

class AddToCart extends Controller
{
  private $redirect_to = '';

  public function index($id = '')
  {
    $this->setRedirect();

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
    header('Location: ' . ROOT . 'cart');

    exit;
  }

  public function addQty($id = '')
  {
    $this->setRedirect();

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
    $this->redirect();
  }

  public function decreaseQty($id = '')
  {
    $this->setRedirect();

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
    $this->redirect();
  }

  public function removeCartItem($id = '')
  {
    $this->setRedirect();

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
    $this->redirect();
  }

  private function redirect()
  {
    header('Location: ' . $this->redirect_to);
    // header('Location: ' . ROOT . 'cart');

    exit;
  }

  private function setRedirect()
  {
    if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != "") {
      $this->redirect_to = $_SERVER['HTTP_REFERER'];
    } else {
      $this->redirect_to = ROOT . 'shop';
    }
    show($_SERVER);
  }
}
