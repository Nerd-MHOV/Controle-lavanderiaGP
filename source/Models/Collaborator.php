<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Collaborator extends DataLayer
{
    public function __construct()
    {
        parent::__construct("collaborator", ["id_department","collaborator","cpf","type"]);
    }
}