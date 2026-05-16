 <input type="hidden" value="<?php echo $_SESSION["LoginID"];?>">
 <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="../../index3.html" class="brand-link navbar-primary">
          <img/>
          <span class="brand-text font-weight-light">SIMS</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="pull-left image">
              <img
                src="assets/images/user.png"
                class="img-circle elevation-2"
                alt="User Image"
              >
            </div>
            <div class="pull-left info">
                <p style="color:white;"><?php echo $_SESSION["fname"]. " " .$_SESSION["lname"];?></p>
                <a href="#" class="d-block"><i class="fa fa-circle text-success"></i><?php echo $_SESSION["Department"];?></a>
            </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul
              class="nav nav-pills nav-sidebar flex-column"
              data-widget="treeview"
              role="menu"
              data-accordion="false"
            >
              <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
              <li class="nav-item">
                <a href="home.php" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>