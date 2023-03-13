<?php
namespace AdmsSit\Views;
if (!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')) {
    header("Location: https://localhost/animes/"); } ?>
<main class="main_listar">
    <div class="row align_center">
        <!-- DIV-Row que vai apresentar os thumbs do ANIMES -->
        <div class="row">
            <?php echo "<div class='col-12 msg_alert'>";
                if (isset($_SESSION['msg'])) {
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']); }
                    echo "</div>"; ?>
        </div>
        <div class="row">
            <div class="div_list_animes justify-content-evenly">
                <?php foreach ($this->data['listAnimes'] as $anime) { extract($anime);
                $codnome2 = nl2br(mb_strimwidth($codnome,0,50,'...'));
                echo "<div class='thumb_div text-center'>";
                    echo "<div class='div_btn_list align_center'>"; 
                        if (!empty($this->data['button']['list_animacao']) or ($this->data['button']['edit_animes_image']) or ($this->data['button']['edit_animes_adm'])) {
                            if (!empty($this->data['button']['list_animacao'])) {
                                echo "<a class='btn btn-sm btn-outline-success mx-2' href='" . URLADM . "list-animacao/index' target='_blank'><i class='fa-solid fa-list'></i> List Animação</a>";
                            }
                            if (!empty($this->data['button']['edit_animes_image'])) {
                                echo "<a class='btn btn-sm btn-outline-success mx-2' href='" . URLADM . "edit-animes-image/index/{$id_anime}' target='_blank'><i class='fa-solid fa-list'></i> Edit Imagem</a>";
                            }
                            if (!empty($this->data['button']['edit_animes_adm'])) {
                                echo "<a class='btn btn-sm btn-outline-warning mx-2' href='" . URLADM . "edit-animes-adm/index/{$id_anime}' target='_blank'><i class='fa-solid fa-list'></i> Editar</a>";
                            }
                            } ?>
                        </div>
                    <img class="thumb_img" src="<?=URLADM;?>app/site/assets/imgs/anime/<?=$img_mini;?>">
                    <div class="col-12"><span class="span_nome"><?=$codnome2;?></span>
                    </div></a>
                </div><?php }
            echo "</div><hr>";
            echo $this->data['pagination']; ?>
        </div>
    </div>
</main>