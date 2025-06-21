<?php
session_start();
include "../dbconnect.php"; // Kết nối với file dbconnect.php ở thư mục cha

// Lấy dữ liệu từ bảng cart và tính tổng số lượng cho từng sản phẩm
$query_cart = "SELECT cart.Product, cart.Customer, cart.Quantity, products.Title, products.Price 
               FROM cart 
               JOIN products ON cart.Product = products.PID";
$result_cart = mysqli_query($con, $query_cart) or die(mysqli_error($con));
$cart_items = mysqli_fetch_all($result_cart, MYSQLI_ASSOC);

// Tính tổng số lượng và doanh thu cho từng sản phẩm
$product_sales = [];
foreach ($cart_items as $item) {
    $pid = $item['Product'];
    if (!isset($product_sales[$pid])) {
        $product_sales[$pid] = [
            'title' => $item['Title'],
            'price' => $item['Price'],
            'quantity' => 0,
            'revenue' => 0
        ];
    }
    $product_sales[$pid]['quantity'] += $item['Quantity'];
    $product_sales[$pid]['revenue'] += $item['Quantity'] * $item['Price'];
}

// Sắp xếp sản phẩm theo số lượng bán chạy (quantity) giảm dần
usort($product_sales, function($a, $b) {
    return $b['quantity'] - $a['quantity'];
});

// Lấy 5 sản phẩm bán chạy nhất
$top_products = array_slice($product_sales, 0, 5);

// Tính tổng doanh số và doanh thu
$total_sales = 0;
$total_revenue = 0;
foreach ($product_sales as $product) {
    $total_sales += $product['quantity'] * $product['price'];
    $total_revenue += $product['revenue'];
}

// Lấy số lượng khách hàng (trừ admin)
$query_customers = "SELECT COUNT(*) as total FROM users WHERE UserName != 'admin'";
$result_customers = mysqli_query($con, $query_customers) or die(mysqli_error($con));
$customer_count = mysqli_fetch_assoc($result_customers)['total'];

// Lấy dữ liệu từ bảng cart để hiển thị hoạt động gần đây
$query_cart_activity = "SELECT cart.Product, cart.Customer, cart.Quantity, products.Title 
                       FROM cart 
                       JOIN products ON cart.Product = products.PID";
