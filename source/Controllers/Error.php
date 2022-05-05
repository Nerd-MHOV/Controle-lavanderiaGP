<?php

namespace Source\Controllers;

class Error extends Controller
{
    public function __construct($router)
    {
        parent::__construct($router);
    }

    /**
     * @param $data
     * @return void
     */
    public function error($data): void
    {
        $error = filter_var($data["errcode"], FILTER_VALIDATE_INT);
        $head = $this->seo->optimize(
            "Ooops {$error} | " . site("name"),
            site("desc"),
            $this->router->route('error.error', ["errcode" => $error]),
            routeImage($error),
        )->render();
        $this->view->addData([
            'head' => $head,
            'error' => $error
        ]);
        echo $this->view->render("theme/error");

    }
}