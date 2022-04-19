<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class ProductService extends DataLayer
{
    public function __construct()
    {
        parent::__construct("product_service", ["service"]);
    }

    public function amountProducts(): int
    {
        return (new Product())->find("id_product_service = :pid", "pid={$this->id}")->count();
    }
}