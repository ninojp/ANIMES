<?php
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
if(isset($this->data['form'])){
    //se contiver, atribui para variável:$valorForm
    $valorForm = $this->data['form']; } 
//na posição [0] e quando os dados vem do banco de dados
if(isset($this->data['form'][0])){
    $valorForm = $this->data['form'][0]; } ?>
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Editar Situação</h2>
        </div>
        <?php echo "<div id='msg' class='msg_alert'>";
            if (isset($_SESSION['msg'])) { 
            echo $_SESSION['msg'];
            unset($_SESSION['msg']); }
            echo "</div>"; ?>
        <form class="form_adms" action="" method="POST" id="form-add-sit-user">
            <!-- input oculto pra enviar o id, via post -->
            <input class="form-control" type="hidden" name="id_sits_user" id="id_sits_user" value="<?php if(isset($valorForm['id_sits_user'])){echo $valorForm['id_sits_user'];} ?>">

            <div class="row_edit">
                <label class="" for="name_sits_user">Editar Nome Situação:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="name_sits_user" id="name_sits_user" value="<?php if(isset($valorForm['name_sits_user'])){echo $valorForm['name_sits_user'];} ?>" required>
            </div>
            <div class="row_input">
                <i class="fa-solid fa-hand-pointer"></i>
                <div class="select_input">
                    <label class="mx-3" for="id_color">Cor da Situação:</label>
                    <select name="id_color" id="id_color" required>
                        <option value="">Selecione outra Cor:</option>
                        <?php foreach($this->data['selectCor']['cor'] as $cor){
                            extract($cor);
                            if((isset($valorForm['id_color'])) and ($valorForm['id_color'] == $id_color)){
                                echo "<option value='$id_color' selected>$name_color</option>";
                            } else {
                                echo "<option value='$id_color' style='color:$color_adms;'>$name_color</option>";
                            } } ?>
                    </select>
                </div>
            </div>
            <div class="button_center">
                <button class="btn btn-primary" type="submit" name="SendEditSitUser" value="Editar">Salvar Mudança</button>
            </div>
            <?php if ((!empty($this->data['button']['list_sits_users'])) or (!empty($this->data['button']['add_sits_users'])) or (!empty($this->data['button']['view_sits_users'])) or (!empty($this->data['button']['delete_sits_users']))) {
            echo "<div class='col-12 text-center p-4'>";
                if (!empty($this->data['button']['list_sits_users'])) {
                    echo "<a class='btn btn-sm btn-outline-primary mx-1' href='" . URLADM . "list-sits-users/index'><i class='fa-solid fa-list'></i> Listar</a>"; }
                if (!empty($this->data['button']['add_sits_users'])) {
                    echo "<a class='btn btn-sm btn-outline-success mx-1' href='" . URLADM . "add-sits-users/index'><i class='fa-solid fa-plus'></i> Adicionar</a>"; }
                if (!empty($this->data['button']['view_sits_users'])) {
                    echo "<a class='btn btn-sm btn-outline-warning mx-1' href='" . URLADM . "view-sits-users/index/{$valorForm['id_sits_user']}'><i class='fa-solid fa-eye'></i> Ver</a>"; }
                if (!empty($this->data['button']['delete_sits_users'])) {
                    echo "<a class='btn btn-sm btn-outline-danger mx-1' href='" . URLADM . "delete-sits-users/index/{$valorForm['id_sits_user']}' onclick='return confirm(\"Tem certeza que deseja excluir o registro?\")'><i class='fa-solid fa-trash-can'></i> Apagar</a>"; }
            echo "</div>"; } ?>
        </form>
    </div>
</div>