<?php
declare(strict_types=1);

/*
 * eCommerceFinalProject ShoppingCartProduct.php
 * 
 * @author Ying-Shan Liang (Celine Liang)
 * @since 2023-04-29
 * (c) Copyright 2023 Ying-Shan Liang 
 */

namespace classes;

/**
 * @TODO   Documentation
 *
 * @author Ying-Shan Liang
 * @since  2023-04-29
 */
class ShoppingCartProduct {
    private int $shopping_cart_id;
    private int $product_id;
    private int $quantity;
    
    public function __construct(int $shopping_cart_id, int $product_id, int $quantity) {
        $this->shopping_cart_id = $shopping_cart_id;
        $this->product_id = $product_id;
        $this->quantity = $quantity;
    }
    
    /**
     * @return int
     */
    public function getShoppingCartId() : int {
        return $this->shopping_cart_id;
    }
    
    /**
     * @param int $shopping_cart_id
     */
    public function setShoppingCartId(int $shopping_cart_id) : void {
        $this->shopping_cart_id = $shopping_cart_id;
    }
    
    /**
     * @return int
     */
    public function getProductId() : int {
        return $this->product_id;
    }
    
    /**
     * @param int $product_id
     */
    public function setProductId(int $product_id) : void {
        $this->product_id = $product_id;
    }
    
    /**
     * @return int
     */
    public function getQuantity() : int {
        return $this->quantity;
    }
    
    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity) : void {
        $this->quantity = $quantity;
    }
    
}