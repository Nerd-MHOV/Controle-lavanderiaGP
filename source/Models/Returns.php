<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;


class Returns extends DataLayer
{
    public function __construct()
    {
        parent::__construct("returns", ["id_product", "id_department", "id_collaborator", "id_user", "amount", "status_in", "status_out"]);
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

    public function productType()
    {
        return (new ProductType())->findById($this->product()->id_product_type);
    }

    public function productService()
    {
        return (new ProductService())->findById($this->product()->id_product_service);
    }
}