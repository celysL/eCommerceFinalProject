<?php
declare(strict_types=1);

/*
 * eCommerceFinalProject ShoppingCart.php
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
class ShoppingCart {
    private ?int $id;
    private string $status;
    private int $quantity;
    
    public function __construct(string $status, int $quantity, ?int $id = null) {
        $this->id = $id;
        $this->status = $status;
        $this->quantity = $quantity;
    }
    
    /**
     * @return int
     */
    public function getId() : ?int {
        return $this->id;
    }
    
    /**
     * @return string
     */
    public function getStatus() : string {
        return $this->status;
    }
    
    /**
     * @param string $status
     */
    public function setStatus(string $status) : void {
        $this->status = $status;
    }
    
    /**
     * @return string
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
    
    /**
     * @return void
     *
     * @author Ying-Shan Liang
     * @since  2023-04-30
     */
    public function storeProduct() : void {
    
    }
    
    /**
     * @return void
     *
     * @author Ying-Shan Liang
     * @since  2023-04-30
     */
    public function removeItem() : void {
    
    }
    
    /**
     * @param $quantity
     *
     * @return void
     *
     * @author Ying-Shan Liang
     * @since  2023-04-30
     */
    public function updateQuantity($quantity) : void {
        foreach ($_SESSION['cart'] as $key => $value){
            if($value['id'] == $this->product['id']){
                $_SESSION['cart'][$key]['quantity'] = $quantity;
            }
            
        }
    }
    
}