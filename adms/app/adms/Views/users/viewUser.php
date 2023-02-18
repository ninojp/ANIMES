<?php
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); } ?>
<!-- Inicio do conteudo do Visualizar ADM -->
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Detalhes do Usuário</h2>
        </div>
        <div class="pt-3 text-center">
        <?php if (!empty($this->data['viewUser'])) {
            // var_dump($this->data['viewUsers'][0]);
            extract($this->data['viewUser'][0]);
            if ((!empty($adm_img)) and (file_exists("app/adms/assets/imgs/users/$id_user/$adm_img"))) {
                echo "<img src='" . URLADM . "app/adms/assets/imgs/users/$id_user/$adm_img' width='200' height='200'><br><br>";
            } else {
                echo "<img src='" . URLADM . "app/adms/assets/imgs/users/Logo_Dtudo_2022-300p.png' width='300' height='100'><br><br>";
            } ?>
        </div>
        <div class="col-12 text-center pb-3">
        <?php if($this->data['button']['list_user']) { ?>
            <a class="btn btn-sm btn-outline-success mx-4" href="<?= URLADM; ?>list-user/index"><i class="fa-solid fa-rectangle-list"></i> Listar</a> <?php } 
        if($this->data['button']['edit_user_image']) { ?>
            <a class="btn btn-sm btn-outline-primary mx-4" href="<?= URLADM; ?>edit-user-image/index/<?= $id_user; ?>"><i class="fa-solid fa-image"></i> Editar Imagem</a> <?php } ?>
        </div>
        <?php echo "<div id='msg' class='msg_alert'>";
            if (isset($_SESSION['msg'])) { 
            echo $_SESSION['msg'];
            unset($_SESSION['msg']); }
            echo "</div>"; ?>
        <div class="content_adm">
            <div class="view_det">
                <span class="view_det_title">ID:</span>
                <span class="view_det_info"><?= $id_user; ?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">Nome do Usuário:</span>
                <span class="view_det_info"><?= $adm_user; ?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">E-mail:</span>
                <span class="view_det_info"><?= $adm_email; ?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">Situação Usuário:</span>
                <span class="view_det_info"><span style='color:<?= $color_adms; ?>'><?= $name_sits_user; ?></span></span>
            </div>
            <?php if (!empty($access_level)) { ?>
                <div class="view_det">
                    <span class="view_det_title">Nivel de Acesso:</span>
                    <!-- Link para OUTRA VIEW:view-access-nivels, passando o id da mesma   -->
                    <span class="view_det_info"><?php echo "<a href='" . URLADM . "view-access-nivels/index/$id_access_level'>" .$access_level. "</a>"; ?></span>
            </div><?php } ?>
            <?php if (!empty($adm_img)) { ?>
                <div class="view_det">
                    <span class="view_det_title">Imagem name:</span>
                    <span class="view_det_info"><?= $adm_img; ?></span>
                </div><?php } ?>
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
        <?php if($this->data['button']['edit_user']) { ?>
            <a class="btn btn-sm btn-outline-warning mx-2" href="<?= URLADM; ?>edit-user/index/<?= $id_user; ?>"><i class='fa-solid fa-pen-to-square'></i> Editar</a> <?php }
        if($this->data['button']['edit_user_pass']) { ?>
            <a class="btn btn-sm btn-outline-info mx-2" href="<?= URLADM; ?>edit-user-pass/index/<?= $id_user; ?>"><i class="fa-solid fa-unlock-keyhole"></i> Editar Senha</a><?php }
        if($this->data['button']['delete_user']) { ?>
            <a class="btn btn-sm btn-outline-danger mx-2" href="<?= URLADM; ?>delete-user/index/<?= $id_user; ?>" onclick="return confirm('Tem certeza que deseja excluir o registro?')"><i class='fa-solid fa-trash-can'></i> Apagar Usuário</a> <?php } ?>
        </div>
        <?php } ?>
    </div>
</div>
<!-- FIM do conteudo do ADM -->