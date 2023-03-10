<?php
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
// Manter os dados no formulário     
if (isset($this->data['form'])) {
    // var_dump($this->data['form']);
    $valorForm = $this->data['form'];
} ?>

<!-- Inicio do conteudo LISTAR do ADM -->
<div class="wrapper_list">
    <div class="row_list">
        <div class="top_list">
            <div class="title_content">
                <h2 class="title_h2">Listar Tipos de Paginas</h2>
            </div>
            <div class="div_row_msg_btn">
                <div class="col-9 msg_alert">
                    <!-- Mensagens de avisos -->
                    <?php if (isset($_SESSION['msg'])) {
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']); } ?>
                </div>
                <?php if(!empty($this->data['button']['add_types_page'])) { 
                    echo "<div class='col-3 top_list_right'>";
                        echo "<a class='btn btn-sm btn_success' href='".URLADM."add-types-page/index'; type='button'>Cadastrar Tipo Pgs</a>";
                    echo "</div>"; } ?>
            </div>
            <!-- DIV com o campo de pesquisa -->
            <div class="div_row_form">
                <form class="form_pesquisar" action="" name="form_pesquisar" method="POST">
                    <div class="row_form_pesquisar">
                        <div class="col-4">
                            <?php $search_name = "";
                            if (isset($valorForm['search_name'])) {
                                $search_name = $valorForm['search_name']; } ?>
                            <label class="">Nome: </label>
                            <input type="text" name="search_name" id="seach_name" value="<?php echo $search_name; ?>" placeholder="Pesquisar pelo nome">
                        </div>
                        <div class="col-3">
                            <button  class="btn btn-sm btn-outline-info" type="submit" name="SendSearchType" value="Pesquisar">Pesquisar por nome ou Tipo</button>
                        </div>
                        <div class="col-4">
                            <?php $search_type = "";
                            if (isset($valorForm['search_type'])) {
                                $search_type = $valorForm['search_type']; } ?>
                            <label class="">Tipo de Pgs: </label>
                            <input type="text" name="search_type" id="seach_type" value="<?= $search_type; ?>" placeholder="Pesquisar pelo Tipo">
                        </div>
                    </div>
                </form>
            </div>
            
        </div>
        <table class="table table-striped table_list">
            <thead class="list_head">
                <tr>
                    <th class="list_head_content">ID</th>
                    <th class="list_head_content">Tipo</th>
                    <th class="list_head_content">Nome do Tipo</th>
                    <!-- classe:tb_sm_none para OCULTAR o item em resolucão menores -->
                    <th class="list_head_content tb_sm_none">order_type_pg</th>
                    <?php if((!empty($this->data['button']['order_types_page'])) or (!empty($this->data['button']['view_types_page'])) or (!empty($this->data['button']['edit_types_page'])) or (!empty($this->data['button']['delete_types_page']))) { 
                        echo "<th class='list_head_content'>Botões de Ações</th>"; } ?>
                </tr>
            </thead>
            <tbody class="list_body">
                <?php foreach ($this->data['listTypesPgs'] as $typePgs) { extract($typePgs);  ?>
                <tr>
                    <td class="list_body_content"><?=$id_type_page;?></td>
                    <td class="list_body_content"><?=$type_page;?></td>
                    <td class="list_body_content"><?=$name_type_page;?></td>
                    <td class="list_body_content tb_sm_none"><?=$order_type_page;?></td>
                    <?php if((!empty($this->data['button']['order_types_page'])) or (!empty($this->data['button']['view_types_page'])) or (!empty($this->data['button']['edit_types_page'])) or (!empty($this->data['button']['delete_types_page']))) { 
                        echo "<td class='list_body_content'>";
                        if(!empty($this->data['button']['order_types_page'])) {
                            echo "<a class='btn btn-sm btn-outline-primary mx-1' href='".URLADM."order-types-page/index/$id_type_page?pag=".$this->data['pag']."'><i class='fa-solid fa-arrow-up-short-wide'></i> Ordenar</a>"; }
                        if(!empty($this->data['button']['view_types_page'])) {
                            echo "<a class='btn btn-sm btn-outline-primary mx-1' href='".URLADM."view-types-page/index/$id_type_page'><i class='fa-solid fa-eye'></i> Ver</a>"; }
                        if(!empty($this->data['button']['edit_types_page'])) { 
                            echo "<a class='btn btn-sm btn-outline-warning mx-1' href='".URLADM."edit-types-page/index/$id_type_page'><i class='fa-solid fa-pen-to-square'></i> Editar</a>"; }
                        if(!empty($this->data['button']['delete_types_page'])) {
                            echo "<a class='btn btn-sm btn-outline-danger mx-1' href='".URLADM."delete-types-page/index/$id_type_page' onclick='return confirm(\"Tem certeza que deseja excluir o registro?\")'><i class='fa-solid fa-trash-can'></i> Apagar</a>"; }
                    echo "</td>"; } 
                echo "</tr>"; } ?>
            </tbody>
        </table>
        <!-- Inicio da paginação -->
        <?php echo $this->data['pagination']; ?>
    </div>
</div>