<?php
    $depart = new \Source\Models\Department();
    $depart->fetch(true);
    var_dump($depart->data());