<?php
include_once "../inc/header.php";
if(!is_admin()) redirect("../index.php");

if(isset($_GET['delete'])){
    $pid = intval($_GET['delete']);
    $conn->query("DELETE FROM products WHERE id=$pid");
}

$result = $conn->query("SELECT p.*, u.username AS seller FROM products p LEFT JOIN users u ON p.seller_id=u.id ORDER BY p.id DESC");
?>

<h1 class="text-2xl font-bold mb-6 text-maroon">จัดการสินค้า</h1>

<table class="w-full bg-white rounded shadow">
<tr class="bg-maroon text-white"><th>รูป</th><th>ชื่อสินค้า</th><th>ราคา</th><th>ผู้ขาย</th><th>วันที่</th><th>จัดการ</th></tr>
<?php while($row = $result->fetch_assoc()): ?>
<tr>
  <td class="p-2 text-center"><img src="../assets/img/<?=$row['image']?>" class="h-16 mx-auto"></td>
  <td class="p-2"><?=$row['name']?></td>
  <td class="p-2 text-right pr-4">฿<?=number_format($row['price'],2)?></td>
  <td class="p-2 text-center"><?=$row['seller']?></td>
  <td class="p-2 text-center"><?=$row['created_at']?></td>
  <td class="p-2 text-center"><a href="?delete=<?=$row['id']?>" class="text-red-600" onclick="return confirm('ลบสินค้านี้?')">ลบ</a></td>
</tr>
<?php endwhile; ?>
</table>

<?php include_once "../inc/footer.php"; ?>
