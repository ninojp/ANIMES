<?php
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); } ?>
<!-- Inicio do conteudo do Visualizar ADM -->
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Detalhes do Grupo de Páginas</h2>
        </div>
        <?php if (!empty($this->data['viewGroupsPgs'])) {
            extract($this->data['viewGroupsPgs'][0]); 
            echo "<div id='msg' class='msg_alert'>";
            if (isset($_SESSION['msg'])) { 
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);}
            echo "</div>"; ?>
        <div class="content_adm">
            <div class="view_det">
                <span class="view_det_title">ID:</span>
                <span class="view_det_info"><?= $id_group_page; ?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">Nome do Grupo:</span>
                <span class="view_det_info"><?= $name_group_page; ?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">Ordem do Grupo:</span>
                <span class="view_det_info"><?= $order_group_page; ?></span>
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
        <?php if(isset($this->data['button']['list_groups_page']) or ($this->data['button']['edit_groups_page']) or ($this->data['button']['delete_groups_page']) or ($this->data['button']['add_groups_page'])) {
                    echo "<div class='col-12 text-center p-4'>";
                    if($this->data['button']['list_groups_page']) {
                        echo "<a class='btn btn-sm btn-outline-primary mx-1' href='".URLADM."list-groups-page/index'><i class='fa-solid fa-eye'></i> Listar</a>"; }
                    if($this->data['button']['add_groups_page']) {
                        echo "<a class='btn btn-sm btn-outline-success mx-1' href='".URLADM."add-groups-page/index'><i class='fa-solid fa-eye'></i> Adicionar</a>"; }
                    if($this->data['button']['edit_groups_page']) {
                        echo "<a class='btn btn-sm btn-outline-warning mx-1' href='".URLADM."edit-groups-page/index/$id_group_page'><i class='fa-solid fa-pen-to-square'></i> Editar</a>"; }
                    if($this->data['button']['delete_groups_page']) {
                        echo "<a class='btn btn-sm btn-outline-danger mx-1' href='".URLADM."delete-groups-page/index/$id_group_page' onclick='return confirm(\"Tem certeza que deseja excluir o registro?\")'><i class='fa-solid fa-trash-can'></i> Apagar</a>"; } 
                    echo "</div>"; } ?>
        <?php } ?>
    </div>
</div>
<!-- FIM do conteudo do ADM -->