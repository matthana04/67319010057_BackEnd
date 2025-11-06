<?php
include_once "../inc/header.php";
if(!is_admin()) redirect("../index.php");

// ลบผู้ใช้
if(isset($_GET['delete'])){
    $uid = intval($_GET['delete']);
    $conn->query("DELETE FROM users WHERE id=$uid");
}

$result = $conn->query("SELECT * FROM users ORDER BY id DESC");
?>

<h1 class="text-2xl font-bold mb-6 text-maroon">จัดการผู้ใช้</h1>

<table class="w-full bg-white rounded shadow">
<tr class="bg-maroon text-white">
  <th>ID</th><th>ชื่อผู้ใช้</th><th>สิทธิ์</th><th>วันที่สมัคร</th><th>จัดการ</th>
</tr>
<?php while($row = $result->fetch_assoc()): ?>
<tr>
  <td class="p-2 text-center"><?=$row['id']?></td>
  <td class="p-2"><?=$row['username']?></td>
  <td class="p-2 text-center"><?=$row['role']?></td>
  <td class="p-2 text-center"><?=$row['created_at']?></td>
  <td class="p-2 text-center">
    <?php if($row['role'] != 'admin'): ?>
      <a href="?delete=<?=$row['id']?>" class="text-red-600" onclick="return confirm('ลบผู้ใช้นี้?')">ลบ</a>
    <?php endif; ?>
  </td>
</tr>
<?php endwhile; ?>
</table>

<?php include_once "../inc/footer.php"; ?>
