<?php
declare(strict_types=1);

/*
 * eCommerceFinalProject functions.php
 * 
 * @author Ying-Shan Liang (Celine Liang)
 * @since 2023-04-29
 * (c) Copyright 2023 Ying-Shan Liang 
 */

use classes\Order;
use classes\Product;
use classes\ShoppingCart;
use classes\ShoppingCartProduct;

require_once 'include/config.php';
require_once 'classes/Product.php';
require_once 'classes/Order.php';
require_once 'classes/ShoppingCart.php';
require_once 'classes/ShoppingCartProduct.php';

/**
 * @return array
 *
 * @author Ying-Shan Liang
 * @since  2023-04-29
 */
function getProducts() : array {
    
    $sql = "SELECT * FROM Product;";
    $connection = getPdoConnection();
    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    $products = [];
    
    if (count($result) > 0) {
        foreach ($result as $product_array) {
            $product = new Product();
            $product->setId($product_array["id"]);
            $product->setDescription($product_array["description"]);
            $product->setImageUrl($product_array["image_url"]);
            $product->setUnitPrice((float) $product_array["unit_price"]);
            $product->setAvailableQuantity((int)$product_array["available_quantity"]);
            $product->setDateCreated($product_array["date_created"]);
    
            $products[] = $product;
        }
    }
    
    return $products;

    /*
    
    global $conn;

    $sql = "select * from Product";
    $result = $conn->query($sql);
    $products = [];
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $product = new Product();
            $product->setId($row["id"]);
            $product->setDescription($row["description"]);
            $product->setImageUrl($row["image_url"]);
            $product->setUnitPrice((float) $row["unit_price"]);
            $product->setAvailableQuantity((int)$row["available_quantity"]);
            $product->setDateCreated($row["date_created"]);

            $products[] = $product;
        }
    }
    
    return $products;
    
    */

}

/**
 * @param string $email
 *
 * @return int|null
 *
 * @throws Exception
 * @author Ying-Shan Liang
 * @since  2023-04-30
 */
function getCustomerIdByEmail(string $email): ?int {
    
    $sql = "SELECT id FROM Customer WHERE email = :email ;";
    $connection = getPdoConnection();
    $statement = $connection->prepare($sql);
    $statement->bindValue(":email", $email);
    $statement->execute();
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    if (count($results) > 1) {
        throw new Exception("Erreur d'intégrité de base de donnée: plusieurs customers avec le même courriel. Impossible de récupérer un Id.");
    } elseif (count($results) == 1) {
        return (int)$results[0]['id'];
    } else {
        return null;
    }
    
    
    /*
    global $conn;
    $sql = "select id from Customer where email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return (int)$row['id'];
    }
    
    return null;
    */
}


/**
 * @param $product_id
 * @param $quantity
 *
 * @return void
 *
 * @author Ying-Shan Liang
 * @since  2023-04-29
 */
function addToCart($product_id, $quantity) : void {
    $cart_items = [];
    
    if (isset($_SESSION['shopping_cart'])) {
        $cart_items = $_SESSION['shopping_cart'];
    }
    
//    if (isset($_COOKIE['shopping_cart'])) {
//        $cart_items = json_decode($_COOKIE['shopping_cart'], true);
//    }
    
    if (isset($cart_items[$product_id])) {
        $cart_items[$product_id] += $quantity;
    } else {
        $cart_items[$product_id] = $quantity;
    }
    
    $_SESSION['shopping_cart'] = $cart_items;
//    setcookie('shopping_cart', json_encode($cart_items), time() + (86400 * 30), "/");

}

/**
 * @param $customer_id
 * @param $billing_address
 * @param $shipping_address
 *
 * @return bool
 *
 * @author Ying-Shan Liang
 * @since  2023-04-29
 */
