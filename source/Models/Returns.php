<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;


/**
 * @property int|null $id_product
 * @property int|null $id_department
 * @property int|null $id_collaborator
 * @property int|null $id_responsible_in
 * @property int|null $id_responsible_out
 * @property int|null $id_user
 * @property int|null $has_amount
 * @property int|null $amount
 * @property string|null $status_in
 * @property string|null $status_out
 * @property string|null $date_in
 * @property string|null $date_out
 * @property string|null $obs_in
 * @property string|null $obs_out
 * @property int|null $amount_bad
 */
class Returns extends DataLayer
{
    public function __construct()
    {
        parent::__construct("returns", ["id_product", "id_department", "id_collaborator", "id_responsible_in", "id_responsible_out", "id_user", "amount", "has_amount", "status_in", "status_out", "date_in", "date_out"]);
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

    public function responsibleIn()
    {
        return ((new Collaborator())->findById($this->id_responsible_in)->collaborator);
    }
    public function responsibleOut()
    {
        return ((new Collaborator())->findById($this->id_responsible_out)->collaborator);
    }
}