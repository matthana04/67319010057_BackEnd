<?php
include_once "../inc/header.php";
if(!is_admin()) redirect("../index.php");

$sql = "SELECT o.*, u.username, SUM(oi.quantity * oi.price) AS total
        FROM orders o
        JOIN users u ON o.user_id=u.id
        JOIN order_items oi ON o.id=oi.order_id
        GROUP BY o.id
        ORDER BY o.id DESC";
$result = $conn->query($sql);
?>

<h1 class="text-2xl font-bold mb-6 text-maroon">คำสั่งซื้อทั้งหมด</h1>

<table class="w-full bg-white rounded shadow">
<tr class="bg-maroon text-white"><th>รหัส</th><th>ผู้สั่งซื้อ</th><th>ยอดรวม</th><th>วันที่</th><th>สถานะ</th></tr>
<?php while($row = $result->fetch_assoc()): ?>
<tr>
  <td class="p-2 text-center"><?=$row['id']?></td>
  <td class="p-2"><?=$row['username']?></td>
  <td class="p-2 text-right pr-4">฿<?=number_format($row['total'],2)?></td>
  <td class="p-2 text-center"><?=$row['created_at']?></td>
  <td class="p-2 text-center"><?=$row['status']?></td>
</tr>
<?php endwhile; ?>
</table>

<?php include_once "../inc/footer.php"; ?>
