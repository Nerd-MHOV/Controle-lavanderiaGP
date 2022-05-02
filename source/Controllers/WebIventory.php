<?php

namespace Source\Controllers;

use Source\Models\Product;
use Source\Models\User;

class WebIventory extends Controller
{
    public function __construct($router)
    {
        parent::__construct($router);

        if (empty($_SESSION["user"]) || !($this->user = (new User())->findById($_SESSION["user"]))) {
            unset($_SESSION["user"]);

            flash("error", "Acesso negado. Favor logue-se");
            $this->router->redirect("web.login");
        }
    }

    public function searchIventory (array $data): void
    {
        $products = (new Product())->search($data["search"]);
        $callback["data"] = $products[0]->product;
        $callback["response"] = $this->view->render("assets/fragments/iventory/table_iventoryProducts",[
            "products" => $products
        ]);
        echo json_encode($callback);
    }
}