<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

/**
 * @property string|null $id_department
 * @property string|null collaborator
 * @property string|null cpf
 * @property string|null id_type
 */
class Collaborator extends DataLayer
{
    public function __construct()
    {
        parent::__construct("collaborator", ["id_department","id_type","collaborator","cpf"]);
    }

    public function department(): ?string
    {
        return ((new Department())->findById($this->id_department))->department;
    }

    public function type (): ?string
    {
        return ((new CollaboratorType())->findById($this->id_type))->type;
    }
}