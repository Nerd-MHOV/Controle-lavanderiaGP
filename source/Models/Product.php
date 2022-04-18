<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Product extends DataLayer
{
    public function __construct()
    {
        parent::__construct("product", ["status", "id_product_type", "id_product_service", "product", "unitary_value"]);
    }

    public function productType()
    {
        return (new ProductType())->findById($this->id_product_type);
    }

    public function productService()
    {
        return (new ProductService())->findById($this->id_product_service);
    }

    public function department()
    {
        return (new Department())->findById($this->id_department);
    }

}