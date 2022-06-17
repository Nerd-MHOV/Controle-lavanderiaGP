<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

/**
 * @property int|null $id_product
 * @property int|null $id_department
 * @property int|null $id_collaborator
 * @property int|null $id_responsible
 * @property int|null $id_user
 * @property int|null $amount
 * @property string|null $status
 * @property string|null $obs
*/
class OutputLog extends DataLayer
{
    public function __construct()
    {
        parent::__construct("output_log", ["id_product","id_department","id_collaborator","id_responsible","id_user","amount","status"]);
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

    public function responsible()
    {
        return ((new Collaborator())->findById($this->id_responsible)->collaborator);
    }
}