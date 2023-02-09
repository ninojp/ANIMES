<?php
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
// echo "Views/login/login.php <h1> Pagina(view) para fazer o login</h1>";
//Criptografar a senha - Teste
// echo password_hash("123456a", PASSWORD_DEFAULT);
if(isset($this->data['form'])){
    // var_dump($this->data['form']);
    $valorForm = $this->data['form']; } ?>

<div class="container-login">
    <div class="wrapper-login">
        <div class="title">
            <span>Administrativo<br> do Site Animes</span>
        </div>
        <form class="form-login" action="" method="POST" id="form-login">
            <div class="row">
            <i class="fa-solid fa-envelope"></i>
                <input class="form-control" type="text" name="adm_user" id="adm_user" value="<?php if(isset($valorForm)){echo $valorForm['adm_user'];} ?>" placeholder="Digite o Nome(user)" required>
            </div>
            <div class="row">
                <i class="fa-solid fa-lock"></i>
                <input class="form-control" type="password" name="adm_pass" autocomplete="on" id="adm_pass" value="<?php if(isset($valorForm)){echo $valorForm['adm_pass'];} ?>" placeholder="Digite a Senha do usuário" required><br>
                <!-- <span style="color:#f00;">* Campo obrigatório</span><br> -->
            </div>
            <div class="msg-alert" id="msg">
                <!-- Verifica se existir mensagem na $global[posição]: $_SESSION['msg'], exibe, depois destroi -->
                <?php if(isset($_SESSION['msg'])){
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']); } ?>
                <!-- Local onde vai exibir a mensagem: $_SESSION['msg'] do JavaScript-->
            </div>
            <div class="row button">
                <button class="btn btn-primary" type="submit" name="SendLogin" value="Acessar">Acessar</button>
            </div>
            <div class="signup-link text-center">
                <!-- Para direcionar para o endereço, URL:URLADM, nome da CONTROLLER:NewUser precisa ter um SEPARADOR entre os termos(espaço ou traço)e depois o nome do método usado:index(dentro da controller) -->
                <a class="btn btn-sm btn-outline-primary me-4" href="<?=URLADM?>new-user/index">Cadastrar Usuário!</a>
                <a class="btn btn-sm btn-outline-primary" href="<?=URLADM?>recover-password/index">Recuperar Senha!</a>
            </div>
        </form>
    </div><!-- Finalica a DIV:wrapper-login -->
</div><!-- Finalica a DIV:container-login -->

