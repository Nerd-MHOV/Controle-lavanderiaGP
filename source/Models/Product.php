<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Product extends DataLayer
{
    public function __construct()
    {
        parent::__construct("product", ["status", "id_department", "id_product_type", "product", "unitary_value"]);
    }

    public function productTypes()
    {
        return (new ProductType())->find("id = :idtp", "idtp={$this->id_product_type}")->fetch(true);
    }
}