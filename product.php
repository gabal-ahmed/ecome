<?php include('includes/header.php'); ?>

<?php
// تحقق من وجود ID في الرابط
if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    // جلب البيانات من JSON
    $data = file_get_contents('products.json');
    $products = json_decode($data, true);

    // البحث عن المنتج بالـ ID
    $selectedProduct = null;
    foreach ($products as $product) {
        if ($product['id'] == $productId) {
            $selectedProduct = $product;
            break;
        }
    }

    // عرض المنتج أو رسالة خطأ
    if ($selectedProduct) {
        echo "<div class='product-details'>";
        echo "<img src='{$selectedProduct['image']}' alt='{$selectedProduct['title']}' />";
        echo "<div class='details'>";
        echo "<h2>{$selectedProduct['title']}</h2>";
        echo "<p class='price'>Price:$ {$selectedProduct['price']} </p>";
        echo "<p>{$selectedProduct['description']}</p>";
        echo "<form action='cart.php' method='post'>
        <input type='hidden' name='product_id' value='" . $selectedProduct['id'] . "'>
        <button type='submit'>Add To Cart 🛒</button>
      </form>";
        echo "</div>";
        echo "</div>";
    } else {
        echo "<p>This Product is not available</p>";
    }
} else {
    echo "<p>No product selected</p>";
}
?>

<?php include('includes/footer.php'); ?>

<style>

