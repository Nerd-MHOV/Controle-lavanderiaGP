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
}