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
            <h2>Editar Grupo da Página</h2>
        </div>
        <?php echo "<div id='msg' class='msg_alert'>";
            if (isset($_SESSION['msg'])) { 
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);}
            echo "</div>"; ?>
        <form class="form_adms" action="" method="POST" id="form-edit-groups-pg">
            <!-- input oculto pra enviar o id, via post -->
            <input class="form-control" type="hidden" name="id_group_page" id="id_group_page" value="<?php if(isset($valorForm['id_group_page'])){echo $valorForm['id_group_page'];} ?>">

            <div class="row_edit">
                <label class="" for="name_group_page">Nome Do Grupo:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="name_group_page" id="name_group_page" value="<?php if(isset($valorForm['name_group_page'])){echo $valorForm['name_group_page'];} ?>" placeholder="Digite o nome" required>
            </div>
            <div class="row_edit">
                <label class="" for="order_group_page">Numero da ordem:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="order_group_page" id="order_group_page" value="<?php if(isset($valorForm['order_group_page'])){echo $valorForm['order_group_page'];} ?>" placeholder="Numero para ordenar o Grupo pg">
            </div>
            <div class="button_center">
                <button class="btn btn-primary" type="submit" name="SendEditGroupsPgs" value="Salvar">Salvar Mudanças</button><br>
            </div>
            <?php if(isset($this->data['button']['list_groups_page']) or ($this->data['button']['view_groups_page']) or ($this->data['button']['delete_groups_page']) or ($this->data['button']['add_groups_page'])) {
            echo "<div class='col-12 text-center p-4'>";
            if($this->data['button']['list_groups_page']) {
                echo "<a class='btn btn-sm btn-outline-primary mx-1' href='".URLADM."list-groups-page/index'><i class='fa-solid fa-eye'></i> Listar</a>"; }
            if($this->data['button']['add_groups_page']) {
                echo "<a class='btn btn-sm btn-outline-success mx-1' href='".URLADM."add-groups-page/index'><i class='fa-solid fa-eye'></i> Adicionar</a>"; }
            if($this->data['button']['view_groups_page']) {
                echo "<a class='btn btn-sm btn-outline-info mx-1' href='".URLADM."view-groups-page/index/{$valorForm['id_group_page']}'><i class='fa-solid fa-pen-to-square'></i> Ver</a>"; }
            if($this->data['button']['delete_groups_page']) {
                echo "<a class='btn btn-sm btn-outline-danger mx-1' href='".URLADM."delete-groups-page/index/{$valorForm['id_group_page']}' onclick='return confirm(\"Tem certeza que deseja excluir o registro?\")'><i class='fa-solid fa-trash-can'></i> Apagar</a>"; } 
            echo "</div>"; } ?>
        </form>
    </div>
</div>



