<?php
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); } ?>
<!-- Inicio do conteudo LISTAR do ADM -->
<div class="wrapper_list">
    <div class="row_list">
        <div class="top_list">
            <div class="col-12 title_content">
                <h2 class="title_h2">Grupos de Paginas</h2>
            </div>
            <div class="row mb-2">
                <div class='col-9 msg_alert'>
                    <?php if (isset($_SESSION['msg'])) { 
                        echo $_SESSION['msg'];
                        unset($_SESSION['msg']); } ?>
                </div>
                <div class="col-3 top_list_right">
                    <a class="btn btn-sm btn_success" href="<?= URLADM.'add-groups-page/index';?>" type="button">Cadastrar Grupo Pg</a>
                </div>
            </div>
        </div>
        <table class="table table-striped table_list">
            <thead class="list_head">
                <tr>
                    <th class="list_head_content">ID</th>
                    <th class="list_head_content">Nome do Grupo</th>
                    <th class="list_head_content tb_sm_none">Ordem Grupos</th>
                    <?php if(($this->data['button']['view_groups_page']) or ($this->data['button']['edit_groups_page']) or ($this->data['button']['delete_groups_page']) or ($this->data['button']['order_groups_page'])) { ?>
                    <th class="list_head_content">Botões de Ações</th> <?php }?>
                </tr>
            </thead>
            <tbody class="list_body">
                <?php foreach ($this->data['listGroupsPgs'] as $groupsPgs) { extract($groupsPgs);  ?>
                <tr>
                    <td class="list_body_content"><?=$id_group_page;?></td>
                    <td class="list_body_content"><?=$name_group_page;?></td>
                    <td class="list_body_content tb_sm_none"><?=$order_group_page;?></td>
                    <?php if(isset($this->data['button']['view_groups_page']) or ($this->data['button']['edit_groups_page']) or ($this->data['button']['delete_groups_page']) or ($this->data['button']['order_groups_page'])) {
                    echo "<td class='list_body_content'>";
                    if($this->data['button']['order_groups_page']) {
                        echo "<a class='btn btn-sm btn-outline-primary mx-1' href='".URLADM."order-groups-page/index/$id_group_page?pag=".$this->data['pag']."'><i class='fa-solid fa-arrow-up-short-wide'></i> Ordem</a>"; }
                    if($this->data['button']['view_groups_page']) {
                        echo "<a class='btn btn-sm btn-outline-primary mx-1' href='".URLADM."view-groups-page/index/$id_group_page'><i class='fa-solid fa-eye'></i> Ver</a>"; }
                    if($this->data['button']['edit_groups_page']) {
                        echo "<a class='btn btn-sm btn-outline-warning mx-1' href='".URLADM."edit-groups-page/index/$id_group_page'><i class='fa-solid fa-pen-to-square'></i> Editar</a>"; }
                    if($this->data['button']['delete_groups_page']) {
                        echo "<a class='btn btn-sm btn-outline-danger mx-1' href='".URLADM."delete-groups-page/index/$id_group_page' onclick='return confirm(\"Tem certeza que deseja excluir o registro?\")'><i class='fa-solid fa-trash-can'></i> Apagar</a>"; } 
                    echo "</td>"; } ?>
                </tr>  <?php } ?>
            </tbody>
        </table>
        <!-- Inicio da paginação -->
        <?php echo $this->data['pagination'];  ?>
    </div>
</div>