<input type="hidden" id="LoginID" value="<?php echo $_SESSION["LoginID"];?>">
<input type="hidden" id="fname" value="<?php echo $_SESSION["fname"];?>">
<input type="hidden" id="lname" value="<?php echo $_SESSION["lname"];?>">
<input type="hidden" id="Department" value="<?php echo $_SESSION["Department"];?>">
<input type="hidden" id="RoleID" value="<?php echo $_SESSION["Role"];?>">
 <input type="hidden" id="Permission" value='<?= htmlspecialchars(
            json_encode($_SESSION["permissionArray"], JSON_UNESCAPED_UNICODE),
            ENT_QUOTES,
            "UTF-8"
          ); ?>'>
 <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4 ">
        <!-- Brand Logo -->
        <a href="home.php" class="brand-link navbar-primary">
          <img/>
          <span class="brand-text font-weight-light">SIMS</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user (optional) -->
          <div class="user-panel mt-3 mb-3 d-flex">
            <div class="pull-left image">
              <img
                src="assets/images/user.png"
                class="img-circle elevation-2"
                alt="User Image"
              >
            </div>
            <div class="pull-left info">
                <p style="color:white;"><?php echo $_SESSION["fname"]. " " .$_SESSION["lname"];?></p>
                <small><a href="#" class="d-block"><i class="fa fa-circle text-success"></i><?php echo $_SESSION["Department"];?></a></small>
            </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2 ">
            <ul
              class="nav nav-pills nav-sidebar flex-column"
              data-widget="treeview"
              role="menu"
              data-accordion="false"
              id="sidebar-menu"
            >
              <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
             
            </ul >
          </nav>
          <!-- /.sidebar-menu -->     
        </div>
        <!-- /.sidebar -->
      </aside>