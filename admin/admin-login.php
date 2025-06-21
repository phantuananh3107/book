<?php
session_start();

// Kết nối với file dbconnect.php
include "../dbconnect.php";

// Kiểm tra kết nối
if (!$con) {
    die("Kết nối cơ sở dữ liệu thất bại: " . mysqli_connect_error());
}

// Xử lý form đăng nhập
if (isset($_POST['submit']) && $_POST['submit'] == "login") {
    $username = mysqli_real_escape_string($con, $_POST['login_username']);
    $password = mysqli_real_escape_string($con, $_POST['login_password']);

    // Kiểm tra dữ liệu đầu vào
    if (empty($username) || empty($password)) {
        echo '<script type="text/javascript">
                alert("Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu!");
                window.location.href = "admin-login.php";
              </script>';
        exit();
    }

    // Sử dụng prepared statement để kiểm tra người dùng
    $stmt = $con->prepare("SELECT * FROM users WHERE UserName = ? AND Password = ?");
    if (!$stmt) {
        echo '<script type="text/javascript">
                alert("Lỗi chuẩn bị truy vấn: ' . addslashes(mysqli_error($con)) . '");
                window.location.href = "admin-login.php";
              </script>';
        exit();
    }

    $stmt->bind_param("ss", $username, $password);
    if (!$stmt->execute()) {
        echo '<script type="text/javascript">
                alert("Lỗi thực thi truy vấn: ' . addslashes($stmt->error) . '");
                window.location.href = "admin-login.php";
              </script>';
        exit();
    }

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        // Đăng nhập thành công
        $_SESSION['user'] = $username;
        echo '<script type="text/javascript">
                alert("Đăng nhập thành công!");
                window.location.href = "index.php";
              </script>';
        exit();
    } else {
        echo '<script type="text/javascript">
                alert("Tên đăng nhập hoặc mật khẩu không đúng!");
                window.location.href = "admin-login.php";
              </script>';
        exit();
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Đăng nhập </title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <!-- Favicons -->
    <link href="assets/img/logo-icon.ico" rel="icon" />
    <link href="assets/img/logo-icon.ico" rel="apple-touch-icon" />

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect" />
    <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
      rel="stylesheet"
    />

    <!-- Vendor CSS Files -->
    <link
      href="assets/vendor/bootstrap/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="assets/vendor/bootstrap-icons/bootstrap-icons.css"
      rel="stylesheet"
    />
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet" />
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet" />
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet" />
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet" />

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet" />
  </head>

  <body style="background-image: url(./assets/img/background.png);">
    <main>
      <div class="container">
        <section
          class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4"
        >
          <div class="container">
            <div class="row justify-content-center">
              <div
                class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center"
              >
                <div class="d-flex justify-content-center py-4">
                  <a
                    href="../index.php"
                    class="logo d-flex align-items-center w-auto"
                  >
                    
                    <span class="d-none d-lg-block">Cửa hàng sách</span>
                  </a>
                </div>
                <!-- End Logo -->

                <div class="card mb-3" style="display: flex; flex-direction: row; width: 800px; padding: 10px; border-radius: 45px;">
                  <div>
                    <img src="./assets/img/login2.png" alt="" style="width: 100%;">
                  </div>
                  
                  <div class="card-body">
                    <div class="pt-4 pb-2" style="margin-top: 40px;">
                      <h5 class="card-title text-center pb-0 fs-4">
                        Đăng nhập tài khoản
                      </h5>
                    </div>

                    <form class="row g-3 needs-validation" method="POST" action="admin-login.php" novalidate>
                      <div class="col-12">
                        <label for="login_username" class="form-label">Tên đăng nhập</label>
                        <div class="input-group has-validation">
                          <input
                            type="text"
                            name="login_username"
                            class="form-control"
                            id="login_username"
                            required
                          />
                          <div class="invalid-feedback">
                            Vui lòng nhập tên của bạn!
                          </div>
                        </div>
                      </div>

                      <div class="col-12">
                        <label for="login_password" class="form-label">Mật khẩu</label>
                        <input
                          type="password"
                          name="login_password"
                          class="form-control"
                          id="login_password"
                          required
                        />
                        <div class="invalid-feedback">
                          Vui lòng nhập mật khẩu của bạn!
                        </div>
                      </div>

                      <div class="col-12">
                        <div class="form-check" style="display: flex; justify-content: space-between;">
                          <div>
                            <input
                              class="form-check-input"
                              type="checkbox"
                              name="remember"
                              value="true"
                              id="rememberMe"
                            />
                            <label class="form-check-label" for="rememberMe">Lưu mật khẩu</label>
                          </div>
                          <a href="#" style="text-align: right; color: #212529;">Quên mật khẩu?</a>
                        </div>
                      </div>
                      <div class="col-12">
                        <button class="btn btn-secondary w-100" type="submit" name="submit" value="login">
                          Đăng nhập
                        </button>
                      </div>
                      <div class="col-12">
                        <p class="small mb-0">
                          Chưa có tài khoản?
                          <a href="admin-register.php">Tạo tài khoản</a>
                        </p>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </main>
    <!-- End #main -->

    <a
      href="#"
      class="back-to-top d-flex align-items-center justify-content-center"
      ><i class="bi bi-arrow-up-short"></i
    ></a>

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
  </body>
</html>