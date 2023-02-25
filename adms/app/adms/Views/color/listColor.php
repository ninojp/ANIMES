<?php
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); } ?>
<!-- Inicio do conteudo LISTAR do ADM -->
<div class="wrapper_list">
    <div class="row_list">
        <div class="top_list">
            <span class="title_content">
                <h2 class="title_h2">Listar Cores</h2>
            </span>
            <div class="div_row_msg_btn">
            <div class="col-9 msg_alert">
                <!-- Mensagens de avisos -->
                <?php if (isset($_SESSION['msg'])) {
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']); }?>
            </div>
            <?php if($this->data['button']['add_color']) {?>
                    <div class="col-3 top_list_right">
                        <a class="btn btn-sm btn_success" href="<?= URLADM.'add-color/index';?>" type="button">Cadastrar Cor</a>
                    </div>
                <?php }?>
            </div>
        </div>
        <table class="table table-striped table_list">
            <thead class="list_head">
                <tr>
                    <th class="list_head_content">ID</th>
                    <th class="list_head_content">Nome da Cor</th>
                    <!-- classe:tb_sm_none para OCULTAR o item em resolucão menores -->
                    <th class="list_head_content tb_sm_none">Codigo da Cor</th>
                    <?php if(($this->data['button']['view_color']) or ($this->data['button']['edit_color']) or ($this->data['button']['delete_color'])) { ?>
                    <th class="list_head_content">Botões de Ações</th><?php } ?>
                </tr>
            </thead>
            <tbody class="list_body">
                <?php foreach ($this->data['listColor'] as $colorList) { extract($colorList);  ?>
                <tr>
                    <td class="list_body_content"><?=$id_color;?></td>
                    <td class="list_body_content"><span style='background-color:<?=$color_adms;?>;color:#fff;'><?=$name_color?></span></td>
                    <td class="list_body_content tb_sm_none"><span style='color:<?=$color_adms;?>'><?=$color_adms;?></span></td>
                    <?php if(($this->data['button']['view_color']) or ($this->data['button']['edit_color']) or ($this->data['button']['delete_color'])) { 
                        echo "<td class='list_body_content'>";
                        if($this->data['button']['view_color']) {
                            echo "<a class='btn btn-sm btn-outline-primary mx-1' href='".URLADM."view-color/index/$id_color'><i class='fa-solid fa-eye'></i> Ver</a>"; }
                        if($this->data['button']['edit_color']) { 
                            echo "<a class='btn btn-sm btn-outline-warning mx-1' href='".URLADM."edit-color/index/$id_color'><i class='fa-solid fa-pen-to-square'></i> Editar</a>"; }
                        if($this->data['button']['delete_color']) {
                            echo "<a class='btn btn-sm btn-outline-danger mx-1' href='".URLADM."delete-color/index/$id_color' onclick='return confirm(\"Tem certeza que deseja excluir o registro?\")'><i class='fa-solid fa-trash-can'></i> Apagar</a>"; }
                        echo "</td>";
                    } 
                echo "</tr>";
                } ?>
            </tbody>
        </table>
        <!-- Inicio da paginação -->
        <?php echo $this->data['pagination']; ?>
    </div>
</div>