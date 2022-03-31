<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Inventory extends DataLayer
{
    public function __construct()
    {
        parent::__construct("inventory", ["id_product", "id_department", "amount"]);
    }
}