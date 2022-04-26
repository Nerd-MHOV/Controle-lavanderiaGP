<?php

namespace Source\Controllers;

use Source\Models\Collaborator;
use Source\Models\CollaboratorType;
use Source\Models\Department;
use Source\Models\ProductService;
use Source\Models\ProductType;
use Source\Models\User;

class WebDepartment extends Controller
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

    public function newDepartment(): void
    {
        $head = $this->seo->optimize(
            "Cadastrar Departamento | " . site("name"),
            site("desc"),
            $this->router->route("web-department.new-department"),
            routeImage("CADASTRAR DEPARTAMENTO"),
        )->render();
        $departments = (new Department())->find()->fetch(true);
        $this->view->addData(['head' => $head, 'departments' => $departments]);
        echo $this->view->render("theme/pages/department/newDepartment");
    }

    public function newCollaborator(): void
    {
        $head = $this->seo->optimize(
            "Cadastrar Colaborador | " . site("name"),
            site("desc"),
            $this->router->route("web-department.new-collaborator"),
            routeImage("CADASTRAR COLABORADOR"),
        )->render();
        $collaborators = (new Collaborator())->find("id_department != 0")->fetch(true);
        $departments = (new Department())->find()->fetch(true);
        $types = (new CollaboratorType())->find()->fetch(true);
        $this->view->addData([
            'head' => $head,
            'collaborators' => $collaborators,
            'departments' => $departments,
            'types' => $types
        ]);
        echo $this->view->render("theme/pages/department/newCollaborator");
    }

    public function registerDepartment(array $data): void
    {
        if (isset($data["inp_department"]) && $data["inp_department"] === ""){
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Preencha o campo!"
            ]);
            return;
        }

        if((new Department())->find("department = :depart", "depart={$data["inp_department"]}")->fetch()) {
            echo $this->ajaxResponse("message",[
                "type" => "alert",
                "message" => "<u>{$data["inp_department"]}</u> já está cadastrado como departamento!"
            ]);
            return;
        }

        $department = (new Department());
        $department->department = $data["inp_department"];
        $department->save();

        if ($department->fail()) {
            $debug = $department->fail()->getMessage();
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Erro com Banco de Dados, Favor chamar o responsavel! {$debug}",
            ]);
            return;
        } else {
            $departments = (new Department())->find()->fetch(true);
            echo $this->ajaxResponse("message", [
                "type" => "success",
                "message" => "Cadastro do departamento: \"<u>{$data["inp_department"]}</u>\", efetuado com sucesso!",
                "registerType" => $this->view->render("assets/fragments/department/registeredDepartments", [
                    "departments" => $departments
                ]),

            ]);
            return;
        }
    }

    public function registerCollaborator(array $data) : void
    {
        

        $callback["data"] = $data;
        echo json_encode($callback);
    }
}