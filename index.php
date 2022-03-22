<?php
ob_start();
session_start();
require __DIR__.'/vendor/autoload.php';
use Source\Support\Painel;
use CoffeeCode\Router\Router;
use Source\Controllers\Web;

$router = new Router(site());
$router->namespace("Source\Controllers");

/**
* login WEB
*/
$router->group(null);
$router->get("/","Web:login", "web.login");
$router->get("/cadastrar","Web:register","web.register");
$router->get("/recuperar","Web:forget","web.forget");
$router->get("/senha/{email}/{forget}","Web:reset","web.reset");

/**
 * login WEB
 */
$router->group(null);
$router->post("/login", "Auth:login", "auth.login");
$router->post("/register", "Auth:register", "auth.register");
$router->post("/forget", "Auth:forget", "auth.forget");
$router->post("/reset", "Auth:reset", "auth.reset");

/**
 *  home DASHBORD
 */
$router->group('/painel');
$router->get("/home","Painel:home", "painel.home");
$router->get("/retirar","Painel:retirar", "painel.retirar");
$router->get("/produto","Painel:produto", "painel.produto");
$router->get("/departamento","Painel:departamento", "painel.departamento");
$router->get("/relatorio","Painel:relatorio", "painel.relatorio");
$router->get("/estoque","Painel:estoque", "painel.estoque");
$router->get("/sair","Painel:logoff", "painel.logoff");



/**
 * ERRORS
 */
$router->group('ops');
$router->get('/{errcode}', "Web:error", "web.error");

/**
 * ROUTE PROCESS
 */
$router->dispatch();

if ($router->error()) {
    $router->redirect("/ops/{$router->error()}");
}

ob_end_flush();

/*
if(Painel::logado() == false){
    include('pages/login.php');
    die();
}
*/