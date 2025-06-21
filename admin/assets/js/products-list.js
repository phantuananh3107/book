const products = [
  {
    name: "Ivory Bloom Dress – Đầm midi cổ chữ V phối ren",
    price: "350.000đ",
    image: "./assets/img/Ivory Bloom Dress – Đầm midi cổ chữ V phối ren.webp",
  },
  {
    name: "Golden Hour Skirt – Chân váy maxi vàng hoa",
    price: "1.390.000đ",
    image: "./assets/img/Golden Hour Skirt – Chân váy maxi vàng hoa.webp",
  },
  {
    name: "Áo lụa phối xếp ly xoắn ngực",
    price: "387.000đ ",
    image: "./assets/img/Áo lụa phối xếp ly xoắn ngực.webp",
  },
  {
    name: "Chân váy ren xếp ly",
    price: "200.000đ",
    image: "./assets/img/Chân váy ren xếp ly.webp",
  },
  {
    name: "Đầm hai dây nhún ngực",
    price: "507.000đ",
    image: "./assets/img/Đầm hai dây nhún ngực.webp",
  },
  {
    name: "Sunpetal Dress – Đầm Tencel hoa vàng pastel",
    price: "795.000đ",
    image: "./assets/img/Sunpetal Dress – Đầm Tencel hoa vàng pastel.webp",
  },
  {
    name: "Chân váy bút chì cạp cách điệu",
    price: "357.000đ",
    image: "./assets/img/Chân váy bút chì cạp cách điệu.jpg",
  },
  {
    name: "Chân váy chữ A phối viền hoa nổi",
    price: "267.000đ",
    image: "./assets/img/Chân váy chữ A phối viền hoa nổi.webp",
  },
  {
    name: "Chân váy A ngắn vạt chéo",
    price: "890.000đ",
    image: "./assets/img/Chân váy A ngắn vạt chéo.webp",
  },
  {
    name: "Chân váy midi phối ren",
    price: "375.000đ",
    image: "./assets/img/Chân váy midi phối ren.webp",
  },
  {
    name: "Áo thun đính ren",
    price: "100.000đ",
    image: "./assets/img/Áo thun đính ren.webp",
  },
  {
    name: "Blossom Scarf Tee – Áo thun phối khăn",
    price: "650.000đ",
    image: "./assets/img/Blossom Scarf Tee – Áo thun phối khăn.webp",
  },
];

let currentPage = 1;
let itemsPerPage = 10;
let filteredProducts = [...products];

const container = document.getElementById("productContainer");
const pagination = document.getElementById("pagination");
const searchInput = document.getElementById("searchInput");
const itemsPerPageSelect = document.getElementById("itemsPerPage");

function renderProducts() {
  container.innerHTML = "";
  const start = (currentPage - 1) * itemsPerPage;
  const end = start + itemsPerPage;

  let pageItems;
  if (itemsPerPage >= filteredProducts.length) {
    pageItems = filteredProducts;
  } else {
    pageItems = filteredProducts.slice(start, end);
  }

  if (pageItems.length === 0) {
    container.innerHTML =
      "<p class='text-muted'>Không tìm thấy sản phẩm nào.</p>";
    return;
  }

  pageItems.forEach((product, index) => {
    const col = document.createElement("div");
    col.className = "col-md-6 mb-3";
    col.innerHTML = `
                      <div class="card h-100" style="margin-bottom: 0px;">
                        <div class="row g-0">
                          <div class="col-auto">
                            <img src="${product.image}" alt="${
      product.name
    }" class="img-fluid rounded-start product-thumb" style="width: 200px; height: 100%; object-fit: cover;" />
                          </div>
                          <div class="col">
                            <div class="card-body d-flex flex-column justify-content-between h-100">
                              <div>
                                <h6 class="card-title mb-1">${product.name}</h6>
                                <p class="mb-1 text-muted">Mã: SP0${
                                  index + 1
                                }</p>
                                <p class="mb-1">Giá: <strong>${
                                  product.price
                                }</strong></p>
                                <p class="mb-1">Trạng thái: <span class="badge bg-success">Còn hàng</span></p>
                                <p class="mb-2 text-muted">Danh mục: Thời trang</p>
                              </div>
                              <div class="d-flex justify-content-end gap-2">
                                <a href="repair-product.html" class="btn btn-sm btn-outline-warning" title="Sửa"><i class="bi bi-pencil"></i></a>
                                <a href="#" class="btn btn-sm btn-outline-danger inner-remove" title="Xóa"><i class="bi bi-trash"></i></a>
                                <a href="details-product.html" class="btn btn-sm btn-outline-info" title="Chi tiết"><i class="bi bi-eye"></i></a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    `;
    container.appendChild(col);
  });

  renderPagination();
}

function renderPagination() {
  pagination.innerHTML = "";

  if (itemsPerPage >= filteredProducts.length) return; // Không phân trang nếu hiển thị hết

  const totalPages = Math.ceil(filteredProducts.length / itemsPerPage);

  for (let i = 1; i <= totalPages; i++) {
    const li = document.createElement("li");
    li.className = `page-item ${i === currentPage ? "active" : ""}`;
    li.innerHTML = `<a class="page-link" href="#">${i}</a>`;
    li.addEventListener("click", function (e) {
      e.preventDefault();
      currentPage = i;
      renderProducts();
    });
    pagination.appendChild(li);
  }
}

searchInput.addEventListener("input", function () {
  const keyword = this.value.toLowerCase();
  filteredProducts = products.filter((p) =>
    p.name.toLowerCase().includes(keyword)
  );
  currentPage = 1;
  renderProducts();
});

itemsPerPageSelect.addEventListener("change", function () {
  const value = this.value;
  if (value === "all") {
    itemsPerPage = filteredProducts.length;
  } else {
    itemsPerPage = parseInt(value);
  }
  currentPage = 1;
  renderProducts();
});

renderProducts();



