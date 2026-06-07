<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-primary navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"
        ><i class="fas fa-bars"></i
      ></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="home.php" class="nav-link">Home</a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- profile -->
    <li class="nav-item dropdown user user-menu">
      <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
        <img
          src="assets/images/user.png"
          alt=""
          class="user-image"
          alt="User image"
        />
        <span class="d-none d-md-inline"
          ><?php echo $_SESSION["fname"]. " " .$_SESSION["lname"];?></span
        >
      </a>

      <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <li class="user-header text-center" id="user-header">
          <img src="assets/images/user.png" alt="" class="img-circle" />
          <p>
            <?php echo $_SESSION["fname"]. " " .$_SESSION["lname"];?>
            <small><?php echo $_SESSION["Department"];?></small>
          </p>
        </li>

        <!-- Menu body -->
        <!-- Menu Footer -->
        <li class="user-footer d-flex p-2">
          <a
            href="#"
            class="btn btn-default btn-flat flex-fill mr-1 text-center"
          >
            Profile
          </a>

          <a
            href="functions/logout.php"
            class="btn btn-default btn-flat flex-fill text-center"
          >
            Sign out
          </a>
        </li>
      </ul>
    </li>
  </ul>
</nav>
<!-- /.navbar -->
