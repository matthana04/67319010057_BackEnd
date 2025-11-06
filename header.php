<?php include_once "config.php"; ?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Online Shop</title>
<link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<style>
body { font-family: 'Kanit', sans-serif; }
.text-maroon { color: #73be70ff; }
.bg-maroon { background-color: #097a2bff; }
</style>
</head>
<body class="bg-gray-100">

<nav class="bg-maroon text-white p-4 flex justify-between">
  <a href="index.php" class="font-bold">🏬 Online Shop</a>
  <div>
    <?php if(is_logged_in()): ?>
        <a href="cart.php" class="mr-4">🛒 ตะกร้า</a>
        <a href="order_history.php" class="mr-4">คำสั่งซื้อ</a>
        <?php if(is_seller()): ?><a href="seller/" class="mr-4">Seller</a><?php endif; ?>
        <?php if(is_admin()): ?><a href="admin/" class="mr-4">Admin</a><?php endif; ?>
        <a href="logout.php">ออกจากระบบ</a>
    <?php else: ?>
        <a href="login.php" class="mr-4">เข้าสู่ระบบ</a>
        <a href="register.php">สมัครสมาชิก</a>
    <?php endif; ?>
  </div>
</nav>
<div class="container mx-auto p-6">
