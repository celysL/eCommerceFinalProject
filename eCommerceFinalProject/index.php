<?php
declare(strict_types=1);

/*
 * eCommerceFinalProject index.php
 * 
 * @author Ying-Shan Liang (Celine Liang)
 * @since 2023-04-29
 * (c) Copyright 2023 Ying-Shan Liang 
 */

use classes\Product;

require_once 'include/config.php';
require_once 'functions.php';
$products = getProducts();

?>
<!---->
<!--<!DOCTYPE html>-->
<!--<html lang="en">-->
<!--<head>-->
<!--    <meta charset="UTF-8">-->
<!--    <meta name="viewport" content="width=device-width, initial-scale=1.0">-->
<!--    <title>Shopping Cart</title>-->
<!--    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
<!--    <script>-->
<!--        $(document).ready(function() {-->
<!--            $(".addToCart").submit(function(event) {-->
<!--                event.preventDefault();-->
<!--                -->
<!--                let product_id = $(this).find("input[name='product_id']").val();-->
<!--                let quantity = $(this).find("input[name='quantity']").val();-->
<!--                -->
<!--                $.ajax({-->
<!--                           url: "ajax_add_to_cart.php",-->
<!--                           type: "POST",-->
<!--                           data: {-->
<!--                               product_id: product_id,-->
<!--                               quantity: quantity-->
<!--                           },-->
<!--                           success: function(response) {-->
<!--                               $("#message").html(response);-->
<!--                           },-->
<!--                           error: function() {-->
<!--                               $("#message").html("An error occurred while adding the item to the cart.");-->
<!--                           }-->
<!--                       });-->
<!--            });-->
<!--        });-->
<!--    </script>-->
<!--</head>-->
<!--<body>-->
<!--<h1>Products</h1>-->
<?php
//$sql = "select * from Product";
//$result = $conn->query($sql);
//
//if ($result->num_rows > 0) {
//    while ($row = $result->fetch_assoc()) {
//        $product = new Product($row['id'], $row['description'], $row['image_url'], $row['unit_price'], $row['available_quantity'], $row['date_created']);
//        echo "<div>";
//        echo "<img src='" . $product->getImageUrl() . "' alt='" . $product->getDescription() . "'>";
//        echo "<p>" . $product->getDescription() . "</p>";
//        echo "<p>Price: $" . $product->getUnitPrice() . "</p>";
//        echo "<form class='addToCart'>";
//        echo "<input type='hidden' name='product_id' value='" . $product->getId() . "'>";
//        echo "<label for='quantity'>Quantity:</label>";
//        echo "<input type='number' name='quantity' value='1' min='1'>";
//        echo "<button type='submit'>Add to Cart</button>";
//        echo "</form>";
//        echo "</div>";
//    }
//} else {
//    echo "No products found.";
//}
//?>
<!--<div id="message"></div>-->
<!--<a href="checkout.php">Proceed to Checkout</a>-->
<!--</body>-->
<!--</html>-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".add-to-cart").click(function() {
                let product_id = $(this).data("product-id");
                let quantity = 1; // You can change this value or get it from an input field
                
                $.ajax({
                           url: "ajax_add_to_cart.php",
                           type: "POST",
                           data: {
                               product_id: product_id,
                               quantity: quantity
                           },
                           success: function(response) {
                               alert("Product added to cart!");
                           },
                           error: function() {
                               alert("An error occurred while adding the product to the cart.");
                           }
                       });
            });
        });
    </script>
</head>
<body>
<h1>Product List</h1>
<div class="product-list">
    <?php foreach ($products as $product): ?>
        <div class="product-item">
            <img src="<?php echo $product->getImageUrl(); ?>" alt="<?php echo $product->getDescription(); ?>">
            <h3><?php echo $product->getDescription(); ?></h3>
            <p>Price: $<?php echo $product->getUnitPrice(); ?></p>
            <p>Available Quantity: <?php echo $product->getAvailableQuantity(); ?></p>
            <button class="add-to-cart" data-product-id="<?php echo $product->getId(); ?>">Add to Cart</button>
        </div>
    <?php endforeach; ?>
</div>
<a href="checkout.php">Go to Checkout</a>
</body>
</html>


