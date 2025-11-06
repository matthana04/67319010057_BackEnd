<?php
include_once "../inc/header.php";
if(!is_admin()) redirect("../index.php");

// ดึงจำนวนรวม
$users = $conn->query("SELECT COUNT(*) AS c FROM users")->fetch_assoc();
$products = $conn->query("SELECT COUNT(*) AS c FROM products")->fetch_assoc();
$orders = $conn->query("SELECT COUNT(*) AS c FROM orders")->fetch_assoc();
$sellers = $conn->query("SELECT COUNT(*) AS c FROM users WHERE role='seller'")->fetch_assoc();
?>

<h1 class="text-2xl font-bold mb-6 text-maroon">แดชบอร์ดผู้ดูแลระบบ</h1>

<div class="grid md:grid-cols-4 sm:grid-cols-2 gap-6">
  <div class="bg-white p-6 rounded shadow text-center">
    <h2 class="text-lg font-semibold">ผู้ใช้ทั้งหมด</h2>
    <p class="text-3xl font-bold text-maroon"><?=$users['c']?></p>
  </div>

  <div class="bg-white p-6 rounded shadow text-center">
    <h2 class="text-lg font-semibold">ผู้ขาย</h2>
    <p class="text-3xl font-bold text-maroon"><?=$sellers['c']?></p>
  </div>

  <div class="bg-white p-6 rounded shadow text-center">
    <h2 class="text-lg font-semibold">สินค้า</h2>
    <p class="text-3xl font-bold text-maroon"><?=$products['c']?></p>
  </div>

  <div class="bg-white p-6 rounded shadow text-center">
    <h2 class="text-lg font-semibold">คำสั่งซื้อ</h2>
    <p class="text-3xl font-bold text-maroon"><?=$orders['c']?></p>
  </div>
</div>

<?php include_once "../inc/footer.php"; ?>
