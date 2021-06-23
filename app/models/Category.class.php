<?php
class Category
{
  public function create($DATA)
  {
    # code...
    $DB = Database::newInstance();

    $arr['category'] = ucwords($DATA->category);
    $arr['parent'] = ucwords($DATA->parent);

    // validate user input
    if (!preg_match("/^[a-zA-Z ]+$/", trim($arr['category']))) {
      $_SESSION['error'] = 'Please enter a valid category name!';
    }

    # create category
    if (!isset($_SESSION['error']) || $_SESSION['error'] == "") {
      $sql = "INSERT INTO `categories` (`category`, parent) VALUES (:category,:parent)";
      $check = $DB->write($sql, $arr);

      if ($check) {
        # check if it returns a result
        return true;
      }
    }

    return false;
  }

  public function edit($data)
  {
    $DB = Database::newInstance();
    $arr['id'] = $data->id;
    $arr['category'] = $data->category;
    $arr['parent'] = $data->parent;
    $sql = "UPDATE categories set `category`=:category, parent=:parent WHERE id = :id LIMIT 1";
    $DB->write($sql, $arr);
  }

  public function getAll()
  {
    $DB = Database::newInstance();
    return $DB->read('SELECT * FROM `categories` ORDER BY id DESC');
  }

  public function getOne($id)
  {

    $id = (int) $id; // sanitize item
    $DB = Database::newInstance();
    $data = $DB->read("SELECT * FROM `categories` WHERE id='$id' LIMIT 1");

    return $data[0]; //to return one item instead of an array of arrays
  }

  public function delete($id)
  {
    # code...
    $DB = Database::newInstance();
    $id = (int) $id; //to prevent hacking validate id as an integer
    $sql = "DELETE FROM categories WHERE id = '{$id}' LIMIT 1";
    $DB->write($sql);
  }

  public function makeTable($cats)
  {
    # use result instead of echo
    $result = '';

    if (is_array($cats)) {
      foreach ($cats as $cat_row) {
        // convert status to text
        $color = $cat_row->disabled ? '#797979' : '#3077d3';
        $cat_row->disabled = $cat_row->disabled ? 'Disabled' : 'Enabled';

        $args = $cat_row->id . ",'" . $cat_row->disabled . "'";
        $edit_args = $cat_row->id . ",'" . $cat_row->category . "', " . $cat_row->parent;

        $parent = '';

        foreach ($cats as $cat_row2) {
          if ($cat_row->parent == $cat_row2->id) {
            $parent = $cat_row2->category;
          }
        }

        $result .= '<tr>';

        $result .= '<td><a href="basic_table.html#">' . $cat_row->category . '</a></td>
            <td><a href="basic_table.html#">' . $parent . '</a></td>
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
