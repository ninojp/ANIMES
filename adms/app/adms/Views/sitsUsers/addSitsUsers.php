<?php
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
if(isset($this->data['form'])){
    //se contiver, atribui para variável:$valorForm
    $valorForm = $this->data['form']; } ?>
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Cadastrar Situação de Usuário</h2>
        </div>
        <?php echo "<div id='msg' class='msg_alert'>";
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']); } 
            echo "</div>"; ?>
        <form class="form_adms" action="" method="POST" id="form-add-sit-user">
            <div class="row_input">
            <?php $name_sits_user="";
            if(isset($valorForm['name_sits_user'])){
                $name_sits_user = $valorForm['name_sits_user'];} ?>
                <label class="form_label" for="name_sits_user">Nova Situação:<span style="color:#f00;">*</span></label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="name_sits_user" id="name_sits_user" value="<?php echo $name_sits_user; ?>" placeholder="Digite o nome da Situação *" required>
            </div><br>
            <div class="row_input">
                <i class="fa-solid fa-hand-pointer"></i>
                <div class="select_input">
                    <label class="form_label" for="id_color">Cor da Situação<span style="color:#f00;"> * </span></label>
                    <select name="id_color" id="id_color" required>
                        <option value="">Selecione a Cor</option>
                        <?php foreach($this->data['selectCor']['cor'] as $cor){
                            extract($cor);
                            if((isset($valorForm['id_color'])) and ($valorForm['id_color'] == $id_color)){
                                echo "<option value='$id_color' selected>$name_color</option>";
                            } else {
                                echo "<option value='$id_color' style='color:$color_adms;'>$name_color</option>";
                            }  } ?>
                    </select>
                </div>
            </div>
            <span class="span_obrigatorio" >* Campos obrigatórios</span><br>
            <div class="button_center">
                <button class="btn btn-primary" type="submit" name="SendAddSitUser" value="Cadastrar">Cadastrar Situação</button>
            </div>
            <div class="button_center">
                 <a class="btn btn-sm btn-outline-primary" href="<?=URLADM;?>list-sits-users/index"> Listar Situações </a>
            </div>
        </form>
    </div>
</div>