<?php
session_start();
include "../dbconnect.php"; // Kết nối với file dbconnect.php ở thư mục cha



// Lấy thông tin sản phẩm để chỉnh sửa
if (isset($_GET['pid'])) {
    $pid = mysqli_real_escape_string($con, $_GET['pid']);
    $query = "SELECT * FROM products WHERE PID = '$pid'";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    $product = mysqli_fetch_assoc($result);

    if (!$product) {
        die("Sản phẩm không tồn tại.");
    }

    // Xử lý cập nhật sản phẩm
    if (isset($_POST['update_product'])) {
        $title = mysqli_real_escape_string($con, $_POST['productName']);
        $author = mysqli_real_escape_string($con, $_POST['productAuthor']);
        $mrp = mysqli_real_escape_string($con, $_POST['productMrp']);
        $price = mysqli_real_escape_string($con, $_POST['productPrice']);
        $discount = mysqli_real_escape_string($con, $_POST['productDiscount']);
        $available = mysqli_real_escape_string($con, $_POST['productQuantity']);

        $updateQuery = "UPDATE products SET 
                        Title='$title', 
                        Author='$author', 
                        MRP='$mrp', 
                        Price='$price', 
                        Discount='$discount', 
                        Available='$available' 
                        WHERE PID='$pid'";
        
        mysqli_query($con, $updateQuery) or die(mysqli_error($con));
        header("location: products-list.php?message=updated");
        exit();
    }

    // Xử lý xóa sản phẩm
    if (isset($_POST['delete_product'])) {
        $deleteQuery = "DELETE FROM products WHERE PID='$pid'";
        mysqli_query($con, $deleteQuery) or die(mysqli_error($con));
        header("location: products-list.php?message=deleted");
        exit();
    }
} else {
    die("Không có sản phẩm để chỉnh sửa.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Chỉnh sửa phim</title>

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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
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
        <a class="nav-link" href="products-list.php">
          <i class="bi bi-box-seam"></i><span>Quản lý sản phẩm</span>
        </a>
      </li>
      <!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-person"></i><span>Quản lý tài khoản</span>
        </a>
      </li>
      <!-- End Tables Nav -->
    </ul>
  </aside>
  <!-- End Sidebar-->

  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Chỉnh sửa phim</h1>
    </div>

    <div class="card">
      <div class="card-body">
        <form method="post" action="">
          <!-- Hàng 1 -->
          <div class="row mt-4 mb-4">
            <div class="col-md-6 d-flex align-items-center">
              <label for="productName" class="form-label" style="width: 150px;">Tên phim</label>
              <input type="text" class="form-control" id="productName" name="productName" value="<?php echo htmlspecialchars($product['Title']); ?>" style="margin-left: 40px;" required>
            </div>
            <div class="col-md-6 d-flex align-items-center">
              <label for="productAuthor" class="form-label" style="width: 150px;">Tác giả</label>
              <input type="text" class="form-control" id="productAuthor" name="productAuthor" value="<?php echo htmlspecialchars($product['Author']); ?>" style="margin-left: 40px;" required>
            </div>
          </div>

          <!-- Hàng 2 -->
          <div class="row mb-3">
            <div class="col-md-6 d-flex align-items-center">
              <label for="productMrp" class="form-label" style="width: 150px;">Giá gốc</label>
              <input type="number" class="form-control" id="productMrp" name="productMrp" value="<?php echo $product['MRP']; ?>" style="margin-left: 40px;" required>
            </div>
            <div class="col-md-6 d-flex align-items-center">
              <label for="productPrice" class="form-label" style="width: 150px;">Giá bán</label>
              <input type="number" class="form-control" id="productPrice" name="productPrice" value="<?php echo $product['Price']; ?>" style="margin-left: 40px;" required>
            </div>
          </div>

          <!-- Hàng 3 -->
          <div class="row mb-3">
            <div class="col-md-6 d-flex align-items-center">
              <label for="productDiscount" class="form-label" style="width: 150px;">Giảm giá (%)</label>
              <input type="number" class="form-control" id="productDiscount" name="productDiscount" value="<?php echo $product['Discount']; ?>" style="margin-left: 40px;" readonly>
            </div>
            <div class="col-md-6 d-flex align-items-center">
              <label for="productQuantity" class="form-label" style="width: 150px;">Số lượng tồn kho</label>
              <input type="number" class="form-control" id="productQuantity" name="productQuantity" value="<?php echo $product['Available']; ?>" style="margin-left: 40px;" required>
            </div>
          </div>

          <!-- Nút cập nhật và xóa -->
          <div class="d-flex justify-content-end gap-2">
            <button type="submit" name="update_product" class="btn btn-success btn-update-product">Cập nhật phim</button>
            <button type="submit" name="delete_product" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa phim này?')">Xóa phim</button>
          </div>
        </form>
      </div>
    </div>
  </main>

  <div class="gtranslate_wrapper"></div>
  <script src="https://cdn.gtranslate.net/widgets/latest/float.js" defer="defer"></script>
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
  <script src="assets/js/validate-product.js"></script>

  <!-- JavaScript để tính toán giảm giá tự động -->
  <script>
    const mrpInput = document.getElementById('productMrp');
    const priceInput = document.getElementById('productPrice');
    const discountInput = document.getElementById('productDiscount');

    function calculateDiscount() {
      const mrp = parseFloat(mrpInput.value) || 0;
      const price = parseFloat(priceInput.value) || 0;
      if (mrp > 0) {
        const discount = Math.round(((mrp - price) / mrp) * 100);
        discountInput.value = discount > 0 ? discount : 0;
      } else {
        discountInput.value = 0;
      }
    }

    mrpInput.addEventListener('input', calculateDiscount);
    priceInput.addEventListener('input', calculateDiscount);
  </script>
</body>
</html>