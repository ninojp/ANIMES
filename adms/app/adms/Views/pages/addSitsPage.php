<?php
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
//verifica, se contém dados no array:$this->data['form']
if(isset($this->data['form'])){
    //se contiver, atribui para variável:$valorForm
    $valorForm = $this->data['form']; } ?>
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Cadastrar Situação da Página</h2>
        </div>
        <div id="msg" class="msg_alert">
            <?php if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']); } ?>
        </div>
        <form class="form_adms" action="" method="POST" id="form-add-sit-pg">
            <div class="row_input">
            <?php $name_sits_page="";
            if(isset($valorForm['name_sits_page'])) {
                $name_sits_page = $valorForm['name_sits_page'];} ?>
                <!-- <label class="form-label" for="name">Nova Situação:<span style="color:#f00;">*</span></label> -->
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="name_sits_page" id="name_sits_page" value="<?php echo $name_sits_page; ?>" placeholder="Digite a Situação da página *" required>
            </div>
            <div class="row_input">
                <i class="fa-solid fa-hand-pointer"></i>
                <div class="select_input">
                    <label class="form_label" for="id_color">Cor da Situação<span style="color:#f00;"> *</span></label>
                    <select name="id_color" id="id_color" required>
                        <option value="">Selecione a Cor</option>
                        <?php foreach($this->data['selectCor']['cor'] as $cor){
                            extract($cor);
                            if((isset($valorForm['id_color'])) and ($valorForm['id_color'] == $idCor)){
                                echo "<option value='$id_color' selected>$name_color</option>";
                            } else {
                                echo "<option value='$id_color'>$name_color</option>";
                            }  } ?>
                    </select>
                </div>
            </div>
            <span class="span_obrigatorio" >* Campos obrigatórios</span><br>
            <div class="button_center">
                <button class="btn btn-primary" type="submit" name="SendAddSitPg" value="Cadastrar">Cadastrar Situação</button>
            </div>
            <div class="button_center">
                 <a class="btn btn-sm btn-outline-info" href="<?=URLADM;?>list-sits-page/index"> Listar Situações </a>
            </div>
        </form>
    </div>
</div>