<?php
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
    // echo "Views/login/login.php <h1> Pagina(view) para fazer o login</h1>";
if(isset($this->data['form'])){
    // var_dump($this->data['form']);
    $valorForm = $this->data['form']; } ?>

<div class="container-login">
    <div class="wrapper-login">
        <div class="title">
            <span>Cadastrar Novo Usuário</span>
        </div>
        <form class="form-login" action="" method="POST" id="form-new-user">
            <div class="row">
                <i class="fa-solid fa-user"></i>
                <input class="form-control" type="text" name="adm_user" id="adm_user" value="<?php if(isset($valorForm)){echo $valorForm['adm_user'];} ?>" placeholder="Digite o USER(usuário)"
                required>
            </div>
            <div class="row">
                <i class="fa-solid fa-envelope"></i>
                <input class="form-control" type="email" name="adm_email" id="adm_email" value="<?php if(isset($valorForm)){echo $valorForm['adm_email'];} ?>" placeholder="Digite o E-Mail" required>
            </div>
            <div class="row">
                <i class="fa-solid fa-lock"></i>
                <input class="form-control" type="password" autocomplete="on" name="adm_pass" id="adm_pass" onkeyup="passwordStrength()" value="<?php if(isset($valorForm)){echo $valorForm['adm_pass'];} ?>" placeholder="Digite uma Senha" required><br>
                <!-- <span style="color:#f00;">* Campo obrigatório</span><br> -->
            </div>
                <span id="msgViewStrength"></span>
                <!-- Verifica se existir mensagem na $global[posição]: $_SESSION['msg'], exibe, depois destroi -->
                <?php if(isset($_SESSION['msg'])){
                echo $_SESSION['msg'];
                unset($_SESSION['msg']); } ?>
                <!-- Local onde vai exibir a mensagem: $_SESSION['msg'] -->
                <span id="msg"></span>
            <div class="row button">
                <button class="btn btn-primary" type="submit" name="SendNewUser" value="Cadastrar">Cadastrar</button>
            </div>
            <div class="signup-link text-center">
                <a class="btn btn-sm btn-outline-info me-4" href="<?=URLADM?>">Login</a>
                <a class="btn btn-sm btn-outline-info" href="<?=URLADM?>new-confirm-email/index">Novo E-mail confirmação!</a>
            </div>
        </form>
    </div>
</div>



