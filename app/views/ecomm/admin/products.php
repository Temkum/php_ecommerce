<?php $this->view('admin/header', $data); ?>
<?php $this->view('admin/sidebar', $data); ?>

<div class="row mt">
  <style>
    .add {
      margin-left: 15px;
      padding: 3px 7px;
    }

    .add-new,
    .edit_product {
      width: 50%;
      height: auto;
      left: 20%;
      background-color: #cecece;
      position: absolute;
      padding: 7px;
      box-shadow: 0px 0px 8px #aaa;
    }

    .show {
      display: block;
    }

    .hide {
      display: none;
    }

    .save {
      float: right;
      margin-top: 10px;
      margin-right: 15px;
    }

    .mb {
      margin-bottom: 2rem;
    }

    .mt-2 {
      margin-top: 2rem;
    }

    .ml-3 {
      margin-left: 16px;
    }

    input[type='file'] {
      margin-top: 4px;
    }

    .edit-product-imgs {
      display: inline-block;
    }

    .img-fluid {
      width: 50px;
      height: 50px;
      margin: 10px;
      border-radius: 10px;
    }
  </style>

  <div class="col-md-12">
    <div class="content-panel">
      <table class="table table-striped table-advance table-hover">
        <h4><i class="fa fa-angle-right"></i> Products <button class="btn btn-primary btn-xs add" onclick="addNew(event)"><i class="fa fa-plus"></i> Add new product</button></h4>
        <!-- add new product -->
        <div class="add-new hide">
          <h5 class="ml-3">New product</h5>
          <form action="" class="form-horizontal style-form mt-2" method="POST">
            <div class="form-group ">
              <label for="" class="col-sm-3 control-label">Product Name</label>
              <div class="col-sm-9 mb">
                <input type="text" id="description" class="form-control" name="description" placeholder="Enter product name" autofocus>
              </div>
            </div>

            <br><br style="clear: both;">
            <div class="form-group ">
              <label for="" class="col-sm-3 control-label">Product Category</label>
              <div class="col-sm-9 mb">
                <select name="category" id="category" class="form-control" required>
                  <option value="">Select product category</option>
                  <?php if (is_array($categories)) : ?>
                    <?php foreach ($categories as $categ) : ?>
                      <option value="<?= $categ->id ?>"><?= $categ->category ?></option>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </select>
              </div>
            </div>

            <br><br style="clear: both;">
            <div class="form-group ">
              <label for="" class="col-sm-3 control-label">Price</label>
              <div class="col-sm-9 mb">
                <input type="number" id="price" class="form-control" name="price" placeholder="0.00" autofocus required>
              </div>
            </div>

            <br><br style="clear: both;">
            <div class="form-group ">
              <label for="" class="col-sm-3 control-label">Quantity</label>
              <div class="col-sm-9 mb">
                <input type="number" id="quantity" class="form-control" name="quantity" value="1" placeholder="" autofocus>
              </div>
            </div>

            <br><br style="clear: both;">
            <div class="form-group ">
              <label for="" class="col-sm-3 control-label">Image</label>
              <div class="col-sm-9 mb">
                <input type="file" id="image" class="" name="image" placeholder="" required>
              </div>
            </div>
            <div class="form-group ">
              <label for="" class="col-sm-3 control-label">Image 2 (Optional)</label>
              <div class="col-sm-9 mb">
                <input type="file" id="image2" class="" name="image2" placeholder="">
              </div>
            </div>
            <div class="form-group ">
              <label for="" class="col-sm-3 control-label">Image 3 (Optional)</label>
              <div class="col-sm-9 mb">
                <input type="file" id="image3" class="" name="image3" placeholder="">
              </div>
            </div>
            <div class="form-group ">
              <label for="" class="col-sm-3 control-label">Image 4 (Optional)</label>
              <div class="col-sm-9 mb">
                <input type="file" id="image4" class="" name="image4" placeholder="">
              </div>
            </div>

            <button class="btn btn-warning save" type="button" onclick="addNew(event)">Cancel</button>
            <button class="btn btn-primary save" type="button" onclick="collectData(event)">Save</button>
          </form>
        </div>
        <!-- end add new product -->

        <!-- EDIT product -->
        <div class="edit_product hide">
          <h5 class="ml-3">Edit product</h5>
          <form action="" class="form-horizontal style-form mt-2" method="POST">
            <div class="form-group ">
              <label for="" class="col-sm-3 control-label">Product Name</label>
              <div class="col-sm-9 mb">
                <input type="text" id="edit_description" class="form-control" name="description" placeholder="Enter description" autofocus>
              </div>
            </div>

            <br><br style="clear: both;">
            <div class="form-group ">
              <label for="" class="col-sm-3 control-label">Product Category</label>
              <div class="col-sm-9 mb">
                <select name="category" id="edit_category" class="form-control" required>
                  <option value="">Select category</option>
                  <?php if (is_array($categories)) : ?>
                    <?php foreach ($categories as $categ) : ?>
                      <option value="<?= $categ->id ?>"><?= $categ->category ?></option>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </select>
              </div>
            </div>

            <br><br style="clear: both;">
            <div class="form-group ">
              <label for="" class="col-sm-3 control-label">Price</label>
              <div class="col-sm-9 mb">
                <input type="number" id="edit_price" class="form-control" name="price" placeholder="0.00" required>
              </div>
            </div>

            <br><br style="clear: both;">
            <div class="form-group ">
              <label for="" class="col-sm-3 control-label">Quantity</label>
              <div class="col-sm-9 mb">
                <input type="number" id="edit_quantity" class="form-control" name="quantity" value="1" placeholder="">
              </div>
            </div>

            <br><br style="clear: both;">
            <div class="form-group ">
              <label for="" class="col-sm-3 control-label">Image</label>
              <div class="col-sm-9 mb">
                <input type="file" id="edit_image" class="" name="image" placeholder="" required>
              </div>
            </div>
            <div class="form-group ">
              <label for="" class="col-sm-3 control-label">Image 2 (Optional)</label>
              <div class="col-sm-9 mb">
                <input type="file" id="edit_image2" class="" name="image2" placeholder="">
              </div>
            </div>
            <div class="form-group ">
              <label for="" class="col-sm-3 control-label">Image 3 (Optional)</label>
              <div class="col-sm-9 mb">
                <input type="file" id="edit_image3" class="" name="image3" placeholder="">
              </div>
            </div>
            <div class="form-group ">
              <label for="" class="col-sm-3 control-label">Image 4 (Optional)</label>
              <div class="col-sm-9 mb">
                <input type="file" id="edit_image4" class="" name="image4" placeholder="">
              </div>
            </div>

            <div class="js-images edit-product-imgs">

            </div>

            <button class="btn btn-warning save" type="button" onclick="showEditProduct(event)">Cancel</button>
            <button class="btn btn-primary save" type="button" onclick="getEditData(event)">Update</button>
          </form>
        </div>
        <!-- end edit product -->
        <hr>
        <thead>
          <tr>
            <th> Product ID</th>
            <th> Product Name</th>
            <th> Category</th>
            <th> Quantity</th>
            <th> Price</th>
            <th> Image</th>
            <th> Date</th>
            <th> Action</th>
          </tr>
        </thead>
        <tbody id="table_body">
          <?= $tbl_rows ?>
        </tbody>
      </table>
    </div><!-- /content-panel -->
  </div><!-- /col-md-12 -->
