<?php
session_start();
unset($_SESSION['user']);
session_destroy();
header("location: admin/admin-login.php?Message=" . "Đăng  xuất thành công!!");
?>

