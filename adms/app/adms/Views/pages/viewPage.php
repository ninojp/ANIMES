<?php
if (!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')) {
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada");
} ?>
<!-- Inicio do conteudo do Visualizar ADM -->
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Detalhes da Pagina</h2>
        </div>
        <?php echo "<div id='msg' class='msg_alert'>";
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        echo "</div>";
        if (!empty($this->data['viewPage'])) {
            extract($this->data['viewPage'][0]); ?>
            <div class="content_adm">
                <div class="view_det">
                    <span class="view_det_title">ID:</span>
                    <span class="view_det_info"><?= $id_page; ?></span>
                </div>
                <div class="view_det">
                    <span class="view_det_title">Nome da Página:</span>
                    <span class="view_det_info"><?= $name_page; ?></span>
                </div>
                <div class="view_det">
                    <span class="view_det_title">Nome da Controller(classe):</span>
                    <span class="view_det_info"><?= $controller_page; ?></span>
                </div>
                <div class="view_det">
                    <span class="view_det_title">Nome do Método:</span>
                    <span class="view_det_info"><?= $metodo_page; ?></span>
                </div>
                <div class="view_det">
                    <span class="view_det_title">menu_controller:</span>
                    <span class="view_det_info"><?= $menu_controller; ?></span>
                </div>
                <div class="view_det">
                    <span class="view_det_title">menu_metodo:</span>
                    <span class="view_det_info"><?= $menu_metodo; ?></span>
                </div>
                <div class="view_det">
                    <span class="view_det_title">1=Publica, 2=Não é Publica:</span>
                    <span class="view_det_info"><?= $public_page; ?></span>
                </div>
                <div class="view_det">
                    <span class="view_det_title">Situação da Página:</span>
                    <span class="view_det_info"><?= $name_sits_page; ?></span>
                </div>
                <div class="view_det">
                    <span class="view_det_title">Tipo da Página:</span>
                    <span class="view_det_info"><?= $type_page; ?></span>
                </div>
                <div class="view_det">
                    <span class="view_det_title">Grupo de Páginas:</span>
                    <span class="view_det_info"><?= $name_group_page; ?></span>
                </div>
                <?php if (!empty($obs)) { ?>
                    <div class="view_det">
                        <span class="view_det_title">Observações Sobre a Página:</span>
                        <span class="view_det_info"><?= $obs_page; ?></span>
                    </div>
                <?php } ?>
                <?php if (!empty($icon)) { ?>
                    <div class="view_det">
                        <span class="view_det_title">Icone(classe) no Menu:</span>
                        <span class="view_det_info"><i class="<?= $icon_menu_page; ?>"></i></span>
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
            <?php if ((!empty($this->data['button']['list_page'])) or (!empty($this->data['button']['edit_page'])) or (!empty($this->data['button']['delete_page'])) or (!empty($this->data['button']['add_page']))) {
                echo "<div class='col-12 text-center p-4'>";
                if (!empty($this->data['button']['list_page'])) {
                    echo "<a class='btn btn-sm btn-outline-primary mx-1' href='" . URLADM . "list-page/index'><i class='fa-solid fa-list'></i> Listar</a>";
                }
                if (!empty($this->data['button']['add_page'])) {
                    echo "<a class='btn btn-sm btn-outline-success mx-1' href='" . URLADM . "add-page/index'><i class='fa-solid fa-plus'></i> Adicionar</a>";
                }
                if (!empty($this->data['button']['edit_page'])) {
                    echo "<a class='btn btn-sm btn-outline-warning mx-1' href='" . URLADM . "edit-page/index/$id_page'><i class='fa-solid fa-pen-to-square'></i> Editar</a>";
                }
                if (!empty($this->data['button']['delete_page'])) {
                    echo "<a class='btn btn-sm btn-outline-danger mx-1' href='" . URLADM . "delete-page/index/$id_page' onclick='return confirm(\"Tem certeza que deseja excluir o registro?\")'><i class='fa-solid fa-trash-can'></i> Apagar</a>";
                }
                echo "</div>"; } ?>
        <?php } ?>
    </div>
</div>
<!-- FIM do conteudo do ADM -->