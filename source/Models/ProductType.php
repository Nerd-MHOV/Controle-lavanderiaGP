<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;


class ProductType extends DataLayer
{
    public function __construct()
    {
        parent::__construct("product_type", ["product_type"]);
    }

    public function products()
    {
        return (new Product())->find("id_product_type = :pid", "pid={$this->id}")->fetch();
    }

    public function amountProducts(): int
    {
        return (new Product())->find("id_product_type = :pid", "pid={$this->id}")->count();
    }
}