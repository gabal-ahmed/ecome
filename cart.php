<?php
session_start(); // مهم جدا لتخزين السلة

// تحميل البيانات من JSON
$data = file_get_contents('products.json');
$products = json_decode($data, true);

// إضافة منتج للسلة
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $id = $_POST['product_id'];

    // جهز السلة لو مش موجودة
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // زود المنتج أو ابدأ بعده من 1
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]++;
    } else {
        $_SESSION['cart'][$id] = 1;
    }

    header("Location: cart.php");
    exit();
}

// حذف منتج من السلة
if (isset($_GET['remove'])) {
    $id = $_GET['remove'];
    unset($_SESSION['cart'][$id]);
    header("Location: cart.php");
    exit();
}

include('includes/header.php');
?>

<h2>🛒 Shopping cart</h2>

<?php
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    echo "<div class='cart-items'>";

    $total = 0;

    foreach ($_SESSION['cart'] as $id => $qty) {
        // جيب المنتج من JSON
        foreach ($products as $p) {
            if ($p['id'] == $id) {
                $subtotal = $qty * $p['price'];
                $total += $subtotal;

                echo "<div class='cart-item'>";
                echo "<img src='{$p['image']}' alt='{$p['title']}'>";
                echo "<div class='info'>";
                echo "<h3>{$p['title']}</h3>";
                echo "<p>Quantity: $qty</p>";
                echo "<p>Price: {$p['price']} × $qty = $subtotal $</p>";
                echo "<a href='cart.php?remove={$p['id']}'>❌ Remove</a>";
                echo "</div></div>";
            }
        }
    }

    echo "<div class='total'><strong>Total: $ $total  </strong></div>";
    echo "</div>";
} else {
    echo "<p>السلة فارغة.</p>";
}
?>

<?php include('includes/footer.php'); ?>
