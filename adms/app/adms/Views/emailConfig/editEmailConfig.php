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
            <h2>Editar E-mail de Configuração</h2>
        </div>
        <?php echo "<div id='msg' class='msg_alert'>";
            if (isset($_SESSION['msg'])) { 
            echo $_SESSION['msg'];
            unset($_SESSION['msg']); }
            echo "</div>"; ?>
        <form class="form_adms" action="" method="POST" id="form-edit-email-confs">
            <!-- input oculto pra enviar o id, via post -->
            <input class="form-control" type="hidden" name="id_email_config" id="id_email_config" value="<?php if(isset($valorForm['id_email_config'])){echo $valorForm['id_email_config'];} ?>">

            <div class="row_edit">
                <label class="" for="email">Alterar o E-mail:</label>
                <i class="fa-solid fa-envelope"></i>
                <input class="form-control" type="email" name="email_config" id="email_config" value="<?php if(isset($valorForm['email_config'])){echo $valorForm['email_config'];} ?>" placeholder="Digite o Email" required>
            </div>
            <div class="row_edit">
                <label class="" for="title_email_config">Alterar o Titulo:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="title_email_config" id="title_email_config" value="<?php if(isset($valorForm['title_email_config'])){echo $valorForm['title_email_config'];} ?>" placeholder="Digite o Titulo" required>
            </div>
            <div class="row_edit">
                <label class="" for="name_email_config">Alterar o Nome:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="name_email_config" id="name_email_config" value="<?php if(isset($valorForm['name_email_config'])){echo $valorForm['name_email_config'];} ?>" placeholder="Digite o nome Completo" required>
            </div>
            <div class="row_edit">
                <label class="" for="host_email_config">Alterar o Host:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="host_email_config" id="host_email_config" value="<?php if(isset($valorForm['host_email_config'])){echo $valorForm['host_email_config'];} ?>" placeholder="Digite o host" required>
            </div>
            <div class="row_edit">
                <label class="" for="user_email_config">Nome do Usuário(Login):</label>
                <i class="fa-solid fa-user"></i>
                <input class="form-control" type="user_email_config" name="user_email_config" id="user_email_config" value="<?php if(isset($valorForm['user_email_config'])){echo $valorForm['user_email_config'];} ?>" placeholder="Digite o Nome do Usuário(Login)" required>
            </div>
            <div class="row_edit">
                <label class="" for="smtpsecure">smtpsecure:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="smtpsecure" id="smtpsecure" value="<?php if(isset($valorForm['smtpsecure'])){echo $valorForm['smtpsecure'];} ?>" placeholder="Digite o usuário para acessar o administrativo">
            </div>
            <div class="row_edit">
                <label class="" for="port">port:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="port" id="port" value="<?php if(isset($valorForm['port'])){echo $valorForm['port'];} ?>" placeholder="Digite a porta">
            </div>
            <div class="button_center">
                <button class="btn btn-primary" type="submit" name="SendEditEmailConfs" value="Salvar">Salvar Mudança</button>
            </div>
            <?php if ((!empty($this->data['button']['list_email_config'])) or (!empty($this->data['button']['add_email_config'])) or (!empty($this->data['button']['view_email_config'])) or (!empty($this->data['button']['edit_email_config_pass'])) or (!empty($this->data['button']['delete_email_config']))) {
            echo "<div class='col-12 text-center p-3'>";
                if (!empty($this->data['button']['list_email_config'])) {
                    echo "<a class='btn btn-sm btn-outline-primary mx-1' href='" . URLADM . "list-email-config/index'><i class='fa-solid fa-list'></i> Listar</a>"; }
                if (!empty($this->data['button']['add_email_config'])) {
                    echo "<a class='btn btn-sm btn-outline-success mx-1' href='" . URLADM . "add-email-config/index'><i class='fa-solid fa-plus'></i> Adicionar</a>"; }
                if (!empty($this->data['button']['view_email_config'])) {
                    echo "<a class='btn btn-sm btn-outline-info mx-1' href='" . URLADM . "view-email-config/index/".$valorForm['id_email_config']."'><i class='fa-solid fa-eye'></i> Ver</a>"; }
                if (!empty($this->data['button']['edit_email_config_pass'])) {
                    echo "<a class='btn btn-sm btn-outline-warning mx-1' href='" . URLADM . "edit-email-config-pass/index/".$valorForm['id_email_config']."'><i class='fa-solid fa-unlock-keyhole'></i> Senha</a>"; }
                if (!empty($this->data['button']['delete_email_config'])) {
                    echo "<a class='btn btn-sm btn-outline-danger mx-1' href='" . URLADM . "delete-email-config/index/".$valorForm['id_email_config']."' onclick='return confirm(\"Tem certeza que deseja excluir o registro?\")'><i class='fa-solid fa-trash-can'></i> Apagar</a>"; }
            echo "</div>"; } ?>
        </form>
    </div>
</div>



