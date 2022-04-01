<?php
date_default_timezone_set('America/Sao_Paulo');

if ($_SERVER["SERVER_NAME"] == "localhost") {
    require __DIR__ . "/Minify.php";
    require __DIR__ . "/MinifyDashbord.php";

    define("SITE", [
        "name" => "controle_lavanderia",
        "desc" => "Controle de saida e entrada da lavanderia Grupo Peraltas",
        "domain" => "NULL",
        "locale" => "pt-BR",
        "root" => "http://localhost/controle_lavanderia4.0"
    ]);
} else {
    define("SITE", [
        "name" => "controle_lavanderia",
        "desc" => "Controle de saida e entrada da lavanderia Grupo Peraltas",
        "domain" => "NULL",
        "locale" => "pt-BR",
        "root" => "http://192.168.10.87/controle_lavanderia4.0"
    ]);
}

const DATA_LAYER_CONFIG = [
    "driver" => "mysql",
    "host" => "localhost",
    "port" => "3306",
    "dbname" => "lavanderia",
    "username" => "root",
    "passwd" => "",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
];

const MAIL = [
    "host" => "smtp.sendgrid.net",
    "port" => "587",
    "user" => "apikey",
    "passwd" => "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",
    "from_name" => "MatheusHenrique",
    "from_email" => "matheus.henrique4245@gmail.com"
];