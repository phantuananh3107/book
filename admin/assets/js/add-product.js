document.getElementById("addProductForm").addEventListener("submit", function (e) {
  e.preventDefault(); // Ngăn submit mặc định trước

  // Lấy giá trị
  const fields = {
    productName: document.getElementById("productName").value.trim(),
    productCode: document.getElementById("productCode").value.trim(),
    productPrice: document.getElementById("productPrice").value,
    productCategory: document.getElementById("productCategory").value,
    productMaterial: document.getElementById("productMaterial").value.trim(),
    productColor: document.getElementById("productColor").value.trim(),
    productSize: document.getElementById("productSize").value.trim(),
    productStatus: document.getElementById("productStatus").value,
    productQuantity: document.getElementById("productQuantity").value,
    productImage: document.getElementById("productImage").files,
    productDescription: document.querySelector(".tox-edit-area iframe")?.contentDocument?.body?.innerText?.trim()
  };

  // Xóa thông báo lỗi cũ
  Object.keys(fields).forEach(id => {
    const errorElement = document.getElementById(`error-${id}`);
    if (errorElement) errorElement.innerText = "";
  });

  let isValid = true;

  // Kiểm tra từng trường
  if (!fields.productName) {
    showError("productName", "Vui lòng nhập tên sản phẩm");
    isValid = false;
  }

  if (!fields.productCode) {
    showError("productCode", "Vui lòng nhập mã sản phẩm");
    isValid = false;
  }

  if (!fields.productPrice || parseFloat(fields.productPrice) <= 0) {
    showError("productPrice", "Giá sản phẩm phải là số dương");
    isValid = false;
  }

  if (fields.productCategory === "Chọn danh mục") {
    showError("productCategory", "Vui lòng chọn danh mục");
    isValid = false;
  }

  if (!fields.productMaterial) {
    showError("productMaterial", "Vui lòng nhập chất liệu");
    isValid = false;
  }

  if (!fields.productColor) {
    showError("productColor", "Vui lòng nhập màu sắc");
    isValid = false;
  }

  if (!fields.productSize) {
    showError("productSize", "Vui lòng nhập kích cỡ");
    isValid = false;
  }

  if (!fields.productQuantity || parseInt(fields.productQuantity) <= 0) {
    showError("productQuantity", "Số lượng phải là số dương");
    isValid = false;
  }

  if (!fields.productImage || fields.productImage.length === 0) {
    showError("productImage", "Vui lòng chọn ảnh sản phẩm");
    isValid = false;
  }

  if (!fields.productDescription) {
    showError("productDescription", "Vui lòng nhập mô tả sản phẩm");
    isValid = false;
  }

  // Nếu hợp lệ thì cho submit
  if (isValid) {
    alert("Thêm sản phẩm thành công");
    this.submit(); // Gửi form nếu không có lỗi
  }

  function showError(id, message) {
    const errorDiv = document.getElementById(`error-${id}`);
    if (errorDiv) {
      errorDiv.innerText = message;
    }
  }
});