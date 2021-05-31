<?php $this->view('admin/header', $data); ?>
<?php $this->view('admin/sidebar', $data); ?>

<div class="row mt">
  <style>
    .add {
      margin-left: 15px;
      padding: 3px 7px;
    }

    .add-new {
      width: 50%;
      height: 300px;
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
      margin-left: 30px;
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
                <input type="text" id="category" class="form-control" name="category" placeholder="Enter product category" autofocus>
              </div>
            </div>
            <button class="btn btn-warning save" type="" onclick="showAddNew(event)">Cancel</button>
            <button class="btn btn-primary save" type="button" onclick="collectData(event)">Save</button>
          </form>
        </div>
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
          <?php
          $DB = Database::newInstance();
          $categories = $DB->read('SELECT * FROM `categories` ORDER BY id DESC');

          $category = $this->loadModel('Category');
          $tbl_rows = $category->makeTable($categories);

          ?>
          <tr>
            <td><a href="basic_table.html#">Company Ltd</a></td>
            <td><span class="label label-info label-mini">Enabled</span></td>
            <td>
              <button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
              <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
              <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
            </td>
          </tr>
        </tbody>
      </table>
    </div><!-- /content-panel -->
  </div><!-- /col-md-12 -->
</div><!-- /row -->

<script>
  function showAddNew() {
    let showModal = document.querySelector('.add-new');
    showModal.classList.toggle('hide');

    let cat_input = document.querySelector('#category');
    cat_input.focus();

    cat_input.value = '';
  }

  // AJAX request
  function collectData(e) {
    let cat_input = document.querySelector('#category');
    if (cat_input.value.trim() == '' || !isNaN(cat_input.value.trim())) {
      alert('Please enter a valid category.');
    }

    // send data as an object
    let data = cat_input.value.trim();
    sendData({
      data: data,
      data_type: 'add_category'
    });
  }

  function sendData(data = {}) {
    // create new ajax object
    let ajax = new XMLHttpRequest();

    // send data as a form
    // let form = new FormData();
    // form.append('data', data);

    ajax.addEventListener('readystatechange', function() {
      if (ajax.readyState == 4 && ajax.status == 200) {
        handleResult(ajax.responseText);
      }
    });

    ajax.open('POST', '<?= ROOT ?>ajax', true); //true here is to tell it to run in the background
    ajax.send(JSON.stringify(data));
  }

  function handleResult(result) {
    // check if result is not empty
    if (result != '') {
      let obj = JSON.parse(result);

      // keep dialogue box open if error exist
      if (typeof obj.msg_type != 'undefined') {

        if (obj.msg_type == 'success') {
          alert(obj.msg);
          showAddNew();

          let table = document.querySelector('#table_body');
          table_body.innerHTML = obj.data;
        } else {
          alert(obj.msg);
        }
      }
    }
  }
</script>

<?php $this->view('admin/footer', $data); ?>