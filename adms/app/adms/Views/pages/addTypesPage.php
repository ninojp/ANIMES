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
            <h2>Cadastrar Novos Paginas</h2>
        </div>
        <?php echo "<div id='msg' class='msg_alert'>";
            if (isset($_SESSION['msg'])) { 
            echo $_SESSION['msg'];
            unset($_SESSION['msg']); }
            echo "</div>";  ?>
        <form class="form_adms" action="" method="POST" id="form-add-type-pgs">
            <div class="row_input">
                <?php $type_page = "";
                if (isset($valorForm['type_page'])) {
                    $type_page = $valorForm['type_page']; } ?>
                <i class="fa-solid fa-file-circle-plus"></i>
                <input class="form-control" type="text" name="type_page" id="type_page" value="<?= $type_page; ?>" placeholder="Digite o tipo da pagina *" required>
            </div>
            <div class="row_input">
                <?php $name_type_page = "";
                if (isset($valorForm['name_type_page'])) {
                    $name_type_page = $valorForm['name_type_page']; } ?>
                <i class="fa-regular fa-file-lines"></i>
                <input class="form-control" type="text" name="name_type_page" id="name_type_page" value="<?php echo $name_type_page; ?>" placeholder="Digite o Nome para o Tipo *">
            </div>
            <div class="row_input">
                <?php $order_type_page = "";
                if (isset($valorForm['order_type_page'])) {
                    $order_type_page = $valorForm['order_type_page']; } ?>
                <i class="fa-solid fa-file"></i>
                <input class="form-control" type="text" name="order_type_page" id="order_type_page" value="<?= $order_type_page; ?>" placeholder="Digite o numero para ordenar *" required>
            </div>
            <div class="row_input">
                <?php $obs_type_page = "";
                if (isset($valorForm['obs_type_page'])) {
                    $obs_type_page = $valorForm['obs_type_page']; } ?>
                <i class="fa-solid fa-file-lines"></i>
                <input class="form-control" type="text" name="obs_type_page" id="obs_type_page" value="<?php echo $obs_type_page; ?>" placeholder="Observações gerais sobre o tipo">
            </div>
            <span class="span_obrigatorio">* Campos obrigatórios</span><br>
            <div class="button_center">
                <button class="btn btn-primary" type="submit" name="SendAddTypePgs" value="Cadastrar">Cadastrar Tipo</button>
            </div>
            <div class="button_center">
                 <a class="btn btn-sm btn-outline-info" href="<?=URLADM;?>list-types-page/index"> Listar tipos de Pgs </a>
            </div>
        </form>
    </div>
</div>