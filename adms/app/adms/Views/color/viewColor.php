<?php
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); } ?>
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Detalhes da Cor</h2>
        </div>
        <?php echo "<div id='msg' class='msg_alert'>";
            if (isset($_SESSION['msg'])) { 
            echo $_SESSION['msg'];
            unset($_SESSION['msg']); }
            echo "</div>"; 
            if (!empty($this->data['viewColor'])) {
                extract($this->data['viewColor'][0]);  ?>
        <div class="content_adm">
            <div class="view_det">
                <span class="view_det_title">ID:</span>
                <span class="view_det_info"><?=$id_color;?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">Nome da Cor:</span>
                <span class="view_det_info"><span style='background-color:<?=$color_adms;?>;color:#fff;'><?=$name_color;?></span></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">Codigo da Cor:</span>
                <span class="view_det_info"><?=$color_adms;?></span>
            </div>
            
            <div class="view_det">
                <span class="view_det_title">Data Criação:</span>
                <span class="view_det_info"><?=date('d/m/Y H:i:s', strtotime($created));?></span>
            </div>
            <?php if(!empty($modified)) { ?>
            <div class="view_det">
                <span class="view_det_title">Modificado:</span>
                <span class="view_det_info"><?=date('d/m/Y H:i:s', strtotime($modified)); ?></span>
            </div> <?php } ?>
        </div>
        <div class="col-12 text-center p-4">
            <?php if(($this->data['button']['list_color']) or ($this->data['button']['edit_color']) or ($this->data['button']['delete_color']) or ($this->data['button']['add_color'])) {
                if($this->data['button']['list_color']) { ?>
                <a class="btn btn-sm btn-outline-success mx-1" href="<?= URLADM; ?>list-color/index"><i class="fa-solid fa-rectangle-list"></i> Listar</a> <?php } ?>
                <?php if($this->data['button']['add_color']) { ?>
                <a class="btn btn-sm btn-outline-warning mx-1" href="<?= URLADM; ?>add-color/index"><i class='fa-solid fa-pen-to-square'></i> Adicionar</a> <?php } ?>
                <?php if($this->data['button']['edit_color']) { ?>
                <a class="btn btn-sm btn-outline-warning mx-1" href="<?= URLADM; ?>edit-color/index/<?= $id_color; ?>"><i class='fa-solid fa-pen-to-square'></i> Editar</a> <?php } ?>
                <?php if($this->data['button']['delete_color']) { ?>
                <a class="btn btn-sm btn-outline-danger mx-1" href="<?= URLADM; ?>delete-color/index/<?= $id_color; ?>" onclick="return confirm('Tem certeza que deseja excluir o registro?')"><i class='fa-solid fa-trash-can'></i> Apagar</a><?php } } ?>
            </div>
        <?php } ?>
        </div>
    </div>
</div>
<!-- FIM do conteudo do ADM -->