<?php
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); } 
if (isset($this->data['form'])) {
    $valorForm = $this->data['form']; }
//na posição [0] e quando os dados vem do banco de dados
if (isset($this->data['form'][0])) {
    $valorForm = $this->data['form'][0];} ?>
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Editar Imagem do Perfil</h2>
        </div>
        <?php echo "<div id='msg' class='msg_alert'>";
            if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);}
            echo "</div>"; ?>
        <!--OBRIGATóRIO o enctype="multipart/form-data", para trabalhar com imagens dentro de formulários-->
        <form class="form_adms" action="" method="POST" id="form-edit-prof-img" enctype="multipart/form-data">
            <div class="text-center">
            <?php if ((!empty($valorForm['adm_img'])) and (file_exists("app/adms/assets/imgs/users/" . $_SESSION['id_user'] . "/" . $valorForm['adm_img']))) {
                    $old_img = URLADM . "app/adms/assets/imgs/users/" . $_SESSION['id_user'] . "/" . $valorForm['adm_img'];
                } else {
                    $old_img = URLADM . "app/adms/assets/imgs/users/TI_link.png";
                }
                ?>
                <span id="preview-img">
                    <img src="<?=$old_img;?>" alt="Imagem" style="width: 300px;height: 300px;">
                </span>
            </div>
            <div class="row_edit">
                <label class="" for="image">Selecione a Imagem: (300x300px)</label>
                <i class="fa-solid fa-image"></i>
                <input class="form-control" type="file" name="new_image" id="new_image" onchange="inputFileValImg()" required>
            </div>
            <div class="button_center">
                <button class="btn btn-primary" type="submit" name="SendEditProfImage" value="Salvar">Salvar Mudança</button>
            </div>
            <?php if(($this->data['button']['view_profile']) or ($this->data['button']['edit_profile_pass']) or ($this->data['button']['edit_profile']) or ($this->data['button']['logout'])) { 
                echo "<div class='col-12 text-center p-4'>";
                if($this->data['button']['view_profile']) { 
                echo "<a class='btn btn-sm btn-outline-warning mx-1' href='".URLADM."view-profile/index/{$_SESSION['user_id']}'><i class='fa-solid fa-eye'></i> Ver</a>"; }
                if($this->data['button']['edit_profile_pass']) {
                echo "<a class='btn btn-sm btn-outline-info mx-1' href='".URLADM."edit-profile-pass/index/{$_SESSION['user_id']}'><i class='fa-solid fa-unlock-keyhole'></i> Senha</a>"; }
                if($this->data['button']['edit_profile']) {
                echo "<a class='btn btn-sm btn-outline-primary mx-1' href=".URLADM."edit-profile/index/{$_SESSION['user_id']}'><i class='fa-solid fa-image'></i> Editar</a>"; }
                if($this->data['button']['logout']) {
                echo "<a class='btn btn-sm btn-outline-danger mx-1' href='".URLADM."logou/index/{$_SESSION['user_id']}'><i class='fa-solid fa-right-from-bracket'></i> Logout</a>"; }
            echo "</div>"; } ?>
        </form>
    </div>
</div>