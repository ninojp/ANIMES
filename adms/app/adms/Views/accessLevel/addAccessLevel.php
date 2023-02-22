<?php
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
// Manter os dados no formulário     
if (isset($this->data['form'])) {
    // var_dump($this->data['form']);
    $valorForm = $this->data['form']; } ?>
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Cadastrar Novo Nivel de Acesso</h2>
        </div>
        <?php echo "<div id='msg' class='msg_alert'>";
            if (isset($_SESSION['msg'])) { 
            echo $_SESSION['msg'];
            unset($_SESSION['msg']); }
            echo "</div>"; ?>
        <form class="form_adms" action="" method="POST" id="form-add-access-nivels">
            <div class="row_input">
                <?php $access_level = "";
                if (isset($valorForm['access_level'])) {
                    $access_level = $valorForm['access_level'];
                } ?>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="access_level" id="access_level" value="<?php echo $access_level; ?>" placeholder="Nome Do Nivel de Acesso *">
            </div>
            <span class="span_obrigatorio">* Campos obrigatórios</span><br>
            <div class="button_center">
                <button class="btn btn-primary" type="submit" name="SendAddAccessLevel" value="Cadastrar">Cadastrar Nivel de Acesso</button>
            </div>
            <div class="button_center">
                 <a class="btn btn-sm btn-outline-info" href="<?=URLADM;?>list-access-level/index"> Listar Niveis</a>
            </div>
        </form>
    </div>
</div>