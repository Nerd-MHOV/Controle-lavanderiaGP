<?php

namespace Source\Controllers;

use Source\Models\Collaborator;
use Source\Models\Department;
use Source\Models\Output;
use Source\Models\User;
use CoffeeCode\DataLayer\DataLayer;

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

        if(empty($_SESSION["user"]) || !$this->user = (new User())->findById($_SESSION["user"])) {
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

    public function produto(): void
    {
        $head = $this->seo->optimize(
            "Produtos | " . site("name"),
            site("desc"),
            $this->router->route('painel.produto'),
            routeImage("Produtos - Painel"),
        )->render();
        $this->view->addData(['head' => $head]);
        echo $this->view->render("theme/pages/painel_produto");
    }

    public function departamento(): void
    {
        $head = $this->seo->optimize(
            "Departamentos | " . site("name"),
            site("desc"),
            $this->router->route('painel.departamento'),
            routeImage("Departamento - Painel")
        )->render();
        $this->view->addData(['head'=>$head]);
        echo $this->view->render("theme/pages/painel_departamento");
    }

    public function estoque(): void
    {
        $head = $this->seo->optimize(
          "Estoque | " . site("name"),
          site("desc"),
          $this->router->route('painel.estoque'),
          routeImage("Estoque itens")
        )->render();
        $this->view->addData(['head'=>$head]);
        echo $this->view->render("theme/pages/painel_estoque");
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