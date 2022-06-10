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
     * SELECIONE O TIPO
     */
    public function products(array $data): void
    {
        $id_department = (int)$data["id_department"];
        #$products = (new Product())->find("status = 'A' AND id_department = :did", "did={$id_department}")->group("id_product_type")->fetch(true);
        $products = (new Product())->find("status = 'A'")->group("id_product_type")->fetch(true);
        $callback["products"] = $this->view->render("assets/fragments/painel_response_products", [
            "countRow" => $data["qtdeRetiradas"],
            "products" => $products,
            "id_collaborator" => $data["id_collaborator"],
            "id_department" => $data["id_department"],
        ]);

        $collaborators = (new Collaborator())->find("id_department = :depart", "depart={$data["id_department"]}")->fetch(true);
        $callback["responsible"] = $this->view->render("assets/fragments/withdraw/reposibleCard", [
            "id_collaborator" => $data["id_collaborator"],
            "collaborators" => $collaborators,
            "selected" => $data["val_responsible"]
        ]);

        $callback["data"] = $data;
        $callback["debug"] = $products;
        echo json_encode($callback);
    }

    /**
     * @param array $data
     * @return void
     * SELECIONE O OFICIO
     */
    public function productType(array $data): void
    {
        #$products = (new Product())->find("status = 'A' AND id_department = :did AND id_product_type = :idpt",
        #    "did={$data["id_department"]}&idpt={$data["id_selectProductType"]}")
        #    ->group("id_product_service")
        #    ->fetch(true);

        $products = (new Product())->find("status = 'A' AND id_product_type = :idpt",
        "idpt={$data["id_selectProductType"]}")
        ->group("id_product_service")
        ->fetch(true);
        $callback["products"] = $this->view->render("assets/fragments/painel_productService", [
            "products" => $products,
            "selected" => @$data["val_service"]
        ]);
        $callback["debug"] = $products;
        $callback["data"] = $data;
        echo json_encode($callback);
    }

    /**
     * @param array $data
     * @return void
     * SELECIONE O PRODUTO
     */
    public function productService(array $data): void
    {
        #$products = (new Product())->find("status = 'A' AND id_department = :did AND id_product_type = :ipt AND id_product_service = :ips", "did={$data["id_department"]}&ipt={$data["id_productType"]}&ips={$data["id_productService"]}")->group("product")->fetch(true);
        $products = (new Product())->find("status = 'A' AND id_product_type = :ipt AND id_product_service = :ips", "ipt={$data["id_productType"]}&ips={$data["id_productService"]}")->group("product")->fetch(true);
        $callback["products"] = $this->view->render("assets/fragments/painel_product", [
            "products" => $products,
            "selected" => @$data["val_product"]
        ]);
        $callback["data"] = $data;
        echo json_encode($callback);
    }

    public function productSend(array $data): void
    {
        $products = (new Product())
            ->find("status = 'A' AND id_product_type = :idpt AND id_product_service = :idps AND product = :product",
                "idpt={$data["id_productType"]}&idps={$data["id_productService"]}&product={$data["product"]}")
            ->fetch(true);
        $callback["products"] = $this->view->render("assets/fragments/painel_productSize", [
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
        if (isset($data["responsible"]) && $data["responsible"] == "") {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Retiradas por setor necessitam de um responsável!"
            ]);
            return;
        }
        if (!(false === array_search(false, $data["select_productType"], false))
            || !(false === array_search(false, $data["select_productService"], false))
            || !(false === array_search(false, $data["select_product"], false))
            || !(false === array_search(false, $data["select_size"], false))
        ) {
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
                $inventory = (new Inventory())->find("id_product = :idp", "idp={$data["select_size"][$i]}")->fetch();
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
                if (((new Output())->find("id_product = :idp AND id_collaborator = 0", "idp={$data["select_size"][$i]}")->count())) { //Já existe pendencias
                    $output = (new Output())->find("id_product = :idp AND id_collaborator = 0", "idp={$data["select_size"][$i]}")->fetch();
                    $output->amount = ($output->amount + $data["amount"][$i]);
                    $output->id_responsible = $data["responsible"];
                    $output->id_user = $_SESSION["user"];
                    $output->log();
                    $output->save();
                } else { //Não existe pendencia!
                    $departmentProduct = (new Product())->find("id = {$data["select_size"][$i]}")->fetch();
                    $output = new Output();
                    $output->status = "bom";
                    $output->id_product = $data["select_size"][$i];
                    $output->id_department = $departmentProduct->id_department;
                    $output->id_collaborator = 0;
                    $output->id_responsible = $data["responsible"];
                    $output->id_user = $_SESSION["user"];
                    $output->amount = $data["amount"][$i];
                    $output->log();
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
                flash("success", "Retirada Feita com Sucesso, lembre-se de devolver!");
                echo $this->ajaxResponse("redirect", [
                    "url" => $this->router->route("painel.retirar")
                ]);
            }
        } else { // COLABORADOR
            $ruim = 0;
            for ($i = 0; $i < $countRows; $i++) {
                $departmentProduct = (new Product())->find("id = {$data["select_size"][$i]}")->fetch();
                $output = new Output();

                if ($data["select_status"][$i] == '1') {
                    $data["select_status"][$i] = "ruim";
                    $output->id_product = $data["select_size"][$i];
                    $output->id_department = $departmentProduct->id_department;
                    $output->id_collaborator = $data["colaborador"];
                    $output->id_responsible = $data["colaborador"];
                    $output->id_user = $_SESSION["user"];
                    $output->amount = 1;
                    $output->status = $data["select_status"][$i];
                    $output->obs = $data["txta_obs"][$ruim];
                    $ruim++;
                } else {
                    $data["select_status"][$i] = "bom";
                    $output->id_product = $data["select_size"][$i];
                    $output->id_department = $departmentProduct->id_department;
                    $output->id_collaborator = $data["colaborador"];
                    $output->id_responsible = $data["colaborador"];
                    $output->id_user = $_SESSION["user"];
                    $output->amount = 1;
                    $output->status = $data["select_status"][$i];
                }
                $output->log();
                $output->save();
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
}