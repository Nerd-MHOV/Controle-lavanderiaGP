<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;


class Returns extends DataLayer
{
    public function __construct()
    {
        parent::__construct("returns", ["id_product", "id_department", "id_collaborator", "id_user", "amount", "status_in", "status_out"]);
    }
}