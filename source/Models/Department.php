<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Department extends DataLayer
{
    public function __construct()
    {
        parent::__construct("departamento", ["departamento"], "id", false);
    }
}