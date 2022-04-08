<?php

namespace Source\Controllers;

use Source\Models\Collaborator;
use Source\Models\Inventory;
use Source\Models\Output;
use Source\Models\Product;
use Source\Models\ProductType;

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
        if (!(false === array_search(false, $data["select_productType"], false))) {
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


        if (!$data["colaborador"]) {
            for ($i = 0; $i < $countRows; $i++) {
                $output = new Output();
                $output->id_product = $data["select_product"][$i];
                $output->id_department = $data["departamento"];
                $output->id_collaborator = 0;
                $output->id_user = $_SESSION["user"];
                $output->amount = $data["amount"][$i];
                $output->status = "bom";
                $output->save();
            }
        } else {
            $ruim = 0;
            for ($i = 0; $i < $countRows; $i++) {
                if ($data["select_status"][$i] == 'ruim') {
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
        }
        if ($output->fail()) {
            $debug = $output->fail()->getMessage();
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Erro com Banco de Dados, Favor chamar o responsavel! {$debug}"
            ]);
            return;
        } else {
            echo $this->ajaxResponse("message", [
                "type" => "success",
                "message" => "Retirada Feita com Sucesso, lembre-se de devolver!"
            ]);
            return;
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
        $productType = $outputs->productType($product->id_product_type);

        $callback["modal"] = $this->view->render("assets/fragments/painel_devolver_modal",[
            "productName" => "{$productType->product_type} {$product->product}",
            "status_old" => $outputs->status,
            "obs_old" => $outputs->obs,
            "id_saida" => $outputs->id,
        ]);

        $callback["debug"] = $productType->product_type;
        $callback["data"] = $data;
        echo json_encode($callback);
    }

    /**
     * @param array $data
     * @return void
     */
    public function returnProduct(array $data): void
    {
        $callback["data"] = $data;
        echo json_encode($callback);
    }
}