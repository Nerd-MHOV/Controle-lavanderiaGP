<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Product extends DataLayer
{
    public function __construct()
    {
        parent::__construct("product", ["status", "id_product_type", "id_product_service", "product", "unitary_value"]);
    }

    public function productTypes()
    {
        return (new ProductType())->findById($this->id_product_type);
    }

    public function productServices()
    {
        return (new ProductService())->findById($this->id_product_service);
    }

}