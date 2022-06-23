<?php

namespace Source\Controllers;

use Source\Models\Collaborator;
use Source\Models\Department;
use Source\Models\Output;
use Source\Models\OutputLog;
use Source\Models\Product;
use Source\Models\Returns;
use Source\Models\User;
use CoffeeCode\DataLayer\DataLayer;
use Source\Controllers\Controller;


/**
 *
 */
class Painel extends Controller
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
        if (empty($_SESSION["user"]) || !is_int($_SESSION["user"]) || !$this->user = (new User())->findById($_SESSION["user"])) {

            unset($_SESSION["user"]);

            flash("error", "Acesso negado. Favor logue-se");
            $this->router->redirect("web.login");
        }

    }

    /**
     * @return void
     */
    public function home(): void
    {
        $head = $this->seo->optimize(
            "Home {$this->user->first_name} | " . site("name"),
            site("desc"),
            $this->router->route('painel.home'),
            routeImage("HOME PAINEL"),
        )->render();
        $this->view->addData(['head' => $head]);
        echo $this->view->render("theme/pages/painel_home");
    }

    /**
     * @return void
     */
    public function retirar(): void
    {
        $head = $this->seo->optimize(
            "Retirada | " . site("name"),
            site("desc"),
            $this->router->route('painel.retirar'),
            routeImage("Retirar"),
        )->render();
        $departments = (new Department())->find()->fetch(true);
        $this->view->addData([
            'head' => $head,
            'departments' => $departments
        ]);
        echo $this->view->render("theme/pages/painel_retirar");
    }

    /**
     * @return void
     */
    public function devolver(): void
    {
        $head = $this->seo->optimize(
            "Devolver | " . site("name"),
            site("desc"),
            $this->router->route('painel.devolver'),
            routeImage("Devolver"),
        )->render();
        $pendingCollaborator = (new Output())->find("id_collaborator != 0")->fetch(true);
        $pendingDepartment = (new Output())->find("id_collaborator = 0")->fetch(true);
        $this->view->addData([
            'head' => $head,
            "pendingCollaborator" => $pendingCollaborator,
            "pendingDepartment" => $pendingDepartment
        ]);
        echo $this->view->render("theme/pages/painel_devolver");
    }

    /**
     * @return void
     */
    public function produto(): void
    {
        if (($this->user->level) < 3) {
            $this->router->redirect("error.error",[
                "errcode" => "401"
            ]);
        }
        $head = $this->seo->optimize(
            "Produtos | " . site("name"),
            site("desc"),
            $this->router->route('painel.produto'),
            routeImage("Produtos - Painel"),
        )->render();
        $products = (new Product())->find()->fetch(true);
        $this->view->addData(['head' => $head, 'products' => $products]);
        echo $this->view->render("theme/pages/painel_produto");
    }

    /**
     * @return void
     */
    public function departamento(): void
    {
        if ($this->user->level < 1) {
            $this->router->redirect("error.error",[
                "errcode" => "401"
            ]);
        }
        $head = $this->seo->optimize(
            "Departamentos | " . site("name"),
            site("desc"),
            $this->router->route('painel.departamento'),
            routeImage("Departamento - Painel")
        )->render();
        $departments = (new Department())->find()->fetch(true);
        $collaborators = (new Collaborator())->find("id_department != 0")->fetch(true);
        $this->view->addData(['head' => $head, 'departments' => $departments, 'collaborators' => $collaborators]);
        echo $this->view->render("theme/pages/painel_departamento");
    }

    public function danificados(): void
    {
        if (($this->user->level) < 4) {
            $this->router->redirect("error.error",[
                "errcode" => "401"
            ]);
        }
        $head = $this->seo->optimize(
            "Danificados | " . site("name"),
            site("desc"),
            $this->router->route("painel.danificados"),
            routeImage("Danificados - Painel")
        )->render();
        $damagedCollaborators = (new Returns())->find("id_collaborator != 0 AND status_in = 'bom' AND status_out = 'ruim'")->fetch(true);
        $damagedDepartments = (new Returns())->find("id_collaborator = 0 AND status_in = 'bom' AND status_out = 'ruim'")->fetch(true);
        $this->view->addData([
            'head' => $head,
            "damagedCollaborators" => $damagedCollaborators,
            "damagedDepartments" => $damagedDepartments
        ]);
        echo $this->view->render("theme/pages/painel_danificados");
    }

    /**
     * @return void
     */
    public function estoque(): void
    {
        $head = $this->seo->optimize(
            "Estoque | " . site("name"),
            site("desc"),
            $this->router->route('painel.estoque'),
            routeImage("Estoque itens")
        )->render();
        $products = (new Product())->find()->fetch(true);
        $this->view->addData(['head' => $head, 'products' => $products]);
        echo $this->view->render("theme/pages/painel_estoque");
    }

    public function controle(): void
    {
        if (($this->user->level) < 1) {
            $this->router->redirect("error.error",[
                "errcode" => "401"
            ]);
        }
        $head = $this->seo->optimize(
            "Controle | " . site("name"),
            site("desc"),
            $this->router->route("painel.controle"),
            routeImage("Controle - Painel")
        )->render();
        $today = date("Y-m-d");
        $due = date('Y-m-d H:i:s', strtotime('-3 days'));

        $this->view->addData([
            'head' => $head,
            'outputToday' => ((new OutputLog())->find("updated_at LIKE '%{$today}%'")->count()),
            'returnToday' => ((new Returns())->find("updated_at LIKE '%{$today}%'")->count()),
            'pendencies' => ((new Output())->find()->count()),
            'duePendencies' => ((new Output())->find("updated_at < '{$due}'")->count()),
            'recents' => ((new Returns())->find()->limit(20)->order("updated_at DESC")->fetch(true)),
        ]);
        echo $this->view->render("theme/pages/painel_controle");
    }

    /**
     * @return void
     */
    public function logoff(): void
    {
        unset($_SESSION["user"]);

        flash("info", "Você saiu com sucesso, volte logo {$this->user->first_name}");
        $this->router->redirect("web.login");
    }


}