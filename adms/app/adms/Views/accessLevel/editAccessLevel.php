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
// var_dump($this->data['form'][0]); ?>
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Editar Nivel de Acesso</h2>
        </div>
        <?php echo "<div id='msg' class='msg_alert'>";
            if (isset($_SESSION['msg'])) { 
            echo $_SESSION['msg'];
            unset($_SESSION['msg']); }
            echo "</div>"; ?>
        <form class="form_adms" action="" method="POST" id="form-edit-access-nivels">
            <!-- input oculto pra enviar o id, via post -->
            <input class="form-control" type="hidden" name="id_access_level" id="id_access_level" value="<?php if(isset($valorForm['id_access_level'])){echo $valorForm['id_access_level'];} ?>">

            <div class="row_edit">
                <label class="" for="access_level">Nome:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="access_level" id="access_level" value="<?php if(isset($valorForm['access_level'])){echo $valorForm['access_level'];} ?>" placeholder="Altere o nome" required>
            </div>
            <div class="row_edit">
                <label class="" for="order_level">Codigo do Nivel:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="order_level" id="order_level" value="<?php if(isset($valorForm['order_level'])){echo $valorForm['order_level'];} ?>" placeholder="Alterar o Codigo do Nivel">
            </div>
            <div class="button_center">
                <button class="btn btn-primary" type="submit" name="SendEditAccessLevel" value="Salvar">Salvar Mudanças</button><br>
            </div>
                <div class="col-12 text-center p-4">
            <?php if($this->data['button']['list_access_level']) { ?>
                <a class="btn btn-sm btn-outline-success mx-2" href="<?= URLADM; ?>list-access-level/index"><i class="fa-solid fa-rectangle-list"></i> Listar</a> <?php }
            if($this->data['button']['view_access_level']) { ?>
                <a class="btn btn-sm btn-outline-warning mx-2" href="<?= URLADM; ?>view-access-level/index/<?=$valorForm['id_access_level']; ?>"><i class='fa-solid fa-pen-to-square'></i> Editar</a> <?php }
            if($this->data['button']['delete_access_level']) { ?>
                <a class="btn btn-sm btn-outline-danger mx-2" href="<?= URLADM; ?>delete-access-level/index/<?=$valorForm['id_access_level']; ?>" onclick="return confirm('Tem certeza que deseja excluir o registro?')"><i class='fa-solid fa-trash-can'></i> Apagar</a> <?php } ?>
            </div>
        </form>
    </div>
</div>



