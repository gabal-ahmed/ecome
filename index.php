<?php include('includes/header.php'); ?>

<h2>Available Products</h2>

<div class="products">
<?php
$data = file_get_contents('products.json');
$products = json_decode($data, true);

foreach ($products as $product) {
    echo "<div class='product'>";
    echo "<img src='{$product['image']}' alt='{$product['title']}' />";
    echo "<h3>{$product['title']}</h3>";
    echo "<p>Price: {$product['price']} $</p>";
    echo "<a href='product.php?id={$product['id']}'>Show details</a>";
    echo "</div>";
}
?>
</div>

<?php include('includes/footer.php'); ?>
