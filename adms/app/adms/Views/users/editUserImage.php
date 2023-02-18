<?php
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
// Manter os dados no formulário     
if (isset($this->data['form'])) {
    $valorForm = $this->data['form']; }
//na posição [0] e quando os dados vem do banco de dados
if (isset($this->data['form'][0])) {
    $valorForm = $this->data['form'][0]; } ?>
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Editar Imagem do Usuário</h2>
        </div>
        <?php echo "<div id='msg' class='msg_alert'>";
            if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']); }
            echo "</div>"; ?>
        <!--OBRIGATóRIO o enctype="multipart/form-data", para trabalhar com imagens dentro de formulários-->
        <form class="form_adms" action="" method="POST" id="form-edit-user-img" enctype="multipart/form-data">
            <!-- input oculto pra enviar o id, via post -->
            <input class="form-control" type="hidden" name="id_user" id="id_user" value="<?php if (isset($valorForm['id_user'])) { echo $valorForm['id_user']; } ?>">

            <div class="text-center">
                <?php if ((!empty($valorForm['adm_img'])) and (file_exists("app/adms/assets/imgs/users/" . $valorForm['id_user'] . "/" . $valorForm['adm_img']))) {
                    $old_img = URLADM . "app/adms/assets/imgs/users/" . $valorForm['id_user'] . "/" . $valorForm['adm_img'];
                } else {
                    $old_img = URLADM . "app/adms/assets/imgs/users/TI_link.png";
                } ?>
                <span id="preview-img">
                    <img src="<?= $old_img; ?>" alt="Imagem" style="width: 300px;height: 300px;">
                </span>
            </div>
            <div class="row_edit">
                <label class="" for="image">Selecione uma Imagem: (300x300px)</label>
                <i class="fa-solid fa-image"></i>
                <input class="form-control" type="file" name="new_image" id="new_image" onchange="inputFileValImg()" required>
            </div>
            <div class="button_center">
                <button class="btn btn-primary" type="submit" name="SendEditUserImage" value="Salvar">Salvar Mudança</button>
            </div>
            <div class="col-12 text-center p-4">
                <?php if($this->data['button']['list_user']) { ?>
                    <a class="btn btn-sm btn-outline-success mx-2" href="<?= URLADM; ?>list-user/index"><i class="fa-solid fa-rectangle-list"></i> Listar Usuários</a> <?php }
                if($this->data['button']['view_user']) { ?>
                    <a class="btn btn-sm btn-outline-warning mx-2" href="<?= URLADM; ?>view-user/index/<?= $valorForm['id_user']; ?>"><i class='fa-solid fa-pen-to-square'></i> Visualizar Usuário</a> <?php } ?>
            </div>
        </form>
    </div>
</div>