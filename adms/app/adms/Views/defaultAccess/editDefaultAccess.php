<?php
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
// Manter os dados no formulário     
if(isset($this->data['form'])){
    $valorForm = $this->data['form']; } 
//na posição [0] e quando os dados vem do banco de dados
if(isset($this->data['form'][0])){
    $valorForm = $this->data['form'][0]; } 
// var_dump($this->data['form']); 
// var_dump($this->data['select']['sit']);
// var_dump($this->data['select']['lev']); ?>
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Editar as Configurações<br> dos novos Usuários</h2>
        </div>
        <?php echo "<div id='msg' class='msg_alert'>";
            if (isset($_SESSION['msg'])) { 
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);}
            echo "</div>"; ?>
        <form class="form_adms" action="" method="POST" id="form-edit-level-form">
            <!-- input oculto pra enviar o id, via post -->
            <input class="form-control" type="hidden" name="id_default_access" id="id_default_access" value="<?php if(isset($valorForm['id_default_access'])){echo $valorForm['id_default_access'];} ?>">

            <div class="row_input">
                <i class="fa-solid fa-hand-pointer"></i>
                <div class="select_input">
                    <label class="mx-3" for="id_access_level">Nivel de Acesso (New User):</label>
                    <select name="id_access_level" id="id_access_level" required>
                        <option value="">Selecione</option>
                        <?php foreach($this->data['select']['lev'] as $lev){
                            extract($lev);
                            //verifica se existe, E SE É IGUAL ao valor do id
                            if((isset($valorForm['id_access_level'])) and ($valorForm['id_access_level'] == $id_access_level)){
                                echo "<option value='$id_access_level' selected>$access_level</option>";
                            } else {
                                echo "<option value='$id_access_level'>$access_level</option>";
                            } } ?>
                    </select>
                </div>
            </div>
            <div class="row_input">
                <i class="fa-solid fa-hand-pointer"></i>
                <div class="select_input">
                    <label class="mx-3" for="id_sits_user"> Situação (New User): </label>
                    <select name="id_sits_user" id="id_sits_user" required>
                        <option value="">Selecione</option>
                        <?php foreach($this->data['select']['sit'] as $sit){
                            extract($sit);
                            if((isset($valorForm['id_sits_user'])) and ($valorForm['id_sits_user'] == $id_sits_user)){
                                echo "<option value='$id_sits_user' selected>$name_sits_user</option>";
                            } else {
                                echo "<option value='$id_sits_user'>$name_sits_user</option>";
                            } } ?>
                    </select>
                </div>
            </div>
            <div class="button_center">
                <button class="btn btn-primary" type="submit" name="SendEditLevelForm" value="Salvar">Salvar Mudanças</button><br>
            </div>
            <div class="button_center">
                <?php if(isset($valorForm['id_default_access'])){
                    echo "<a class='btn btn-sm btn-outline-warning mx-2' href='".URLADM."view-default-Access/index/".$valorForm['id_default_access']."'> Visualizar </a>";
                } ?>
            </div>
        </form>
    </div>
</div>



