<?php

/**
 *  CSS
 */
$minCSS = new \MatthiasMullie\Minify\CSS();
$minCSS->add(dirname(__DIR__,1)."/views/assets/css/sidebarDashbord.css");
$minCSS->add(dirname(__DIR__,1)."/views/assets/css/painel.css");
$minCSS->add(dirname(__DIR__,1)."/views/assets/css/form.css");
$minCSS->add(dirname(__DIR__,1)."/views/assets/css/button.css");
$minCSS->add(dirname(__DIR__,1)."/views/assets/css/message.css");
$minCSS->add(dirname(__DIR__,1)."/views/assets/css/load.css");
$minCSS->minify(dirname(__DIR__,1)."/views/assets/styleDashbord.min.css");


/**
 *  JS
 */
$minJS = new \MatthiasMullie\Minify\JS();
$minJS->add(dirname(__DIR__,1)."/views/assets/js/jquery.js");
$minJS->add(dirname(__DIR__,1)."/views/assets/js/jquery-ui.js");
$minJS->add(dirname(__DIR__,1)."/views/assets/js/sidebar.js");
$minJS->minify(dirname(__DIR__,1)."/views/assets/scriptsDashbord.mim.js");
