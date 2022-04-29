<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

/**
 * @property int $id_product
 * @property int $id_department
 * @property int $amount
 */
class Input extends DataLayer
{
    public function __construct()
    {
        parent::__construct("input", ["id_product", "id_department", "amount"]);
    }
}