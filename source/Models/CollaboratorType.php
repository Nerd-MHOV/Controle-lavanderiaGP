<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

/**
 * @property string|null type
 */
class CollaboratorType extends DataLayer
{
    public function __construct()
    {
        parent::__construct("collaborator_type", ["type"]);
    }
}