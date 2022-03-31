<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Output extends DataLayer
{
    public function __construct()
    {
        parent::__construct("output", ["id_product","id_department","id_collaborator","id_user","amount","status"]);
    }
}