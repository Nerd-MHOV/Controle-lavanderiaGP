<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Department extends DataLayer
{
    public function __construct()
    {
        parent::__construct("department", ["department"]);
    }

    public function departmentHeads (): string
    {
        $heads = (new DepartmentHead())->find("id_department = :depart", "depart={$this->id}")->fetch(true);
        $strHeads = "";
        $first = true;
        if(!empty($heads)) {
            foreach ($heads as $head) {
                if ($first) {
                    $strHeads .= $head->first_name;
                    $first = false;
                } else {
                    $strHeads .= " / " . $head->first_name;
                }
            }
        }
        return $strHeads;
    }
}