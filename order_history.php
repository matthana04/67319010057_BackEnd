<?php include_once "inc/header.php"; ?>
<?php
if(!is_logged_in()) redirect("login.php");

$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT * FROM orders WHERE user_id=$user_id ORDER BY id DESC");
?>

<h2 class="text-2xl font-bold mb-6 text-maroon">ประวัติคำสั่งซื้อ</h2>

<?php if($result->num_rows == 0): ?>
  <p>ยังไม่มีคำสั่งซื้อ</p>
<?php else: ?>
<table class="w-full bg-white rounded shadow">
<tr class="bg-maroon text-white"><th>รหัสคำสั่งซื้อ</th><th>วันที่</th><th>ยอดรวม</th><th>สถานะ</th></tr>
<?php while($row = $result->fetch_assoc()): ?>
<tr>
  <td class="p-2 text-center"><?=$row['id']?></td>
  <td class="p-2 text-center"><?=$row['created_at']?></td>
  <td class="p-2 text-right pr-4">฿<?=number_format($row['total'],2)?></td>
  <td class="p-2 text-center"><?=$row['status']?></td>
</tr>
<?php endwhile; ?>
</table>
<?php endif; ?>

<?php include_once "inc/footer.php"; ?>
