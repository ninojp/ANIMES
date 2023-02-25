<?php
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); } 
if(isset($this->data['form'])){
    $valorForm = $this->data['form']; } 
//na posição [0] e quando os dados vem do banco de dados
if(isset($this->data['form'][0])){
    $valorForm = $this->data['form'][0]; } ?>
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Trocar a Senha do Perfil</h2>
        </div>
        <?php echo "<div id='msg' class='msg_alert'>";
            if (isset($_SESSION['msg'])) { 
            echo $_SESSION['msg'];
            unset($_SESSION['msg']); }
            echo "</div>"; ?>
        <form class="form_adms" action="" method="POST" id="form-edit-prof-pass">
            <div class="row_edit">
                <label class="" for="password">Nova Senha:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="password" name="adm_pass" id="adm_pass" onkeyup="passwordStrength()" autocomplete="on" value="<?php if(isset($valorForm['adm_pass'])){echo $valorForm['adm_pass'];} ?>" placeholder="Digite uma nova senha" required>
            </div>
            <div class="msg_alert" id="msgViewStrength"></div>
            <div class="button_center">
                <button class="btn btn-primary" type="submit" name="SendEditProfPass" value="Salvar">Salvar Nova Senha</button>
            </div>
            <?php if(($this->data['button']['view_profile']) or ($this->data['button']['edit_profile_image']) or ($this->data['button']['edit_profile']) or ($this->data['button']['logout'])) { 
                echo "<div class='col-12 text-center p-4'>";
                if($this->data['button']['view_profile']) { 
                echo "<a class='btn btn-sm btn-outline-warning mx-1' href='".URLADM."view-profile/index/{$_SESSION['user_id']}'><i class='fa-solid fa-eye'></i> Ver</a>"; }
                if($this->data['button']['edit_profile_image']) {
                echo "<a class='btn btn-sm btn-outline-info mx-1' href='".URLADM."edit-profile-image/index/{$_SESSION['user_id']}'><i class='fa-solid fa-unlock-keyhole'></i> Imagem</a>"; }
                if($this->data['button']['edit_profile']) {
                echo "<a class='btn btn-sm btn-outline-primary mx-1' href=".URLADM."edit-profile/index/{$_SESSION['user_id']}'><i class='fa-solid fa-image'></i> Editar</a>"; }
                if($this->data['button']['logout']) {
                echo "<a class='btn btn-sm btn-outline-danger mx-1' href='".URLADM."logout/index/{$_SESSION['user_id']}'><i class='fa-solid fa-right-from-bracket'></i> Logout</a>"; }
            echo "</div>"; } ?>
        </form>
    </div>
</div>



