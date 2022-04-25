<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class DepartmentHead extends DataLayer
{
    public function __construct()
    {
        parent::__construct("department_head", ["id_department", "first_name", "last_name", "email", "cel"]);
    }
}