<?php
namespace Animes\Views;
if (!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')) { header("Location: https://localhost/animes/"); } ?>
<main class="container-fluid">
    <div class="row align_center">
        <div class="row">
            <?php echo "<div class='col-12 msg_alert'>";
                if (isset($_SESSION['msg'])) {
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']); }
                    echo "</div>"; ?>
        </div>
        <div class="row">
            <div class="div_list_animes justify-content-evenly">
                <?php foreach ($this->data['listOvas'] as $ova) { extract($ova);
                $titulo_ova2 = nl2br(mb_strimwidth($titulo_ova,0,50,'...'));
                echo "<div class='thumb_div text-center'>";?>
                    <a class="link_sem" href="ova_detalhes.php?id_ova=$id_ova" title="<?=$s_titulo_ova?>" target="_blank">
                    <img class="thumb_img" src="<?=URLADM;?>app/site/assets/imgs/ova/<?=$img_mini;?>">
                    <div class="col-12"><span class="span_nome"><?=$titulo_ova2;?></span>
                    </div></a>
                </div><?php }
            echo "</div><hr>";
            echo $this->data['pagination']; ?>
        </div>
    </div>
</main>