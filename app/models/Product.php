<?php
class Product
{
  public function create($DATA)
  {
    # code...
    $DB = Database::newInstance();

    $arr['description'] = ucwords($DATA->data);

    // validate user input
    if (!preg_match("/^[a-zA-Z ]+$/", trim($arr['description']))) {
      $_SESSION['error'] = 'Please enter a valid description for this product!';
    }

    # create product
    if (!isset($_SESSION['error']) || $_SESSION['error'] == "") {
      $sql = "INSERT INTO `products` (`description`) VALUES (:description)";
      $check = $DB->write($sql, $arr);

      if ($check) {
        # check if it returns a result
        return true;
      }
    }

    return false;
  }

  public function edit($id, $description)
  {
    $DB = Database::newInstance();
    $arr['id'] = $id;
    $arr['description'] = $description;
    $sql = "UPDATE products SET `description`=:description WHERE id = :id LIMIT 1";
    $DB->write($sql, $arr);
  }

  public function getAll()
  {
    $DB = Database::newInstance();
    return $DB->read("SELECT * FROM products ORDER BY id DESC");
  }

  public function delete($id)
  {
    # code...
    $DB = Database::newInstance();
    $id = (int) $id; //to prevent hacking validate id as an integer
    $sql = "DELETE FROM products WHERE id = '{$id}' LIMIT 1";
    $DB->write($sql);
  }

  public function makeTable($cats)
  {
    # use result instead of echo
    $result = '';

    if (is_array($cats)) {
      foreach ($cats as $cat_row) {
        // convert status to text
        $edit_args = $cat_row->id . ",'" . $cat_row->description . "'";

        $result .= '<tr>';

        $result .= '<td><a href="basic_table.html#">' . $cat_row->description . '</a></td>
            <td>
              <button class="btn btn-primary btn-xs"><i class="fa fa-pencil" onclick="showEditProduct(' . $edit_args . ', event)"></i></button>

              <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o " onclick="deleteRow(' . $cat_row->id . ')"></i></button>
            </td>';
        $result .= '</tr>';
      }
    }

    return $result;
  }
}
