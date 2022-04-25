<?php

namespace Source\Controllers;

use Source\Models\Department;
use Source\Models\Product;
use Source\Models\ProductService;
use Source\Models\ProductType;
use Source\Models\User;

/**
 *
 */
class WebProduct extends Controller
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

        if(empty($_SESSION["user"]) || !($this->user = (new User())->findById($_SESSION["user"]))) {
            unset($_SESSION["user"]);

            flash("error", "Acesso negado. Favor logue-se");
            $this->router->redirect("web.login");
        }
    }

    /**
     * @return void
     */
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

    /**
     * @return void
     */
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

    /**
     * @return void
     */
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
        $departments = (new Department())->find()->fetch(true);
        $this->view->addData([
            'head' => $head,
            'types' => $types,
            'services' => $services,
            'products' => $products,
            'departments' => $departments
        ]);
        echo $this->view->render("theme/pages/product/newProduct");
    }

    /**
     * @param array $data
     * @return void
     */
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

    /**
     * @param array $data
     * @return void
     */
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

    /**
     * @param array $data
     * @return void
     */
    public function registerProduct(array $data): void
    {
        if($data["select_type"] == ""){
            echo $this->ajaxResponse("message", [
                "type" => "alert",
                "message" => "Selecione o Tipo",
            ]);
            return;
        }
        if($data["select_service"] == ""){
            echo $this->ajaxResponse("message", [
                "type" => "alert",
                "message" => "Selecione o Oficio"
            ]);
            return;

        }
        if($data["select_department"] == ""){
            echo $this->ajaxResponse("message", [
                "type" => "alert",
                "message" => "Selecione o Departamento"
            ]);
            return;

        }
        if($data["inp_product"] == ""){
            echo $this->ajaxResponse("message", [
                "type" => "alert",
                "message" => "Qual o nome do produto",
            ]);
            return;

        }
        if($data["inp_unitaryValue"] == ""){
            echo $this->ajaxResponse("message", [
                "type" => "alert",
                "message" => "O produto precisa ter um valor unitário para cadastro!",
            ]);
            return;

        }
        if($data["inp_amount"] == ""){
            echo $this->ajaxResponse("message", [
                "type" => "alert",
                "message" => "Informe a quantidade!",
            ]);
            return;

        }
        if((new Product())
            ->find("id_department = :department AND id_product_type = :type AND id_product_service = :service AND product = :product",
            "department={$data["select_department"]}&type={$data["select_type"]}&service={$data["select_service"]}&product={$data["inp_product"]}")
            ->fetch()) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Esse produto já tem cadastro na nossa base de dados!"
            ]);
            return;
        }

        $product = new Product();
        $product->status = "A";
        $product->id_department = $data["select_department"];
        $product->id_product_type = $data["select_type"];
        $product->id_product_service = $data["select_service"];
        $product->product = $data["inp_product"];
        $product->unitary_value = $data["inp_unitaryValue"];
        $id_product = $product->save();


        if ($product->fail()) {
            $debug = $product->fail()->getMessage();
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Erro com Banco de Dados, Favor chamar o responsavel! {$debug}",
            ]);
            return;
        } else {
            $product = (new Product())->findById($id_product);
            $products = (new Product())->find()->fetch(true);
            echo $this->ajaxResponse("message", [
                "type" => "success",
                "message" => "Cadastro de \"<u>{$product->productType()->product_type} {$data["inp_product"]} {$product->productService()->service}</u>, para o departamento <u>{$product->department()->department}</u>\" efetuado com sucesso!",
                "reloadRegistered" => $this->view->render("assets/fragments/product/registeredProducts", [
                    "products" => $products
                ]),
            ]);
            return;
        }

        $callback["data"] = $data;
        echo json_encode($callback);
    }

    /**
     * @param array $data
     * @return void
     */
    public function reloadProducts(array $data): void
    {
        $products = (new Product())
            ->find("id_department = :depart AND id_product_type = :type AND id_product_service = :service",
                "depart={$data["department"]}&type={$data["type"]}&service={$data["service"]}")
            ->fetch(true);
        $callback["reload"] = $this->view->render("assets/fragments/product/registeredProducts",[
            'products' => $products
        ]);
        $callback["data"] = $data;
        echo json_encode($callback);
    }




}