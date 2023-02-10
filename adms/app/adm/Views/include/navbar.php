<?php
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); } ?>
<!-- Início do NavBar -->
<nav class="navbar sticky-top">
    <div class="navbar_content">
        <div class="bars">
            <i class="fa-solid fa-bars"></i>
        </div>
        <a href="<?= URLADM; ?>">
            <img class="logo" src="<?= URLADM; ?>app/adm/assets/imgs/Logo-Dtudo_102x40.png" alt="Logo Dtudo"></a>
    </div>
    <div class="navbar_content">
        <div class="notification">
            <i class="fa-solid fa-bell"></i>
            <span class="number">2</span>
            <div class="dropdown_menu">
                <div class="dropdown_content">
                    <li>
                        <?php
                        if ((!empty($_SESSION['adm_img'])) and (file_exists("app/adm/assets/imgs/users/" . $_SESSION['id_adm_user'] . "/" . $_SESSION['adm_img']))) {
                            echo "<img src=" . URLADM . 'app/adm/assets/imgs/users/' . $_SESSION['id_adm_user'] . '/' . $_SESSION['adm_img'] . " width='50px' height='50px'>";
                        } else {
                            echo "<img src='" . URLADM . "app/adm/assets/imgs/Logo-Dtudo_102x40.png' width='50px'>";
                        } ?>
                        <!-- <img src="imgs/TI_link.png" alt="foto do usuário"></i> -->
                        <div class="msg_text">Aqui vai aparecer as menssagens de notificações do usuario</div>
                    </li>
                    <li><img src="imgs/TI_link.png" alt="foto do usuário"></i>
                        <div class="msg_text">A Segunda menssagens vai aparecer aqui nas notificações do usuario</div>
                    </li>
                </div>
            </div>
        </div>
        <div class="avatar">
            <?php
            if ((!empty($_SESSION['adm_img'])) and (file_exists("app/adm/assets/imgs/users/" . $_SESSION['id_adm_user'] . "/" . $_SESSION['adm_img']))) {
                echo "<img src=" . URLADM . 'app/adm/assets/imgs/users/' . $_SESSION['id_adm_user'] . '/' . $_SESSION['adm_img'] . " width='50px' height='50px'>";
            } else {
                echo "<img src='" . URLADM . "app/adm/assets/imgs/Logo-Dtudo_102x40.png' width='50px'>";
            }
            ?>
            <!-- <img src="imgs/TI_link.png" alt="foto do usuário" width=""> -->
            <div class="dropdown_menu setting">
                <div class="item">
                    <a class="" href="<?= URLADM ?>view-profile/index">
                        <i class="fa-solid fa-circle-user"></i> Perfil</a>
                </div>
                <div class="item">
                    <a class="" href="<?= URLADM ?>edit-profile/index">
                        <i class="fa-solid fa-gear"></i> Configurações</a>
                </div>
                <div class="item">
                    <a class="" href="<?= URLADM ?>logout/index">
                        <i class="fa-solid fa-right-from-bracket"></i> Sair</a>
                </div>
            </div>
        </div>
    </div>
</nav>
<div class="div_corpo_pg"><!-- INÍCIO da DIV ROW do corpo da pagina -->