<!--sidebar start-->
<aside>
  <div id="sidebar" class="nav-collapse ">
    <!-- sidebar menu start-->
    <ul class="sidebar-menu" id="nav-accordion">

      <p class="centered"><a href="profile.html"><img src="<?= ASSETS ?>admin/img/ui-sam.jpg" class="img-circle" width="60"></a></p>
      <h5 class="centered"><?php echo $data['user_data']->name ?></h5>
      <h6 class="centered"><?php echo $data['user_data']->email ?></h6>

      <li class="mt">
        <a href="index.html">
          <i class="fa fa-dashboard"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <li class="sub-menu">
        <a href="<?= ROOT ?>admin/products">
          <i class="fa fa-barcode"></i>
          <span>Products</span>
        </a>
        <ul class="sub">
          <li><a href="<?= ROOT ?>admin/products/add">Add new product</a></li>
          <li><a href="<?= ROOT ?>admin/products/edit">Edit product</a></li>
          <li><a href="<?= ROOT ?>admin/products/delete">Delete</a></li>
        </ul>
      </li>

      <li class="sub-menu">
        <a href="<?= ROOT ?>admin/categories">
          <i class="fa fa-list-alt"></i>
          <span>Categories</span>
        </a>
        <ul class="sub">
          <li><a href="<?= ROOT ?>admin/categories/add">Add new category</a></li>
          <li><a href="<?= ROOT ?>admin/categories/edit">Edit category</a></li>
          <li><a href="<?= ROOT ?>admin/categories/delete">Delete</a></li>
        </ul>
      </li>

      <li class="sub-menu">
        <a href="<?= ROOT ?>admin/orders">
          <i class="fa fa-reorder"></i>
          <span>Orders</span>
        </a>
      </li>

      <li class="sub-menu">
        <a href="<?= ROOT ?>admin/settings">
          <i class="fa fa-cogs"></i>
          <span>Settings</span>
        </a>
        <ul class="sub">
          <li><a href="<?= ROOT ?>admin/settings/slider">Image slider</a></li>
        </ul>
      </li>

      <li class="sub-menu">
        <a class="" href="<?= ROOT ?>admin/users">
          <i class="fa fa-user"></i>
          <span>Users</span>
        </a>
        <ul class="sub">
          <li><a href="<?= ROOT ?>admin/users/customers">Customers</a></li>
          <li><a href="<?= ROOT ?>admin/users/admins">Admins</a></li>
        </ul>
      </li>

      <li class="sub-menu">
        <a class="" href="<?= ROOT ?>admin/backup">
          <i class="fa fa-hdd-o"></i>
          <span>Website Backup</span>
        </a>
      </li>
    </ul>
    <!-- sidebar menu end-->
  </div>
</aside>
<!--sidebar end-->