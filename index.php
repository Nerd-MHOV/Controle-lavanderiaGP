<?php
ob_start();
session_start();
require __DIR__ . '/vendor/autoload.php';

use CoffeeCode\Router\Router;
use Source\Controllers\Web;

$router = new Router(site());
$router->namespace("Source\Controllers");


/**
 * login WEB
 */
$router->group(null);
$router->get("/", "Web:login", "web.login");
$router->get("/cadastrar", "Web:register", "web.register");
$router->get("/recuperar", "Web:forget", "web.forget");
$router->get("/senha/{email}/{forget}", "Web:reset", "web.reset");

/**
 * login AUTH
 */
$router->group(null);
$router->post("/login", "Auth:login", "auth.login");
$router->post("/register", "Auth:register", "auth.register");
$router->post("/forget", "Auth:forget", "auth.forget");
$router->post("/reset", "Auth:reset", "auth.reset");

/**
 *  home PAINEL
 */
$router->group('painel');
$router->get("/home", "Painel:home", "painel.home");
$router->get("/retirar", "Painel:retirar", "painel.retirar");
$router->get("/devolver", "Painel:devolver", "painel.devolver");
$router->get("/produto", "Painel:produto", "painel.produto");
$router->get("/departamento", "Painel:departamento", "painel.departamento");
$router->get("/relatorio", "Painel:relatorio", "painel.relatorio");
$router->get("/estoque", "Painel:estoque", "painel.estoque");
$router->get("/sair", "Painel:logoff", "painel.logoff");


/**
 *  retirar RESPONSE
 */
$router->group('retirar');
$router->post("/colaborador", "Response:collaborator", "response.colaborador");
$router->post("/produtos", "Response:products", "response.produtos");
$router->post("/produtos/tipo", "Response:productType", "response.typeproducts");
$router->post("/produtos/oficio", "Response:productService", "response.product_service");
$router->post("/produtos/enviar", "Response:productSend", "response.product_send");
$router->post("/retirada", "Response:withdrawal", "response.withdrawal");
$router->get("/documento/{id}", "Withdraw:document", "withdraw.document");


/**
 *  devolver RESPONSE
 */
$router->group('devolver');
$router->post("/colaborador", "Response:returnCollaborator", "response.return_collaborator");
$router->post("/setor", "Response:returnDepartment", "response.return_department");
$router->post("/finalizar", "Response:returnProduct", "response.return_product");

/**
 *  produto WEB PRODUCT
 */
$router->group('produto');
$router->get("/novo-tipo", "WebProduct:newType", "web-product.new-type");
$router->post("/novo-tipo", "WebProduct:registerType", "web-product.register-type");
$router->get("/novo-oficio", "WebProduct:newService", "web-product.new-service");
$router->post("/novo-oficio", "WebProduct:registerService", "web-product.register-service");
$router->get("/novo-produto", "WebProduct:newProduct", "web-product.new-product");
$router->post("/novo-produto", "WebProduct:registerProduct", "web-product.register-product");
$router->post("/recarregar-produtos", "WebProduct:reloadProducts", "web-product.reload-products");

/**
 *  departamento WEB DEPARTMENT
 */
$router->group('departamento');
$router->get("/novo-departamento", "WebDepartment:newDepartment", "web-department.new-department");
$router->post("/novo-departamento", "WebDepartment:registerDepartment", "web-department.register-department");
$router->get("/novo-colaborador", "WebDepartment:newCollaborator", "web-department.new-collaborator");
$router->post("/novo-colaborador", "WebDepartment:registerCollaborator", "web-department.register-collaborator");
$router->post("/recarregar-colaborador", "WebDepartment:reloadCollaborators", "web-department.reload-collaborators");

/**
 * estoque WEB Iventory
 */
$router->group('estoque');
$router->post("/pesquisar", "WebIventory:searchIventory", "web-iventory.search-iventory");

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