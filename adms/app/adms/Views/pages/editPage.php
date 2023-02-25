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
            <h2>Editar Página</h2>
        </div>
        <?php echo "<div id='msg' class='msg_alert'>";
            if (isset($_SESSION['msg'])) { 
            echo $_SESSION['msg'];
            unset($_SESSION['msg']); }
            echo "</div>"; ?>
        <form class="form_adms" action="" method="POST" id="form-edit-page">
            <!-- input oculto pra enviar o id, via post -->
            <input class="form-control" type="hidden" name="id_page" id="id_page" value="<?php if(isset($valorForm['id_page'])){echo $valorForm['id_page'];} ?>">

            <div class="row_edit">
                <label class="" for="name">Nome da Página:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="name_page" id="name_page" value="<?php if(isset($valorForm['name_page'])){echo $valorForm['name_page'];} ?>" placeholder="Digite o nome Completo" required>
            </div>
            <div class="row_edit">
                <label class="" for="controller">Classe(controller) da Página:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="controller_page" id="controller_page" value="<?php if(isset($valorForm['controller_page'])){echo $valorForm['controller_page'];} ?>" placeholder="Digite o nome da Classe(controller)">
            </div>
            <div class="row_edit">
                <label class="" for="menu_controller">Classe(menu_controller):</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="menu_controller" id="menu_controller" value="<?php if(isset($valorForm['menu_controller'])){echo $valorForm['menu_controller'];} ?>" placeholder="Digite o Classe(menu_controller)">
            </div>
            <div class="row_edit">
                <label class="" for="metodo_page">Método(Index):</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="metodo_page" id="metodo_page" value="<?php if(isset($valorForm['metodo_page'])){echo $valorForm['metodo_page'];} ?>" placeholder="Digite o nome do método">
            </div>
            <div class="row_edit">
                <label class="" for="menu_metodo">menu_metodo:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="menu_metodo" id="menu_metodo" value="<?php if(isset($valorForm['menu_metodo'])){echo $valorForm['menu_metodo'];} ?>" placeholder="Digite o menu_metodo">
            </div>
            <div class="row_edit">
                <label class="" for="obs_page">Observações da Página:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="obs_page" id="obs_page" value="<?php if(isset($valorForm['obs_page'])){echo $valorForm['obs_page'];} ?>" placeholder="Digite as observações">
            </div>
            <div class="row_edit">
                <label class="" for="icon_menu_page">Icone(class) de Menu:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="icon_menu_page" id="icon_menu_page" value="<?php if(isset($valorForm['icon_menu_page'])){echo $valorForm['icon_menu_page'];} ?>" placeholder="Digite a Classe do icone do Menu">
            </div>
            <div class="row_input">
            <i class="fa-solid fa-hand-pointer"></i>
                <div class="select_input">
                    <label class="mx-3">Página Pública:</label>
                    <select name="public_page" id="public_page" class="" required>
                        <?php
                        if (isset($valorForm['public_page']) and $valorForm['public_page'] == 1) {
                            echo "<option value=''>Selecione</option>";
                            echo "<option value='1' selected>Sim</option>";
                            echo "<option value='2'>Não</option>";
                        } elseif (isset($valorForm['public_page']) and $valorForm['public_page'] == 2) {
                            echo "<option value=''>Selecione</option>";
                            echo "<option value='1'>Sim</option>";
                            echo "<option value='2' selected>Não</option>";
                        } else {
                            echo "<option value='' selected>Selecione</option>";
                            echo "<option value='1'>Sim</option>";
                            echo "<option value='2'>Não</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row_input">
                <i class="fa-solid fa-hand-pointer"></i>
                <div class="select_input">
                    <label class="mx-3" for="id_sits_page">Situação da Pagina: </label>
                    <select name="id_sits_page" id="id_sits_page">
                        <option value="">Selecione</option>
                        <?php foreach($this->data['select']['sit'] as $sit){
                            extract($sit);
                            if((isset($valorForm['id_sits_page'])) and ($valorForm['id_sits_page'] == $id_sit)){
                                echo "<option value='$id_sit' selected>$name_sit</option>";
                            } else {
                                echo "<option value='$id_sit'>$name_sit</option>";
                            } } ?>
                    </select>
                </div>
            </div>
            <div class="row_input">
                <i class="fa-solid fa-hand-pointer"></i>
                <div class="select_input">
                    <label class="mx-3" for="id_type_page">Tipo da Página:</label>
                    <select name="id_type_page" id="id_type_page">
                        <option value="">Selecione</option>
                        <?php foreach($this->data['select']['atp'] as $atp){
                            extract($atp);
                            if((isset($valorForm['id_type_page'])) and ($valorForm['id_type_page'] == $id_atp)){
                                echo "<option value='$id_atp' selected>$type_atp</option>";
                            } else {
                                echo "<option value='$id_atp'>$type_atp</option>";
                            } } ?>
                    </select>
                </div>
            </div>
            <div class="row_input">
                <i class="fa-solid fa-hand-pointer"></i>
                <div class="select_input">
                    <label class="mx-3" for="id_group_page">Grupo de Página:</label>
                    <select name="id_group_page" id="id_group_page">
                        <option value="">Selecione</option>
                        <?php foreach($this->data['select']['agp'] as $agp){
                            extract($agp);
                            if((isset($valorForm['id_group_page'])) and ($valorForm['id_group_page'] == $id_agp)){
                                echo "<option value='$id_agp' selected>$name_agp</option>";
                            } else {
                                echo "<option value='$id_agp'>$name_agp</option>";
                            } } ?>
                    </select>
                </div>
            </div>
            <div class="button_center">
                <button class="btn btn-primary" type="submit" name="SendEditPage" value="Salvar">Salvar Mudanças</button><br>
            </div>
            <div class="col-12 text-center p-4">
                <?php if(($this->data['button']['list_page']) or ($this->data['button']['view_page']) or ($this->data['button']['delete_page']) or ($this->data['button']['add_page'])) {
                    if($this->data['button']['list_page']) { ?>
                    <a class="btn btn-sm btn-outline-success mx-1" href="<?= URLADM; ?>list-page/index"><i class="fa-solid fa-rectangle-list"></i> Listar</a> <?php } ?>
                    <?php if($this->data['button']['add_page']) { ?>
                    <a class="btn btn-sm btn-outline-warning mx-1" href="<?= URLADM; ?>add-page/index"><i class='fa-solid fa-pen-to-square'></i> Adicionar</a> <?php } ?>
                    <?php if($this->data['button']['view_page']) { ?>
                    <a class="btn btn-sm btn-outline-warning mx-1" href="<?= URLADM; ?>view-page/index/<?= $valorForm['id_page']; ?>"><i class="fa-solid fa-eye"></i></i> visualizar</a> <?php } ?>
                    <?php if($this->data['button']['delete_page']) { ?>
                    <a class="btn btn-sm btn-outline-danger mx-1" href="<?= URLADM; ?>delete-page/index/<?= $valorForm['id_page']; ?>" onclick="return confirm('Tem certeza que deseja excluir o registro?')"><i class='fa-solid fa-trash-can'></i> Apagar</a><?php } } ?>
            </div>
        </form>
    </div>
</div>



