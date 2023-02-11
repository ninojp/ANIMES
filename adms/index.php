<?php
session_start(); // Iniciar a sessão
ob_start(); // Buffer de saida

//Constante que define que o usuário está acessando páginas internas através da página "index.php".
define('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF', true);

//Carregar o autoload do Composer
require '../vendor/autoload.php';

//Instanciar a classe ConfigController, responsável em tratar a URL
$url = new AdmsSrc\ConfigControllerAdm();
//Instanciar o método para carregar a página/controller
$url->loadPage();
?>
<!-- <h1>Página INDEX, da parte administrativa do site!</h1> -->
