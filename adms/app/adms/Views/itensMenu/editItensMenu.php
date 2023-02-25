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
            <h2>Editar Item do Menu DropDown</h2>
        </div>
        <?php echo "<div id='msg' class='msg_alert'>";
            if (isset($_SESSION['msg'])) { 
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);}
            echo "</div>";  ?>
        <form class="form_adms" action="" method="POST" id="form-edit-itens-menu">
            <!-- input oculto pra enviar o id, via post -->
            <input class="form-control" type="hidden" name="id_item_menu" id="id_item_menu" value="<?php if(isset($valorForm['id_item_menu'])){echo $valorForm['id_item_menu'];} ?>">

            <div class="row_edit">
                <label class="" for="name_item_menu">Nome no menu:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="name_item_menu" id="name_item_menu" value="<?php if(isset($valorForm['name_item_menu'])){echo $valorForm['name_item_menu'];} ?>" placeholder="Digite o nome" required>
            </div>
            <div class="row_edit">
                <label class="" for="icon_item_menu">Icone (class):</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="icon_item_menu" id="icon_item_menu" value="<?php if(isset($valorForm['icon_item_menu'])){echo $valorForm['icon_item_menu'];} ?>" placeholder="Digite Classe do Icone">
            </div>
            <div class="row_edit">
                <label class="" for="order_item_menu">Ordem do Item:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="order_item_menu" id="order_item_menu" value="<?php if(isset($valorForm['order_item_menu'])){echo $valorForm['order_item_menu'];} ?>" placeholder="Numero para ordenar o Item">
            </div>
            <div class="button_center">
                <button class="btn btn-primary" type="submit" name="SendEditItensMenu" value="Salvar">Salvar Mudanças</button><br>
            </div>
            <div class="col-12 text-center p-4">
            <?php if(($this->data['button']['list_itens_menu']) or ($this->data['button']['view_itens_menu']) or ($this->data['button']['add_itens_menu']) or ($this->data['button']['delete_itens_menu'])) { 
                if($this->data['button']['list_itens_menu']) {
                echo "<a class='btn btn-sm btn-outline-primary mx-1' href='".URLADM."list-itens-menu/index'> Listar</a>"; }
                if($this->data['button']['view_itens_menu']) {
                echo "<a class='btn btn-sm btn-outline-info mx-1' href='".URLADM."view-itens-menu/index/{$valorForm['id_item_menu']}'><i class='fa-solid fa-eye'></i> Ver</a>"; }
                if($this->data['button']['add_itens_menu']){
                echo "<a class='btn btn-sm btn-outline-success' href='" .URLADM . "add-itens-menu/index' type='button'>Cadastrar</a>"; }
                if($this->data['button']['delete_itens_menu']) {
                echo "<a class='btn btn-sm btn-outline-danger mx-1' href='".URLADM."delete-itens-menu/index/{$valorForm['id_item_menu']}' onclick='return confirm(\"Tem certeza que deseja excluir o registro?\")'><i class='fa-solid fa-trash-can'></i> Apagar</a>"; } 
                echo "</td>"; } ?>
            </div>
        </form>
    </div>
</div>



