<?php
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); } ?>
<!-- Inicio do conteudo do Visualizar ADM -->
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Detalhes do Item <br>do Menu DropDown</h2>
        </div>
        <?php echo "<div class='msg_alert'>";
                if (isset($_SESSION['msg'])) { 
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']); }
                echo "</div>";
        if (!empty($this->data['viewItensMenu'])) {
            extract($this->data['viewItensMenu'][0]); ?>
        <div class="content_adm">
            <div class="view_det">
                <span class="view_det_title">ID:</span>
                <span class="view_det_info"><?= $id_item_menu; ?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">Nome no menu:</span>
                <span class="view_det_info"><?= $name_item_menu; ?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">Icon (class):</span>
                <span class="view_det_info"><i class="<?= $icon_item_menu; ?>"> </i> - <?= $icon_item_menu; ?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">Ordem do Item:</span>
                <span class="view_det_info"><?= $order_item_menu; ?></span>
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
        <div class="col-12 text-center p-4">
        <?php if(($this->data['button']['list_itens_menu']) or ($this->data['button']['edit_itens_menu']) or ($this->data['button']['add_itens_menu']) or ($this->data['button']['delete_itens_menu'])) { 
            if($this->data['button']['list_itens_menu']) {
            echo "<a class='btn btn-sm btn-outline-primary mx-1' href='".URLADM."list-itens-menu/index'> Listar</a>"; }
            if($this->data['button']['edit_itens_menu']) {
            echo "<a class='btn btn-sm btn-outline-warning mx-1' href='".URLADM."edit-itens-menu/index/$id_item_menu'><i class='fa-solid fa-eye'></i> Editar</a>"; }
            if($this->data['button']['add_itens_menu']){
            echo "<a class='btn btn-sm btn-outline-success' href='" .URLADM . "add-itens-menu/index' type='button'>Cadastrar</a>"; }
            if($this->data['button']['delete_itens_menu']) {
            echo "<a class='btn btn-sm btn-outline-danger mx-1' href='".URLADM."delete-itens-menu/index/$id_item_menu' onclick='return confirm(\"Tem certeza que deseja excluir o registro?\")'><i class='fa-solid fa-trash-can'></i> Apagar</a>"; } 
            echo "</td>"; } ?>
        </div>
        <?php } ?>
    </div>
</div>
<!-- FIM do conteudo do ADM -->