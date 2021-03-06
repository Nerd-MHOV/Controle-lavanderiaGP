<?php

namespace Source\Controllers;

use CoffeeCode\Optimizer\Optimizer;
use Source\Models\Collaborator;
use Source\Models\CollaboratorType;
use Source\Models\Department;
use Source\Models\Output;
use Source\Models\Product;
use Source\Models\ProductService;
use Source\Models\ProductType;
use Source\Models\User;


/**
 *
 */
class WebDepartment extends Controller
{
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
     * @return void
     */
    public function newDepartment(): void
    {
        if ($this->user->level < 2) {
            $this->router->redirect("error.error",[
                "errcode" => "401"
            ]);
        }
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

    /**
     * @return void
     */
    public function newCollaborator(): void
    {
        if ($this->user->level < 1) {
            $this->router->redirect("error.error",[
                "errcode" => "401"
            ]);
        }
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

    /**
     * @param array $data
     * @return void
     */
    public function registerDepartment(array $data): void
    {
        if (isset($data["inp_department"]) && $data["inp_department"] === "") {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Preencha o campo!"
            ]);
            return;
        }

        if ((new Department())->find("department = :depart", "depart={$data["inp_department"]}")->fetch()) {
            echo $this->ajaxResponse("message", [
                "type" => "alert",
                "message" => "<u>{$data["inp_department"]}</u> j?? est?? cadastrado como departamento!"
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

    /**
     * @param array $data
     * @return void
     */
    public function registerCollaborator(array $data): void
    {
        if ($data["select_department"] == "") {
            echo $this->ajaxResponse("message", [
                "type" => "alert",
                "message" => "Selecione um departamento"
            ]);
            return;
        }

        if ($data["select_type"] == "") {
            echo $this->ajaxResponse("message", [
                "type" => "alert",
                "message" => "Selecione a forma de trabalho"
            ]);
            return;
        }

        if ($data["inp_collaborator"] == "") {
            echo $this->ajaxResponse("message", [
                "type" => "alert",
                "message" => "Informe o nome do colaborador"
            ]);
            return;
        }

        if($data["inp_cpf"] == ""){
            echo $this->ajaxResponse("message", [
               "type" => "alert",
               "message" => "Informe o C.P.F"
            ]);
            return;
        }

        $collaborator = (new Collaborator);
        $collaborator->id_department = $data["select_department"];
        $collaborator->id_type = $data["select_type"];
        $collaborator->collaborator = $data["inp_collaborator"];
        $collaborator->cpf = $data["inp_cpf"];
        $collaborator->active = 1;

        if(!$collaborator->save()) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => $collaborator->fail()->getMessage()
            ]);
            return;
        }

        $collaborators = (new Collaborator())->find("id_department != 0")->fetch(true);
        echo $this->ajaxResponse("message", [
            "type" => "success",
            "message" => "{$data["inp_collaborator"]} cadastrado como um colaborador",
            "registerType" => $this->view->render("assets/fragments/department/registeredCollaborators", [
                "collaborators" => $collaborators
            ]),
        ]);
        return;
    }

    /**
     * @param array $data
     * @return void
     */
    public function reloadCollaborators (array $data): void
    {
        $collaborators = (new Collaborator())->find("id_department = :depart", "depart={$data["department"]}")->fetch(true);
        $callback["reload"] = $this->view->render("assets/fragments/department/registeredCollaborators",[
            "collaborators" => $collaborators
        ]);
        $callback["data"] = $collaborators;
        echo json_encode($callback);
    }

    /**
     * @param array $data
     * @return void
     */
    public function searchCollaborators (array $data): void
    {
        $collaborators = (new Collaborator())->search($data["search"]);
        $callback["data"] = $collaborators[0]->collaborator;
        $callback["response"] = $this->view->render("assets/fragments/department/table_searchCollaborator",[
            "collaborators" => $collaborators
        ]);
        echo json_encode($callback);
    }

    /**
     * @param array $data
     * @return void
     */
    public function modalCollaborator (array $data): void
    {
        $collaborator = ((new Collaborator())->findById($data["id"]));
        $pendencies = ((new Output())->find("id_collaborator LIKE {$collaborator->id}"))->fetch(true);
        $types = ((new CollaboratorType())->find()->fetch(true));
        $departments = ((new Department())->find()->fetch(true));
        $callback["modal"] = $this->view->render("assets/fragments/department/modalCollaborator", [
            "collaborator" => $collaborator,
            "pendencies" => $pendencies,
            "types" => $types,
            "departments" => $departments,
        ]);

        $callback["data"] = $data;
        echo json_encode($callback);
    }

    /**
     * @param array $data
     * @return void
     */
    public function changeDepartment (array $data): void
    {
        $collaborator = ((new Collaborator())->findById($data["collaborator"]));
        $collaborator->id_department = $data["newDepartment"];


        if (!$collaborator->save(false)) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "ERROR, tente de novo, se o erro persistir entre em contato"
            ]);
            return;
        }
        echo $this->ajaxResponse("message", [
            "type" => "info",
            "message" => "O departamento foi trocado para {$collaborator->department()}"
        ]);
    }

    /**
     * @param array $data
     * @return void
     */
    public function changeType (array $data): void
    {
        $collaborator = ((new Collaborator())->find("id = {$data["collaborator"]}")->fetch());
        $collaborator->id_type = $data["newType"];


        if (!$collaborator->save(false)) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "ERROR, tente de novo, se o erro persistir entre em contato"
            ]);
            return;
        }
        echo $this->ajaxResponse("message", [
            "type" => "info",
            "message" => "O collaborador agora ?? um {$collaborator->type()}"
        ]);
    }

    /**
     * @param array $data
     * @return void
     */
    public function changeSituation (array $data): void
    {
        $collaborator = ((new Collaborator())->findById($data["collaborator"]));
        $collaborator->active = (int)$data["newSituation"];

        if (!$collaborator->save(false)) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "ERROR, tente de novo, se o erro persistir entre em contato. [ {$collaborator->fail()->getMessage()} ]"
            ]);
            return;
        }
        $logmessage = ($collaborator->active) ? "ativo" : "desativado";
        echo $this->ajaxResponse("message", [
            "type" => "info",
            "message" => "Collaborador foi {$logmessage}"
        ]);
    }

    public function validateOutput (array $data): void
    {
        $output = ((new Output())->findById($data["outputID"]));
        $output->validate = ($data["check_validate"] == "true") ? "1" : "0";

        if(!$output->save()){
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "ERROR, tente de novo, se o erro persistir entre em contato"
            ]);
            return;
        }
        echo $this->ajaxResponse("message", [
            "type" => "info",
            "message" => "{$output->id} alterado {$data["check_validate"]}"
        ]);
    }
}