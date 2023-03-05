<?php
if (!defined('$2y!10#OaHjLtR20hiD23TKNv(0$2)TkYur)$23$(zF')) {
    header("Location: https://localhost/animes/");
} ?>
<!-- NAVBAR, barra de navegação do topo da página -->
<nav class="navbar sticky-top container-fluid">
    <div class="col-2 text-center">
        <a href="<?= URL; ?>">
            <img class="logo" src="<?= URL; ?>app/animes/assets/imgs/Logo-Dtudo_102x40.png" alt="Logo Dtudo"></a>
    </div>
    <!--------------- DIV - PRINCIPAL DO BLOCO DE MENU collapse ------------->
    <div class="col-10 d-flex justify-content-evenly">
        <!--BLOCO PARA ACESSO RAPIDO DE INSERÇÃO E EXCLUSÃO-->
        <div class="nav-item">
            <a class="nav-link" href="animacao.php">Animes</a>
        </div>
        <div class="nav-item">
            <a class="nav-link" href="series.php">Séries</a>
        </div>
        <div class="nav-item">
            <a class="nav-link" href="filmes.php">Filmes</a>
        </div>
        <div class="nav-item">
            <a class="nav-link" href="ovas.php">Ovas</a>
        </div>
        <div class="nav-item">
            <a class="nav-link" href="especiais.php">Especiais</a>
        </div>
        <!-- Menu do botão dropdown ANIMES - Filmes - Ecchi BOTÃO DROPDOWN ----- -->
        <div class="nav-item dropdown">
            <a class="dropdown-toggle nav-link" role="button" data-bs-toggle="dropdown">Gêneros</a>
            <ul class="dropdown-menu dropdown-menu-dark">
                <li><a class="dropdown-item nav-link" href="#" target="_blank">Ação</a></li>
                <li><a class="dropdown-item nav-link" href="#" target="_blank">Aventura</a></li>
                <li><a class="dropdown-item nav-link" href="#" target="_blank">Ficção</a></li>
                <li><a class="dropdown-item nav-link" href="#" target="_blank">etc</a></li>
            </ul>
        </div>
        <div class="dropdown">
                <a class="dropdown-toggle nav-link" role="button" data-bs-toggle="dropdown" alt="Link para Login" title="Link para Login">
        <div class="d-inline"><img class="ms-2" src="<?=URL;?>app/animes/assets/imgs/login.png">
        </div>
        <div class="d-inline fonte_small"><span>Login</span></div></a>
                <ul class="dropdown-menu dropdown-menu-dark fonte_small" aria-labelledby="dropdownMenuButton2">
                    <li><a class="dropdown-item nav-link" href="" data-bs-toggle="modal" data-bs-target="#Modal_login">Fazer Login</a></li>
                    <li><a class="dropdown-item nav-link" href="" data-bs-toggle="modal" data-bs-target="#Modal_cadastrar">Cadastrar</a></li>
                    <li><a class="dropdown-item nav-link" href="" data-bs-toggle="modal" data-bs-target="#Modal_recuperarSenha">Recuperar Senha</a></li>
                </ul>
        </div>
    </div>
</nav>
<!-- Inicio do corpo principal do site (final está no rodapé) -->
<!-- <div class="corpo_pg"> -->