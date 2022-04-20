<?php

namespace Source\Controllers;

use Source\Models\Product;
use Source\Models\ProductService;
use Source\Models\ProductType;
use Source\Models\User;

class WebProduct extends Controller
{
    protected User $user;

    public function __construct($router)
    {
        parent::__construct($router);

        if(empty($_SESSION["user"]) || !($this->user = (new User())->findById($_SESSION["user"]))) {
            unset($_SESSION["user"]);

            flash("error", "Acesso negado. Favor logue-se");
            $this->router->redirect("web.login");
        }
    }

    public function newType(): void
    {
        $head = $this->seo->optimize(
            "Cadastrar TIPO | " . site("name"),
            site("desc"),
            $this->router->route('web-product.new-type'),
            routeImage("CADASTRAR TIPO"),
        )->render();
        $types = (new ProductType())->find()->fetch(true);
        $this->view->addData(['head' => $head, 'types' => $types]);
        echo $this->view->render("theme/pages/product/newType");
    }

    public function newService(): void
    {
        $head = $this->seo->optimize(
            "Cadastrar OFICIO | " . site("name"),
            site("desc"),
            $this->router->route('web-product.new-service'),
            routeImage("CADASTRAR OFICIO"),
        )->render();
        $services = (new ProductService())->find()->fetch(true);
        $this->view->addData(['head' => $head, 'services' => $services]);
        echo $this->view->render("theme/pages/product/newService");
    }

    public function newProduct(): void
    {
        $head = $this->seo->optimize(
            "Cadastrar PRODUTO | " . site("name"),
            site("desc"),
            $this->router->route('web-product.new-product'),
            routeImage("CADASTRAR PRODUTO"),
        )->render();
        $types = (new ProductType())->find()->fetch(true);
        $services = (new ProductService())->find()->fetch(true);
        $products = (new Product())->find()->fetch(true);
        $this->view->addData(['head' => $head, 'types' => $types, 'services' => $services, 'products' => $products]);
        echo $this->view->render("theme/pages/product/newProduct");
    }

    public function registerType(array $data): void
    {
        if (isset($data["inp-typeregister"]) && $data["inp-typeregister"] === ""){
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Preencha o campo!"
            ]);
            return;
        }

        if((new ProductType())->find("product_type = :ptp", "ptp={$data["inp-typeregister"]}")->fetch()) {
            echo $this->ajaxResponse("message",[
               "type" => "alert",
               "message" => "<u>{$data["inp-typeregister"]}</u> já está cadastrado como tipo!"
            ]);
            return;
        }

        $type = (new ProductType());
        $type->product_type = $data["inp-typeregister"];
        //$type->save();

        if ($type->fail()) {
            $debug = $type->fail()->getMessage();
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Erro com Banco de Dados, Favor chamar o responsavel! {$debug}",
            ]);
            return;
        } else {
            $types = (new ProductType())->find()->fetch(true);
            echo $this->ajaxResponse("message", [
                "type" => "success",
                "message" => "Cadastro de \"<u>{$data["inp-typeregister"]}</u>\" efetuado com sucesso!",
                "registerType" => $this->view->render("assets/fragments/product/registeredTypes", [
                    "types" => $types
                ]),

            ]);
            return;
        }
    }

    public function registerService(array $data): void
    {
        if (isset($data["inp-typeregister"]) && $data["inp-typeregister"] === ""){
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Preencha o campo!"
            ]);
            return;
        }

        if((new ProductService())->find("service = :svc", "svc={$data["inp-typeregister"]}")->fetch()) {
            echo $this->ajaxResponse("message",[
                "type" => "alert",
                "message" => "<u>{$data["inp-typeregister"]}</u> já está cadastrado como oficio!"
            ]);
            return;
        }

        $service = (new ProductService());
        $service->service = $data["inp-typeregister"];
        $service->save();

        if ($service->fail()) {
            $debug = $service->fail()->getMessage();
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Erro com Banco de Dados, Favor chamar o responsavel! {$debug}",
            ]);
            return;
        } else {
            $services = (new ProductService())->find()->fetch(true);
            echo $this->ajaxResponse("message", [
                "type" => "success",
                "message" => "Cadastro de \"<u>{$data["inp-typeregister"]}</u>\" efetuado com sucesso!",
                "registerType" => $this->view->render("assets/fragments/product/registeredServices", [
                    "services" => $services
                ]),

            ]);
            return;
        }
    }

    public function registerProduct(array $data): void
    {

        $callback["data"] = $data;
        echo json_encode($callback);
    }

    public function filter_type(array $data): void
    {
        $callback["data"] = $data;
        echo json_encode($callback);
    }



}