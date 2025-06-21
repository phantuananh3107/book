<?php
include "dbconnect.php";

if (isset($_POST['submit']) && $_POST['submit'] == "register") {
    $username = mysqli_real_escape_string($con, $_POST['register_username']);
    $email = mysqli_real_escape_string($con, $_POST['register_email']);
    $password = mysqli_real_escape_string($con, $_POST['register_password']);
    $confirm_password = mysqli_real_escape_string($con, $_POST['confirm_password']);

    // Kiểm tra mật khẩu và nhập lại mật khẩu có khớp không
    if ($password !== $confirm_password) {
        echo '<script type="text/javascript">
                alert("Mật khẩu không khớp, vui lòng thử lại.");
                window.location.href = "register.php";
              </script>';
        exit();
    }

    // Kiểm tra xem username đã tồn tại chưa
    $query = "SELECT * FROM users WHERE UserName = '$username'";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    if (mysqli_num_rows($result) > 0) {
        echo '<script type="text/javascript">
                alert("Tên đã được sử dụng, vui lòng đặt tên khác.");
                window.location.href = "register.php";
              </script>';
        exit();
    }

    // Kiểm tra xem email đã tồn tại chưa
    $query = "SELECT * FROM users WHERE Email = '$email'";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    if (mysqli_num_rows($result) > 0) {
        echo '<script type="text/javascript">
                alert("Email đã được sử dụng, vui lòng sử dụng email khác.");
                window.location.href = "register.php";
              </script>';
        exit();
    }

    // Thêm người dùng mới vào cơ sở dữ liệu
    $query = "INSERT INTO users (UserName, Email, Password) VALUES ('$username', '$email', '$password')";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));

    // Hiển thị thông báo đăng ký thành công và chuyển hướng về trang đăng nhập
    echo '<script type="text/javascript">
            alert("Đăng ký tài khoản thành công!");
            window.location.href = "login.php";
          </script>';
    exit();
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
    <title>Đăng ký tài khoản</title>
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
                    <li><a href="index.php" class="btn btn-md"><span class="glyphicon glyphicon-log-in"> Quay lại</span></a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                <h2 style="color:#D67B22;text-transform:uppercase;margin-bottom:20px;">Đăng ký tài khoản</h2>
            </div>
        </div>

        <form method="post" action="">
            <div class="form-group">
                <label for="register_username">Tên người dùng</label>
                <input type="text" class="form-control" id="register_username" name="register_username" placeholder="Nhập tên người dùng" required>
            </div>
            <div class="form-group">
                <label for="register_email">Email</label>
                <input type="email" class="form-control" id="register_email" name="register_email" placeholder="Nhập email" required>
            </div>
            <div class="form-group">
                <label for="register_password">Mật khẩu</label>
                <input type="password" class="form-control" id="register_password" name="register_password" placeholder="Nhập mật khẩu" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Nhập lại mật khẩu</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Nhập lại mật khẩu" required>
            </div>
            <button type="submit" name="submit" value="register" class="btn btn-primary btn-block">Đăng ký</button>
        </form>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>