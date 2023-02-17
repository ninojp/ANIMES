<?php
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
// echo "Views/login/login.php <h1> Pagina(view) para fazer o login</h1>";
// Manter os dados no formulário     
if (isset($this->data['form'])) {
    // var_dump($this->data['form']);
    $valorForm = $this->data['form']; } ?>
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Cadastrar Nova Página</h2>
        </div>
        <?php echo "<div id='msg' class='msg_alert'>";
            if (isset($_SESSION['msg'])) { 
            echo $_SESSION['msg'];
            unset($_SESSION['msg']); }
            echo "</div>";?>
        <form class="form_adms" action="" method="POST" id="form-add-page">
            <div class="row_input">
                <?php $name_page = "";
                if (isset($valorForm['name_page'])) {
                    $name_page = $valorForm['name_page']; } ?>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="name_page" id="name_page" value="<?php echo $name_page; ?>" placeholder="Digite o nome da Página *" required>
            </div>
            <div class="row_input">
                <?php $controller_page = "";
                if (isset($valorForm['controller_page'])) {
                    $controller_page = $valorForm['controller_page']; } ?>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="controller_page" id="controller_page" value="<?php echo $controller_page; ?>" placeholder="Digite o nome da Classe(controllers) *" required>
            </div>
            <div class="row_input">
                <?php $menu_controller = "";
                if (isset($valorForm['menu_controller'])) {
                    $menu_controller = $valorForm['menu_controller']; } ?>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="menu_controller" id="menu_controller" value="<?php echo $menu_controller; ?>" placeholder="Digite o nome menu_controller *" required>
            </div>
            <div class="row_input">
                <?php $metodo_page = "";
                if (isset($valorForm['metodo_page'])) {
                    $metodo_page = $valorForm['metodo_page']; } ?>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="metodo_page" id="metodo_page" value="<?php echo $metodo_page; ?>" placeholder="Digite o nome do Método(principal) *" required>
            </div>
            <div class="row_input">
                <?php $menu_metodo = "";
                if (isset($valorForm['menu_metodo'])) {
                    $menu_metodo = $valorForm['menu_metodo']; } ?>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="menu_metodo" id="menu_metodo" value="<?php echo $menu_metodo; ?>" placeholder="Digite o nome menu_metodo *" required>
            </div>
            <div class="row_input">
                <?php $obs_page = "";
                if (isset($valorForm['obs_page'])) {
                    $obs_page = $valorForm['obs_page']; } ?>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="obs_page" id="obs_page" value="<?php echo $obs_page; ?>" placeholder="Digite as observações da Página">
            </div>
            <div class="row_input">
                <?php $icon_menu_page = "";
                if (isset($valorForm['icon_menu_page'])) {
                    $icon_menu_page = $valorForm['icon_menu_page']; } ?>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="icon_menu_page" id="icon_menu_page" value="<?php echo $icon_menu_page; ?>" placeholder="Digite a Tag para inserir o icon">
            </div>
            <div class="row_input">
            <i class="fa-solid fa-hand-pointer"></i>
                <div class="select_input">
                    <label class="mx-3">Página Pública:<span class="text-danger">*</span></label>
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
                    <label class="mx-3" for="id_sits_page">Situação da Pagina:<span class="text-danger">*</span></label>
                    <select name="id_sits_page" id="id_sits_page">
                        <option value="">Selecione</option>
                        <?php foreach($this->data['select']['sit'] as $sit){
                            extract($sit);
                            if((isset($valorForm['id_sits_page'])) and ($valorForm['id_sits_page'] == $id_sits_page)){
                                echo "<option value='$id_sits_page' selected>$name_sits_page</option>";
                            } else {
                                echo "<option value='$id_sits_page'>$name_sits_page</option>";
                            } } ?>
                    </select>
                </div>
            </div>
            <div class="row_input">
                <i class="fa-solid fa-hand-pointer"></i>
                <div class="select_input">
                    <label class="mx-3" for="id_type_page">Tipo da Página:<span class="text-danger">*</span></label>
                    <select name="id_type_page" id="id_type_page">
                        <option value="">Selecione</option>
                        <?php foreach($this->data['select']['atp'] as $atp){
                            extract($atp);
                            if((isset($valorForm['id_type_page'])) and ($valorForm['id_type_page'] == $id_type_page)){
                                echo "<option value='$id_type_page' selected>$type_page</option>";
                            } else {
                                echo "<option value='$id_type_page'>$type_page</option>";
                            } } ?>
                    </select>
                </div>
            </div>
            <div class="row_input">
                <i class="fa-solid fa-hand-pointer"></i>
                <div class="select_input">
                    <label class="mx-3" for="id_group_page">Grupo de Página:<span class="text-danger">*</span></label>
                    <select name="id_group_page" id="id_group_page">
                        <option value="">Selecione</option>
                        <?php foreach($this->data['select']['agp'] as $agp){
                            extract($agp);
                            if((isset($valorForm['id_group_page'])) and ($valorForm['id_group_page'] == $id_group_page)){
                                echo "<option value='$id_group_page' selected>$name_group_page</option>";
                            } else {
                                echo "<option value='$id_group_page'>$name_group_page</option>";
                            } } ?>
                    </select>
                </div>
            </div>
            <span class="span_obrigatorio">* Campos obrigatórios</span><br>
            <div class="button_center">
                <button class="btn btn-primary" type="submit" name="SendAddPage" value="Cadastrar">Cadastrar Página</button>
            </div>
            <div class="button_center">
                 <a class="btn btn-sm btn-outline-info" href="<?=URLADM;?>list-page/index"> Listar  Páginas </a>
            </div>
        </form>
    </div>
</div>