<?php
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
// Manter os dados no formulário     
if(isset($this->data['form'])){
    $valorForm = $this->data['form']; } 
//na posição [0] e quando os dados vem do banco de dados
if(isset($this->data['form'][0])){
    $valorForm = $this->data['form'][0];
} // var_dump($this->data['form'][0]); ?>
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Editar o Tipo da Pagina</h2>
        </div>
        <?php echo "<div id='msg' class='msg_alert'>";
            if (isset($_SESSION['msg'])) { 
            echo $_SESSION['msg'];
            unset($_SESSION['msg']); }
            echo "</div>"; ?>
        <form class="form_adms" action="" method="POST" id="form-edit-type-pg">
            <!-- input oculto pra enviar o id, via post -->
            <input class="form-control" type="hidden" name="id_type_page" id="id_type_page" value="<?php if(isset($valorForm['id_type_page'])){echo $valorForm['id_type_page'];} ?>">

            <div class="row_edit">
                <label class="" for="type_page">Tipo da Página:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="type_page" id="type_page" value="<?php if(isset($valorForm['type_page'])){echo $valorForm['type_page'];} ?>" placeholder="Digite o Tipo de Pg" required>
            </div>
            <div class="row_edit">
                <label class="" for="name_type_page">Nome Completo do Tipo:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="name_type_page" id="name_type_page" value="<?php if(isset($valorForm['name_type_page'])){echo $valorForm['name_type_page'];} ?>" placeholder="Digite o nome" required>
            </div>
            <div class="row_edit">
                <label class="" for="order_type_page">Ordem do Tipo:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="order_type_page" id="order_type_page" value="<?php if(isset($valorForm['order_type_page'])){echo $valorForm['order_type_page'];} ?>" placeholder="Numero para ordenar o tipo pg">
            </div>
            <?php if(!empty($valorForm['obs_type_page'])) { ?> 
                <div class="row_edit">
                    <label class="" for="obs_type_page">Observações:</label>
                    <i class="fa-solid fa-envelope"></i>
                    <input class="form-control" type="text" name="obs_type_page" id="obs_type_page" value="<?php if(isset($valorForm['obs_type_page'])){echo $valorForm['obs_type_page'];} ?>" placeholder="Edite as Observações" required>
                </div>
            <?php } ?>
            <div class="button_center">
                <button class="btn btn-primary" type="submit" name="SendEditTypesPgs" value="Salvar">Salvar Mudanças</button><br>
            </div>
            <?php if ((!empty($this->data['button']['list_types_page'])) or (!empty($this->data['button']['add_types_page'])) or (!empty($this->data['button']['view_types_page'])) or (!empty($this->data['button']['delete_types_page']))) {
            echo "<div class='col-12 text-center p-4'>";
                if (!empty($this->data['button']['list_types_page'])) {
                    echo "<a class='btn btn-sm btn-outline-primary mx-1' href='" . URLADM . "list-types-page/index'><i class='fa-solid fa-list'></i> Listar</a>"; }
                if (!empty($this->data['button']['add_types_page'])) {
                    echo "<a class='btn btn-sm btn-outline-success mx-1' href='" . URLADM . "add-types-page/index'><i class='fa-solid fa-plus'></i> Adicionar</a>"; }
                if (!empty($this->data['button']['view_types_page'])) {
                    echo "<a class='btn btn-sm btn-outline-warning mx-1' href='" . URLADM . "view-types-page/index/{$valorForm['id_type_page']}'><i class='fa-solid fa-eye'></i> Ver</a>"; }
                if (!empty($this->data['button']['delete_types_page'])) {
                    echo "<a class='btn btn-sm btn-outline-danger mx-1' href='" . URLADM . "delete-types-page/index/{$valorForm['id_type_page']}' onclick='return confirm(\"Tem certeza que deseja excluir o registro?\")'><i class='fa-solid fa-trash-can'></i> Apagar</a>"; }
            echo "</div>"; } ?>
        </form>
    </div>
</div>



