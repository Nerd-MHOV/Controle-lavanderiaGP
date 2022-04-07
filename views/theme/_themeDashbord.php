<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?= $head; ?>
    <link rel="stylesheet" href="<?= asset("/css/sidebarDashbord.css"); ?>">
    <link rel="stylesheet" href="<?= asset("/styleDashbord.min.css"); ?>"/>
    <link rel="icon" type="image/png" href="<?= asset("/images/favicon.ico"); ?>"/>
</head>
<body>

<!--Animação AJAX CARRGAMENTO-->
<div class="ajax_load">
    <div class="ajax_load_box">
        <div class="ajax_load_box_circle"></div>
        <div class="ajax_load_box_title">Aguarde, carrengando...</div>
    </div>
</div>

<!--SIDEBAR E SIDETOP-->
<div class="container">
    <div class="navigation">
        <ul>
            <li>
                <a href="#">
                    <span class="icon logo_peraltas">
                        <img src="<?= asset("images/GP.png") ?>" alt="logo"/>
                    </span>
                    <span class="title" style="font-size: 22px">Controle Lavanderia</span>
                </a>
            </li>

            <li <?= (str_contains($_GET["route"], "home")) ? "class=\"hovered\"" : ""; ?>>
                <a href="<?= $router->route("painel.home") ?>">
                    <span class="icon"><i class='bx bxs-home'></i></span>
                    <span class="title">Home</span>
                </a>
            </li>
            <li <?= (str_contains($_GET["route"], "retirar")) ? "class=\"hovered\"" : ""; ?>>
                <a href="<?= $router->route("painel.retirar") ?>">
                    <span class="icon"><i class='bx bxs-shopping-bags'></i></span>
                    <span class="title">Retirar</span>
                </a>
            </li>
            <li <?= (str_contains($_GET["route"], "devolver")) ? "class=\"hovered\"" : ""; ?>>
                <a href="<?= $router->route("painel.devolver") ?>">
                    <span class="icon"><i class='bx bx-task'></i></span>
                    <span class="title">Devolver</span>
                </a>
            </li>
            <li <?= (str_contains($_GET["route"], "produto")) ? "class=\"hovered\"" : ""; ?>>
                <a href="<?= $router->route("painel.produto") ?>">
                    <span class="icon"><i class='bx bx-list-plus'></i></span>
                    <span class="title">Produto</span>
                </a>
            </li>
            <li <?= (str_contains($_GET["route"], "departamento")) ? "class=\"hovered\"" : ""; ?>>
                <a href="<?= $router->route("painel.departamento") ?>">
                    <span class="icon"><i class='bx bx-hard-hat'></i></span>
                    <span class="title">Departamento</span>
                </a>
            </li>
            <li <?= (str_contains($_GET["route"], "relatorios")) ? "class=\"hovered\"" : ""; ?>>
                <a href="<?= $router->route("painel.relatorio") ?>">
                    <span class="icon"><i class='bx bxs-pie-chart-alt-2'></i></span>
                    <span class="title">Relatórios</span>
                </a>
            </li>
            <li <?= (str_contains($_GET["route"], "estoque")) ? "class=\"hovered\"" : ""; ?>>
                <a href="<?= $router->route("painel.estoque") ?>">
                    <span class="icon"><i class='bx bxs-package'></i></span>
                    <span class="title">Estoque</span>
                </a>
            </li>

            <li>
                <a href="<?= $router->route("painel.logoff"); ?>">
                    <span class="icon"><i class='bx bx-log-out'></i></span>
                    <span class="title">Sair</span>
                </a>
            </li>
        </ul>
    </div>
</div>

<!--  main  -->
<div class="main">
    <div class="topbar">
        <div class="toggle">
            <i class='bx bx-menu'></i>
            <!-- <ion-icon name="menu-outline"></ion-icon> -->
        </div>
        <!-- search -->
        <div class="search">
            <label>
                <input type="text" placeholder="Search here">
                <i class='bx bx-search'></i>
                <!--<img style="width: 100%; max-width:200px" src="<?=asset("images/GrupoperaltasCompleto.png")?>" alt="LogoCompleta">-->
            </label>
        </div>
        <!-- userImg -->
        <div class="user">
            <!--<img src="<?= asset("images/perfil.jpg") ?>"/>-->
        </div>
    </div>


    <main class="main_content">
        <?= $this->section("content"); ?>
    </main>


</div>

<script src="<?= asset("/scriptsDashbord.mim.js"); ?>"></script>
<?= $this->section("scripts"); ?>
</body>
</html>