$result_cart_activity = mysqli_query($con, $query_cart_activity) or die(mysqli_error($con));
$cart_items = mysqli_fetch_all($result_cart_activity, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />

  <title>Trang quản trị</title>
  <meta content="" name="description" />
  <meta content="" name="keywords" />

  <!-- Favicons -->
  <link href="assets/img/logo-icon.ico" rel="icon" />
  <link href="assets/img/logo-icon.ico" rel="apple-touch-icon" />

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect" />
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet" />

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

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
        <a class="nav-link active" href="index.php">
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
        <a class="nav-link" href="user-list.php">
          <i class="bi bi-person"></i><span>Quản lý tài khoản</span>
        </a>
      </li>
      <!-- End Tables Nav -->

      <li class="nav-heading">Pages</li>
    </ul>
  </aside>
  <!-- End Sidebar-->

  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Tổng quan</h1>
    </div>
    <!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">
            <!-- Sales Card -->
            <div class="col-xxl-6 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Doanh số</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo number_format($total_sales, 0, ',', '.') . 'đ'; ?></h6>
                      <span class="text-success small pt-1 fw-bold">Hôm nay</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-6 col-md-6">
              <div class="card info-card revenue-card">
                <div class="card-body">
                  <h5 class="card-title">Doanh thu</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo number_format($total_revenue, 0, ',', '.') . 'đ'; ?></h6>
                      <span class="text-success small pt-1 fw-bold">Hôm nay</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-6 col-md-6">
              <div class="card info-card customers-card">
                <div class="card-body">
                  <h5 class="card-title">Khách hàng</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $customer_count; ?></h6>
                      <span class="text-danger small pt-1 fw-bold">Hôm nay</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Customers Card -->

            <!-- Reports -->
            <div class="col-12">
              <div class="card">
                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Bộ lọc</h6>
                    </li>
                    <li><a class="dropdown-item" href="#">Hôm nay</a></li>
                    <li><a class="dropdown-item" href="#">Tháng này</a></li>
                    <li><a class="dropdown-item" href="#">Năm này</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Thống kê <span>/Hôm nay</span></h5>

                  <!-- Line Chart -->
                  <div id="reportsChart"></div>

                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      new ApexCharts(document.querySelector("#reportsChart"), {
                        series: [
                          {
                            name: "Doanh số",
                            data: [<?php echo implode(',', array_column($product_sales, 'quantity')); ?>],
                          },
                          {
                            name: "Doanh thu",
                            data: [<?php echo implode(',', array_column($product_sales, 'revenue')); ?>],
                          },
                          {
                            name: "Khách hàng",
                            data: [<?php echo str_repeat('1,', $customer_count); ?>], // Giả định mỗi khách hàng là 1 đơn vị
                          },
                        ],
                        chart: {
                          height: 350,
                          type: "area",
                          toolbar: {
                            show: false,
                          },
                        },
                        markers: {
                          size: 4,
                        },
                        colors: ["#4154f1", "#2eca6a", "#ff771d"],
                        fill: {
                          type: "gradient",
                          gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.3,
                            opacityTo: 0.4,
                            stops: [0, 90, 100],
                          },
                        },
                        dataLabels: {
                          enabled: false,
                        },
                        stroke: {
                          curve: "smooth",
                          width: 2,
                        },
                        xaxis: {
                          type: "datetime",
                          categories: [
                            "2025-05-30T16:00:00.000Z",
                            "2025-05-30T16:30:00.000Z",
                            "2025-05-30T17:00:00.000Z",
                            "2025-05-30T17:30:00.000Z",
                            "2025-05-30T18:00:00.000Z",
                          ],
                        },
                        tooltip: {
                          x: {
                            format: "dd/MM/yy HH:mm",
                          },
                        },
                      }).render();
                    });
                  </script>
                  <!-- End Line Chart -->
                </div>
              </div>
            </div>
            <!-- End Reports -->
          </div>
        </div>
        <!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">
          <!-- Recent Activity -->
          <div class="card">
            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Bộ lọc</h6>
                </li>
                <li><a class="dropdown-item" href="#">Hôm nay</a></li>
                <li><a class="dropdown-item" href="#">Tháng này</a></li>
                <li><a class="dropdown-item" href="#">Năm này</a></li>
              </ul>
            </div>

            <div class="card-body">
              <h5 class="card-title">Hoạt động gần đây</h5>
              <div class="activity">
                <?php
                foreach ($cart_items as $item) {
                    echo "<div class='activity-item d-flex'>";
                  
                    echo "<i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>";
                    echo "<div class='activity-content'>" . htmlspecialchars($item['Customer']) . " đã thêm " . htmlspecialchars($item['Title']) . " vào giỏ hàng</div>";
                    echo "</div>";
                }
                if (empty($cart_items)) {
                    echo "<p class='text-center'>Không có hoạt động nào hôm nay.</p>";
                }
                ?>
              </div>
            </div>
          </div>
          <!-- End Recent Activity -->
        </div>
        <!-- End Right side columns -->

        <!-- Top Selling -->
        <div class="col-12">
          <div class="card top-selling overflow-auto">
            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Bộ lọc</h6>
                </li>
                <li><a class="dropdown-item" href="#">Hôm nay</a></li>
                <li><a class="dropdown-item" href="#">Tháng này</a></li>
                <li><a class="dropdown-item" href="#">Năm này</a></li>
              </ul>
            </div>

            <div class="card-body pb-0" id="banchay">
              <h5 class="card-title">
                Bán chạy nhất <span>| Hôm nay</span>
              </h5>

              <table class="table table-borderless">
                <thead>
                  <tr>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Sản phẩm</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Đã thêm vào giỏ</th>
                    <th scope="col">Doanh thu</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($top_products as $product) {
                      echo "<tr>";
                      echo "<th scope='row'><a href='#'><img src='assets/img/product-placeholder.jpg' alt=''></a></th>";
                      echo "<td><a href='#' class='text-primary fw-bold'>" . htmlspecialchars($product['title']) . "</a></td>";
                      echo "<td>" . number_format($product['price'], 0, ',', '.') . "đ</td>";
                      echo "<td class='fw-bold'>" . $product['quantity'] . "</td>";
                      echo "<td>" . number_format($product['revenue'], 0, ',', '.') . "đ</td>";
                      echo "</tr>";
                  }
                  if (empty($top_products)) {
                      echo "<tr><td colspan='5' class='text-center'>Không có sản phẩm nào trong giỏ hàng.</td></tr>";
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- End Top Selling -->
      </div>
    </section>
  </main>
  <!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
  </footer>
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

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