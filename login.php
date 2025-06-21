<?php
session_start();
include "dbconnect.php";

if (isset($_POST['submit']) && $_POST['submit'] == "login") {
    $username = mysqli_real_escape_string($con, $_POST['login_username']);
    $password = mysqli_real_escape_string($con, $_POST['login_password']);
    
    $query = "SELECT * FROM users WHERE UserName = '$username' AND Password = '$password'";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user'] = $row['UserName'];
        echo '<script type="text/javascript">
                alert("Đăng nhập thành công!");
                window.location.href = "index.php";
              </script>';
        exit();
    } else {
        echo '<script type="text/javascript">
                alert("Tên người dùng hoặc mật khẩu không đúng!");
                window.location.href = "login.php";
              </script>';
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Books">
    <meta name="author" content="Shivangi Gupta">
    <title>Đăng nhập tài khoản</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/my.css" rel="stylesheet">
    <style>
        body { margin-top: 70px; }
        .container { max-width: 500px; }
    </style>
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Thanh điều hướng</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><img alt="Brand" src="img/logo.jpg" style="width: 118px;margin-top: -7px;margin-left: -10px;"></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="index.php" class="btn btn-md"><span class="glyphicon glyphicon-home"> Trang chủ</span></a></li>
                    <li><a href="register.php" class="btn btn-md"><span class="glyphicon glyphicon-user"> Đăng ký</span></a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                <h2 style="color:#D67B22;text-transform:uppercase;margin-bottom:20px;">Đăng nhập tài khoản</h2>
            </div>
        </div>

        <form method="post" action="">
            <div class="form-group">
                <label for="login_username">Tên người dùng</label>
                <input type="text" class="form-control" id="login_username" name="login_username" placeholder="Nhập tên người dùng" required>
            </div>
            <div class="form-group">
                <label for="login_password">Mật khẩu</label>
                <input type="password" class="form-control" id="login_password" name="login_password" placeholder="Nhập mật khẩu" required>
            </div>
            <button type="submit" name="submit" value="login" class="btn btn-primary btn-block">Đăng nhập</button>
        </form>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>