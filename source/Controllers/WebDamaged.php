<?php

namespace Source\Controllers;

use Source\Models\Collaborator;
use Source\Models\Output;
use Source\Models\ProductType;
use Source\Models\Returns;
use Source\Models\User;

class WebDamaged extends Controller
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

    /**
     * @param array $data
     * @return void
     */
    public function returnCollaborator(array $data): void
    {
        $damaged = (new Returns())->findById($data["id_saida"]);
        $product = $damaged->product();
        $productType = $damaged->productType();
        $productService = $damaged->productService();

        $callback["modal"] = $this->view->render("assets/fragments/damaged/modalCollaborator", [
            "productName" => "{$productType->product_type} {$product->product} {$productService->service} {$product->size}",
            "status_in" => $damaged->status_in,
            "obs_in" => $damaged->obs_in,
            "status_out" => $damaged->status_out,
            "obs_out" => $damaged->obs_out,
            "id_saida" => $damaged->id,
            "all" => $damaged,
        ]);
        $callback["debug"] = $damaged->status;
        $callback["data"] = $data;
        echo json_encode($callback);
    }

    public function returnDepartment(array $data): void
    {
        $damaged = (new Returns())->findById($data["id_saida"]);
        $product = $damaged->product();
        $productType = $damaged->productType();
        $productService = $damaged->productService();
        $callback["modal"] = $this->view->render("assets/fragments/damaged/modalDepartment", [
            "productName" => "{$productType->product_type} {$product->product} {$productService->service} {$product->size}",
            "id_saida" => $data["id_saida"],
            "amountGood" => ($damaged->amount - $damaged->amount_bad),
            "amountBad" => $damaged->amount_bad,
            "obs_out" => $damaged->obs_out,
        ]);
        $callback["data"] = $data;
        echo json_encode($callback);
    }

    public function perCollaborator(): void
    {
        if ($this->user->level < 3) {
            $this->router->redirect("error.error",[
                "errcode" => "401"
            ]);
        }
        $head = $this->seo->optimize(
            "Danificados por colaborador | " . site("name"),
            site("desc"),
            $this->router->route('web-product.new-type'),
            routeImage("Danificados | colaborador"),
        )->render();
        $types = (new ProductType())->find()->fetch(true);
        $collaborator = (new Collaborator())->find("id != 0")->fetch(true);
        $this->view->addData(['head' => $head, 'collaborator' => $collaborator]);
        echo $this->view->render("theme/pages/damaged/perCollaborator");
    }
}