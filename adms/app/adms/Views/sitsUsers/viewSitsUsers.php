<?php
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); } ?>
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Detalhes da Situação</h2>
        </div>
    <?php echo "<div id='msg' class='msg_alert'>";
        if (isset($_SESSION['msg'])) { 
            echo $_SESSION['msg'];
            unset($_SESSION['msg']); }
            echo "</div>"; 
        if (!empty($this->data['viewSitsUsers'])) {
        extract($this->data['viewSitsUsers'][0]); ?>
        <div class="content_adm">
            <div class="view_det">
                <span class="view_det_title">ID:</span>
                <span class="view_det_info"><?= $id_sits_user; ?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">Nome da Situação:</span>
                <span class="view_det_info" style="color:<?=$color_adms;?>;"><?=$name_sits_user;?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">Data Criação:</span>
                <span class="view_det_info"><?= date('d/m/Y H:i:s', strtotime($created)); ?></span>
            </div>
            <?php if (!empty($modified)) { ?>
                <div class="view_det">
                    <span class="view_det_title">Modificado:</span>
                    <span class="view_det_info"><?= date('d/m/Y H:i:s', strtotime($modified)); ?></span>
                </div> <?php } ?>
        </div>
        <?php if ((!empty($this->data['button']['list_sits_users'])) or (!empty($this->data['button']['add_sits_users'])) or (!empty($this->data['button']['edit_sits_users'])) or (!empty($this->data['button']['delete_sits_users']))) {
            echo "<div class='col-12 text-center p-4'>";
            if (!empty($this->data['button']['list_sits_users'])) {
                echo "<a class='btn btn-sm btn-outline-primary mx-1' href='" . URLADM . "list-sits-users/index'><i class='fa-solid fa-list'></i> Listar</a>"; }
            if (!empty($this->data['button']['add_sits_users'])) {
                echo "<a class='btn btn-sm btn-outline-success mx-1' href='" . URLADM . "add-sits-users/index'><i class='fa-solid fa-plus'></i> Adicionar</a>"; }
            if (!empty($this->data['button']['edit_sits_users'])) {
                echo "<a class='btn btn-sm btn-outline-warning mx-1' href='" . URLADM . "edit-sits-users/index/$id_sits_user'><i class='fa-solid fa-pen-to-square'></i> Editar</a>"; }
            if (!empty($this->data['button']['delete_sits_users'])) {
                echo "<a class='btn btn-sm btn-outline-danger mx-1' href='" . URLADM . "delete-sits-users/index/$id_sits_user' onclick='return confirm(\"Tem certeza que deseja excluir o registro?\")'><i class='fa-solid fa-trash-can'></i> Apagar</a>"; }
            echo "</div>"; }  } ?>
    </div>
</div>