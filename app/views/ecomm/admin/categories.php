<?php $this->view('admin/header', $data); ?>
<?php $this->view('admin/sidebar', $data); ?>

<div class="row mt">
  <style>
    .add {
      margin-left: 15px;
      padding: 3px 7px;
    }

    .add-new {
      width: 60%;
      height: 300px;
      left: 20%;
      background-color: #cecece;
      position: absolute;
      padding: 7px;
    }

    .show {
      display: block;
    }

    .hide {
      display: none;
    }
  </style>

  <div class="col-md-12">
    <div class="content-panel">
      <table class="table table-striped table-advance table-hover">
        <h4><i class="fa fa-angle-right"></i> Product Categories <button class="btn btn-primary btn-xs add" onclick="showAddNew(event)"><i class="fa fa-plus"></i> Add new</button></h4>
        <!-- add new category -->
        <div class="add-new hide">

        </div>
        <hr>
        <thead>
          <tr>
            <th><i class="fa fa-bullhorn"></i> Category</th>
            <th class="hidden-phone"><i class="fa fa-question-circle"></i> Description</th>
            <th><i class="fa fa-bookmark"></i> Price</th>
            <th><i class="fa fa-bookmark"></i> Status</th>
            <th><i class=" fa fa-edit"></i> Action</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><a href="basic_table.html#">Company Ltd</a></td>
            <td class="hidden-phone">Lorem Ipsum dolor</td>
            <td>12000.00$ </td>
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
  function showAddNew(e) {
    let showModal = document.querySelector('.add-new');
    showModal.classList.toggle('hide');
  }
</script>

<?php $this->view('admin/footer', $data); ?>