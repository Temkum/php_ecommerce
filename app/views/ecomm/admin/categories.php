<?php $this->view('admin/header', $data); ?>
<?php $this->view('admin/sidebar', $data); ?>

<div class="row mt">
  <style>
    .add {
      margin-left: 15px;
      padding: 3px 7px;
    }

    .add-new,
    .edit_category {
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
        <h4><i class="fa fa-angle-right"></i> Product Categories <button class="btn btn-primary btn-xs add" onclick="showAddNew(event)"><i class="fa fa-plus"></i> Add new</button></h4>
        <!-- add new category -->
        <div class="add-new hide">
          <h5 class="ml-3">New category</h5>
          <form action="" class="form-horizontal style-form mt-2" method="POST">
            <div class="form-group ">
              <label for="" class="col-sm-3 control-label">Category Name</label>
              <div class="col-sm-9 mb">
                <input type="text" id="category" class="form-control" name="category" placeholder="Enter category name" autofocus>
              </div>
            </div>

            <div class="form-group ">
              <label for="" class="col-sm-3 control-label">Parent (Optional)</label>
              <div class="col-sm-9 mb">
                <select name="parent" id="parent" class="form-control" required>
                  <option value="">Select parent</option>
                  <?php if (is_array($categories)) : ?>
                    <?php foreach ($categories as $categ) : ?>
                      <option value="<?= $categ->id ?>"><?= $categ->category ?></option>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </select>
              </div>
            </div>
            <button class="btn btn-warning save" type="" onclick="showAddNew(event)">Cancel</button>
            <button class="btn btn-primary save" type="button" onclick="collectData(event)">Save</button>
          </form>
        </div>
        <!-- end add new category -->

        <!-- EDIT category -->
        <div class="edit_category hide">
          <h5 class="ml-3">Edit category</h5>
          <form action="" class="form-horizontal style-form mt-2" method="POST">
            <div class="form-group ">
              <label for="" class="col-sm-3 control-label">Category Name</label>
              <div class="col-sm-9 mb">
                <input type="text" id="category_edit" class="form-control" name="category" placeholder="Enter category name" autofocus>
              </div>
            </div>

            <div class="form-group ">
              <label for="" class="col-sm-3 control-label">Parent (Optional)</label>
              <div class="col-sm-9 mb">
                <select name="parent" id="parent_edit" class="form-control" required>
                  <option value="">Select parent</option>
                  <?php if (is_array($categories)) : ?>
                    <?php foreach ($categories as $categ) : ?>
                      <option value="<?= $categ->id ?>"><?= $categ->category ?></option>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </select>
              </div>
            </div>
            <button class="btn btn-warning save" type="" onclick="showEditCategory(0, '', event)">Cancel</button>
            <button class="btn btn-primary save" type="button" onclick="getEditData(event)">Update</button>
          </form>
        </div>
        <!-- end add new category -->
        <hr>
        <thead>
          <tr>
            <th><i class="fa fa-bullhorn"></i> Category</th>
            <th><i class="fa fa-bookmark"></i> Status</th>
            <th><i class=" fa fa-edit"></i> Action</th>
            <th></th>
          </tr>
        </thead>
        <tbody id="table_body">
          <?= $data['tbl_rows']; ?>
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

    let cat_input = document.querySelector('#category');
    showModal.classList.toggle('hide');

    cat_input.focus();
    cat_input.value = '';
  }

  function showEditCategory(id, category, e) {

    EDIT_ID = id; //in order to update the id of edited item

    let show_edit_modal = document.querySelector('.edit_category');

    // show modal on clicked position
    /* show_edit_modal.style.left = (e.clientX - 700) + 'px';
    show_edit_modal.style.top = (e.clientY - 140) + 'px'; */

    let cat_input = document.querySelector('#category_edit');
    cat_input.value = category;

    show_edit_modal.classList.toggle('hide');

    cat_input.focus();
  }

  /* function showEditCategory(id, category) {
    let show_edit_modal = document.querySelector('.add_new');
    let cat_input = document.querySelector('#category_edit');
    cat_input.value = category;

    if (show_edit_modal.classList.contains('hide')) {
      show_edit_modal.classList.remove('hide');
      cat_input.focus();
    } else {
      show_edit_modal.classList.add('hide');
      cat_input.value = '';
    }
  } */

  // AJAX request
  function collectData(e) {
    let cat_input = document.querySelector('#category');

    if (cat_input.value.trim() == '' || !isNaN(cat_input.value.trim())) {
      alert('Please enter a valid category name.');
    }

    // send data as an object
    let data = cat_input.value.trim();
    sendData({
      data: data,
      data_type: 'add_category'
    });
  }

  function getEditData(e) {
    let cat_input = document.querySelector('#category_edit');

    if (cat_input.value.trim() == '' || !isNaN(cat_input.value.trim())) {
      alert('Please enter a valid category name.');
    }

    // send data as an object
    let data = cat_input.value.trim();
    sendData({
      id: EDIT_ID,
      category: data,
      data_type: 'edit_category'
    });
  }

  function sendData(data = {}) {
    // create new ajax object
    let ajax = new XMLHttpRequest();

    // send data as a form
    /*  let form = new FormData();
     form.append('data', data); */

    ajax.addEventListener('readystatechange', function() {
      if (ajax.readyState == 4 && ajax.status == 200) {
        handleResult(ajax.responseText);
      }
    });

    ajax.open('POST', '<?= ROOT ?>ajaxcategory', true); //true here is to tell it to run in the background
    ajax.send(JSON.stringify(data));
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
        if (obj.data_type == 'edit_category') {

          showEditCategory(0, '', false);

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