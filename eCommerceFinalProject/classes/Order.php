<?php
declare(strict_types=1);

/*
 * eCommerceFinalProject Order.php
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
class Order {
    
    public int $id;
    public string $status;
    public int $customer_id;
    public int $shopping_cart_id;
    public string $billing_address;
    public string $shipping_address;
    public string $date_created;
    public string $date_placed;
    public ?string $date_shipped;
    
    /**
     * @param $id
     * @param $status
     * @param $customer_id
     * @param $shopping_cart_id
     * @param $billing_address
     * @param $shipping_address
     * @param $date_created
     * @param $date_placed
     * @param $date_shipped
     */
    public function __construct(int $id, string $status, int $customer_id, int $shopping_cart_id, string $billing_address, string $shipping_address, string $date_created, string $date_placed, ?string $date_shipped) {
        $this->id = $id;
        $this->status = $status;
        $this->customer_id = $customer_id;
        $this->shopping_cart_id = $shopping_cart_id;
        $this->billing_address = $billing_address;
        $this->shipping_address = $shipping_address;
        $this->date_created = $date_created;
        $this->date_placed = $date_placed;
        $this->date_shipped = $date_shipped;
    }
    
    /**
     * @return int
     */
    public function getId() : int {
        return $this->id;
    }
    
    /**
     * @param int $id
     */
    public function setId(int $id) : void {
        $this->id = $id;
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
     * @return int
     */
    public function getCustomerId() : int {
        return $this->customer_id;
    }
    
    /**
     * @param int $customer_id
     */
    public function setCustomerId(int $customer_id) : void {
        $this->customer_id = $customer_id;
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
     * @return string
     */
    public function getBillingAddress() : string {
        return $this->billing_address;
    }
    
    /**
     * @param string $billing_address
     */
    public function setBillingAddress(string $billing_address) : void {
        $this->billing_address = $billing_address;
    }
    
    /**
     * @return string
     */
    public function getShippingAddress() : string {
        return $this->shipping_address;
    }
    
    /**
     * @param string $shipping_address
     */
    public function setShippingAddress(string $shipping_address) : void {
        $this->shipping_address = $shipping_address;
    }
    
    /**
     * @return string
     */
    public function getDateCreated() : string {
        return $this->date_created;
    }
    
    /**
     * @param string $date_created
     */
    public function setDateCreated(string $date_created) : void {
        $this->date_created = $date_created;
    }
    
    /**
     * @return string
     */
    public function getDatePlaced() : string {
        return $this->date_placed;
    }
    
    /**
     * @param string $date_placed
     */
    public function setDatePlaced(string $date_placed) : void {
        $this->date_placed = $date_placed;
    }
    
    /**
     * @return string
     */
    public function getDateShipped() : string {
        return $this->date_shipped;
    }
    
    /**
     * @param string $date_shipped
     */
    public function setDateShipped(string $date_shipped) : void {
        $this->date_shipped = $date_shipped;
    }
    
    
    
}