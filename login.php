<?php include_once "inc/header.php"; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        $user = $res->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            redirect("index.php");
        } else {
            $msg = "รหัสผ่านไม่ถูกต้อง!";
        }
    } else {
        $msg = "ไม่พบบัญชีผู้ใช้!";
    }
}
?>

<form method="post" class="max-w-md mx-auto bg-white p-6 rounded shadow">
  <h2 class="text-xl font-bold mb-4">เข้าสู่ระบบ</h2>
  <?php if(isset($msg)) echo "<div class='bg-red-100 p-2 rounded mb-2'>$msg</div>"; ?>
  <input type="text" name="username" placeholder="ชื่อผู้ใช้" required class="w-full border p-2 mb-3 rounded">
  <input type="password" name="password" placeholder="รหัสผ่าน" required class="w-full border p-2 mb-3 rounded">
  <button type="submit" class="bg-maroon text-white px-4 py-2 rounded w-full">เข้าสู่ระบบ</button>
</form>

<?php include_once "inc/footer.php"; ?>
