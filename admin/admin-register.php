<?php
include "../dbconnect.php";

if (isset($_POST['submit']) && $_POST['submit'] == "register") {
    $username = mysqli_real_escape_string($con, $_POST['register_username']);
    $email = mysqli_real_escape_string($con, $_POST['register_email']);
    $password = mysqli_real_escape_string($con, $_POST['register_password']);
    $confirm_password = mysqli_real_escape_string($con, $_POST['confirm_password']);

    // Kiểm tra mật khẩu và nhập lại mật khẩu có khớp không
    if ($password !== $confirm_password) {
        echo '<script type="text/javascript">
                alert("Mật khẩu không khớp, vui lòng thử lại.");
                window.location.href = "admin-register.php";
              </script>';
        exit();
    }

    // Kiểm tra xem username đã tồn tại chưa
    $query = "SELECT * FROM users WHERE UserName = '$username'";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    if (mysqli_num_rows($result) > 0) {
        echo '<script type="text/javascript">
                alert("Tên đã được sử dụng, vui lòng đặt tên khác.");
                window.location.href = "admin-register.php";
              </script>';
        exit();
    }

    // Kiểm tra xem email đã tồn tại chưa
    $query = "SELECT * FROM users WHERE Email = '$email'";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    if (mysqli_num_rows($result) > 0) {
        echo '<script type="text/javascript">
                alert("Email đã được sử dụng, vui lòng sử dụng email khác.");
                window.location.href = "admin-register.php";
              </script>';
        exit();
    }

    // Thêm người dùng mới vào cơ sở dữ liệu
    $query = "INSERT INTO users (UserName, Email, Password) VALUES ('$username', '$email', '$password')";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));

    // Hiển thị thông báo đăng ký thành công và chuyển hướng về trang đăng nhập
    echo '<script type="text/javascript">
            alert("Đăng ký tài khoản thành công!");
            window.location.href = "admin-login.php";
          </script>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Đăng ký | Cửa hàng sách</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/logo-icon.ico" rel="icon">
  <link href="assets/img/logo-icon.ico" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.php" class="logo d-flex align-items-center w-auto">
                  
                  <span class="d-none d-lg-block">Cửa hàng sách</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Tạo tài khoản</h5>
                    <p class="text-center small">Nhập thông tin để tạo tài khoản</p>
                  </div>

                  <form class="row g-3 needs-validation form-register" method="POST" action="admin-register.php">
                    <div class="col-12">
                      <label for="register_username" class="form-label">Tên đăng nhập</label>
                      <input type="text" name="register_username" class="form-control" id="register_username" required>
                      <div class="invalid-feedback">Vui lòng nhập tên đăng nhập!</div>
                    </div>

                    <div class="col-12">
                      <label for="register_email" class="form-label">Email</label>
                      <input type="email" name="register_email" class="form-control" id="register_email" required>
                      <div class="invalid-feedback">Vui lòng nhập email hợp lệ!</div>
                    </div>

                    <div class="col-12">
                      <label for="register_password" class="form-label">Mật khẩu</label>
                      <input type="password" name="register_password" class="form-control" id="register_password" required>
                      <div class="invalid-feedback">Vui lòng nhập mật khẩu!</div>
                    </div>

                    <div class="col-12">
                      <label for="confirm_password" class="form-label">Xác nhận mật khẩu</label>
                      <input type="password" name="confirm_password" class="form-control" id="confirm_password" required>
                      <div class="invalid-feedback">Vui lòng nhập lại mật khẩu!</div>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-secondary w-100 button-register" type="submit" name="submit" value="register">Đăng ký</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Đã có tài khoản? <a href="admin-login.php">Đăng nhập</a></p>
                    </div>
                  </form>

                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <!-- Bỏ validate-account.js để tránh lỗi -->
  <!-- <script src="assets/js/validate-account.js"></script> -->

</body>

</html>