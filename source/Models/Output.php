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
class Output extends DataLayer
{
    public function __construct()
    {
        parent::__construct("output", ["id_product","id_department","id_collaborator","id_responsible","id_user","amount","status"]);
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

    public function log():void
    {
        $log = (new OutputLog());
        $log->id_product = $this->id_product;
        $log->id_department = $this->id_department;
        $log->id_collaborator = $this->id_collaborator;
        $log->id_responsible = $this->id_responsible;
        $log->id_user = $this->id_user;
        $log->amount = $this->amount;
        $log->status = $this->status;
        $log->obs = $this->obs;
        $log->save();
    }
}