function checkout($customer_id, $billing_address, $shipping_address) : bool {
    global $conn;
    
    if (!isset($_SESSION['shopping_cart'])) {
        return false;
    }
    
//    if (!isset($_COOKIE['shopping_cart'])) {
//        return false;
//    }
//
//    $cart_items = json_decode($_COOKIE['shopping_cart'], true);
    
    // Create a new shopping cart entry
//    $new_cart = new ShoppingCart('completed', 0);
//    $sql = "insert into `shopping cart` (status, quantity) values ('{$new_cart->getStatus()}', '{$new_cart->getQuantity()}')";
//    //echo "SQL: {$sql}<br>";
//    if ($conn->query($sql) !== true) {
//        return false;
//    }
//    $cart_id = $conn->insert_id;
//    $total_quantity = 0;

    $new_cart = new ShoppingCart('completed', 0);
    $sql = "insert into `shopping cart` (status, quantity) values (:status, :quantity);";
    $connection = getPdoConnection();
    $connection->setAttribute(PDO::ATTR_AUTOCOMMIT, false);
    $connection->beginTransaction();
    try {
        error_log('Creating new shopping cart entry');
        $statement = $connection->prepare($sql);
        $statement->bindValue(":status", $new_cart->getStatus());
        $statement->bindValue(":quantity", $new_cart->getQuantity(), PDO::PARAM_INT);
        $statement->execute();
        $cart_id = (int) $connection->lastInsertId();
    
    
        $cart_items = $_SESSION['shopping_cart'];
        $total_quantity = 0;
        
        error_log("Error: Adding products to the shoppingcartproduct table");
        // Add products to the shoppingcartproduct table
        $sql = "insert into shoppingcartproduct (shopping_cart_id, product_id, quantity) values (:cartId, :productId, :quantity);";
        $statement = $connection->prepare($sql);
        foreach ($cart_items as $product_id => $quantity) {
            $total_quantity += $quantity;
            $cart_product = new ShoppingCartProduct($cart_id, (int)$product_id, (int)$quantity);
        
            $statement->bindValue(":cartId", $cart_id, PDO::PARAM_INT);
            $statement->bindValue(":productId", (int)$product_id, PDO::PARAM_INT);
            $statement->bindValue(":quantity", (int)$quantity, PDO::PARAM_INT);
            $statement->execute();

//        $sql = "insert into shoppingcartproduct (shopping_cart_id, product_id, quantity) values (NULL, '{$cart_product->getProductId()}', '{$cart_product->getQuantity()}')";
//        if ($conn->query($sql) !== true) {
//            return false;
//        }
        }
        error_log("Error: Upadating shopping cart quantity");
        // Update the shopping cart quantity
        $new_cart->setQuantity($total_quantity);
        $sql = "update `shopping cart` set quantity = :quantity where id = :id ;";
        $statement = $connection->prepare($sql);
        $statement->bindValue(":quantity", $new_cart->getQuantity(), PDO::PARAM_INT);
        $statement->bindValue(":id", $cart_id, PDO::PARAM_INT);
//    $sql = "update `shopping cart` set quantity = '{$new_cart->getQuantity()}' where id = '$cart_id'";
//    if ($conn->query($sql) !== true) {
//        return false;
//    }
        error_log("Error: Creating a new order entry");
        // Create a new order entry
        $date_created = date("Y-m-d H:i:s");
        $date_placed = date("Y-m-d H:i:s");
        $new_order = new Order($conn->insert_id, 'pending', (int)$customer_id, $cart_id, $billing_address, $shipping_address, $date_created, $date_placed, null);
        
        $sql = "insert into `order` (status, customer_id, shopping_cart_id, billing_address, shipping_address, date_created) values (:status, :customerId, :cartId, :billAddr, :shipAddr, :dateCreated);";
        $statement = $connection->prepare($sql);
        $statement->bindValue(":status", $new_order->getStatus());
        $statement->bindValue(":customerId", $new_order->getCustomerId(), PDO::PARAM_INT);
        $statement->bindValue(":cartId", $new_order->getShoppingCartId(), PDO::PARAM_INT);
        $statement->bindValue(":billAddr", $new_order->getBillingAddress());
        $statement->bindValue(":shipAddr", $new_order->getShippingAddress());
        $statement->bindValue(":dateCreated", $new_order->getDateCreated());
        $statement->execute();
        
//        $sql = "insert into `order` (status, customer_id, shopping_cart_id, billing_address, shipping_address, date_created) values ('{$new_order->getStatus()}', '{$new_order->getCustomerId()}', '{$new_order->getShoppingCartId()}', '{$new_order->getBillingAddress()}', '{$new_order->getShippingAddress()}', '{$new_order->getDateCreated()}')";
//        if ($conn->query($sql) !== true) {
//            return false;
//        }
        error_log("Error: Committing transaction");
        $connection->commit();
    
        // clear the session
        $_SESSION['shopping_cart'] = null;
    
        // Clear the cookie
//    setcookie('shopping_cart', '', time() - 3600, "/");
    
    
    } catch (Throwable $thrown) {
        $connection->rollBack();
        error_log('Error during checkout: ' . $thrown->getMessage());
        return false;
    }
    return true;
}
