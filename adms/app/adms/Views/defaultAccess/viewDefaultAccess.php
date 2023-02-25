<?php
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); } ?>
<!-- Inicio do conteudo do Visualizar ADM  -->
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Configurações para todos<br>os novos usuários</h2>
        </div>
        <?php echo "<div id='msg' class='msg_alert'>";
        if (isset($_SESSION['msg'])) { 
            echo $_SESSION['msg'];
            unset($_SESSION['msg']); }
        echo "</div>";
        if (!empty($this->data['viewLevelsForm'])) {
            extract($this->data['viewLevelsForm'][0]); 
            // var_dump($this->data['viewLevelsForm'][0]); ?>
        <div class="content_adm">
            <div class="view_det">
                <span class="view_det_title">ID:</span>
                <span class="view_det_info"><?=$id_default_access;?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">Nivel de Acesso (New User):</span>
                <span class="view_det_info"><?=$access_level;?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">Situação do cadastro:</span>
                <span class="view_det_info"><?=$name_sits_user;?></span>
            </div>
            
            <div class="view_det">
                <span class="view_det_title">Data Criação (Registro):</span>
                <span class="view_det_info"><?=date('d/m/Y H:i:s', strtotime($created));?></span>
            </div>
            <?php if(!empty($modified)) { ?>
            <div class="view_det">
                <span class="view_det_title">Modificado (Registro):</span>
                <span class="view_det_info"><?=date('d/m/Y H:i:s', strtotime($modified)); ?></span>
            </div> <?php } ?>
        </div>

        <div class="col-12 text-center p-4">
        <?php if(($this->data['button']['edit_default_access'])) { ?>
            <a class="btn btn-sm btn-outline-warning mx-1" href="<?=URLADM;?>edit-default-access/index/<?=$id_default_access;?>"><i class='fa-solid fa-pen-to-square'></i> Editar</a>
        <?php }?>
        </div>
        <?php } ?>
    </div>
</div>
<!-- FIM do conteudo do ADM -->