<?php
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
// Manter os dados no formulário     
if (isset($this->data['form'])) {
    // var_dump($this->data['form']);
    $valorForm = $this->data['form']; } ?>
<!-- Inicio do conteudo LISTAR do ADM -->
<div class="wrapper_list">
    <div class="row_list">
        <div class="top_list">
            <div class="title_content">
                <h2 class="title_h2">Listar Niveis de acesso</h2>
            </div>
            <div class="div_row_msg_btn">
                <div class="col-8 msg_alert">
                    <!-- Mensagens de avisos -->
                    <?php if (isset($_SESSION['msg'])) {
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']); } ?>
                </div>
                <div class="col-4 top_list_right">
                    <a class="btn btn-sm btn_success" href="<?= URLADM.'add-access-level/index';?>" type="button">Cadastrar Nivel</a>
                    <a class="btn btn-sm btn_warning" href="<?= URLADM.'sync-page-level/index';?>" type="button">Sincronizar</a>
                </div>
            </div>
            <!-- DIV com o campo de pesquisa -->
            <div class="div_row_form">
                <form class="form_pesquisar" action="" name="form_pesquisar" method="POST">
                    <div class="row_form_pesquisar">
                        <div class="col-4">
                            <?php $search_name = "";
                            if (isset($valorForm['search_name'])) {
                                $search_name = $valorForm['search_name'];
                            } ?>
                            <label class="">Nome do Nivel: </label>
                            <input type="text" name="search_name" id="seach_name" value="<?php echo $search_name; ?>" placeholder="Pesquisar pelo nome">
                        </div>
                        <div class="col-3">
                            <button  class="btn btn-sm btn-outline-info" type="submit" name="SendSearchAccessLevel" value="Pesquisar">Pesquisar, nome do Nivel</button>
                        </div>
                        <div class="col-4">
                            <?php $search_access_nivels = "";
                            if (isset($valorForm['search_access_nivels'])) {
                                $search_access_nivels = $valorForm['search_access_nivels'];
                            } ?>
                            <label class="">Order Level: </label>
                            <input type="text" name="search_access_nivels" id="search_access_nivels" value="<?= $search_access_nivels; ?>" placeholder="Pesquisar pela Ordem de Acesso">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-striped table_list">
            <thead class="list_head">
                <tr>
                    <th class="list_head_content">ID</th>
                    <th class="list_head_content">Nome do Nivel</th>
                    <!-- classe:tb_sm_none para OCULTAR o item em resolucão menores -->
                    <th class="list_head_content tb_sm_none">Ordem do Nivel</th>
                    <?php if((!empty($this->data['button']['order_access_level'])) or (!empty($this->data['button']['list_permission'])) or (!empty($this->data['button']['view_access_level'])) or (!empty($this->data['button']['edit_access_level'])) or (!empty($this->data['button']['delete_access_level']))) { 
                    echo "<th class='list_head_content'>Botões de Ações</th>"; } ?>
                    
                </tr>
            </thead>
            <?php
            // var_dump($this->data['listAccessNivels']);
            ?>
            <tbody class="list_body">
                <?php foreach ($this->data['listAccessLevel'] as $AccessNivels) { extract($AccessNivels); ?>
                <tr>
                    <td class="list_body_content"><?=$id_access_level;?></td>
                    <td class="list_body_content"><?=$access_level;?></td>
                    <td class="list_body_content tb_sm_none"><?=$order_level;?></td>
                    <?php if((!empty($this->data['button']['order_access_level'])) or (!empty($this->data['button']['list_permission'])) or (!empty($this->data['button']['view_access_level'])) or (!empty($this->data['button']['edit_access_level'])) or (!empty($this->data['button']['delete_access_level']))) { 
                    echo "<td class='list_body_content'>";
                        if(!empty($this->data['button']['order_access_level'])) {
                        echo "<a class='btn btn-sm btn-outline-primary mx-1' href='".URLADM."order-access-level/index/$id_access_level?pag=".$this->data['pag']."'><i class='fa-solid fa-arrow-up-short-wide'></i> Ordenar</a>"; }
                        if(!empty($this->data['button']['list_permission'])) {
                        echo "<a class='btn btn-sm btn-outline-primary mx-1' href='".URLADM."list-permission/index?level=$id_access_level'><i class='icon fa-solid fa-user-lock'></i> Permissão</a>"; }
                        if(!empty($this->data['button']['view_access_level'])) {
                        echo "<a class='btn btn-sm btn-outline-primary mx-1' href='".URLADM."view-access-level/index/$id_access_level'><i class='fa-solid fa-eye'></i> Ver</a>"; }
                        if(!empty($this->data['button']['edit_access_level'])) {
                        echo "<a class='btn btn-sm btn-outline-warning mx-1' href='".URLADM."edit-access-level/index/$id_access_level'><i class='fa-solid fa-pen-to-square'></i> Editar</a>"; }
                        if(!empty($this->data['button']['delete_access_level'])) {
                        echo "<a class='btn btn-sm btn-outline-danger mx-1' href='".URLADM."delete-access-level/index/$id_access_level' onclick='return confirm(\"Tem certeza que deseja excluir o registro?\")'><i class='fa-solid fa-trash-can'></i> Apagar</a>"; } 
                    echo "</td>"; } ?>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <!-- Inicio da paginação -->
        <?php echo $this->data['pagination']; ?>
    </div>
</div>