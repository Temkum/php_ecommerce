<?php
class Category
{
  public function create($Data)
  {
    # code...
    $DB = Database::getInstance();

    $arr['category'] = ucwords($Data->data);

    // validate user input
    if (!preg_match("/^[a-zA-Z ]+$/", trim($arr['category']))) {
      $_SESSION['error'] = 'Please enter a valid category name!';
    }

    # create category
    if (!isset($_SESSION['error']) && $_SESSION['error'] == "") {
      $sql = "INSERT INTO `categories` (`category`) VALUES (:category)";
      $check = $DB->write($sql, $arr);

      if ($check) {
        # check if it returns a result
        return true;
      }
    }

    return false;
  }

  public function edit($Data)
  {
    # code...
  }

  public function getAll()
  {
    $DB = Database::newInstance();
    return $DB->read('SELECT * FROM `categories` ORDER BY id DESC');
  }

  public function delete($Data)
  {
    # code...
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

        $result .= '<tr>';

        $result .= '<td><a href="basic_table.html#">' . $cat_row->category . '</a></td>
            <td><span class="label label-info label-mini cursor " style="background-color:' . $color . ';" onclick="disableRow(' . $args . ')">' . $cat_row->disabled . '</span></td>

            <td>
              <button class="btn btn-primary btn-xs"><i class="fa fa-pencil" onclick="editRow(' . $cat_row->id . ')"></i></button>

              <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o " onclick="deleteRow(' . $cat_row->id . ')"></i></button>
            </td>';
        $result .= '</tr>';
      }
    }

    return $result;
  }
}
