<?php
declare(strict_types=1);

/*
 * eCommerceFinalProject index.php
 * 
 * @author Ying-Shan Liang (Celine Liang)
 * @since 2023-04-29
 * (c) Copyright 2023 Ying-Shan Liang 
 */
//session_start();

//use classes\Product;

require_once 'include/config.php';
require_once 'functions.php';
$products = getProducts();

?>

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
<?php if(isset($_SESSION['user_id'])):?>
<h2>Welcome, to DAESAN JEWELRY <?php echo $_SESSION['username']; ?> </h2>
<?php endif;?>

<h1>All jewelry</h1>
<div class="product-list">
    <?php foreach ($products as $product): ?>
        <div class="product-item">
            <img src="<?php echo $product->getImageUrl(); ?>" alt="<?php echo $product->getDescription(); ?>">
<!--            <h3>--><?php //echo $product->getDescription(); ?><!--</h3>-->
            <h3><?php echo $product->getDisplayName(); ?></h3>
            <p>Price: $<?php echo $product->getUnitPrice(); ?></p>
            <p>Available Quantity: <?php echo $product->getAvailableQuantity(); ?></p>
            <button class="add-to-cart" data-product-id="<?php echo $product->getId(); ?>">Add to Cart</button>
            <br><br>
        </div>
    <?php endforeach; ?>
</div>
<a href="checkout.php">Go to Checkout</a>
</body>
</html>


