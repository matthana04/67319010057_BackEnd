<?php include_once "inc/header.php"; ?>

<?php
if(!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])){
    $pid = $_POST['product_id'];
    $_SESSION['cart'][$pid] = ($_SESSION['cart'][$pid] ?? 0) + 1;
}

if(isset($_GET['remove'])){
    unset($_SESSION['cart'][$_GET['remove']]);
}
?>

<h2 class="text-2xl font-bold mb-6 text-maroon">ตะกร้าสินค้า</h2>

<?php
if(empty($_SESSION['cart'])) {
    echo "<p>ยังไม่มีสินค้าในตะกร้า</p>";
} else {
    $ids = implode(',', array_keys($_SESSION['cart']));
    $result = $conn->query("SELECT * FROM products WHERE id IN ($ids)");
    $total = 0;
    echo "<table class='w-full bg-white rounded shadow'>";
    echo "<tr class='bg-maroon text-white'><th>สินค้า</th><th>จำนวน</th><th>ราคา</th><th></th></tr>";
    while($row = $result->fetch_assoc()) {
        $qty = $_SESSION['cart'][$row['id']];
        $price = $row['price'] * $qty;
        $total += $price;
        echo "<tr><td class='p-2'>{$row['name']}</td><td class='text-center'>{$qty}</td><td class='text-right pr-4'>฿".number_format($price,2)."</td>
              <td class='text-center'><a href='?remove={$row['id']}' class='text-red-600'>ลบ</a></td></tr>";
    }
    echo "<tr class='font-bold bg-gray-100'><td colspan='2'>รวมทั้งหมด</td><td class='text-right pr-4'>฿".number_format($total,2)."</td><td></td></tr>";
    echo "</table>";
    echo "<a href='checkout.php' class='mt-4 inline-block bg-maroon text-white px-4 py-2 rounded'>ดำเนินการชำระเงิน</a>";
}
?>

<?php include_once "inc/footer.php"; ?>
