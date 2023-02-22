<?php
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); } ?>
<!-- Inicio do conteudo LISTAR do ADM -->
<div class="wrapper_list">
    <div class="row_list">
        <div class="top_list">
            <div class="col-12 title_content">
                <h2 class="title_h2">listar Itens Menu DropDown</h2>
            </div>
            <div class="row mb-2">
                <div class='col-9 msg_alert'>
                    <?php if (isset($_SESSION['msg'])) { 
                        echo $_SESSION['msg'];
                        unset($_SESSION['msg']); } ?>
                </div>
                <div class="col-3 top_list_right">
                <?php if($this->data['button']['add_itens_menu']){
                    echo "<a class='btn btn-sm btn_success' href='" .URLADM . "add-itens-menu/index' type='button'>Cadastrar Iten Menu</a>"; } ?>
                </div>
            </div>
        </div>
        <table class="table table-striped table_list">
            <thead class="list_head">
                <tr>
                    <th class="list_head_content">ID</th>
                    <th class="list_head_content">Nome do Item</th>
                    <th class="list_head_content tb_sm_none">Icone</th>
                    <th class="list_head_content tb_sm_none">Ordem no Menu</th>
                    <?php if(($this->data['button']['order_itens_menu']) or ($this->data['button']['view_itens_menu']) or ($this->data['button']['edit_itens_menu']) or ($this->data['button']['delete_itens_menu'])) { ?>
                    <th class="list_head_content">Botões de Ações</th> <?php }?>
                </tr>
            </thead>
            <tbody class="list_body">
                <?php foreach ($this->data['listItensMenu'] as $ItemMenu) { extract($ItemMenu);  ?>
                <tr>
                    <td class="list_body_content"><?=$id_item_menu;?></td>
                    <td class="list_body_content"><?=$name_item_menu;?></td>
                    <td class="list_body_content tb_sm_none"><?=$icon_item_menu;?></td>
                    <td class="list_body_content tb_sm_none"><?=$order_item_menu;?></td>
                    <?php if(($this->data['button']['order_itens_menu']) or ($this->data['button']['view_itens_menu']) or ($this->data['button']['edit_itens_menu']) or ($this->data['button']['delete_itens_menu'])) { 
                        echo "<td class='list_body_content'>";
                        if($this->data['button']['order_itens_menu']) {
                        echo "<a class='btn btn-sm btn-outline-primary mx-1' href='".URLADM."order-itens-menu/index/$id_item_menu?pag=".$this->data['pag']."'><i class='fa-solid fa-arrow-up-short-wide'></i> Ordem</a>"; }
                        if($this->data['button']['view_itens_menu']) {
                        echo "<a class='btn btn-sm btn-outline-primary mx-1' href='".URLADM."view-itens-menu/index/$id_item_menu'><i class='fa-solid fa-eye'></i> Ver</a>"; }
                        if($this->data['button']['edit_itens_menu']) {
                        echo "<a class='btn btn-sm btn-outline-warning mx-1' href='".URLADM."edit-itens-menu/index/$id_item_menu'><i class='fa-solid fa-pen-to-square'></i> Editar</a>"; }
                        if($this->data['button']['delete_itens_menu']) {
                        echo "<a class='btn btn-sm btn-outline-danger mx-1' href='".URLADM."delete-itens-menu/index/$id_item_menu' onclick='return confirm(\"Tem certeza que deseja excluir o registro?\")'><i class='fa-solid fa-trash-can'></i> Apagar</a>"; } 
                        echo "</td>"; } ?>
                </tr> 
                <?php } ?>
            </tbody>
        </table>
        <!-- Inicio da paginação -->
        <?php echo $this->data['pagination'];  ?>
    </div>
</div>