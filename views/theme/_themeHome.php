<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?= $head; ?>
    <link rel="stylesheet" href="<?= asset("/style.min.css"); ?>"/>
    <link rel="icon" type="image/png" href="<?= asset("/images/favicon.ico"); ?>"/>
</head>
<body>

<div class="ajax_load">
    <div class="ajax_load_box">
        <div class="ajax_load_box_circle"></div>
        <div class="ajax_load_box_title">Aguarde, carrengando...</div>
    </div>
</div>

<div class="container">
    <div class="navigation">
        <ul>
            <li>
                <a href="#">
                    <span class="icon"><i class='bx bxs-cube-alt'></i></span>
                    <span class="title" style="font-size: 22px">SysEscolas</span>
                </a>
            </li>
            <li <?php if(str_contains(@$_GET['url'], 'home') || @$_GET['url'] == ''){ echo 'class="hovered"';}?> />
            <a href="">
                <span class="icon"><i class='bx bx-home-alt-2' ></i></span>
                <span class="title">Home</span>
            </a>
            </li>

            <li <?php if(str_contains(@$_GET['url'], 'escolas')){ echo 'class="hovered"';}?> />
            <a href="">
                <span class="icon"><i class='bx bxs-graduation' ></i></span>
                <span class="title">Escolas</span>
            </a>
            </li>
            <li <?php if(str_contains(@$_GET['url'], 'eventos')){ echo 'class="hovered"';}?>>
                <a href="">
                    <span class="icon"><i class='bx bx-calendar-event' ></i></span>
                    <span class="title">Eventos</span>
                </a>
            </li>

            <li>
                <a href="?singout=true">
                    <span class="icon"><i class='bx bx-log-out' ></i></span>
                    <span class="title">Sing Out</span>
                </a>
            </li>
        </ul>
    </div>
</div>

<!--  main  -->
<div class="main">
    <div class="topbar">
        <div class="toggle">
            <i class='bx bx-menu' ></i>
            <!--            <ion-icon name="menu-outline"></ion-icon>-->
        </div>
        <!-- search -->
        <div class="search">
            <label>
                <input type="text" placeholder="Search here">
                <i class='bx bx-search' ></i>
            </label>
        </div>
        <!-- userImg -->
        <div class="user">
            <img src="<?=asset("image/perfil.jpg")?>" />
        </div>
    </div>

<main class="main_content">
    <?= $this->section("content"); ?>
</main>

</div>

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script>
    // MenuToggle
    let toggle = document.querySelector('.toggle');
    let navigation = document.querySelector('.navigation');
    let main = document.querySelector('.main');

    toggle.onclick = function (){
        navigation.classList.toggle('active');
        main.classList.toggle('active');
    }


    // add hovered class in selected list item
    let list = document.querySelectorAll('.navigation li');
    function activeLink(){
        list.forEach((item) =>
            item.classList.remove('hovered'));
        this.classList.add('hovered');
    }
    list.forEach((item) =>
        item.addEventListener('click', activeLink))
</script>
<script src="<?= asset("/scripts.mim.js"); ?>"></script>
<?= $this->section("scripts"); ?>

</body>
</html>


