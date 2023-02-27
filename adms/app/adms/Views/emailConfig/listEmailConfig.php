<?php
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); } ?>
<div class="wrapper_list">
    <div class="row_list">
        <div class="top_list">
            <span class="title_content">
                <h2 class="title_h2">Listar Configurações de E-mail</h2>
            </span>
            <div id="msg" class="msg_alert">
                <!-- Mensagens de avisos -->
                <?php if (isset($_SESSION['msg'])) {
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']); }?>
            </div>
            <?php if(!empty($this->data['button']['add_email_config'])) {
                    echo "<div class='col-3 top_list_right'>";
                        echo "<a class='btn btn-sm btn_success' href='".URLADM."add-email-config/index'> type='button'>Cadastrar</a>";
                    echo "</div>"; }?>
        </div>
        <table class="table table-striped table_list">
            <thead class="list_head">
                <tr>
                    <th class="list_head_content">ID</th>
                    <th class="list_head_content">Titulo</th>
                    <th class="list_head_content">Nome</th>
                    <th class="list_head_content">E-mail</th>
                    <?php if((!empty($this->data['button']['view_email_config'])) or (!empty($this->data['button']['edit_email_config'])) or (!empty($this->data['button']['delete_email_config']))) {echo "<th class='list_head_content'>Botões de Ações</th>"; }?>
                </tr>
            </thead>
            <tbody class="list_body">
                <?php foreach ($this->data['listEmails'] as $emails) { extract($emails);  ?>
                <tr>
                    <td class="list_body_content"><?=$id_email_config;?></td>
                    <td class="list_body_content"><?=$title_email_config;?></td>
                    <td class="list_body_content"><?=$name_email_config;?></td>
                    <td class="list_body_content"><?=$email_config;?></td>
                    <?php if((!empty($this->data['button']['view_email_config'])) or (!empty($this->data['button']['edit_email_config'])) or (!empty($this->data['button']['delete_email_config']))) { 
                        echo "<td class='list_body_content'>";
                            if(!empty($this->data['button']['view_email_config'])) {
                                echo "<a class='btn btn-sm btn-outline-primary mx-1' href='".URLADM."view-email-config/index/$id_email_config'><i class='fa-solid fa-eye'></i> Ver</a>"; }
                            if(!empty($this->data['button']['edit_email_config'])) { 
                                echo "<a class='btn btn-sm btn-outline-warning mx-1' href='".URLADM."edit-email-config/index/$id_email_config'><i class='fa-solid fa-pen-to-square'></i> Editar</a>"; }
                            if(!empty($this->data['button']['delete_email_config'])) {
                                echo "<a class='btn btn-sm btn-outline-danger mx-1' href='".URLADM."delete-email-config/index/$id_email_config' onclick='return confirm(\"Tem certeza que deseja excluir o registro?\")'><i class='fa-solid fa-trash-can'></i> Apagar</a>"; }
                        echo "</td>"; } 
                echo "</tr>"; } ?>
        </table>
        <!-- Inicio da paginação -->
        <?php echo $this->data['pagination']; ?>
    </div>
</div>
