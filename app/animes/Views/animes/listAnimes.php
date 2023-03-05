<?php
namespace Animes\Views;
if (!defined('$2y!10#OaHjLtR20hiD23TKNv(0$2)TkYur)$23$(zF')) {
    header("Location: https://localhost/animes/"); } ?>
<main class="container-fluid">
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
                $tit_anime2 = nl2br(mb_strimwidth($tit_anime,0,150,'...'));
                echo "<div class='thumb_div text-center'>";?>
                    <a class="link_sem" href="anime_detalhes.php?id_anime=$id_anime" title="<?=$tit_anime2?>" target="_blank">
                    <img class="thumb_img" src="<?=URL;?>app/animes/assets/imgs/anime/<?=$img_mini;?>">
                    <div class="col-12"><span class="span_nome"><?=$codnome;?></span>
                    </div></a>
                </div><?php }
            echo "</div><hr>";
            echo $this->data['pagination']; ?>
        </div>
    </div>
</main>