<?php

namespace Source\Controllers;

use Source\Models\Collaborator;
use Source\Models\Product;
use Source\Models\ProductType;

class Response extends Controller
{
    public function __construct($router)
    {
        parent::__construct($router);
    }

    public function collaborator(array $data): void
    {
        $collaborators = (new Collaborator())->find("id_department = :depart OR id_department = 0", "depart={$data["id_department"]}")->fetch(true);
        $callback["collaborators"] = $this->view->render("assets/fragments/painel_response_collaborator", ["collaborators" => $collaborators]);
        $callback["data"] = $data;
        $callback["status"] = "success";
        echo json_encode($callback);
    }

    public function products(array $data): void
    {
        $id_department = (int)$data["id_department"];
        $products = (new Product())->find("status = 'A' AND id_department = :did", "did={$id_department}")->fetch(true);
        $callback["products"] = $this->view->render("assets/fragments/painel_response_products",[
            "countRow" => $data["qtdeRetiradas"],
            "products" => $products
        ]);
        $callback["debug"] = $products;
        $callback["data"] = $data;
        $callback["status"] = "success";
        echo json_encode($callback);
    }
}