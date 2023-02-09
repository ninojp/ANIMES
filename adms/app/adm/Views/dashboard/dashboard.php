<?php
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
echo "Views/dashboard/dashboard.php<h1>Pagina(view) Dashboard</h1>";
echo "Bem Vindo ".$_SESSION['adm_user']."!<br>";
//realiza o logout, url raiz:URLADM + nome da classe:Logout + nome do método:index
// echo "<a href='".URLADM."logout/index'>Sair</a><br>";
?>
<!-- Inicio do conteudo do ADM -->
<!-- <div class="container-adms"> -->

<div class="wrapper_list">
    <div class="row_list">
        <div class="box box_first">
            <span class="class=icon fa-solid fa-users"></span>
            <span>
                <?php
                    if(!empty($this->data['countUsers'])){
                        echo $this->data['countUsers'][0]['qntUsers'];
                    };  ?>
            </span>
            <span>Usuários Cadastrados</span>
        </div>
        <div class="box box_second">
            <span class="fa-solid fa-truck-fast"></span>
            <span>43</span>
            <span>Entregas(exemplo)</span>
        </div>
        <div class="box box_third">
            <span class="fa-solid fa-circle-check"></span>
            <span>12</span>
            <span>Completas(exemplo)</span>
        </div>
        <div class="box box_fourth">
            <span class="fa-solid fa-triangle-exclamation"></span>
            <span>3</span>
            <span>Alertas(exemplo)</span>
        </div>
    </div>
    <!-- <?php //var_dump($this->data['menu']); ?> -->
</div>
<!-- </div> -->
<!-- FIM do conteudo do ADM -->