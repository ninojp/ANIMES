<?php
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); } ?>
<!-- Inicio do conteudo do Visualizar ADM -->
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
                <h2>Detalhes do Perfil Usuário</h2>
            </div>
        <div class="pt-3 text-center">
        <?php if (!empty($this->data['viewProfile'])) {
            // var_dump($this->data['viewProfile'][0]);
            extract($this->data['viewProfile'][0]);
            if ((!empty($adm_img)) and (file_exists("app/adms/assets/imgs/users/".$_SESSION['id_user']."/$adm_img"))) {
                echo "<img src='".URLADM."app/adms/assets/imgs/users/".$_SESSION['id_user']."/$adm_img' width='200' height='200'><br><br>";
            } else {
                echo "<img src='".URLADM."app/adms/assets/imgs/users/TI_link.png' width='300' height='100'><br><br>";
            }?>
        </div>
        <?php echo "<div id='msg' class='msg_alert'>";
            if (isset($_SESSION['msg'])) { 
            echo $_SESSION['msg'];
            unset($_SESSION['msg']); }
            echo "</div>";  ?>
        <div class="content_adm">
            <div class="view_det">
                <span class="view_det_title">ID:</span>
                <span class="view_det_info"><?=$_SESSION['id_user'];?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">User Name:</span>
                <span class="view_det_info"><?=$adm_user;?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">E-mail:</span>
                <span class="view_det_info"><?=$adm_email;?></span>
            </div>
            <?php if(!empty($image)) { ?>
            <div class="view_det">
                <span class="view_det_title">Imagem name:</span>
                <span class="view_det_info"><?=$adm_img;?></span>
            </div><?php } ?>
        </div>
        <?php if(($this->data['button']['edit_profile']) or ($this->data['button']['edit_profile_pass']) or ($this->data['button']['edit_profile_image']) or ($this->data['button']['logout'])) { ?>
            <div class="col-12 text-center p-4">
            <?php if($this->data['button']['edit_profile']) { ?>
            <a class="btn btn-sm btn-outline-warning mx-1" href="<?=URLADM;?>edit-profile/index/<?=$_SESSION['user_id'];?>"><i class='fa-solid fa-pen-to-square'></i> Editar</a> <?php } ?>
            <?php if($this->data['button']['edit_profile_pass']) { ?>
            <a class="btn btn-sm btn-outline-info mx-1" href="<?=URLADM;?>edit-profile-pass/index/<?=$_SESSION['user_id'];?>"><i class="fa-solid fa-unlock-keyhole"></i> Senha</a> <?php } ?>
            <?php if($this->data['button']['edit_profile_image']) { ?>
            <a class="btn btn-sm btn-outline-primary mx-1" href="<?=URLADM;?>edit-profile-image/index/<?=$_SESSION['user_id'];?>"><i class="fa-solid fa-image"></i> Imagem</a><?php } ?>
            <?php if($this->data['button']['logout']) { ?>
            <a class="btn btn-sm btn-outline-danger mx-1" href="<?=URLADM;?>logout/index/<?=$_SESSION['user_id'];?>"><i class="fa-solid fa-right-from-bracket"></i> Logout</a><?php } ?>
        </div> <?php } } ?>
    </div>
</div>
<!-- FIM do conteudo do ADM -->
