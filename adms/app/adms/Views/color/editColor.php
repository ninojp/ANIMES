<?php
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
//verifica, se contém dados no array:$this->data['form']
if(isset($this->data['form'])){
    //se contiver, atribui para variável:$valorForm
    $valorForm = $this->data['form']; } 
//na posição [0] e quando os dados vem do banco de dados
if(isset($this->data['form'][0])){
    $valorForm = $this->data['form'][0]; } ?>
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Editar Cor</h2>
        </div>
        <?php echo "<div id='msg' class='msg_alert'>";
            if (isset($_SESSION['msg'])) { 
            echo $_SESSION['msg'];
            unset($_SESSION['msg']); }
            echo "</div>"; ?>
        <form class="form_adms" action="" method="POST" id="form-add-colors">
            <!-- input oculto pra enviar o id, via post -->
            <input class="form-control" type="hidden" name="id_color" id="id_color" value="<?php if(isset($valorForm['id_color'])){echo $valorForm['id_color'];} ?>" required>

            <div class="row_edit">
                <label class="" for="name_color">Editar o Nome Cor:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="name_color" id="name_color" value="<?php if(isset($valorForm['name_color'])){echo $valorForm['name_color'];}?>" required>
            </div>
            <div class="row_edit">
                <?php $color_adms="";
                if(isset($valorForm['color_adms'])){
                    $color_adms = $valorForm['color_adms'];} ?>
                    <label class="" for="color_adms">Selecione a Cor:</label>
                    <i class="fa-solid fa-palette"></i>
                    <input class="form-control" type="color" name="color_adms" id="color_adms" value="<?php echo $color_adms; ?>" placeholder="Código da Cor">
            </div>
            <div class="button_center">
                <button class="btn btn-primary" type="submit" name="SendEditColor" value="Editar">Salvar Mudança</button>
            </div>
             <div class="col-12 text-center p-4">
            <?php if(($this->data['button']['list_color']) or ($this->data['button']['view_color']) or ($this->data['button']['delete_color']) or ($this->data['button']['add_color'])) {
                if($this->data['button']['list_color']) { ?>
                <a class="btn btn-sm btn-outline-success mx-1" href="<?= URLADM; ?>list-color/index"><i class="fa-solid fa-rectangle-list"></i> Listar</a> <?php } ?>
                <?php if($this->data['button']['add_color']) { ?>
                <a class="btn btn-sm btn-outline-warning mx-1" href="<?= URLADM; ?>add-color/index"><i class='fa-solid fa-pen-to-square'></i> Adicionar</a> <?php } ?>
                <?php if($this->data['button']['view_color']) { ?>
                <a class="btn btn-sm btn-outline-warning mx-1" href="<?= URLADM; ?>view-color/index/<?= $valorForm['id_color']; ?>"><i class='fa-solid fa-pen-to-square'></i> Visualizar</a><?php } ?>
                <?php if($this->data['button']['delete_color']) { ?>
                <a class="btn btn-sm btn-outline-danger mx-1" href="<?= URLADM; ?>delete-color/index/<?= $valorForm['id_color']; ?>" onclick="return confirm('Tem certeza que deseja excluir o registro?')"><i class='fa-solid fa-trash-can'></i> Apagar</a><?php } } ?>
            </div>
        </form>
    </div>
</div>