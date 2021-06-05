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
  </style>

  <div class="col-md-12">
    <div class="content-panel">
      <table class="table table-striped table-advance table-hover">
        <h4><i class="fa fa-angle-right"></i> Products <button class="btn btn-primary btn-xs add" onclick="showAddNew(event)"><i class="fa fa-plus"></i> Add new product</button></h4>
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
                <input type="file" id="image" class="form-control" name="image" placeholder="" required>
              </div>
            </div>
            <div class="form-group ">
              <label for="" class="col-sm-3 control-label">Image 2 (Optional)</label>
              <div class="col-sm-9 mb">
                <input type="file" id="image2" class="form-control" name="image2" placeholder="">
              </div>
            </div>
            <div class="form-group ">
              <label for="" class="col-sm-3 control-label">Image 3 (Optional)</label>
              <div class="col-sm-9 mb">
                <input type="file" id="image3" class="form-control" name="image3" placeholder="">
              </div>
            </div>
            <div class="form-group ">
              <label for="" class="col-sm-3 control-label">Image 4 (Optional)</label>
              <div class="col-sm-9 mb">
                <input type="file" id="image4" class="form-control" name="image4" placeholder="">
              </div>
            </div>

            <button class="btn btn-warning save" type="button" onclick="showAddNew(event)">Cancel</button>
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
                <input type="text" id="product_edit" class="form-control" name="description" placeholder="Enter description" autofocus>
              </div>
            </div>

            <br><br style="clear: both;">
            <div class="form-group ">
              <label for="" class="col-sm-3 control-label">Product Category</label>
              <div class="col-sm-9 mb">


                <select name="category" id="product_edit" class="form-control" required>
                  <option value=""></option>
                  <!-- <?php if (is_array($categories)) : ?>
                    <?php foreach ($categories as $categ) : ?>
                      <option value="<?= $categ->id ?>"><?= $categ->$category ?></option>
                    <?php endforeach; ?>
                  <?php endif; ?> -->
                </select>
                <input type="text" class="form-control" placeholder="Enter category" autofocus>
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
                <input type="number" id="quantity" class="form-control" name="quantity" value="1" placeholder="">
              </div>
            </div>

            <br><br style="clear: both;">
            <div class="form-group ">
              <label for="" class="col-sm-3 control-label">Image</label>
              <div class="col-sm-9 mb">
                <input type="file" id="image" class="form-control" name="image" placeholder="" required>
              </div>
            </div>
            <div class="form-group ">
              <label for="" class="col-sm-3 control-label">Image 2 (Optional)</label>
              <div class="col-sm-9 mb">
                <input type="file" id="image2" class="form-control" name="image2" placeholder="">
              </div>
            </div>
            <div class="form-group ">
              <label for="" class="col-sm-3 control-label">Image 3 (Optional)</label>
              <div class="col-sm-9 mb">
                <input type="file" id="image3" class="form-control" name="image3" placeholder="">
              </div>
            </div>
            <div class="form-group ">
              <label for="" class="col-sm-3 control-label">Image 4 (Optional)</label>
              <div class="col-sm-9 mb">
                <input type="file" id="image4" class="form-control" name="image4" placeholder="">
              </div>
            </div>

            <button class="btn btn-warning save" type="" onclick="showEditProduct(0, '', event)">Cancel</button>
            <button class="btn btn-primary save" type="button" onclick="getEditData(event)">Update</button>
          </form>
        </div>
        <!-- end add new product -->
        <hr>
        <thead>
          <tr>
            <th> Product ID</th>
            <th> Product Name</th>
            <th> Category</th>
            <th> Quantity</th>
            <th> Price</th>
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

  function showAddNew() {
    let showModal = document.querySelector('.add-new');

    let product_input = document.querySelector('#description');
    showModal.classList.toggle('hide');

    product_input.focus();
    product_input.value = '';
  }

  function showEditProduct(id, product, e) {

    EDIT_ID = id; //in order to update the id of edited item

    let show_edit_modal = document.querySelector('.edit_product');

    // show modal on clicked position
    /* show_edit_modal.style.left = (e.clientX - 700) + 'px';
    show_edit_modal.style.top = (e.clientY - 140) + 'px'; */

    let product_input = document.querySelector('#product_edit');
    product_input.value = product;

    show_edit_modal.classList.toggle('hide');

    product_input.focus();
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

      return; //to exit function
    }

    let category_input = document.querySelector('#category');
    if (category_input.value.trim() == '' || isNaN(category_input.value.trim())) {
      alert('Please enter a valid category.');

      return; //to exit function
    }

    let price_input = document.querySelector('#price');
    if (price_input.value.trim() == '' || isNaN(price_input.value.trim())) {
      alert('Please enter a valid price.');

      return; //to exit function
    }

    // send form data
    let form_data = new FormData();
    form_data.append('description', product_input.value.trim());
    form_data.append('quantity', quantity_input.value.trim());
    form_data.append('category', category_input.value.trim());
    form_data.append('price', price_input.value.trim());
    form_data.append('data_type', 'add_product');

    sendDataFiles(form_data);

  }

  function getEditData(e) {
    let product_input = document.querySelector('#product_edit');

    if (product_input.value.trim() == '' || !isNaN(product_input.value.trim())) {
      alert('Please enter a valid product name.');
    }

    // send data as an object
    let data = product_input.value.trim();
    sendData({
      id: EDIT_ID,
      product: data,
      data_type: 'edit_product'
    });
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
            showAddNew();

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