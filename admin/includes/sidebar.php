<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-text mx-3">Waroeng Dahar Admin</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <?php  if($_SESSION['level'] == 'owner') : ?>
    <li class="nav-item active">
      <a class="nav-link" href="?f=dashboard&m=select">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>
  <?php  endif; ?>
  <li class="nav-item">
    <a class="nav-link" href="?f=kategori&m=select">
      <i class="fas fa-fw fa-chart-area"></i>
      <span>Kategori</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="?f=menu&m=select">
      <i class="fas fa-fw fa-chart-area"></i>
      <span>Menu</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-cog"></i>
      <span>Order Management</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="?f=order&m=select">Orders</a>
      </div>
    </div>
  </li>

  <!-- Nav Item - Pages Collapse Menu -->

  <?php if($_SESSION['level'] == 'owner') : ?>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menegement_user" aria-expanded="true" aria-controls="menegement_user">
          <i class="fas fa-fw fa-folder"></i>
          <span>Menegement User</span>
        </a>
        <div id="menegement_user" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="?f=user&m=select">Management Users</a>
            <a class="collapse-item" href="?f=pelanggan&m=select">Management pelanggan</a>
          </div>
        </div>
      </li>
  <?php  endif;?>
  

  <li class="nav-item">
    <a class="nav-link" href="?f=user&m=update_user&id=<?= $_SESSION['id_user']; ?>">
      <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
      <span>Setting</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->