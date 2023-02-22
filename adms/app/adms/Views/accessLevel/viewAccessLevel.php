<?php
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); } ?>
<!-- Inicio do conteudo do Visualizar ADM -->
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Detalhes do Nivel de Acesso</h2>
        </div>
        <div class="pt-3 text-center">
        <?php if (!empty($this->data['viewAccessLevel'])) {
            // var_dump($this->data['viewUsers'][0]);
            extract($this->data['viewAccessLevel'][0]); ?>
        </div>
        <?php echo "<div id='msg' class='msg_alert'>";
            if (isset($_SESSION['msg'])) { 
            echo $_SESSION['msg'];
            unset($_SESSION['msg']); }
            echo "</div>"; ?>
        <div class="content_adm">
            <div class="view_det">
                <span class="view_det_title">ID:</span>
                <span class="view_det_info"><?= $id_access_level; ?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">Nome do Nivel:</span>
                <span class="view_det_info"><?= $access_level; ?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">Codigo do Nivel:</span>
                <span class="view_det_info"><?= $order_level; ?></span>
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
        <?php if($this->data['button']['list_access_level']) { ?>
            <a class="btn btn-sm btn-outline-success mx-2" href="<?= URLADM; ?>list-access-level/index"><i class="fa-solid fa-rectangle-list"></i> Listar</a> <?php }
        if($this->data['button']['edit_access_level']) { ?>
            <a class="btn btn-sm btn-outline-warning mx-2" href="<?= URLADM; ?>edit-access-level/index/<?=$id_access_level; ?>"><i class='fa-solid fa-pen-to-square'></i> Editar</a> <?php }
        if($this->data['button']['delete_access_level']) { ?>
            <a class="btn btn-sm btn-outline-danger mx-2" href="<?= URLADM; ?>delete-access-level/index/<?=$id_access_level; ?>" onclick="return confirm('Tem certeza que deseja excluir o registro?')"><i class='fa-solid fa-trash-can'></i> Apagar</a> <?php } ?>
        </div>
        <?php } ?>
    </div>
</div>
<!-- FIM do conteudo do ADM -->