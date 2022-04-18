<?php

namespace Source\Controllers;

use Source\Models\Collaborator;
use Source\Models\Inventory;
use Source\Models\Output;
use Source\Models\Product;
use Source\Models\ProductType;
use Source\Models\Returns;

/**
 *
 */
class Response extends Controller
{
    /**
     * @param $router
     */
    public function __construct($router)
    {
        parent::__construct($router);
    }

    /**
     * @param array $data
     * @return void
     */
    public function collaborator(array $data): void
    {
        $collaborators = (new Collaborator())->find("id_department = :depart OR id_department = 0", "depart={$data["id_department"]}")->fetch(true);
        $callback["collaborators"] = $this->view->render("assets/fragments/painel_response_collaborator", ["collaborators" => $collaborators]);
        $callback["data"] = $data;
        $callback["status"] = "success";
        echo json_encode($callback);
    }

    /**
     * @param array $data
     * @return void
     */
    public function products(array $data): void
    {
        $id_department = (int)$data["id_department"];
        $products = (new Product())->find("status = 'A' AND id_department = :did", "did={$id_department}")->group("id_product_type")->fetch(true);
        $callback["products"] = $this->view->render("assets/fragments/painel_response_products", [
            "countRow" => $data["qtdeRetiradas"],
            "products" => $products,
            "id_collaborator" => $data["id_collaborator"]
        ]);
        $callback["data"] = $data;
        echo json_encode($callback);
    }

    /**
     * @param array $data
     * @return void
     */
    public function productService(array $data): void
    {
        $products = (new Product())->find("id_product_type = :ipt AND id_product_service = :ips", "ipt={$data["id_productType"]}&ips={$data["id_productService"]}")->fetch(true);
        $callback["products"] = $this->view->render("assets/fragments/painel_product", [
            "products" => $products
        ]);
        $callback["data"] = $data;
        echo json_encode($callback);
    }

    /**
     * @param array $data
     * @return void
     */
    public function productType(array $data): void
    {
        $products = (new Product())->find("id_product_type = :idpt", "idpt={$data["id_selectProductType"]}")->group("id_product_service")->fetch(true);
        $callback["products"] = $this->view->render("assets/fragments/painel_productService", [
            "products" => $products
        ]);
        $callback["debug"] = $products;
        $callback["data"] = $data;
        echo json_encode($callback);
    }

