<?php
class Product
{
  public function create($DATA, $FILES, $image_class = null)
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
    $arr['slug'] = $this->strToURL($DATA->description);

    // validate user input
    if (!preg_match("/^[a-zA-Z 0-9._\-,]+$/", trim($arr['description']))) {
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

    // make slug unique
    $slug_arr['slug'] = $arr['slug'];
    $sql = "SELECT slug FROM products WHERE slug=:slug LIMIT 1";
    $check = $DB->read($sql);

    if ($check) {

      $arr['slug'] .= "-" . rand(0, 9999);
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
        if ($img_row['size'] < $size) {
          # code...
          $destination = $dir . $image_class->generate_filename(60) . '.jpg';

          move_uploaded_file($img_row['tmp_name'], $destination);

          $arr[$key] = $destination;

          $image_class->resize_image($destination, $destination, 1080, 1080);
        } else {
          $_SESSION['error'] .= $key . ' is bigger than required size.';
        }
      }
    }

    # create product
    if (!isset($_SESSION['error']) || $_SESSION['error'] == "") {
      $sql = "INSERT INTO `products` (`description`, `quantity`, `category`, `price`, `user_url`, `date`, `image`, image2, image3, image4, slug) VALUES (:description, :quantity, :category, :price, :user_url, :date, :image, :image2, :image3, :image4,:slug)";
      $check = $DB->write($sql, $arr);

      if ($check) {
        # check if it returns a result
        return true;
      }
    }

    return false;
  }

  public function edit($data, $FILES, $image_class = null)
  {
    $arr['id'] = $data->id;
    $arr['description'] = $data->description;
    $arr['category'] = $data->category;
    $arr['quantity'] = $data->quantity;
    $arr['price'] = $data->price;
    $imgs_string = '';

    // validate user input
    if (!preg_match("/^[a-zA-Z 0-9._\-,]+$/", trim($arr['description']))) {
      $_SESSION['error'] .= 'Please enter a valid description for this product!';
    }
    if (!is_numeric($arr['quantity'])) {
      $_SESSION['error'] .= 'Please enter a valid quantity!';
    }
    if (!is_numeric($arr['category'])) {
      $_SESSION['error'] .= 'Please enter a valid category!';
    }
    if (!is_numeric($arr['price'])) {
      $_SESSION['error'] .= 'Please enter a valid price!';
    }

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
        if ($img_row['size'] < $size) {
          # code...
          $destination = $dir . $image_class->generate_filename(60) . '.jpg';
          move_uploaded_file($img_row['tmp_name'], $destination);
          $arr[$key] = $destination;

          $image_class->resize_image($destination, $destination, 1080, 1080);

          $imgs_string .= ',' . $key . '= :' . $key;
        } else {
          $_SESSION['error'] .= $key . ' is bigger than required size.';
        }
      }
    }

    if (!isset($_SESSION['error']) || $_SESSION['error'] == '') {
      # code...
      $DB = Database::newInstance();

      $sql = "UPDATE `products` SET `description`=:description,`category`=:category,`quantity`=:quantity,`price`=:price '{$imgs_string}' WHERE `id` = :id LIMIT 1";
      $DB->write($sql, $arr);
    }
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
        <td><a href="basic_table.html#">$' . $cat_row->price . '</a></td>
        <td><a href="basic_table.html#"><img src="' . ROOT . $cat_row->image . '?>" width="50px" height="50px"></a></td>
        <td><a href="basic_table.html#">' . date("jS M, y H:i:s", strtotime($cat_row->date)) . '</a></td>

        <td>
          <button  class="btn btn-primary btn-xs">
          <i class="fa fa-pencil fa-2x" info="' . $info . '" onclick="showEditProduct(' . $edit_args . ', event)"></i>
          </button>

          <button class="btn btn-danger btn-xs "><i class="fa fa-trash-o fa-2x" onclick="deleteRow(' . $cat_row->id . ')"></i>
          </button>
        </td>';
        $result .= '</tr>';
      }
    }

    return $result;
  }

  public function strToURL($url)
  {
    # code...
    $url = preg_replace("~[^\\pL0-9_]+~u", "-", $url);
    $url = trim($url, "-");
    $url = iconv('utf-8', 'us-ascii//TRANSLIT', $url);
    $url = strtolower($url);
    $url = preg_replace('~[^-a-z0-9_]+~', '', $url);

    return $url;
  }
}
