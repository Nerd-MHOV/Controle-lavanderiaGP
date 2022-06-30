<?php

namespace Source\Controllers;

use Source\Models\Collaborator;
use Source\Models\Output;
use Source\Models\Product;
use Source\Models\Returns;
use Source\Models\User;

class WebReturn extends Controller
{
    /**
     * @var User|\CoffeeCode\DataLayer\DataLayer|null
     */
    protected User $user;

    /**
     * @param $router
     */
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
        $outputs = (new Output())->findById($data["id_saida"]);
        $product = $outputs->product();
        $productType = $outputs->productType();
        $productService = $outputs->productService();

        $callback["modal"] = $this->view->render("assets/fragments/painel_devolver_modal", [
            "productName" => "{$productType->product_type} {$product->product} {$productService->service} {$product->size}",
            "status_old" => $outputs->status,
            "obs_old" => $outputs->obs,
            "id_saida" => $outputs->id,
        ]);

        $callback["data"] = $data;
        echo json_encode($callback);
    }

    public function returnDepartment(array $data): void
    {
        $outputs = (new Output())->findById($data["id_saida"]);
        $responsibles = (new Collaborator())->find("id_department LIKE {$outputs->id_department}")->fetch(true);
        $product = $outputs->product();
        $productType = $outputs->productType();
        $productService = $outputs->productService();
        $callback["modal"] = $this->view->render("assets/fragments/painel_devolver_modalDepartment", [
            "productName" => "{$productType->product_type} {$product->product} {$productService->service} {$product->size}",
            "id_saida" => $data["id_saida"],
            "totalAmount" => $outputs->amount,
            "responsible_in" => $outputs->responsible(),
            "responsibles" => $responsibles,
        ]);
        $callback["data"] = $data;
        echo json_encode($callback);
    }

    /**
     * @param array $data
     * @return void
     */
    public function returnProduct(array $data): void
    {
        if (isset($data["estado-modal"]) && !$data["estado-modal"]) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Informe o estado do item!"
            ]);
            return;
        }

        if (isset($data["responsible_out"]) && $data["responsible_out"] === "") {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Necessario selecionar um responsável pela entrega!"
            ]);
            return;
        }

        if (isset($data["obs-modal"]) && $data["obs-modal"] === "") {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Descreva o porquê de o item estar \"Ruim\""
            ]);
            return;
        }

        $id = $data["id_saida"];
        $output = (new Output())->findById($id);
        $returns = new Returns();

        $amountTotal = 1;
        if (isset($data["nmb_good"]))
            $amountTotal = ($data["nmb_good"] + $data["nmb_bad"]);

        $id = 0;
        if ($output->id_collaborator == "0") { //setor
            $returns->id_product = $output->id_product;
            $returns->id_department = $output->id_department;
            $returns->id_collaborator = $output->id_collaborator;
            $returns->id_responsible_in = $output->id_responsible;
            $returns->id_responsible_out = $data["responsible_out"];
            $returns->id_user = $_SESSION["user"];
            $returns->amount = $amountTotal;
            $returns->amount_bad = $data["nmb_bad"];
            $returns->status_in = $output->status;
            $returns->status_out = ($data["nmb_bad"] > 0) ? "ruim" : "bom";
            $returns->obs_in = $output->obs;
            $returns->obs_out = $data["obs-modal"] ?? "";
            $returns->date_in = $output->created_at;
            $returns->date_out = date("Y-m-d H:i:s");


            $newAmount = ($output->amount - $returns->amount);
            if ($newAmount == "0") {
                $id = $data["id_saida"];
                $output->destroy();
            } else {
                $output->amount = $newAmount;
                $output->save();
            }
            $returns->save();
        } else { //collaborator
            $returns->id_product = $output->id_product;
            $returns->id_department = $output->id_department;
            $returns->id_collaborator = $output->id_collaborator;
            $returns->id_responsible_in = $output->id_collaborator;
            $returns->id_responsible_out = $output->id_collaborator;
            $returns->id_user = $_SESSION["user"];
            $returns->amount = $output->amount;
            $returns->amount_bad = 0;
            $returns->status_in = $output->status;
            $returns->status_out = $data["estado-modal"];
            $returns->obs_in = $output->obs;
            $returns->obs_out = $data["obs-modal"] ?? "";
            $returns->date_in = $output->created_at;
            $returns->date_out = date("Y-m-d H:i:s");

            $id = $data["id_saida"];
            $returns->save();
            $output->destroy();
        }


        if ($output->fail()) {
            $debug = $output->fail()->getMessage();
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Erro com Banco de Dados, Favor chamar o responsavel! {$debug}"
            ]);
            return;
        } else if ($returns->fail()) {
            $debug = $returns->fail()->getMessage();
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Erro com Banco de Dados, Favor chamar o responsavel! {$debug}"
            ]);
            return;
        } else {
            echo $this->ajaxResponse("message", [
                "type" => "success",
                "message" => "{$amountTotal} {$data["productName"]} devolvido com sucesso!",
                "id" => $id,
            ]);
        }
    }

    public function searchCollaborator(array $data): void
    {
        $products = (new Product())->searchOutputsCollaborator($data["search"]);
        $callback["data"] = $products;
        $callback["response"] = $this->view->render("assets/fragments/painel_outputsCollaborator_search",[
            "products" => $products
        ]);
        echo json_encode($callback);
    }

    public function searchDepartment(array $data): void
    {
        $products = (new Product())->searchOutputsDepartment($data["search"]);
        $callback["data"] = $products;
        $callback["response"] = $this->view->render("assets/fragments/painel_outputsDepartment_search",[
            "products" => $products
        ]);
        echo json_encode($callback);
    }
}