<?php include_once "inc/header.php"; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 'user';

    $stmt = $conn->prepare("INSERT INTO users(username, password, role) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $password, $role);

    if($stmt->execute()) {
        echo "<div class='bg-green-100 p-3 rounded text-center mb-4'>สมัครสมาชิกสำเร็จ! <a href='login.php' class='text-maroon font-semibold'>เข้าสู่ระบบ</a></div>";
    } else {
        echo "<div class='bg-red-100 p-3 rounded text-center mb-4'>ชื่อผู้ใช้นี้ถูกใช้แล้ว!</div>";
    }
}
?>

<form method="post" class="max-w-md mx-auto bg-white p-6 rounded shadow">
  <h2 class="text-xl font-bold mb-4">สมัครสมาชิก</h2>
  <input type="text" name="username" placeholder="ชื่อผู้ใช้" required class="w-full border p-2 mb-3 rounded">
  <input type="password" name="password" placeholder="รหัสผ่าน" required class="w-full border p-2 mb-3 rounded">
  <button type="submit" class="bg-maroon text-white px-4 py-2 rounded w-full">สมัครสมาชิก</button>
</form>

<?php include_once "inc/footer.php"; ?>
