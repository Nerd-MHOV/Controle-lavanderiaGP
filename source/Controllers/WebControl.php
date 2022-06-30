<?php

namespace Source\Controllers;

use Source\Models\Collaborator;
use Source\Models\Output;
use Source\Models\OutputLog;
use Source\Models\ProductType;
use Source\Models\Returns;
use Source\Models\User;

class WebControl extends Controller
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

    public function tableOutputs(array $data): void
    {
        // RESET PATTERN
        $callback["response"] = $this->view->render("assets/fragments/control/recentReturns",[
            'recents' => ((new Returns())
                ->find()
                ->limit(20)
                ->order("created_at DESC")
                ->fetch(true)),
        ]);
        $query = "";
        $date_in = (isset($data["date_in"])) ? $data["date_in"] : date("Y-m-d");
        $date_out = (isset($data["date_out"])) ? $data["date_out"] : date("Y-m-d");
        $filterCollaborator = (isset($data["filterCollaborator"]))
            ? (($data["filterCollaborator"] == "department")
                ? " AND id_collaborator LIKE 0 "
                : (($data["filterCollaborator"] == "collaborator")
                    ? " AND id_collaborator != 0 "
                    : ""))
            : "";

        // RETIRADAS HOJE
        if($data["reference"] == "Retiradas Hoje") {

            $query = "
                created_at > '{$date_in} 00:00:01' 
                AND created_at < '{$date_out} 23:59:59'
                $filterCollaborator
            ";
            $callback["response"] = $this->view->render("assets/fragments/control/outputs", [
                'recents' => ((new OutputLog())
                    ->find($query)
                    ->fetch(true)),
                'date_in' => $date_in,
                'date_out' => $date_out,
                'filterCollaborator' => $filterCollaborator,
                'reference' => $data["reference"],
            ]);

        }

        // DEVOLVIDOS HOJE
        if($data["reference"] == "Devolvidos Hoje") {

            $query = "
                date_out > '{$date_in} 00:00:01' 
                AND date_out < '{$date_out} 23:59:59'
                $filterCollaborator
            ";
            $callback["response"] = $this->view->render("assets/fragments/control/returns", [
                'recents' => ((new Returns())
                    ->find($query)
                    ->fetch(true)),
                'date_in' => $date_in,
                'date_out' => $date_out,
                'filterCollaborator' => $filterCollaborator,
                'reference' => $data["reference"],
            ]);

        }

        // PENDENCIAS
        if($data["reference"] == "Pendencias" || $data["reference"] == "Pendencias Vencidas") {

            $dueDate = date('Y-m-d H:i:s', strtotime('-3 days'));

            $filterDue = ($data["reference"] == "Pendencias Vencidas") ? " AND created_at < '{$dueDate}' AND validate != 1" : "";

            $query = "
                1 = 1 
                $filterCollaborator
                $filterDue
            ";
            $callback["response"] = $this->view->render("assets/fragments/control/pendencies", [
                'recents' => ((new Output())
                    ->find($query)
                    ->fetch(true)),
                'date_in' => $date_in,
                'date_out' => $date_out,
                'filterCollaborator' => $filterCollaborator,
                'reference' => $data["reference"],
            ]);

        }

        $callback["data"] = $data;
        echo json_encode($callback);
    }

}