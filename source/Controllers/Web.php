<?php

namespace Source\Controllers;

use Source\Models\User;

class Web extends Controller
{
    public function __construct($router)
    {
        parent::__construct($router);

        if (!empty($_SESSION['user'])) {
            $this->router->redirect("painel.retirar");
        }
    }

    public function login(): void
    {
        $head = $this->seo->optimize(
            "Faça login | " . site('name'),
            site('desc'),
            $this->router->route('web.login'),
            routeImage("Login")
        )->render();
        $this->view->addData(['head'=>$head]);
        echo $this->view->render('theme/login/login');
    }


    /**
     * @return void
     */

    public function register(): void
    {
        $head = $this->seo->optimize(
            "Crie sua conta | " . site("name"),
            site("desc"),
            $this->router->route('web.register'),
            routeImage("Register"),
        )->render();

        $form_user = new \stdClass();
        $form_user->first_name = null;
        $form_user->last_name = null;
        $form_user->email = null;
        $form_user->user = null;

        $this->view->addData([
            'head' => $head,
            'user' => $form_user
        ]);
        echo $this->view->render("theme/login/register");
    }

    /**
     * @return void
     */
    public function forget(): void
    {
        $head = $this->seo->optimize(
            "Recupere sua senha | " . site("name"),
            site("desc"),
            $this->router->route('web.forget'),
            routeImage("Forget"),
        )->render();
        $this->view->addData(['head' => $head]);
        echo $this->view->render("theme/login/forget");
    }

    /**
     * @param $data
     * @return void
     */
    public function reset($data): void
    {
        if (empty($_SESSION["forget"])) {
            flash("info", "Informe seu E-MAIL para recuperar a senha");
            $this->router->redirect("web.forget");
        }

        $email = filter_var($data["email"], FILTER_VALIDATE_EMAIL);
        $forget = filter_var($data["forget"], FILTER_DEFAULT);
        if (!$email || !$forget) {
            flash("error", "Não foi possivel recuperar, tente novamente");
            $this->router->redirect("web.forget");
        }

        $user = (new User())->find("email = :e AND forget = :f", "e={$email}&f={$forget}")->fetch();
        if (!$user) {
            flash("error", "Não foi possivel recuperar, tente novamente");
            $this->router->redirect("web.forget");
        }

        $head = $this->seo->optimize(
            "Crie sua nova senha | " . site("name"),
            site("desc"),
            $this->router->route('web.reset'),
            routeImage("Reset"),
        )->render();
        $this->view->addData(['head' => $head]);
        echo $this->view->render("theme/login/reset");
    }
}