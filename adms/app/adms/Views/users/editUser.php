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
            <h2>Editar Usuário</h2>
        </div>
        <?php echo "<div id='msg' class='msg_alert'>";
            if (isset($_SESSION['msg'])) { 
            echo $_SESSION['msg'];
            unset($_SESSION['msg']); }
            echo "</div>"; ?>
        <form class="form_adms" action="" method="POST" id="form-edit-user">
            <!-- input oculto pra enviar o id, via post -->
            <input class="form-control" type="hidden" name="id_user" id="id_user" value="<?php if(isset($valorForm['id_user'])){echo $valorForm['id_user'];} ?>">
            
            <div class="pt-3 text-center">
                <?php if ((!empty($valorForm['adm_img'])) and (file_exists("app/adms/assets/imgs/users/{$valorForm['id_user']}/{$valorForm['adm_img']}"))) {
                        echo "<img src='" . URLADM . "app/adms/assets/imgs/users/{$valorForm['id_user']}/{$valorForm['adm_img']}' width='300' height='200'><br><br>";
                    } else {
                        echo "<img src='" . URLADM . "app/adms/assets/imgs/users/TI_link.png' width='300' height='200'><br><br>";
                    } ?>
            </div>
            <div class="row_edit">
                <label class="" for="adm_user">Alterar Usuário:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="adm_user" id="adm_user" value="<?php if(isset($valorForm['adm_user'])){echo $valorForm['adm_user'];} ?>" placeholder="Alterar o nome do Usuário" required>
            </div>
            <div class="row_edit">
                <label class="" for="adm_email">Alterar Email:</label>
                <i class="fa-solid fa-envelope"></i>
                <input class="form-control" type="email" name="adm_email" id="adm_email" value="<?php if(isset($valorForm['adm_email'])){echo $valorForm['adm_email'];} ?>" placeholder="Edite o E-mail" required>
            </div>
            <div class="row_input">
                <i class="fa-solid fa-hand-pointer"></i>
                <div class="select_input">
                    <label class="mx-3" for="id_sits_user">Alterar Situação: </label>
                    <select name="id_sits_user" id="id_sits_user">
                        <option value="">Selecione</option>
                        <?php foreach($this->data['select']['sit'] as $sit){
                            extract($sit);
                            //verifica se existe, E SE É IGUAL ao valor do id
                            if((isset($valorForm['id_sits_user'])) and ($valorForm['id_sits_user'] == $id_sits_user)){
                                echo "<option value='$id_sits_user' selected>$name_sits_user</option>";
                            } else {
                                echo "<option value='$id_sits_user'>$name_sits_user</option>";
                            } } ?>
                    </select>
                </div>
            </div>
            <div class="row_input">
                <i class="fa-solid fa-hand-pointer"></i>
                <div class="select_input">
                    <label class="mx-3" for="id_access_level">Nivel de Acesso:</label>
                    <select name="id_access_level" id="id_access_level">
                        <option value="">Selecione</option>
                        <?php foreach($this->data['select']['lev'] as $lev){
                            extract($lev);
                            if((isset($valorForm['id_access_level'])) and ($valorForm['id_access_level'] == $id_access_level)){
                                echo "<option value='$id_access_level' selected>$access_level</option>";
                            } else {
                                echo "<option value='$id_access_level'>$access_level</option>";
                            } } ?>
                    </select>
                </div>
            </div>
            <div class="button_center">
                <button class="btn btn-primary" type="submit" name="SendEditUser" value="Salvar">Salvar Mudanças</button><br>
            </div>
            <div class="col-12 text-center p-4">
                <?php if($this->data['button']['list_user']) { ?>
                    <a class="btn btn-sm btn-outline-success mx-2" href="<?= URLADM; ?>list-user/index"><i class="fa-solid fa-rectangle-list"></i> Listar</a> <?php }
                if($this->data['button']['view_user']) { ?>
                    <a class="btn btn-sm btn-outline-warning mx-2" href="<?= URLADM; ?>view-user/index/<?= $valorForm['id_user']; ?>"><i class='fa-solid fa-pen-to-square'></i> Ver</a> <?php }
                if($this->data['button']['edit_user_pass']) { ?>
                    <a class="btn btn-sm btn-outline-info mx-2" href="<?= URLADM; ?>edit-user-pass/index/<?= $valorForm['id_user']; ?>"><i class="fa-solid fa-unlock-keyhole"></i> Edit Senha</a><?php }
                if($this->data['button']['edit_user_image']) { ?>
                    <a class="btn btn-sm btn-outline-primary mx-4" href="<?= URLADM; ?>edit-user-image/index/<?= $valorForm['id_user']; ?>"><i class="fa-solid fa-image"></i> Edit Imagem</a> <?php }
                if($this->data['button']['delete_user']) { ?>
                    <a class="btn btn-sm btn-outline-danger mx-2" href="<?= URLADM; ?>delete-user/index/<?= $valorForm['id_user']; ?>" onclick="return confirm('Tem certeza que deseja excluir o registro?')"><i class='fa-solid fa-trash-can'></i> Apagar</a> <?php } ?>
            </div>
        </form>
    </div>
</div>



