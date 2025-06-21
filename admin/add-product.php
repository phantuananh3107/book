<?php
session_start();
include "../dbconnect.php"; // Kết nối với file dbconnect.php ở thư mục cha



// Xử lý thêm sản phẩm
if (isset($_POST['add_product'])) {
    $pid = mysqli_real_escape_string($con, $_POST['pid']);
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $author = mysqli_real_escape_string($con, $_POST['author']);
    $mrp = mysqli_real_escape_string($con, $_POST['mrp']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $discount = mysqli_real_escape_string($con, $_POST['discount']);
    $available = mysqli_real_escape_string($con, $_POST['available']);
    $publisher = mysqli_real_escape_string($con, $_POST['publisher']);
    $edition = mysqli_real_escape_string($con, $_POST['edition']);
    $category = mysqli_real_escape_string($con, $_POST['category']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $language = mysqli_real_escape_string($con, $_POST['language']);
    $page = mysqli_real_escape_string($con, $_POST['page']);
    $weight = mysqli_real_escape_string($con, $_POST['weight']);

    // Chèn dữ liệu vào bảng products
    $insertQuery = "INSERT INTO products (PID, Title, Author, MRP, Price, Discount, Available, Publisher, Edition, Category, Description, Language, page, weight) 
                    VALUES ('$pid', '$title', '$author', '$mrp', '$price', '$discount', '$available', '$publisher', '$edition', '$category', '$description', '$language', '$page', '$weight')";
    
    mysqli_query($con, $insertQuery) or die(mysqli_error($con));
    header("location: products-list.php?message=added");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Thêm phim mới</title>

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
      <h1>Thêm phim mới</h1>
    </div>

    <div class="card">
      <div class="card-body">
        <form method="post" action="">
          <!-- Hàng 1 -->
          <div class="row mt-4 mb-4">
            <div class="col-md-6 d-flex align-items-center">
              <label for="pid" class="form-label" style="width: 150px;">Mã phim</label>
              <input type="text" class="form-control" id="pid" name="pid" placeholder="Nhập mã phim" style="margin-left: 40px;" required>
            </div>
            <div class="col-md-6 d-flex align-items-center">
              <label for="title" class="form-label" style="width: 150px;">Tên phim</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="Nhập tên phim" style="margin-left: 40px;" required>
            </div>
          </div>

          <!-- Hàng 2 -->
          <div class="row mb-3">
            <div class="col-md-6 d-flex align-items-center">
              <label for="author" class="form-label" style="width: 150px;">Tác giả</label>
              <input type="text" class="form-control" id="author" name="author" placeholder="Nhập tác giả" style="margin-left: 40px;" required>
            </div>
            <div class="col-md-6 d-flex align-items-center">
              <label for="mrp" class="form-label" style="width: 150px;">Giá gốc</label>
              <input type="number" class="form-control" id="mrp" name="mrp" placeholder="Nhập giá gốc" style="margin-left: 40px;" required>
            </div>
          </div>

          <!-- Hàng 3 -->
          <div class="row mb-3">
            <div class="col-md-6 d-flex align-items-center">
              <label for="price" class="form-label" style="width: 150px;">Giá bán</label>
              <input type="number" class="form-control" id="price" name="price" placeholder="Nhập giá bán" style="margin-left: 40px;" required>
            </div>
            <div class="col-md-6 d-flex align-items-center">
              <label for="discount" class="form-label" style="width: 150px;">Giảm giá (%)</label>
              <input type="number" class="form-control" id="discount" name="discount" value="0" style="margin-left: 40px;" readonly>
            </div>
          </div>

          <!-- Hàng 4 -->
          <div class="row mb-3">
            <div class="col-md-6 d-flex align-items-center">
              <label for="available" class="form-label" style="width: 150px;">Số lượng tồn kho</label>
              <input type="number" class="form-control" id="available" name="available" placeholder="Nhập số lượng" style="margin-left: 40px;" required>
            </div>
            <div class="col-md-6 d-flex align-items-center">
              <label for="publisher" class="form-label" style="width: 150px;">Nhà xuất bản</label>
              <input type="text" class="form-control" id="publisher" name="publisher" placeholder="Nhập nhà xuất bản" style="margin-left: 40px;" required>
            </div>
          </div>

          <!-- Hàng 5 -->
          <div class="row mb-3">
            <div class="col-md-6 d-flex align-items-center">
              <label for="edition" class="form-label" style="width: 150px;">Phiên bản</label>
              <input type="text" class="form-control" id="edition" name="edition" placeholder="Nhập phiên bản" style="margin-left: 40px;" required>
            </div>
            <div class="col-md-6 d-flex align-items-center">
              <label for="category" class="form-label" style="width: 150px;">Danh mục</label>
              <input type="text" class="form-control" id="category" name="category" placeholder="Nhập danh mục" style="margin-left: 40px;" required>
            </div>
          </div>

          <!-- Hàng 6 -->
          <div class="row mb-3">
            <div class="col-md-6 d-flex align-items-center">
              <label for="description" class="form-label" style="width: 150px;">Mô tả</label>
              <textarea class="form-control" id="description" name="description" placeholder="Nhập mô tả" style="margin-left: 40px;" rows="3" required></textarea>
            </div>
            <div class="col-md-6 d-flex align-items-center">
              <label for="language" class="form-label" style="width: 150px;">Ngôn ngữ</label>
              <input type="text" class="form-control" id="language" name="language" placeholder="Nhập ngôn ngữ" style="margin-left: 40px;" required>
            </div>
          </div>

          <!-- Hàng 7 -->
          <div class="row mb-3">
            <div class="col-md-6 d-flex align-items-center">
              <label for="page" class="form-label" style="width: 150px;">Số trang</label>
              <input type="text" class="form-control" id="page" name="page" placeholder="Nhập số trang" style="margin-left: 40px;" required>
            </div>
            <div class="col-md-6 d-flex align-items-center">
              <label for="weight" class="form-label" style="width: 150px;">Trọng lượng</label>
              <input type="number" class="form-control" id="weight" name="weight" placeholder="Nhập trọng lượng" style="margin-left: 40px;" required>
            </div>
          </div>

          <!-- Nút thêm -->
          <div class="d-flex justify-content-end">
            <button type="submit" name="add_product" class="btn btn-primary">Thêm phim</button>
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

  <!-- JavaScript để tính toán giảm giá tự động -->
  <script>
    const mrpInput = document.getElementById('mrp');
    const priceInput = document.getElementById('price');
    const discountInput = document.getElementById('discount');

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