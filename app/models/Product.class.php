<?php
class Product
{
  public function create($DATA, $FILES)
  {
    # code...
    $DB = Database::newInstance();

    $arr['description'] = ucwords($DATA->description);
    $arr['quantity'] = ucwords($DATA->quantity);
    $arr['category'] = ucwords($DATA->category);
    $arr['price'] = ucwords($DATA->price);
    $arr['image'] = ucwords($DATA->image);
    $arr['date'] = date('Y-m-d H:i:s');
    $arr['user_url'] = $_SESSION['user_url'];

    // validate user input
    if (!preg_match("/^[a-zA-Z ]+$/", trim($arr['description']))) {
      $_SESSION['error'] .= 'Please enter a valid description for this product!<br>';
    }

    if (!is_numeric($arr['quantity'])) {
      $_SESSION['error'] .= 'Please enter a valid quantity!<br>';
    }
    if (!is_numeric($arr['category'])) {
      $_SESSION['error'] .= 'Please enter a valid category!<br>';
    }
    if (!is_numeric($arr['price'])) {
      $_SESSION['error'] .= 'Please enter a valid price!<br>';
    }

    $arr['image'] = '';
    $arr['image2'] = '';
    $arr['image3'] = '';
    $arr['image4'] = '';

    // set whitelisting rules
    $allowed[] = 'image/jpeg';
    $allowed[] = 'image/jpg';
    $allowed[] = 'image/png';
    $allowed[] = 'image/gif';
    $allowed[] = 'image/tif';
    $allowed[] = 'image/svg';
    $allowed[] = 'application/pdf';

    $size = 10;
    $size = ($size * 1024 * 1024);

    $dir = 'uploads/';
    if (!file_exists($dir)) {
      mkdir($dir, 0777, true);
    }

    // check if files are set
    foreach ($FILES as $key => $img_row) {
      # code...
      if ($img_row['error'] == 0 && in_array($img_row['type'], $allowed)) {
        if ($img_row['size'] <= $size) {
          # code...
          $destination = $dir . $img_row['name'];

          move_uploaded_file($img_row['tmp_name'], $destination);

          $arr[$key] = $destination;
        } else {
          $_SESSION['error'] .= $key . ' is bigger than required size.';
        }
      }
    }

    # create product
    if (!isset($_SESSION['error']) || $_SESSION['error'] == "") {
      $sql = "INSERT INTO `products` (`description`, `quantity`, `category`, `price`, `user_url`, `date`, `image`, image2, image3, image4) VALUES (:description, :quantity, :category, :price, :user_url, :date, :image, :image2, :image3, :image4)";
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
    $sql = "UPDATE `products` SET `description`=:description WHERE `id` = :id LIMIT 1";
    $DB->write($sql, $arr);
  }

  public function getAll()
  {
    $DB = Database::newInstance();
    return $DB->read("SELECT * FROM `products` ORDER BY id DESC");
  }

  public function delete($id)
  {
    # code...
    $DB = Database::newInstance();
    $id = (int) $id; //to prevent hacking validate id as an integer
    $sql = "DELETE FROM products WHERE id = '{$id}' LIMIT 1";
    $DB->write($sql);
  }

  public function makeTable($cats, $model = null)
  {
    # use result instead of echo
    $result = '';

    if (is_array($cats)) {
      foreach ($cats as $cat_row) {
        // convert status to text
        $edit_args = $cat_row->id . ",'" . $cat_row->description . "'";

        $info = [];
        $info['id'] = $cat_row->id;
        $info['description'] = $cat_row->description;
        $info['quantity'] = $cat_row->quantity;
        $info['price'] = $cat_row->price;
        $info['category'] = $cat_row->category;
        $info['image'] = $cat_row->image;
        $info['image2'] = $cat_row->image2;
        $info['image3'] = $cat_row->image3;
        $info['image4'] = $cat_row->image4;

        // convert info into json
        $info = str_replace('"', "'", json_encode($info));

        // $cat_class = $this->loadModel('Category');

        $one_cat = $model->getOne($cat_row->category);

        $result .= '<tr>';

        $result .= '<td><a href="basic_table.html#">' . $cat_row->id . '</a></td>
        <td><a href="basic_table.html#">' . $cat_row->description . '</a></td>
        <td><a href="basic_table.html#">' . $one_cat->category . '</a></td>
        <td><a href="basic_table.html#">' . $cat_row->quantity . '</a></td>
        <td><a href="basic_table.html#">' . $cat_row->price . '</a></td>
        <td><a href="basic_table.html#"><img src="' . ROOT . $cat_row->image . '?>" width="50px" height="50px"></a></td>
        <td><a href="basic_table.html#">' . date("jS M, y H:i:s", strtotime($cat_row->date)) . '</a></td>

        <td>
          <button info="' . $info . '" class="btn btn-primary btn-xs"><i class="fa fa-pencil" onclick="editProduct(' . $edit_args . ', event)"></i></button>
          
          <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o " onclick="deleteRow(' . $cat_row->id . ')"></i></button>
        </td>';
        $result .= '</tr>';
      }
    }

    return $result;
  }
}
