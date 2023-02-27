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
            <h2>Editar Senha do E-mail</h2>
        </div>
        <?php echo "<div id='msg' class='msg_alert'>";
            if (isset($_SESSION['msg'])) { 
            echo $_SESSION['msg'];
            unset($_SESSION['msg']); }
            echo "</div>"; ?>
        <form class="form_adms" action="" method="POST" id="form-edit-email-confs-pass">
            <!-- input oculto pra enviar o id, via post -->
            <input class="form-control" type="hidden" name="id_email_config" id="id_email_config" value="<?php if(isset($valorForm['id_email_config'])){echo $valorForm['id_email_config'];} ?>">

            <div class="row_edit">
                <label class="" for="pass_email_config">Editar Senha:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="password" name="pass_email_config" id="pass_email_config" onkeyup="passwordStrength()" autocomplete="on" value="<?php if(isset($valorForm['pass_email_config'])){echo $valorForm['pass_email_config'];} ?>" placeholder="Digite uma nova senha" required>
            </div>
            <div class="msg_alert" id="msgViewStrength"></div>
            <div class="button_center">
                <button class="btn btn-primary" type="submit" name="SendEditEmailPass" value="Salvar">Salvar Mudança</button>
            </div>
            <?php if ((!empty($this->data['button']['list_email_config'])) or (!empty($this->data['button']['add_email_config'])) or (!empty($this->data['button']['view_email_config'])) or (!empty($this->data['button']['edit_email_config'])) or (!empty($this->data['button']['delete_email_config']))) {
            echo "<div class='col-12 text-center p-3'>";
                if (!empty($this->data['button']['list_email_config'])) {
                    echo "<a class='btn btn-sm btn-outline-primary mx-1' href='" . URLADM . "list-email-config/index'><i class='fa-solid fa-list'></i> Listar</a>"; }
                if (!empty($this->data['button']['add_email_config'])) {
                    echo "<a class='btn btn-sm btn-outline-success mx-1' href='" . URLADM . "add-email-config/index'><i class='fa-solid fa-plus'></i> Adicionar</a>"; }
                if (!empty($this->data['button']['view_email_config'])) {
                    echo "<a class='btn btn-sm btn-outline-info mx-1' href='" . URLADM . "view-email-config/index/".$valorForm['id_email_config']."'><i class='fa-solid fa-eye'></i> Ver</a>"; }
                if (!empty($this->data['button']['edit_email_config'])) {
                    echo "<a class='btn btn-sm btn-outline-warning mx-1' href='" . URLADM . "edit-email-config/index/".$valorForm['id_email_config']."'><i class='fa-solid fa-pen-to-square'></i> Editar</a>"; }
                if (!empty($this->data['button']['delete_email_config'])) {
                    echo "<a class='btn btn-sm btn-outline-danger mx-1' href='" . URLADM . "delete-email-config/index/".$valorForm['id_email_config']."' onclick='return confirm(\"Tem certeza que deseja excluir o registro?\")'><i class='fa-solid fa-trash-can'></i> Apagar</a>"; }
            echo "</div>"; } ?>
        </form>
    </div>
</div>



