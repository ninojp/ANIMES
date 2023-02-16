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
            <span>Recuperar Senha (User Adm)</span>
        </div>
        <form class="form-login" action="" method="POST" id="form-recover-pass">
            <div class="row">
            <i class="fa-solid fa-envelope"></i>
                <input class="form-control" type="email" name="adm_email" id="adm_email" value="<?php if(isset($valorForm)){echo $valorForm['adm_email'];} ?>" placeholder="Digite o seu Email" required>
            </div>
                <!-- Verifica se existir mensagem na $global[posição]: $_SESSION['msg'], exibe, depois destroi -->
                <?php if(isset($_SESSION['msg'])){
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']); } ?>
                <!-- Local onde vai exibir a mensagem: $_SESSION['msg'] do JS-->
                <span id="msg"></span>
            <div class="row  button">
                <button class="btn btn-primary" type="submit" name="SendRecoverPass" value="Recuperar">Recuperar</button>
            </div>
            <div class="signup-link text-center">
                <!-- Para direcionar para o endereço, URL:URLADM, nome da CONTROLLER:NewUser precisa ter um SEPARADOR entre os termos(espaço ou traço)e depois o nome do método usado:index(dentro da controller) -->
                <a class="btn btn-sm btn-outline-info" href="<?=URLADM?>">Login</a>
            </div>
        </form>
    </div>
</div>


