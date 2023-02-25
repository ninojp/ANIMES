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
            <h2>Cadastrar Grupo de Páginas</h2>
        </div>
        <?php echo "<div id='msg' class='msg_alert'>";
            if (isset($_SESSION['msg'])) { 
            echo $_SESSION['msg'];
            unset($_SESSION['msg']); }
            echo "</div>"; ?>
        <form class="form_adms" action="" method="POST" id="form-add-groups-pgs">
            <div class="row_input">
                <?php $name_group_page = "";
                if (isset($valorForm['name_group_page'])) {
                    $name_group_page = $valorForm['name_group_page']; } ?>
                <i class="fa-regular fa-file-lines"></i>
                <input class="form-control" type="text" name="name_group_page" id="name_group_page" value="<?php echo $name_group_page; ?>" placeholder="Digite o Nome para o Tipo *">
            </div>
            <div class="row_input">
                <?php $order_group_page = "";
                if (isset($valorForm['order_group_page'])) {
                    $order_group_page = $valorForm['order_group_page']; } ?>
                <i class="fa-solid fa-file"></i>
                <input class="form-control" type="text" name="order_group_page" id="order_group_page" value="<?= $order_group_page; ?>" placeholder="Digite o numero da Ordem do grupo *" required>
            </div>
            <span class="span_obrigatorio">* Campos obrigatórios</span><br>
            <div class="button_center">
                <button class="btn btn-primary" type="submit" name="SendAddGroupsPgs" value="Cadastrar">Cadastrar Grupo</button>
            </div>
            <div class="button_center">
                 <a class="btn btn-sm btn-outline-info" href="<?=URLADM;?>list-groups-page/index"> Listar Grupos</a>
            </div>
        </form>
    </div>
</div>