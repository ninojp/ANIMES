<?php
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
// Manter os dados no formulário     
if(isset($this->data['form'])){
    // var_dump($this->data['form']);
    $valorForm = $this->data['form']; } ?>
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Adicionar E-mail de Configuração</h2>
        </div>
        <?php echo "<div id='msg' class='msg_alert'>";
            if (isset($_SESSION['msg'])) { 
            echo $_SESSION['msg'];
            unset($_SESSION['msg']); }
            echo "</div>"; ?>
        <form class="form_adms" action="" method="POST" id="form-add-email-confs">
            <div class="row_input">
                <?php $email_config="";
                if(isset($valorForm['email_config'])) {
                $email_config=$valorForm['email_config'];} ?>
                <!-- <label class="form-label" for="email_config">email_config:<span style="color:#f00;">*</span></label> -->
                <i class="fa-solid fa-envelope"></i>
                <input class="form-control" type="email" name="email_config" id="email_config" value="<?=$email_config;?>" placeholder="Digite o Email *" required>
            </div>
            <div class="row_input">
                <?php $user_email_config="";
                if(isset($valorForm['user_email_config'])) {
                $user_email_config = $valorForm['user_email_config'];} ?>
                <!-- <label class="form-label" for="user_email_config">user_email_config:<span style="color:#f00;">*</span></label> -->
                <i class="fa-solid fa-user"></i>
                <input class="form-control" type="text" name="user_email_config" id="user_email_config" value="<?php echo $user_email_config; ?>" placeholder="Digite o nome do usuário (login) *" required>
            </div>
            <div class="row_input">
                <?php $pass_email_config ="";
                if(isset($valorForm['pass_email_config'])) {
                $pass_email_config = $valorForm['pass_email_config'];} ?>
                <!-- <label class="form-label" for="pass_email_config">Senha:<span style="color:#f00;">*</span></label> -->
                <i class="fa-solid fa-lock"></i>
                <input class="form-control" type="password" name="pass_email_config" id="pass_email_config" onkeyup="passwordStrength()" autocomplete="on" value="<?= $pass_email_config; ?>" placeholder="Digite a Senha do E-mail (login) *" required>
            </div>
            <div class="msg_alert" id="msgViewStrength"></div>
            <div class="row_input">
                <?php $title_email_config="";
                if(isset($valorForm['title_email_config'])){
                $title_email_config = $valorForm['title_email_config'];} ?>
                <!-- <label class="form-label" for="title_email_config">Titulo:<span style="color:#f00;">*</span></label> -->
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="title_email_config" id="title_email_config" value="<?php echo $title_email_config; ?>" placeholder="Digite um Titulo *" required>
            </div>
            <div class="row_input">
                <?php $name_email_config="";
                if(isset($valorForm['name_email_config'])) {
                $name_email_config=$valorForm['name_email_config'];} ?>
                <!-- <label class="form-label" for="name_email_config">Nome:<span style="color:#f00;">*</span></label> -->
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="name_email_config" id="name_email_config" value="<?=$name_email_config;?>" placeholder="Digite uma descrição (name) *" required>
            </div>
            <div class="row_input">
                <?php $host_email_config="";
                if(isset($valorForm['host_email_config'])) {
                $host_email_config = $valorForm['host_email_config'];} ?>
                <!-- <label class="form-label" for="host_email_config">host_email_config:<span style="color:#f00;">*</span></label> -->
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="host_email_config" id="host_email_config" value="<?php echo $host_email_config; ?>" placeholder="Digite o nome do host *" required>
            </div>
            <span class="span_obrigatorio">* Campos obrigatórios</span><br>
            <div class="row_input">
                <?php $smtpsecure="";
                if(isset($valorForm['smtpsecure'])) {
                $smtpsecure = $valorForm['smtpsecure'];} ?>
                <!-- <label class="form-label" for="smtpsecure">smtpsecure:</label> -->
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="smtpsecure" id="smtpsecure" value="<?php echo $smtpsecure; ?>" placeholder="Digite o smtpsecure do host">
            </div>
            <div class="row_input">
                <?php $port=null;
                if(isset($valorForm['port'])) {
                $port = $valorForm['port'];} ?>
                <!-- <label class="form-label" for="port">port:</label> -->
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="port" id="port" value="<?php echo $port; ?>" placeholder="Digite o porta se necessário">
            </div>
            <div class="button_center">
                <button class="btn btn-primary" type="submit" name="SendAddEmailConfs" value="Cadastrar">Cadastrar E-Mail</button>
            </div>
            <div class="button_center">
                 <a class="btn btn-sm btn-outline-info" href="<?=URLADM;?>list-email-config/index"> Listar E-Mails</a>
            </div>
        </form>
    </div>
</div>



