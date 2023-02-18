<?php
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
// Manter os dados no formulário     
if(isset($this->data['form'])){
    $valorForm = $this->data['form'];
} 
//na posição [0] e quando os dados vem do banco de dados
if(isset($this->data['form'][0])){
    $valorForm = $this->data['form'][0];
} // var_dump($this->data['form'][0]); ?>
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Editar Senha do Usuário</h2>
        </div>
        <?php echo "<div id='msg' class='msg_alert'>"; 
            if (isset($_SESSION['msg'])) { 
            echo $_SESSION['msg'];
            unset($_SESSION['msg']); }
            echo "</div>"; ?>
        <form class="form_adms" action="" method="POST" id="form-edit-user-pass">
            <!-- input oculto pra enviar o id, via post -->
            <input class="form-control" type="hidden" name="id_user" id="id_user" value="<?php if(isset($valorForm['id_user'])){echo $valorForm['id_user'];} ?>">

            <div class="row_edit">
                <label class="" for="adm_pass">Editar Senha:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="password" name="adm_pass" id="adm_pass" onkeyup="passwordStrength()" autocomplete="on" value="<?php if(isset($valorForm['adm_pass'])){echo $valorForm['adm_pass'];} ?>" placeholder="Digite uma nova senha" required><br>
            </div>
            <div class="msg_alert" id="msgViewStrength"></div>
            <div class="button_center">
                <button class="btn btn-primary" type="submit" name="SendEditUserPass" value="Salvar">Salvar</button>
            </div>
            <div class="col-12 text-center p-4">
                <?php if($this->data['button']['list_user']) { ?>
                    <a class="btn btn-sm btn-outline-success mx-2" href="<?= URLADM; ?>list-user/index"><i class="fa-solid fa-rectangle-list"></i> Listar Usuários</a> <?php }
                if($this->data['button']['view_user']) { ?>
                    <a class="btn btn-sm btn-outline-warning mx-2" href="<?= URLADM; ?>view-user/index/<?= $valorForm['id_user']; ?>"><i class='fa-solid fa-pen-to-square'></i> Visualizar Usuário</a> <?php } ?>
            </div>
        </form>
    </div>
</div>



