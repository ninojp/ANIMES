<?php
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); } ?>
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
                <h2>Detalhes do E-mail</h2>
            </div>
        <?php echo "<div id='msg' class='msg_alert'>";
            if (isset($_SESSION['msg'])) { 
                echo $_SESSION['msg'];
                unset($_SESSION['msg']); }
                echo "</div>"; 
            if (!empty($this->data['viewEmailConf'])) {
            extract($this->data['viewEmailConf'][0]); ?>
        <div class="content_adm">
            <div class="view_det">
                <span class="view_det_title">ID:</span>
                <span class="view_det_info"><?=$id_email_config;?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">Titulo:</span>
                <span class="view_det_info"><?=$title_email_config;?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">Nome:</span>
                <span class="view_det_info"><?=$name_email_config;?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">E-mail:</span>
                <span class="view_det_info"><?=$email_config;?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">User Name:</span>
                <span class="view_det_info"><?=$user_email_config;?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">Host:</span>
                <span class="view_det_info"><?=$host_email_config;?></span>
            </div>
            <?php if(!empty($port)) { ?>
            <div class="view_det">
                <span class="view_det_title">Port:</span>
                <span class="view_det_info"><?=$port;?></span>
            </div><?php } ?>
            <?php if(!empty($smtpsecure)) { ?>
            <div class="view_det">
                <span class="view_det_title">smtpsecure:</span>
                <span class="view_det_info"><?=$smtpsecure;?></span>
            </div><?php } ?>
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
        <?php if ((!empty($this->data['button']['list_email_config'])) or (!empty($this->data['button']['add_email_config'])) or (!empty($this->data['button']['edit_email_config'])) or (!empty($this->data['button']['edit_email_config_pass'])) or (!empty($this->data['button']['delete_email_config']))) {
            echo "<div class='col-12 text-center p-4'>";
            if (!empty($this->data['button']['list_email_config'])) {
                echo "<a class='btn btn-sm btn-outline-primary mx-1' href='" . URLADM . "list-email-config/index'><i class='fa-solid fa-list'></i> Listar</a>"; }
            if (!empty($this->data['button']['add_email_config'])) {
                echo "<a class='btn btn-sm btn-outline-success mx-1' href='" . URLADM . "add-email-config/index'><i class='fa-solid fa-plus'></i> Adicionar</a>"; }
            if (!empty($this->data['button']['edit_email_config'])) {
                echo "<a class='btn btn-sm btn-outline-warning mx-1' href='" . URLADM . "edit-email-config/index/$id_email_config'><i class='fa-solid fa-pen-to-square'></i> Editar</a>"; }
            if (!empty($this->data['button']['edit_email_config_pass'])) {
                echo "<a class='btn btn-sm btn-outline-warning mx-1' href='" . URLADM . "edit-email-config-pass/index/$id_email_config'><i class='fa-solid fa-unlock-keyhole'></i> Senha</a>"; }
            if (!empty($this->data['button']['delete_email_config'])) {
                echo "<a class='btn btn-sm btn-outline-danger mx-1' href='" . URLADM . "delete-email-config/index/$id_email_config' onclick='return confirm(\"Tem certeza que deseja excluir o registro?\")'><i class='fa-solid fa-trash-can'></i> Apagar</a>"; }
        echo "</div>"; }  } ?>
    </div>
</div>
<!-- FIM do conteudo do ADM -->