    /**
     * @param array $data
     * @return void
     */
    public function withdrawal(array $data): void
    {
        if ($data["departamento"] == "") {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Informe o departamento!"
            ]);
            return;
        }
        if ($data["qtde_itens"] == "0") {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Faça ao menos UMA retirada"
            ]);
        }
        if (!(false === array_search(false, $data["select_productType"], false))
            || !(false === array_search(false, $data["select_productService"], false))
            || !(false === array_search(false, $data["select_product"], false))) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Informe todos os produto adequadamente!"
            ]);
            return;
        }
        if (isset($data["txta_obs"]) && !(false === array_search(false, $data["txta_obs"], false))) {
            echo $this->ajaxResponse("message", [
                "type" => "alert",
                "message" => "Descreva o defeito, quando o estado for 'RUIM'"
            ]);
            return;
        }

        $countRows = count($data["select_productType"]);
        if (isset($data["amount"])) {

            for ($i = 0; $i < $countRows; $i++) {
                $inventory = (new Inventory())->find("id_product = :idp", "idp={$data["select_product"][$i]}")->fetch();
                if ($inventory->amount < $data["amount"][$i]) {
                    $productInventory = $inventory->products();
                    $typeInventory = $inventory->productTypes($productInventory->id_product_type);
                    echo $this->ajaxResponse("message", [
                        "type" => "alert",
                        "message" => "Em estoque: {$inventory->amount} unidades de <u>{$typeInventory->product_type} {$productInventory->product}</u>"
                    ]);
                    return;
                }
            }
        }


        if (!$data["colaborador"]) { //SETOR
            for ($i = 0; $i < $countRows; $i++) {
                if ( ((new Output())->find("id_product = :idp AND id_collaborator = 0", "idp={$data["select_product"][$i]}")->count()) ){ //Já existe pendencias
                    $output = (new Output())->find("id_product = :idp AND id_collaborator = 0", "idp={$data["select_product"][$i]}")->fetch();
                    $output->id_user = $_SESSION["user"];
                    $output->amount = ($output->amount + $data["amount"][$i]);
                    $output->save();
                } else { //Não existe pendencia!
                    $output = new Output();
                    $output->status = "bom";
                    $output->id_product = $data["select_product"][$i];
                    $output->id_department = $data["departamento"];
                    $output->id_collaborator = 0;
                    $output->id_user = $_SESSION["user"];
                    $output->amount = $data["amount"][$i];
                    $output->save();
                }
            }
            if ($output->fail()) {
                $debug = $output->fail()->getMessage();
                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Erro com Banco de Dados, Favor chamar o responsavel! {$debug}"
                ]);
            } else {
                echo $this->ajaxResponse("message", [
                    "type" => "success",
                    "message" => "Retirada Feita com Sucesso, lembre-se de devolver!"
                ]);
            }
        } else { // COLABORADOR
            $ruim = 0;
            for ($i = 0; $i < $countRows; $i++) {
                if ($data["select_status"][$i] == '1') {
                    $data["select_status"][$i] = "ruim";
                    $output = new Output();
                    $output->id_product = $data["select_product"][$i];
                    $output->id_department = $data["departamento"];
                    $output->id_collaborator = $data["colaborador"];
                    $output->id_user = $_SESSION["user"];
                    $output->amount = 1;
                    $output->status = $data["select_status"][$i];
                    $output->obs = $data["txta_obs"][$ruim];
                    $output->save();
                    $ruim++;
                } else {
                    $data["select_status"][$i] = "bom";
                    $output = new Output();
                    $output->id_product = $data["select_product"][$i];
                    $output->id_department = $data["departamento"];
                    $output->id_collaborator = $data["colaborador"];
                    $output->id_user = $_SESSION["user"];
                    $output->amount = 1;
                    $output->status = $data["select_status"][$i];

                    $output->save();
                }
            }

            if ($output->fail()) {
                $debug = $output->fail()->getMessage();
                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Erro com Banco de Dados, Favor chamar o responsavel! {$debug}"
                ]);
            } else {
                echo $this->ajaxResponse("redirect", [
                    "url" => $this->router->route("withdraw.document", ["id" => $data["colaborador"]])
                ]);
            }
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

        $callback["modal"] = $this->view->render("assets/fragments/painel_devolver_modal",[
            "productName" => "{$productType->product_type} {$product->product} {$productService->service}",
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
        $product = $outputs->product();
        $productType = $outputs->productType();
        $productService = $outputs->productService();
        $callback["modal"] = $this->view->render("assets/fragments/painel_devolver_modalDepartment", [
            "productName" => "{$productType->product_type} {$product->product} {$productService->service}",
            "id_saida" => $data["id_saida"],
            "totalAmount" => $outputs->amount
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
        if(isset($data["estado-modal"]) && !$data["estado-modal"]){
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Informe o estado do item!"
            ]);

            return;
        }

        if (isset($data["obs-modal"]) && $data["obs-modal"] === ""){
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Descreva o porquê de o item estar \"Ruim\""
            ]);

            return;
        }

        $id = $data["id_saida"];
        $output = (new Output())->findById($id);
        $returns = new Returns();

        if ($output->id_collaborator == "0") {
            $returns->id_product = $output->id_product;
            $returns->id_department = $output->id_department;
            $returns->id_collaborator = $output->id_collaborator;
            $returns->id_user = $_SESSION["user"];
            $returns->amount = ($data["nmb_good"] + $data["nmb_bad"]);
            $returns->amountBad = $data["nmb_bad"];
            $returns->status_in = $output->status;
            $returns->status_out = ($data["nmb_bad"] > 0) ? "ruim" : "bom";
            $returns->obs_in = $output->obs;
            $returns->obs_out = $data["obs-modal"] ?? "";


            $newAmount = ($output->amount - $returns->amount);
            if ($newAmount == "0") {
                $output->destroy();
            } else {
                $output->amount = $newAmount;
                $output->save();
            }
            $returns->save();
        } else {
            $returns->id_product = $output->id_product;
            $returns->id_department = $output->id_department;
            $returns->id_collaborator = $output->id_collaborator;
            $returns->id_user = $_SESSION["user"];
            $returns->amount = $output->amount;
            $returns->amountBad = "";
            $returns->status_in = $output->status;
            $returns->status_out = $data["estado-modal"];
            $returns->obs_in = $output->obs;
            $returns->obs_out = $data["obs-modal"] ?? "";

            $newAmount = $returns->amount;
            $returns->save();
            $output->destroy();
        }



        if ($output->fail() || $returns->fail()) {
            $debug = $output->fail()->getMessage();
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Erro com Banco de Dados, Favor chamar o responsavel! {$debug}"
            ]);
            return;
        } else {
            echo $this->ajaxResponse("message", [
                "type" => "success",
                "message" => "{$newAmount} {$data["productName"]} devolvido com sucesso!",
                "id" => $id,
            ]);
        }
    }
}