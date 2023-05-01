<?php
declare(strict_types=1);

/*
 * eCommerceFinalProject Product.php
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
class Product {
    
    public ?string $id;
    public string $description;
    public string $image_url;
    public ?float $unit_price;
    public ?int $available_quantity;
    public string $date_created;
    
    public function __construct(int $id = null, string $description = '', string $image_url = '', float $unit_price = 0.0, int $available_quantity = 0, string $date_created = '') {
        $this->id = $id;
        $this->description = $description;
        $this->image_url = $image_url;
        $this->unit_price = $unit_price;
        $this->available_quantity = $available_quantity;
        $this->date_created = $date_created;
    }
    
    /**
     * @return int
     */
    public function getId() : string {
        return $this->id;
    }
    
    /**
     * @param int $id
     */
    public function setId(string $id) : void {
        $this->id = $id;
    }
    
    /**
     * @return string
     */
    public function getDescription() : string {
        return $this->description;
    }
    
    /**
     * @param string $description
     */
    public function setDescription(string $description) : void {
        $this->description = $description;
    }
    
    /**
     * @return string
     */
    public function getImageUrl() : string {
        return $this->image_url;
    }
    
    /**
     * @param string $image_url
     */
    public function setImageUrl(string $image_url) : void {
        $this->image_url = $image_url;
    }
    
    /**
     * @return float
     */
    public function getUnitPrice() : float {
        return $this->unit_price;
    }
    
    /**
     * @param float $unit_price
     */
    public function setUnitPrice(float $unit_price) : void {
        $this->unit_price = $unit_price;
    }
    
    /**
     * @return int
     */
    public function getAvailableQuantity() : int {
        return $this->available_quantity;
    }
    
    /**
     * @param int $available_quantity
     */
    public function setAvailableQuantity(int $available_quantity) : void {
        $this->available_quantity = $available_quantity;
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
    
    
    
    
}
    
