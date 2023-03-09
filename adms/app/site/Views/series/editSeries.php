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
            <h2>Editar Série</h2>
        </div>
        <?php echo "<div id='msg' class='msg_alert'>";
            if (isset($_SESSION['msg'])) { 
            echo $_SESSION['msg'];
            unset($_SESSION['msg']); }
            echo "</div>"; ?>
        <form class="form_adms" action="" method="POST" id="form-edit-series">
            <!-- input oculto pra enviar o id, via post -->
            <input class="form-control" type="hidden" name="id_serie" id="id_serie" value="<?php if(isset($valorForm['id_serie'])){echo $valorForm['id_serie'];} ?>">
            
            <div class="pt-3 text-center">
                <?php if ((!empty($valorForm['img_mini'])) and (file_exists("app/site/assets/imgs/serie/{$valorForm['img_mini']}"))) {
                        echo "<img src='".URLADM."app/site/assets/imgs/serie/{$valorForm['img_mini']}' height='300'><br><br>";
                    } else {
                        echo "<img src='".URLADM."app/site/assets/imgs/TI_link.png' height='300'><br><br>";
                    } ?>
            </div>
            <div class="row_edit">
                <label class="" for="titulo_serie">Alterar Título:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="titulo_serie" id="titulo_serie" value="<?php if(isset($valorForm['titulo_serie'])){echo $valorForm['titulo_serie'];} ?>" placeholder="Alterar o Título da Série" required>
            </div>
            <div class="row_edit">
                <label class="" for="s_titulo_serie">Alterar SubTítulo:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="s_titulo_serie" id="s_titulo_serie" value="<?php if(isset($valorForm['s_titulo_serie'])){echo $valorForm['s_titulo_serie'];} ?>" placeholder="Alterar o SubTítulo da Série" required>
            </div>
            <div class="row_edit">
                <label class="" for="enredo_serie">Alterar Enredo:</label>
                <i class="fa-solid fa-envelope"></i>
                <input class="form-control" type="text" name="enredo_serie" id="enredo_serie" value="<?php if(isset($valorForm['enredo_serie'])){echo $valorForm['enredo_serie'];} ?>" placeholder="Edite o Enredo da Serie" required>
            </div>
            <div class="row_edit">
                <label class="" for="exib_inicio">Data de Inicio da exibição:</label>
                <i class="fa-solid fa-envelope"></i>
                <input class="form-control" type="text" name="exib_inicio" id="exib_inicio" value="<?php if(isset($valorForm['exib_inicio'])){echo $valorForm['exib_inicio'];} ?>" placeholder="Inicio da Exibição da Serie" required>
            </div>
            <div class="row_edit">
                <label class="" for="exib_fim">Data do fim da exibição:</label>
                <i class="fa-solid fa-envelope"></i>
                <input class="form-control" type="text" name="exib_fim" id="exib_fim" value="<?php if(isset($valorForm['exib_fim'])){echo $valorForm['exib_fim'];} ?>" placeholder="Fim da Exibição da Serie" required>
            </div>
            <div class="row_edit">
                <label class="" for="num_ep_serie">Numero de Episódios:</label>
                <i class="fa-solid fa-envelope"></i>
                <input class="form-control" type="text" name="num_ep_serie" id="num_ep_serie" value="<?php if(isset($valorForm['num_ep_serie'])){echo $valorForm['num_ep_serie'];} ?>" placeholder="Numero de Episódios" required>
            </div>
            <div class="row_edit">
                <label class="" for="dura_ep_serie">Duração de cada Episódio:</label>
                <i class="fa-solid fa-envelope"></i>
                <input class="form-control" type="text" name="dura_ep_serie" id="dura_ep_serie" value="<?php if(isset($valorForm['dura_ep_serie'])){echo $valorForm['dura_ep_serie'];} ?>" placeholder="Duração de cada Episódio" required>
            </div>
            <div class="row_edit">
                <label class="" for="trailer">Link do Trailer:</label>
                <i class="fa-solid fa-envelope"></i>
                <input class="form-control" type="text" name="trailer" id="trailer" value="<?php if(isset($valorForm['trailer'])){echo $valorForm['trailer'];} ?>" placeholder="Fim da Exibição da Serie" required>
            </div>
            <div class="row_input">
                <i class="fa-solid fa-hand-pointer"></i>
                <div class="select_input">
                    <label class="mx-3" for="anime_id">Anime Relacionado:</label>
                    <select name="anime_id" id="anime_id">
                        <option value="">Selecione</option>
                        <?php foreach($this->data['select']['ani'] as $ani){
                            extract($ani);
                            //verifica se existe, E SE É IGUAL ao valor do id
                            if((isset($valorForm['anime_id'])) and ($valorForm['anime_id'] == $id_anime)){
                                echo "<option value='$id_anime' selected>$codnome</option>";
                            } else {
                                echo "<option value='$id_anime'>$codnome</option>";
                            } } ?>
                    </select>
                </div>
            </div>
            <div class="row_input">
                <i class="fa-solid fa-hand-pointer"></i>
                <div class="select_input">
                    <label class="mx-3" for="cat_anime_id">Anime Categoria:</label>
                    <select name="cat_anime_id" id="cat_anime_id">
                        <option value="">Selecione</option>
                        <?php foreach($this->data['select']['cat_ani'] as $cat_ani){
                            extract($cat_ani);
                            if((isset($valorForm['cat_anime_id'])) and ($valorForm['cat_anime_id'] == $id_cat_anime)){
                                echo "<option value='$id_cat_anime' selected>$cat_anime</option>";
                            } else {
                                echo "<option value='$id_cat_anime'>$cat_anime</option>";
                            } } ?>
                    </select>
                </div>
            </div>
            <div class="button_center">
                <button class="btn btn-primary" type="submit" name="SendEditSeries" value="Salvar">Salvar Mudanças</button><br>
            </div>
            <!-- // if(!empty($this->data['button']['list_user']) OR ($this->data['button']['delete_user'])) {
                //echo "<div class='col-12 text-center p-4'>";
                //if(!empty($this->data['button']['list_user'])) { 
                    //echo "<a class='btn btn-sm btn-outline-success mx-2' href='".URLADM."list-user/index'><i class='fa-solid fa-list'></i> Listar</a>"; }
                //if(!empty($this->data['button']['delete_user'])) { 
                    //echo "<a class='btn btn-sm btn-outline-danger mx-2' href='".URLADM."delete-user/index/{$valorForm['id_user']}' onclick='return confirm('Tem certeza que deseja excluir o registro?')'><i class='fa-solid fa-trash-can'></i> Apagar</a>"; } 
            //echo "</div>"; } ?> -->
        </form>
    </div>
</div>



