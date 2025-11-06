<?php include_once "inc/header.php"; ?>
<?php
if(!is_logged_in()) redirect("login.php");

if(empty($_SESSION['cart'])){
    echo "<p>ไม่มีสินค้าในตะกร้า</p>";
    include_once "inc/footer.php"; exit;
}

$ids = implode(',', array_keys($_SESSION['cart']));
$result = $conn->query("SELECT * FROM products WHERE id IN ($ids)");
$total = 0;
while($row = $result->fetch_assoc()) {
    $total += $row['price'] * $_SESSION['cart'][$row['id']];
}

if(isset($_POST['confirm'])){
    $user_id = $_SESSION['user_id'];
    $conn->query("INSERT INTO orders (user_id,total) VALUES ($user_id,$total)");
    $order_id = $conn->insert_id;

    foreach($_SESSION['cart'] as $pid => $qty){
        $res = $conn->query("SELECT price FROM products WHERE id=$pid");
        $p = $res->fetch_assoc();
        $conn->query("INSERT INTO order_items(order_id,product_id,quantity,price)
                      VALUES($order_id,$pid,$qty,{$p['price']})");
    }

    unset($_SESSION['cart']);
    echo "<div class='bg-green-100 p-4 rounded'>สั่งซื้อสำเร็จ! <a href='order_history.php' class='text-maroon'>ดูคำสั่งซื้อของคุณ</a></div>";
    include_once "inc/footer.php"; exit;
}
?>

<h2 class="text-2xl font-bold mb-6 text-maroon">ยืนยันการสั่งซื้อ</h2>
<p>ยอดรวมทั้งหมด: <span class="font-semibold">฿<?=number_format($total,2)?></span></p>

<form method="post">
    <button name="confirm" class="bg-maroon text-white px-4 py-2 mt-4 rounded">ยืนยันการสั่งซื้อ</button>
</form>

<?php include_once "inc/footer.php"; ?>
