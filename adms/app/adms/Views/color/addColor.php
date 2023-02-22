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
            <h2>Cadastrar Nova Cor</h2>
        </div>
        <?php echo "<div id='msg' class='msg_alert'>";
            if (isset($_SESSION['msg'])) { 
            echo $_SESSION['msg'];
            unset($_SESSION['msg']); } 
            echo "</div>"; ?>
        <form class="form_adms" action="" method="POST" id="form-add-colors">
            <div class="row_input">
                <?php $name_color="";
                if(isset($valorForm['name_color'])){
                    $name_color = $valorForm['name_color'];} ?>
                    <i class="fa-solid fa-file-signature"></i>
                    <input class="form-control" type="text" name="name_color" id="name_color" value="<?php echo $name_color; ?>" placeholder="Nome para Cor *" required>
            </div>
            <div class="row_input">
                <?php $color_adms="";
                if(isset($valorForm['color_adms'])){
                    $color_adms = $valorForm['color_adms'];} ?>
                    <label class="form-label" for="color_adms">Escolha a Cor:<span style="color:#f00;">*</span></label>
                    <i class="fa-solid fa-palette"></i>
                    <input class="form-control" type="color" name="color_adms" id="color_adms" value="<?php echo $color_adms; ?>" placeholder="Código da Cor *" required>
            </div>
            <br><br><span class="span_obrigatorio">* Campos obrigatórios</span><br>
            <div class="button_center">
                <button class="btn btn-primary" type="submit" name="SendAddColor" value="Cadastrar">Cadastrar Cor</button>
            </div>
            <div class="button_center">
                 <a class="btn btn-sm btn-outline-info" href="<?=URLADM;?>list-color/index"> Listar  Cores </a>
            </div>
        </form>
    </div>
</div>