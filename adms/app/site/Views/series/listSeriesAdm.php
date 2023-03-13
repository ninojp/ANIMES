<?php

namespace AdmsSit\Views;

if (!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')) {
    header("Location: https://localhost/animes/");
} ?>
<main class="main_listar">
    <div class="row align_center">
        <div class="row">
            <?php echo "<div class='col-12 msg_alert'>";
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            echo "</div>"; ?>
        </div>
        <div class="row">
            <div class="div_list_animes justify-content-evenly">
                <?php foreach ($this->data['listSeries'] as $serie) {
                    extract($serie);
                    $titulo_serie2 = nl2br(mb_strimwidth($titulo_serie, 0, 50, '...'));
                    echo "<div class='thumb_div text-center align_center'>"; 
                        echo "<div class='div_btn_list align_center'>"; 
                        if (!empty($this->data['button']['list_animacao']) or ($this->data['button']['edit_series_down']) or ($this->data['button']['edit_series_image']) or ($this->data['button']['edit_series_adm'])) {
                            if (!empty($this->data['button']['list_animacao'])) {
                                echo "<a class='btn btn-sm btn-outline-success mx-2' href='" . URLADM . "list-animacao/index' target='_blank'><i class='fa-solid fa-list'></i> List Animação</a>";
                            }
                            if (!empty($this->data['button']['edit_series_down'])) {
                                echo "<a class='btn btn-sm btn-outline-success mx-2' href='" . URLADM . "edit-series-down/index/{$down_id}' target='_blank'><i class='fa-solid fa-list'></i> Edit Down</a>";
                            }
                            if (!empty($this->data['button']['edit_series_image'])) {
                                echo "<a class='btn btn-sm btn-outline-success mx-2' href='" . URLADM . "edit-series-image/index/{$id_serie}' target='_blank'><i class='fa-solid fa-list'></i> Edit Imagem</a>";
                            }
                            if (!empty($this->data['button']['edit_series_adm'])) {
                                echo "<a class='btn btn-sm btn-outline-warning mx-2' href='" . URLADM . "edit-series-adm/index/{$id_serie}' target='_blank'><i class='fa-solid fa-list'></i> Editar</a>";
                            }
                            } ?>
                        </div>
                        <img class="thumb_img" src="<?= URLADM; ?>app/site/assets/imgs/serie/<?= $img_mini; ?>">
                        <div class="col-12"><span class="span_nome"><?= $titulo_serie2; ?></span>
                        </div>
                    </a>
            </div><?php }
                echo "</div><hr>";
                echo $this->data['pagination']; ?>
        </div>
    </div>
</main>