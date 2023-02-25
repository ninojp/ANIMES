<?php
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); } ?>
<!-- Inicio do conteudo do Visualizar ADM -->
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Detalhes da Situação da Pagina</h2>
        </div>
        <?php echo "<div id='msg' class='msg_alert'>";
            if (isset($_SESSION['msg'])) { 
            echo $_SESSION['msg'];
            unset($_SESSION['msg']); } 
            echo "</div>";  
            if (!empty($this->data['viewSitsPgs'])) {
            extract($this->data['viewSitsPgs'][0]); ?>
        <div class="content_adm">
            <div class="view_det">
                <span class="view_det_title">ID:</span>
                <span class="view_det_info"><?= $id_sits_page; ?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">Situação:</span>
                <span class="view_det_info"><?= $name_sits_page; ?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">Cor Situação:</span>
                <span class="view_det_info"><span style='background-color:<?= $color_adms; ?>;color:#fff;'><?= $name_color; ?></span></span>
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
        <?php if ((!empty($this->data['button']['list_sits_page'])) or (!empty($this->data['button']['add_sits_page'])) or (!empty($this->data['button']['edit_sits_page'])) or (!empty($this->data['button']['delete_sits_page']))) {
            echo "<div class='col-12 text-center p-4'>";
            if (!empty($this->data['button']['list_sits_page'])) {
                echo "<a class='btn btn-sm btn-outline-primary mx-1' href='" . URLADM . "list-sits-page/index'><i class='fa-solid fa-list'></i> Listar</a>";
            }
            if (!empty($this->data['button']['add_sits_page'])) {
                echo "<a class='btn btn-sm btn-outline-success mx-1' href='" . URLADM . "add-sits-page/index'><i class='fa-solid fa-plus'></i> Adicionar</a>";
            }
            if (!empty($this->data['button']['edit_sits_page'])) {
                echo "<a class='btn btn-sm btn-outline-warning mx-1' href='" . URLADM . "edit-sits-page/index/$id_sits_page'><i class='fa-solid fa-pen-to-square'></i> Editar</a>";
            }
            if (!empty($this->data['button']['delete_sits_page'])) {
                echo "<a class='btn btn-sm btn-outline-danger mx-1' href='" . URLADM . "delete-sits-page/index/$id_sits_page' onclick='return confirm(\"Tem certeza que deseja excluir o registro?\")'><i class='fa-solid fa-trash-can'></i> Apagar</a>";
            }
            echo "</div>";
        } ?>
        <?php } ?>
    </div>
</div>
<!-- FIM do conteudo do ADM -->