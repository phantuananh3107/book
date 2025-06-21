<?php
session_start();
include "../dbconnect.php"; // Kết nối với file dbconnect.php ở thư mục cha



// Xử lý xóa sản phẩm
if (isset($_GET['delete_pid'])) {
    $delete_pid = mysqli_real_escape_string($con, $_GET['delete_pid']);
    $deleteQuery = "DELETE FROM products WHERE PID='$delete_pid'";
    if (mysqli_query($con, $deleteQuery)) {
        header("location: products-list.php?message=deleted");
        exit();
    } else {
        die("Lỗi khi xóa sản phẩm: " . mysqli_error($con));
    }
}

// Lấy dữ liệu sản phẩm (phim) từ cơ sở dữ liệu
$query = "SELECT * FROM products";
$result = mysqli_query($con, $query) or die(mysqli_error($con));
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Xử lý sắp xếp
$sort = isset($_POST['sort']) ? $_POST['sort'] : 'default';
if ($sort === 'title') {
    usort($products, function($a, $b) {
        return strcmp($a['Title'], $b['Title']);
    });
} elseif ($sort === 'title_desc') {
    usort($products, function($a, $b) {
        return strcmp($b['Title'], $a['Title']);
    });
} elseif ($sort === 'price') {
    usort($products, function($a, $b) {
        return $a['Price'] - $b['Price'];
    });
} elseif ($sort === 'price_desc') {
    usort($products, function($a, $b) {
        return $b['Price'] - $a['Price'];
    });
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />

  <title>Danh sách phim</title>
  <meta content="" name="description" />
  <meta content="" name="keywords" />

  <!-- Favicons -->
  <link href="assets/img/logo-icon.ico" rel="icon" />
  <link href="assets/img/logo-icon.ico" rel="apple-touch-icon" />

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet" />

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet" />
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet" />
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet" />
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet" />

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet" />

  <style>
    .table-responsive { margin-top: 20px; }
    .btn-action { margin-right: 5px; }
    .thumbnail-img { width: 50px; height: auto; }
  </style>
</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Tìm kiếm" title="Nhập từ khóa muốn tìm" />
        <button type="submit" title="Search">
          <i class="bi bi-search"></i>
        </button>
      </form>
    </div>
    <!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle" href="#">
            <i class="bi bi-search"></i>
          </a>
        </li>
        <!-- End Search Icon-->


        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/mini-user.jpg" alt="Profile" class="rounded-circle" />
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo htmlspecialchars($_SESSION['user']); ?></span> </a><!-- End Profile Image Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo htmlspecialchars($_SESSION['user']); ?></h6>
              <span>Người quản trị</span>
            </li>
            <li>
              <hr class="dropdown-divider" />
            </li>

            <li>
              <hr class="dropdown-divider" />
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="../dangxuat.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Đăng xuất</span>
              </a>
            </li>
          </ul>
          <!-- End Profile Dropdown Items -->
        </li>
        <!-- End Profile Nav -->
      </ul>
    </nav>
    <!-- End Icons Navigation -->
  </header>
  <!-- End Header -->
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="bi bi-grid"></i>
          <span>Tổng quan</span>
        </a>
      </li>
      <!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link "  href="products-list.php">
          <i class="bi bi-box-seam"></i><span>Quản lý sản phẩm</span>
        </a>
        
      </li>
      <!-- End Components Nav -->

     
      <!-- End Forms Nav -->
        <li class="nav-item">
        <a class="nav-link "  href="user-list.php">
          <i class="bi bi-person"></i><span>Quản lý tài khoản</span>
        </a>
        
      </li>
     
      <!-- End Tables Nav -->

      
      <!-- End Charts Nav -->

      <li class="nav-heading">Pages</li>

      
      <!-- End Profile Page Nav -->

    
      <!-- End F.A.Q Page Nav -->

      
      <!-- End Contact Page Nav -->
    </ul>
  </aside>

  <!-- End Sidebar -->

  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Quản lý phim</h1>
    </div>
    <!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <!-- Thông báo -->
              <?php if (isset($_GET['message'])): ?>
                <div class="alert alert-success mt-3">
                  <?php
                  if ($_GET['message'] === 'deleted') {
                      echo "Xóa phim thành công!";
                  } elseif ($_GET['message'] === 'updated') {
                      echo "Cập nhật phim thành công!";
                  } elseif ($_GET['message'] === 'added') {
                      echo "Thêm phim thành công!";
                  }
                  ?>
                </div>
              <?php endif; ?>

              <!-- Nút sắp xếp -->
              <div class="row mb-4">
                <div class="col-md-4">
                  <form method="post" action="" class="pull-right">
                    <label for="sort">Sắp xếp: </label>
                    <select name="sort" id="sort" onchange="this.form.submit()">
                      <option value="default" <?php echo ($sort === 'default') ? 'selected' : ''; ?>>Lựa chọn</option>
                      <option value="title" <?php echo ($sort === 'title') ? 'selected' : ''; ?>>Tên phim (A-Z)</option>
                      <option value="title_desc" <?php echo ($sort === 'title_desc') ? 'selected' : ''; ?>>Tên phim (Z-A)</option>
                      <option value="price" <?php echo ($sort === 'price') ? 'selected' : ''; ?>>Giá thấp nhất</option>
                      <option value="price_desc" <?php echo ($sort === 'price_desc') ? 'selected' : ''; ?>>Giá cao nhất</option>
                    </select>
                  </form>
                </div>
              </div>
      <a href="add-product.php" class="btn btn-primary">Thêm phim</a>
              <!-- Danh sách phim -->
              <div class="row" id="productContainer">
                <div class="col-12">
                  <div class="table-responsive">
                    <table class="table table-borderless datatable">
                      <thead>
                        <tr>
                          <th scope="col">Mã phim</th>
                          <th scope="col">Tên phim</th>
                          <th scope="col">Tác giả</th>
                          <th scope="col">Giá gốc (VND)</th>
                          <th scope="col">Giá bán (VND)</th>
                          <th scope="col">Giảm giá (%)</th>
                          <th scope="col">Số lượng tồn</th>
                          <th scope="col">Thao tác</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            foreach ($products as $product) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($product['PID']) . "</td>";
                                echo "<td>" . htmlspecialchars($product['Title']) . "</td>";
                                echo "<td>" . htmlspecialchars($product['Author']) . "</td>";
                                echo "<td>" . number_format($product['MRP'], 0, ',', '.') . " VND</td>";
                                echo "<td>" . number_format($product['Price'], 0, ',', '.') . " VND</td>";
                                echo "<td>" . $product['Discount'] . "%</td>";
                                echo "<td>" . $product['Available'] . "</td>";
                                echo "<td>
                                    <a href='repair-product.php?pid=" . urlencode($product['PID']) . "' class='btn btn-primary btn-action'>Sửa</a>
                                    <a href='?delete_pid=" . urlencode($product['PID']) . "' class='btn btn-danger btn-action' onclick='return confirm(\"Bạn có chắc muốn xóa?\");'>Xóa</a>
                                </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='8' class='text-center'>Không có phim nào.</td></tr>";
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!-- End #main -->

  <!-- ======= Footer ======= -->
  <!-- End Footer -->

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
  <script src="assets/js/products-list.js"></script>
  <script src="assets/js/validate-product.js"></script>
</body>
</html>