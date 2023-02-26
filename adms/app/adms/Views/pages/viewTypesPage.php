<?php
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); } ?>
<!-- Inicio do conteudo do Visualizar ADM -->
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Detalhes do Tipo de pagina</h2>
        </div>
    <?php if (isset($_SESSION['msg'])) { 
        echo "<div id='msg' class='msg_alert'>";
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
        echo "</div>"; }
        if (!empty($this->data['viewTypesPgs'])) {
        extract($this->data['viewTypesPgs'][0]); ?>
        <div class="content_adm">
            <div class="view_det">
                <span class="view_det_title">ID:</span>
                <span class="view_det_info"><?= $id_type_page; ?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">Tipo:</span>
                <span class="view_det_info"><?= $type_page; ?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">Nome do Tipo:</span>
                <span class="view_det_info"><?= $name_type_page; ?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">order_type_pg:</span>
                <span class="view_det_info"><?= $order_type_page; ?></span>
            </div>
            <?php if (!empty($obs_type_page)) { ?>
                <div class="view_det">
                    <span class="view_det_title">Observações:</span>
                    <span class="view_det_info"><?= $obs_type_page; ?></span>
                </div>
            <?php } ?>
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
        <?php if ((!empty($this->data['button']['list_types_page'])) or (!empty($this->data['button']['add_types_page'])) or (!empty($this->data['button']['edit_types_page'])) or (!empty($this->data['button']['delete_types_page']))) {
            echo "<div class='col-12 text-center p-4'>";
            if (!empty($this->data['button']['list_types_page'])) {
                echo "<a class='btn btn-sm btn-outline-primary mx-1' href='" . URLADM . "list-types-page/index'><i class='fa-solid fa-list'></i> Listar</a>"; }
            if (!empty($this->data['button']['add_types_page'])) {
                echo "<a class='btn btn-sm btn-outline-success mx-1' href='" . URLADM . "add-types-page/index'><i class='fa-solid fa-plus'></i> Adicionar</a>"; }
            if (!empty($this->data['button']['edit_types_page'])) {
                echo "<a class='btn btn-sm btn-outline-warning mx-1' href='" . URLADM . "edit-types-page/index/$id_type_page'><i class='fa-solid fa-pen-to-square'></i> Editar</a>"; }
            if (!empty($this->data['button']['delete_types_page'])) {
                echo "<a class='btn btn-sm btn-outline-danger mx-1' href='" . URLADM . "delete-types-page/index/$id_type_page' onclick='return confirm(\"Tem certeza que deseja excluir o registro?\")'><i class='fa-solid fa-trash-can'></i> Apagar</a>"; }
            echo "</div>"; }  } ?>
    </div>
</div>
<!-- FIM do conteudo do ADM -->