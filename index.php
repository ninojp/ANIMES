<?php
session_start(); // Iniciar a sessão
ob_start(); // Buffer de saida

//Constante que define que o usuário está acessando páginas internas através da página "index.php".
define('$2y!10#OaHjLtR20hiD23TKNv(0$2)TkYur)$23$(zF', true);

//Carregar o autoload do Composer
require './vendor/autoload.php';

//Instanciar a classe ConfigController, responsável em tratar a URL
$url = new Src\ConfigController();
//Instanciar o método para carregar a página/controller
$url->loadPage();

?>
<h1>Index! Começando uma nova jornada 01/02/2023</h1>