</div><!-- /row -->

<script>
  // set global id
  let EDIT_ID = 0;

  function addNew() {
    let showModal = document.querySelector('.add-new');

    let product_input = document.querySelector('#description');
    showModal.classList.toggle('hide');

    product_input.focus();
    product_input.value = '';
  }


  function showEditProduct(id, product, e) {
    let showModal = document.querySelector('.edit_product');

    if (e) {
      let alrt = (e.currentTarget.getAttribute("info"));
      let info = JSON.parse(alrt.replaceAll("'", '"'));

      EDIT_ID = info.id; //get id of edited item

      // show modal on clicked position
      /* show_edit_modal.style.left = (e.clientX - 700) + 'px';
      show_edit_modal.style.top = (e.clientY - 140) + 'px'; */

      let edit_description = document.querySelector('#edit_description');
      edit_description.value = info.description;

      let edit_category = document.querySelector('#edit_category');
      edit_category.value = info.category;

      let edit_price = document.querySelector('#edit_price');
      edit_price.value = info.price;

      let edit_quantity = document.querySelector('#edit_quantity');
      edit_quantity.value = info.quantity;

      let edit_images = document.querySelector('.js-images');
      edit_images.innerHTML = `<img class="img-fluid" src="<?= ROOT ?>${info.image}"/>`;
      edit_images.innerHTML += `<img class="img-fluid" src="<?= ROOT ?>${info.image2}"/>`;
      edit_images.innerHTML += `<img class="img-fluid" src="<?= ROOT ?>${info.image3}"/>`;
      edit_images.innerHTML += `<img class="img-fluid" src="<?= ROOT ?>${info.image4}"/>`;
    }
    showModal.classList.toggle('hide');

    /*  if (showModal.classList.contains('hide')) {
       showModal.classList.remove('hide');
     } else {
       showModal.classList.add('hide');

     } */
  }

  // AJAX request
  function collectData(e) {
    let product_input = document.querySelector('#description');
    if (product_input.value.trim() == '' || !isNaN(product_input.value.trim())) {
      alert('Please enter a valid product name.');

      return; //to exit function
    }

    let quantity_input = document.querySelector('#quantity');
    if (quantity_input.value.trim() == '' || isNaN(quantity_input.value.trim())) {
      alert('Please enter a valid quantity.');

      return;
    }

    let category_input = document.querySelector('#category');
    if (category_input.value.trim() == '' || isNaN(category_input.value.trim())) {
      alert('Please enter a valid category.');

      return;
    }

    let price_input = document.querySelector('#price');
    if (price_input.value.trim() == '' || isNaN(price_input.value.trim())) {
      alert('Please enter a valid price.');

      return;
    }

    // create form
    let data = new FormData();

    let image_input = document.querySelector('#image');
    if (image_input.files.length > 0) {
      data.append('image', image_input.files[0]);
    }

    let image2_input = document.querySelector('#image2');
    if (image2_input.files.length > 0) {
      data.append('image2', image2_input.files[0]);
    }

    let image3_input = document.querySelector('#image3');
    if (image3_input.files.length > 0) {
      data.append('image3', image3_input.files[0]);
    }

    let image4_input = document.querySelector('#image4');
    if (image4_input.files.length > 0) {
      data.append('image4', image4_input.files[0]);
    }

    // send form data
    data.append('description', product_input.value.trim());
    data.append('quantity', quantity_input.value.trim());
    data.append('category', category_input.value.trim());
    data.append('price', price_input.value.trim());
    data.append('image', image_input.files[0]);
    data.append('data_type', 'add_product');

    sendDataFiles(data);

  }

  function getEditData(e) {
    let product_input = document.querySelector('#edit_description');
    if (product_input.value.trim() == '' || !isNaN(product_input.value.trim())) {
      alert('Please enter a valid product name.');

      return; //to exit function
    }

    let quantity_input = document.querySelector('#edit_quantity');
    if (quantity_input.value.trim() == '' || isNaN(quantity_input.value.trim())) {
      alert('Please enter a valid quantity.');

      return;
    }

    let category_input = document.querySelector('#edit_category');
    if (category_input.value.trim() == '' || isNaN(category_input.value.trim())) {
      alert('Please enter a valid category.');

      return;
    }

    let price_input = document.querySelector('#edit_price');
    if (price_input.value.trim() == '' || isNaN(price_input.value.trim())) {
      alert('Please enter a valid price.');

      return;
    }

    let image_input = document.querySelector('#edit_image');
    if (image_input.files.length == 0) {
      alert('Please enter a valid main image.')
    }

    // create form
    let data = new FormData();

    let image2_input = document.querySelector('#edit_image2');
    if (image2_input.files.length > 0) {
      data.append('image2', image2_input.files[0]);
    }

    let image3_input = document.querySelector('#edit_image3');
    if (image3_input.files.length > 0) {
      data.append('image3', image3_input.files[0]);
    }

    let image4_input = document.querySelector('#edit_image4');
    if (image4_input.files.length > 0) {
      data.append('image4', image4_input.files[0]);
    }

    // send form data
    data.append('description', product_input.value.trim());
    data.append('quantity', quantity_input.value.trim());
    data.append('category', category_input.value.trim());
    data.append('price', price_input.value.trim());
    data.append('data_type', 'edit_product');
    data.append('id', EDIT_ID);

    sendDataFiles(data);
  }

  function sendData(data = {}) {
    // create new ajax object
    let ajax = new XMLHttpRequest();

    ajax.addEventListener('readystatechange', function() {
      if (ajax.readyState == 4 && ajax.status == 200) {
        handleResult(ajax.responseText);
      }
    });

    ajax.open('POST', '<?= ROOT ?>ajaxproduct', true); //true here is to tell it to run in the background
    ajax.send(JSON.stringify(data));
  }

  function sendDataFiles(formData) {
    // create new ajax object
    let ajax = new XMLHttpRequest();

    ajax.addEventListener('readystatechange', function() {
      if (ajax.readyState == 4 && ajax.status == 200) {
        handleResult(ajax.responseText);
      }
    });

    ajax.open('POST', '<?= ROOT ?>ajaxproduct', true); //true here is to tell it to run in the background
    ajax.send(formData);
  }

  function handleResult(result) {
    // check if result is not empty
    if (result != '') {

      let obj = JSON.parse(result);

      // keep dialogue box open if error exist
      if (typeof obj.data_type != 'undefined') {

        if (obj.data_type == 'add_new') {

          if (obj.msg_type == 'success') {
            alert(obj.msg);
            addNew();

            let table_body = document.querySelector('#table_body');
            table_body.innerHTML = obj.data;
          } else {
            alert(obj.msg);
          }

        } else
        if (obj.data_type == 'disable_row') {
          let table_body = document.querySelector('#table_body');
          table_body.innerHTML = obj.data;
        } else
        if (obj.data_type == 'delete_row') {

          let table_body = document.querySelector('#table_body');
          table_body.innerHTML = obj.data;

          alert(obj.msg);
        } else
        if (obj.data_type == 'edit_product') {

          showEditProduct(0, '', false);

          let table_body = document.querySelector('#table_body');
          table_body.innerHTML = obj.data;
        }
      }
    }
  }

  function editRow(id) {
    sendData({
      data_type: '',
    })
  }

  function deleteRow(id) {
    //  confirm row delete
    if (!confirm('Are you sure you want to delete this row?')) {

      return;
    }

    sendData({
      data_type: 'delete_row',
      id: id
    })
  }

  function disableRow(id, state) {
    sendData({
      data_type: 'disable_row',
      id: id,
      current_state: state
    })
  }
</script>

<?php $this->view('admin/footer', $data); ?>