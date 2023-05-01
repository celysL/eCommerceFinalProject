<?php
declare(strict_types=1);

/*
 * eCommerceFinalProject ${FILE_NAME}
 * 
 * @author Ying-Shan Liang (Celine Liang)
 * @since 2023-04-29
 * (c) Copyright 2023 Ying-Shan Liang 
 */
 
require_once 'functions.php';

//if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//    $customer_id = isset($_POST['customer_id']) ? $_POST['customer_id'] : null;
//    $billing_address = isset($_POST['billing_address']) ? $_POST['billing_address'] : null;
//    $shipping_address = isset($_POST['shipping_address']) ? $_POST['shipping_address'] : null;
//
//    if ($customer_id !== null && $billing_address !== null && $shipping_address !== null) {
//        if (checkout($customer_id, $billing_address, $shipping_address)) {
//            echo "Checkout completed successfully!";
//        } else {
//            echo "An error occurred during the checkout process.";
//        }
//    } else {
//        echo "Please provide all required information.";
//    }
//}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_email = isset($_POST['customer_email']) ? $_POST['customer_email'] : null;
    $billing_address = isset($_POST['billing_address']) ? $_POST['billing_address'] : null;
    $shipping_address = isset($_POST['shipping_address']) ? $_POST['shipping_address'] : null;
    
    if ($customer_email !== null && $billing_address !== null && $shipping_address !== null) {
        $customer_id = getCustomerIdByEmail($customer_email);
        if ($customer_id === null) {
            echo "Customer not found.";
        }
        elseif (checkout($customer_id, $billing_address, $shipping_address)) {
            echo "Checkout completed successfully!";
        }
        else {
            echo "An error occurred during the checkout process.";
        }
    }
    else {
        echo "Please provide all required information.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#checkoutForm").submit(function(event) {
                event.preventDefault();
                
                let customer_email = $("#customer_email").val();
                let billing_address = $("#billing_address").val();
                let shipping_address = $("#shipping_address").val();
                
                $.ajax({
                           url: "ajax_checkout.php",
                           type: "POST",
                           data: {
                               customer_email: customer_email,
                               billing_address: billing_address,
                               shipping_address: shipping_address
                           },
                           success: function(response) {
                               $("#message").html(response);
                           },
                           error: function() {
                               $("#message").html("An error occurred during the checkout process.");
                           }
                       });
            });
        });
    </script>
</head>
<body>
<h1>Checkout</h1>
<!--<form action="checkout.php" method="post">-->
<!--    <form id="checkoutForm">-->
<!--        <label for="customer_id">Customer ID:</label>-->
<!--        <input type="number" id="customer_id" name="customer_id" required><br>-->
<!--        <label for="billing_address">Billing Address:</label>-->
<!--        <input type="text" id="billing_address" name="billing_address" required><br>-->
<!--        <label for="shipping_address">Shipping Address:</label>-->
<!--        <input type="text" id="shipping_address" name="shipping_address" required><br>-->
<!--        <input type="submit" value="Complete Checkout">-->
<!--</form>-->

<form id="checkoutForm">
    <label for="customer_email">Customer Email:</label>
    <input type="email" id="customer_email" name="customer_email" required><br>
    <label for="billing_address">Billing Address:</label>
    <input type="text" id="billing_address" name="billing_address" required><br>
    <label for="shipping_address">Shipping Address:</label>
    <input type="text" id="shipping_address" name="shipping_address" required><br>
    <input type="submit" value="Complete Checkout">
</form>

    <div id="message"></div>
<a href="index.php">Back to Shopping</a>

</body>
</html>
