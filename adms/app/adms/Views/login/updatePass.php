<?php
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
if(isset($this->data['form'])){
    // var_dump($this->data['form']);
    $valorForm = $this->data['form']; } ?>
<div class="container-login">
    <div class="wrapper-login">
        <div class="title">
            <span>Criar uma Nova senha</span>
        </div>
        <form class="form-login" action="" method="POST" id="form-update-pass">
            <div class="row">
                <i class="fa-solid fa-lock"></i>
                <input class="form-control" type="password" name="adm_pass" id="adm_pass" autocomplete="on" onkeyup="passwordStrength()" value="<?php if(isset($valorForm)){echo $valorForm['adm_pass'];} ?>" placeholder="Digite a Nova Senha do ADMs" required><br>
                <span id="msgViewStrength"></span>
            </div>
                <!-- Verifica se existir mensagem na $global[posição]: $_SESSION['msg'], exibe, depois destroi -->
                <?php if(isset($_SESSION['msg'])){
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']); } ?>
                <!-- Local onde vai exibir a mensagem: $_SESSION['msg'] -->
                <span id="msg"></span>
            <div class="row button">
                <button class="btn btn-primary" type="submit" name="SendUpPass" value="Salvar">Salvar Mudança</button>
            </div>
            <div class="signup-link text-center">
                <a class="btn btn-sm btn-outline-info" href="<?=URLADM?>">Login</a>
            </div>
        </form>
    </div>
</div>

