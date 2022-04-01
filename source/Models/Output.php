<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Output extends DataLayer
{
    public function __construct()
    {
        parent::__construct("output", ["id_product","id_department","id_collaborator","id_user","amount","status"]);
    }

    public function collaborator()
    {
        return (new Collaborator())->findById($this->id_collaborator);
    }

    public function department()
    {
        return (new Department())->findById($this->id_department);
    }

    public function product()
    {
        return (new Product())->findById($this->id_product);
    }

    public function productType($id)
    {
        return (new ProductType())->findById($id);
    }
}