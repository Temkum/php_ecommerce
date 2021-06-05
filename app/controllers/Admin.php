<?php

class Admin extends Controller
{
  public function index()
  {
    $User = $this->loadModel('User');
    $user_data = $User->checkLogin(true, ['admin']);

    // check if user is logged in
    if (is_object($user_data)) {
      // code...
      $data['user_data'] = $user_data;
    }

    $data['page_title'] = 'Admin';
    $this->view('admin/index', $data);
  }

  public function categories()
  {
    $User = $this->loadModel('User');
    $user_data = $User->checkLogin(true, ['admin']);

    // check if user is logged in
    if (is_object($user_data)) {
      // code...
      $data['user_data'] = $user_data;
    }

    $DB = Database::newInstance();
    $categories = $DB->read('SELECT * FROM `categories` ORDER BY id DESC');

    $category = $this->loadModel('Category');
    $tbl_rows = $category->makeTable($categories);
    $data['tbl_rows'] = $tbl_rows;

    $data['page_title'] = 'Admin';
    $this->view('admin/categories', $data);
  }

  public function products()
  {
    $User = $this->loadModel('User');
    $user_data = $User->checkLogin(true, ['admin']);

    // check if user is logged in
    if (is_object($user_data)) {
      // code...
      $data['user_data'] = $user_data;
    }

    $DB = Database::newInstance();
    $products = $DB->read("SELECT * FROM `products` ORDER BY id DESC");

    $categories = $DB->read("SELECT * FROM `categories` WHERE disabled=0 ORDER BY id DESC");

    $product = $this->loadModel('Product');
    $category = $this->loadModel('Category');
    // $tbl_rows = $product->makeTable($products, $category);
    $tbl_rows = $this->makeTable($products, $category);
    $data['tbl_rows'] = $tbl_rows;
    $data['categories'] = $categories;

    $data['page_title'] = 'Admin';
    $this->view('admin/products', $data);
  }

  private function makeTable($cats)
  {
    # use result instead of echo
    $result = '';

    if (is_array($cats)) {
      foreach ($cats as $cat_row) {
        // convert status to text
        $color = $cat_row->disabled ? '#797979' : '#3077d3';
        $cat_row->disabled = $cat_row->disabled ? 'Disabled' : 'Enabled';
        $args = $cat_row->id . ",'" . $cat_row->disabled . "'";
        $edit_args = $cat_row->id . ",'" . $cat_row->category . "'";

        $result .= '<tr>';

        $result .= '<td><a href="basic_table.html#">' . $cat_row->category . '</a></td>
            <td><span class="label label-info label-mini cursor " style="background-color:' . $color . ';" onclick="disableRow(' . $args . ')">' . $cat_row->disabled . '</span></td>

            <td>
              <button class="btn btn-primary btn-xs"><i class="fa fa-pencil" onclick="showEditCategory(' . $edit_args . ', event)"></i></button>

              <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o " onclick="deleteRow(' . $cat_row->id . ')"></i></button>
            </td>';
        $result .= '</tr>';
      }
    }

    return $result;
  }
}
