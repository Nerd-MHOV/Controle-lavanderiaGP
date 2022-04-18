<?php

namespace Source\Controllers;

use Source\Models\Collaborator;
use Source\Models\Department;
use Source\Models\Output;
use Source\Models\Product;
use Source\Models\User;
use CoffeeCode\DataLayer\DataLayer;
use Dompdf\Dompdf;
use Dompdf\Options;

class Withdraw extends Controller
{
    /**
     * @var User|DataLayer|null
     */
    protected User $user;

    /**
     * @param $router
     */
    public function __construct($router)
    {
        parent::__construct($router);

        if(empty($_SESSION["user"]) || !$this->user = (new User())->findById($_SESSION["user"])) {
            unset($_SESSION["user"]);

            flash("error", "Acesso negado. Favor logue-se");
            $this->router->redirect("web.login");
        }

    }

    public function document (array $data): void
    {
        $outputs = (new Output())->find("id_collaborator = :idc", "idc={$data["id"]}")->fetch(true);
        $collaborator = (new Collaborator())->findById($data["id"]);
        $user = (new User())->findById($_SESSION["user"]);
        $options = new Options();
        $options->setChroot(__DIR__);
        $options->setIsRemoteEnabled(true);
        $dompdf = new Dompdf($options);

        ob_start();
        echo $this->view->render("assets/fragments/document",[
            "outputs" => $outputs,
            "collaborator" => $collaborator,
            "issuer" => "{$user->first_name} {$user->last_name}"
        ]);
        $dompdf->loadHtml(ob_get_clean());
        $dompdf->setPaper('A4');

        $dompdf->render();
        $filename = "TERMO-DE-RESPONSABILIDADE.pdf";
        $options = ["Attachment" => 0];
        $dompdf->stream($filename, $options);


    }

}