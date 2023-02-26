<?php
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); } ?>
<!-- Inicio do conteudo LISTAR do ADM -->
<div class="wrapper_list">
    <div class="row_list">
        <div class="top_list">
            <div class="col-12 title_content">
                <h2 class="title_h2">Situações das Paginas</h2>
            </div>
            <div class="row mb-2">
                <div class='col-9 msg_alert'>
                    <?php if (isset($_SESSION['msg'])) { 
                        echo $_SESSION['msg'];
                        unset($_SESSION['msg']); } ?>
                </div>
                <?php if(!empty($this->data['button']['add_sits_page'])) {
                echo "<div class='col-3 top_list_right'>";
                echo "<a class='btn btn-sm btn_success' href='".URLADM."add-sits-page/index' type='button'>Cadastrar Situação Pg</a>";
                echo "</div>"; } ?>
            </div>
        </div>
        <table class="table table-striped table_list">
            <thead class="list_head">
                <tr>
                    <th class="list_head_content">ID</th>
                    <th class="list_head_content">Nome da Situação</th>
                    <th class="list_head_content tb_sm_none">Cor Situação</th>
                    <?php if((!empty($this->data['button']['view_sits_page'])) or (!empty($this->data['button']['edit_sits_page'])) or (!empty($this->data['button']['delete_sits_page']))) { 
                    echo "<th class='list_head_content'>Botões de Ações</th>"; } ?>
                </tr>
            </thead>
            <tbody class="list_body">
                <?php foreach ($this->data['listSitsPgs'] as $listSits) { extract($listSits);  ?>
                <tr>
                    <td class="list_body_content"><?=$id_sits_page;?></td>
                    <td class="list_body_content"><?=$name_sits_page;?></td>
                    <td class="list_body_content tb_sm_none"><span style='color:<?=$color_adms;?>'><?=$name_color;?></span></td>
                    <?php if((!empty($this->data['button']['view_sits_page'])) or (!empty($this->data['button']['edit_sits_page'])) or (!empty($this->data['button']['delete_sits_page']))) { 
                        echo "<td class='list_body_content'>";
                        if(!empty($this->data['button']['view_sits_page'])) {
                            echo "<a class='btn btn-sm btn-outline-primary mx-1' href='".URLADM."view-sits-page/index/$id_sits_page'><i class='fa-solid fa-eye'></i> Ver</a>"; }
                        if(!empty($this->data['button']['edit_sits_page'])) { 
                            echo "<a class='btn btn-sm btn-outline-warning mx-1' href='".URLADM."edit-sits-page/index/$id_sits_page'><i class='fa-solid fa-pen-to-square'></i> Editar</a>"; }
                        if(!empty($this->data['button']['delete_sits_page'])) {
                            echo "<a class='btn btn-sm btn-outline-danger mx-1' href='".URLADM."delete-sits-page/index/$id_sits_page' onclick='return confirm(\"Tem certeza que deseja excluir o registro?\")'><i class='fa-solid fa-trash-can'></i> Apagar</a>"; }
                        echo "</td>"; } 
                    echo "</tr>"; } ?>
            </tbody>
        </table>
        <!-- Inicio da paginação -->
        <?php echo $this->data['pagination'];  ?>
    </div>
</div>