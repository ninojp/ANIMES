<?php
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
// echo "Views/login/login.php <h1> Pagina(view) para fazer o login</h1>";
// Manter os dados no formulário     
if (isset($this->data['form'])) {
    // var_dump($this->data['form']);
    $valorForm = $this->data['form'];
} ?>
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Cadastrar Novo Usuário</h2>
        </div>
        <?php echo "<div class='msg_alert' id='msg'>";
            if (isset($_SESSION['msg'])) { 
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);}
            echo "</div>"; ?>
        <form class="form_adms" action="" method="POST" id="form-add-user">
        <div class="row_input">
                <?php $adm_user = "";
                if (isset($valorForm['adm_user'])) {
                    $adm_user = $valorForm['adm_user'];
                } ?>
                <i class="fa-solid fa-user"></i>
                <input class="form-control" type="text" name="adm_user" id="adm_user" value="<?php echo $adm_user; ?>" placeholder="Digite o Usuário(login) *" required>
            </div>
            <div class="row_input">
                <?php $adm_email = "";
                if (isset($valorForm['adm_email'])) {
                    $adm_email = $valorForm['adm_email'];
                } ?>
                <i class="fa-solid fa-envelope"></i>
                <input class="form-control" type="email" name="adm_email" id="adm_email" value="<?= $adm_email; ?>" placeholder="Digite o Email *" required>
            </div>
            <div class="row_input">
                <?php $adm_pass = "";
                if (isset($valorForm['adm_pass'])) {
                    $adm_pass = $valorForm['adm_pass'];
                } ?>
                <i class="fa-solid fa-lock"></i>
                <input class="form-control" type="password" name="adm_pass" id="adm_pass" onkeyup="passwordStrength()" autocomplete="on" value="<?= $adm_pass; ?>" placeholder="Digite a Senha(login) do usuário *" required>
            </div>
            <div class="msg_alert_pass" id="msgViewStrength">
            </div>
            <div class="row_input">
                <i class="fa-solid fa-hand-pointer"></i>
                <div class="select_input">
                    <label class="form_label" for="id_sits_user">Selecione a Situação:<span style="color:#f00;">*</span></label>
                    <select name="id_sits_user" id="id_sits_user" required>
                        <option value="">Selecione</option>
                        <?php foreach ($this->data['select']['sit'] as $sit) {
                            extract($sit);
                            if ((isset($valorForm['id_sits_user'])) and ($valorForm['id_sits_user'] == $id_sits_user)) {
                                echo "<option value='$id_sits_user' selected>$name_sits_user</option>";
                            } else {
                                echo "<option value='$id_sits_user'>$name_sits_user</option>";
                            } } ?>
                    </select>
                </div>
            </div>
            <div class="row_input">
                <i class="fa-solid fa-hand-pointer"></i>
                <div class="select_input">
                    <label class="form_label" for="id_access_level">Nivel de Acesso:<span style="color:#f00;">*</span></label>
                    <select name="id_access_level" id="id_access_level" required>
                        <option value="">Selecione</option>
                        <?php foreach ($this->data['select']['lev'] as $lev) {
                            extract($lev);
                            if ((isset($valorForm['id_access_level'])) and ($valorForm['id_access_level'] == $id_access_level)) {
                                echo "<option value='$id_access_level' selected>$access_level</option>";
                            } else {
                                echo "<option value='$id_access_level'>$access_level</option>";
                            } } ?>
                    </select>
                </div>
            </div>
            <span class="span_obrigatorio">* Campos obrigatórios</span><br>
            <div class="button_center">
                <button class="btn btn-primary" type="submit" name="SendAddUser" value="Cadastrar">Cadastrar Usuário</button>
            </div>
            <div class="button_center">
                 <a class="btn btn-sm btn-outline-info" href="<?=URLADM;?>list-user/index"> Listar  Usuários </a>
            </div>
        </form>
    </div>
</div>