<?php
$page = "app";
session_start();
require_once 'config/database.php';
require_once 'core/guard.php';

requireAccess($pdo, $_SESSION['LoginID'] ?? null, basename($_SERVER['PHP_SELF']));
?>
<!doctype html>
<html lang="en">

<head>
  <title>SIMS | Profile</title>

  <?php include 'includes/css.php' ?>
</head>

<body class="sidebar-mini layout-fixed">
  <!-- Site wrapper -->
  <div class="wrapper">
    <?php include "includes/loader.php";
    include "includes/header.php";
    include
      "includes/sidebar.php"; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Profile</h1>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-primary card-outline">
                <div class="card-header">
                  <div class="right">
                    <img
                      src="assets/images/user.png"
                      alt="User Profile Picture"
                      class="profile-user-img img-fluid img-circle" />
                  </div>
                  <div class="card-title">
                    <h3>Personal Information</h3>
                  </div>
                </div>
                <div class="card-body box-profile">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="firstname">Firstname</label><span class="error" id="firstname-error"></span>
                          <input
                            type="text"
                            class="form-control"
                            id="firstname" />
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="lastname">Lastname</label><span class="error" id="lastname-error"></span>
                          <input
                            type="text"
                            class="form-control"
                            id="lastname" />
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="email">Email</label><span class="error" id="email-error"></span>
                          <input
                            type="text"
                            class="form-control"
                            id="email" />
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="department">Department</label><span class="error" id="department-error"></span>
                          <input
                            type="text"
                            class="form-control"
                            id="department" />
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="position">Position</label><span class="error" id="position-error"></span>
                          <input
                            type="text"
                            class="form-control"
                            id="position" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="col md-12">
                    <div class="float-right">
                      <div class="btn-group">
                        <button type="button" class="btn btn-success" id="personalInfoEditBtn">
                          <i class="fa fa-edit"></i> Edit
                        </button>
                      </div>
                      <div class="btn-group">
                        <button
                          type="button"
                          class="btn btn-primary"
                          style="display: none" id="personalInfoUpdateBtn">
                          <i class="fa fa-save"></i>
                          Update
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card card-primary card-outline">
                <div class="card-header">
                  <div class="card-title">
                    <h3>Security Information</h3>
                  </div>
                </div>
                <div class="card-body">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="username">Username</label><span class="error" id="username-error"></span>
                          <input
                            type="text"
                            class="form-control"
                            id="username" />
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="password">Password</label><span class="error" id="password-error"></span>
                          <input
                            type="text"
                            class="form-control"
                            id="password" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="col md-12">
                    <div class="float-right">
                      <div class="btn-group">
                        <button type="button" class="btn btn-success" id="securityInfoEditBtn">
                          <i class="fa fa-edit"></i> Edit
                        </button>
                      </div>
                      <div class="btn-group">
                        <button
                          type="button"
                          class="btn btn-primary"
                          style="display: none" id="securityInfoUpdateBtn">
                          <i class="fa fa-save"></i>
                          Update
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
      <div class="float-right d-none d-sm-block"><b>Version</b> 1.0.0</div>
      <strong>Copyright &copy; 2026 <a href="index.php">SIMS</a>.</strong>
      All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <?php include 'includes/js.php'; ?>

  <script type="module" src="assets/js/module/profile.js"></script>
</body>

</html>