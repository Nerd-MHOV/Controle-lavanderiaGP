<?php

/**
 *  CSS
 */
$minCSS = new \MatthiasMullie\Minify\CSS();
$minCSS->add(dirname(__DIR__,1)."/views/assets/css/sidebarDashbord.css");
$minCSS->add(dirname(__DIR__,1)."/views/assets/css/button.css");
$minCSS->add(dirname(__DIR__,1)."/views/assets/css/message.css");
$minCSS->add(dirname(__DIR__,1)."/views/assets/css/load.css");
$minCSS->add(dirname(__DIR__,1)."/views/assets/css/modal.css");
$minCSS->add(dirname(__DIR__,1)."/views/assets/css/painel.css");
$minCSS->add(dirname(__DIR__,1)."/views/assets/css/form.css");
$minCSS->add(dirname(__DIR__,1)."/views/assets/css/select2.min.css");
$minCSS->minify(dirname(__DIR__,1)."/views/assets/styleDashbord.min.css");


/**
 *  JS
 */
$minJS = new \MatthiasMullie\Minify\JS();
$minJS->add(dirname(__DIR__,1)."/views/assets/js/jquery.js");
$minJS->add(dirname(__DIR__,1)."/views/assets/js/jquery-ui.js");
$minJS->add(dirname(__DIR__,1)."/views/assets/js/jquery.mask.js");
$minJS->add(dirname(__DIR__,1)."/views/assets/js/jquery.maskMoney.js");

$minJS->add(dirname(__DIR__,1)."/views/assets/js/form.js");
$minJS->add(dirname(__DIR__,1)."/views/assets/js/mainMasks.js");
$minJS->add(dirname(__DIR__,1)."/views/assets/js/sidebar.js");
$minJS->add(dirname(__DIR__,1)."/views/assets/js/select2.min.js");
$minJS->minify(dirname(__DIR__,1)."/views/assets/scriptsDashbord.mim.js");
