<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>SIMS | Login</title>

    <link rel="stylesheet" href="assets/css/index.css">

    <?php include "layout/css.php" ?>
</head>
<body>
    <section>
        <div style="height: 100%; width:100%;">
            <div class="login-container">
                <div class="box">

                    <div class="box-body col-md-12">
                        <p class="login-box-msg">Sign in to start your session</p>

                        <div id="login_error" class="login-box-msg" style="color: red;">
                            <span id="error"></span>
                        </div>
                        <form>
                            <div class="form-group has-feedback">
                                <input type="text" class="form-control" placeholder="Username" id="username">
                            </div>

                            <div class="form-group has-feedback" style="display: relative;">
                                <input type="text" class="form-control" placeholder="Password" id="password">
                                <span id="toggleIcon"
                                    class="fa fa-eye">
                                </span>
                            </div>

                            <div>
                                <button type="button" class="btn btn-primary btn-block btn-flat" id="btnSignIn">Sign In</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>