<?php
include_once "../inc/header.php";
if(!is_admin()) redirect("../index.php");

$result = $conn->query("SELECT id, username, created_at FROM users WHERE role='seller' ORDER BY id DESC");
?>

<h1 class="text-2xl font-bold mb-6 text-maroon">ร้านค้าผู้ขาย</h1>

<table class="w-full bg-white rounded shadow">
<tr class="bg-maroon text-white"><th>ID</th><th>ชื่อร้าน/ผู้ขาย</th><th>วันที่สมัคร</th></tr>
<?php while($row = $result->fetch_assoc()): ?>
<tr>
  <td class="p-2 text-center"><?=$row['id']?></td>
  <td class="p-2"><?=$row['username']?></td>
  <td class="p-2 text-center"><?=$row['created_at']?></td>
</tr>
<?php endwhile; ?>
</table>

<?php include_once "../inc/footer.php"; ?>
