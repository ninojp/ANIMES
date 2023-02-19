<?php
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
// Manter os dados no formulário de PESQUISA   
if (isset($this->data['form'])) {
    // var_dump($this->data['form']);
    $valorForm = $this->data['form'];
}
// var_dump($this->data);
// var_dump($this->data['listUser']);
?>

<!-- Inicio do conteudo LISTAR do ADM -->
<div class="wrapper_list">
    <div class="row_list">
        <div class="top_list">
            <div class="title_content">
                <h2 class="title_h2">Listar Usuários</h2>
            </div>
            <div class="div_row_msg_btn">
                <div class="col-9 msg_alert">
                    <!-- Mensagens de avisos -->
                    <?php if (isset($_SESSION['msg'])) {
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']); } ?>
                </div>
                <?php if($this->data['button']['add_user']) {?>
                    <div class="col-3 top_list_right">
                        <a class="btn btn-sm btn_success" href="<?= URLADM.'add-user/index';?>" type="button">Cadastrar Usuário</a>
                    </div>
                <?php }?>
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
                            <label for="search_name">Nome: </label>
                            <input type="text" name="search_name" id="search_name" value="<?php echo $search_name; ?>" placeholder="Pesquisar pelo nome">
                        </div>
                        <div class="col-3">
                            <button  class="btn btn-sm btn-outline-info" type="submit" name="SendSearchUser" value="Pesquisar">Pesquisar por nome ou e-mail</button>
                        </div>
                        <div class="col-4">
                            <?php $search_email = "";
                            if (isset($valorForm['search_email'])) {
                                $search_email = $valorForm['search_email'];
                            } ?>
                            <label for="seach_email">E-mail: </label>
                            <input type="text" name="search_email" id="seach_email" value="<?= $search_email; ?>" placeholder="Pesquisar pelo e-mail">
                        </div>
                    </div>
                </form>
            </div>
            
        </div>
        <table class="table table-striped table_list">
            <thead class="list_head">
                <tr>
                    <th class="list_head_content">ID</th>
                    <th class="list_head_content">Nome</th>
                    <!-- classe:tb_sm_none para OCULTAR o item em resolucão menores -->
                    <th class="list_head_content tb_sm_none">E-mail</th>
                    <th class="list_head_content tb_sm_none">Situação Cadastral</th>
                    <th class="list_head_content">Botões de Ações</th>
                </tr>
            </thead>
            <tbody class="list_body">
                <?php foreach ($this->data['listUser'] as $user) { extract($user); 
                    // var_dump($user); ?>
                <tr>
                    <td class="list_body_content"><?=$id_user;?></td>
                    <td class="list_body_content"><?=$adm_user;?></td>
                    <td class="list_body_content tb_sm_none"><?=$adm_email;?></td>
                    <td class="list_body_content tb_sm_none"><span style='color:<?=$color_adms;?>'><?=$name_sits_user;?></span></td>
                    <td class="list_body_content">
                        <?php if($this->data['button']['view_user']) {
                            echo "<a class='btn btn-sm btn-outline-primary mx-1' href='".URLADM."view-user/index/$id_user'><i class='fa-solid fa-eye'></i> Ver</a>"; }
                        if($this->data['button']['edit_user']) {
                            echo "<a class='btn btn-sm btn-outline-warning mx-1' href='".URLADM."edit-user/index/$id_user'><i class='fa-solid fa-pen-to-square'></i> Editar</a>"; }
                        if($this->data['button']['delete_user']) {
                        echo "<a class='btn btn-sm btn-outline-danger mx-1' href='".URLADM."delete-user/index/$id_user' onclick='return confirm(\"Tem certeza que deseja excluir o registro?\")'><i class='fa-solid fa-trash-can'></i> Apagar</a>"; } ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <!-- Inicio da paginação -->
        <?php echo $this->data['pagination']; ?>
    </div>
</div>