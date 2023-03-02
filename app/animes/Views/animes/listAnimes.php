<?php

namespace Animes\Views;

if (!defined('$2y!10#OaHjLtR20hiD23TKNv(0$2)TkYur)$23$(zF')) {
    header("Location: https://localhost/animes/");
} ?>
<main class="container-fluid">
    <div class="row align_center">
        <!-- HEADER classe CONTAINER - Banner da pagina -->
        <header class="align_center" id="ir_para_topo">
            <div class="col-4 text-center">
                <h3>Animes Completos</h3>
                <h3>Para Download</h3>
                <h3>E Assistir Online</h3>
            </div>
            <!-- Carousel de IMAGENS Animes-->
            <div class="col-4 align_center" style="height: 250px;">
                <div id="demo_anime" class="carousel slide carousel-fade text-center" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="<?= URL; ?>app/animes/assets/imgs/banner/banner_img1.png" alt="Imagem01">
                        </div>
                        <div class="carousel-item">
                            <img src="<?= URL; ?>app/animes/assets/imgs/banner/banner_img(0).png" alt="Imagem02">
                        </div>
                        <div class="carousel-item">
                            <img src="<?= URL; ?>app/animes/assets/imgs/banner/banner_img(1).png" alt="Imagem03">
                        </div>
                        <div class="carousel-item">
                            <img src="<?= URL; ?>app/animes/assets/imgs/banner/banner_img(2).png" alt="Imagem04">
                        </div>
                        <div class="carousel-item">
                            <img src="<?= URL; ?>app/animes/assets/imgs/banner/banner_img(3).png" alt="Imagem05">
                        </div>
                        <div class="carousel-item">
                            <img src="<?= URL; ?>app/animes/assets/imgs/banner/banner_img(4).png" alt="Imagem06">
                        </div>
                        <div class="carousel-item">
                            <img src="<?= URL; ?>app/animes/assets/imgs/banner/banner_img(5).png" alt="Imagem07">
                        </div>
                        <div class="carousel-item">
                            <img src="<?= URL; ?>app/animes/assets/imgs/banner/banner_img(6).png" alt="Imagem08">
                        </div>
                        <div class="carousel-item">
                            <img src="<?= URL; ?>app/animes/assets/imgs/banner/banner_img(7).png" alt="Imagem09">
                        </div>
                        <div class="carousel-item">
                            <img src="<?= URL; ?>app/animes/assets/imgs/banner/banner_img(8).png" alt="Imagem10">
                        </div>
                        <div class="carousel-item">
                            <img src="<?= URL; ?>app/animes/assets/imgs/banner/banner_img(9).png" alt="Imagem11">
                        </div>
                        <div class="carousel-item">
                            <img src="<?= URL; ?>app/animes/assets/imgs/banner/banner_img(10).png" alt="Imagem12">
                        </div>
                        <div class="carousel-item">
                            <img src="<?= URL; ?>app/animes/assets/imgs/banner/banner_img(11).png" alt="Imagem13">
                        </div>
                        <div class="carousel-item">
                            <img src="<?= URL; ?>app/animes/assets/imgs/banner/banner_img(12).png" alt="Imagem14">
                        </div>
                        <div class="carousel-item">
                            <img src="<?= URL; ?>app/animes/assets/imgs/banner/banner_img(13).png" alt="Imagem15">
                        </div>
                        <div class="carousel-item">
                            <img src="<?= URL; ?>app/animes/assets/imgs/banner/banner_img(14).png" alt="Imagem16">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4 text-center">
                <p>Não hospedamos nada em nossos servidores, selecionamos sempre links externos, ativos e com menor nivel de complexidade para baixar</p>
                <p>Entenda o básico (como baixar) para desfrutar ao máximo</p>
            </div>
        </header>
        <!-- coluna do campo Busca por letras -->
        <div class="row">
            <div class="col-12 nav nav-tabs">
                <div class="nav-item px-1"><a class="nav-link active px-2" href="form_busca.php?input_busca=a">B</a></div>
                <div class="nav-item px-1"><a class="nav-link px-2" href="">C</a></div>
                <div class="nav-item px-1"><a class="nav-link px-2" href="">D</a></div>
                <div class="nav-item px-1"><a class="nav-link px-2" href="">E</a></div>
                <div class="nav-item px-1"><a class="nav-link px-2" href="">F</a></div>
                <div class="nav-item px-1"><a class="nav-link px-2" href="">G</a></div>
                <div class="nav-item px-1"><a class="nav-link px-2" href="">H</a></div>
                <div class="nav-item px-1"><a class="nav-link px-2" href="">I</a></div>
                <div class="nav-item px-1"><a class="nav-link px-2" href="">J</a></div>
                <div class="nav-item px-1"><a class="nav-link px-2" href="">K</a></div>
                <div class="nav-item px-1"><a class="nav-link px-2" href="">L</a></div>
                <div class="nav-item px-1"><a class="nav-link px-2" href="">M</a></div>
                <div class="nav-item px-1"><a class="nav-link px-2" href="">N</a></div>
                <div class="nav-item px-1"><a class="nav-link px-2" href="">O</a></div>
                <div class="nav-item px-1"><a class="nav-link px-2" href="">P</a></div>
                <div class="nav-item px-1"><a class="nav-link px-2" href="">Q</a></div>
                <div class="nav-item px-1"><a class="nav-link px-2" href="">R</a></div>
                <div class="nav-item px-1"><a class="nav-link px-2" href="">S</a></div>
                <div class="nav-item px-1"><a class="nav-link px-2" href="">T</a></div>
                <div class="nav-item px-1"><a class="nav-link px-2" href="">U</a></div>
                <div class="nav-item px-1"><a class="nav-link px-2" href="">V</a></div>
                <div class="nav-item px-1"><a class="nav-link px-2" href="">X</a></div>
                <div class="nav-item px-1"><a class="nav-link px-2" href="">Y</a></div>
                <div class="nav-item px-1"><a class="nav-link px-2" href="">W</a></div>
                <div class="nav-item px-1"><a class="nav-link px-2" href="">Z</a></div>
                <div class="nav-item ps-2">
                    <form class="form_pesquisar" action="" name="form_pesquisar" method="POST">
                        <div class="d-inline">
                            <?php $search_name = "";
                            if (isset($valorForm['search_name'])) {
                                $search_name = $valorForm['search_name'];
                            } ?>
                            <!-- <label for="search_name">Nome: </label> -->
                            <input type="text" name="search_name" id="search_name" value="<?php echo $search_name; ?>" placeholder="Pesquisar: Título, Nome...">
                        </div>
                        <div class="d-inline">
                            <button class="btn btn-sm btn-outline-info" type="submit" name="SendSearchAnime" value="Pesquisar"><img src="<?=URL;?>app/animes/assets/imgs/pesquisar.png"></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- DIV-Row que vai apresentar os thumbs do ANIMES -->
        <!-- <div class="row"> -->
        <?php //var_dump($this->data['listAnimes'][0]['img_mini']); ?>
        <div class="row">
            <?php // Manter os dados no formulário de PESQUISA   
            if (isset($this->data['form'])) {
                $valorForm = $this->data['form']; } 
            echo "<div class='col-6 msg_alert'>";
                if (isset($_SESSION['msg'])) {
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']); } ?>
            </div>
            
            <table class="table table-striped table_list">
            <thead class="list_head">
                <tr>
                    <th class="list_head_content">ID Anime</th>
                    <th class="list_head_content">CodNome Anime</th>
                    <!-- classe:tb_sm_none para OCULTAR o item em resolucão menores -->
                    <th class="list_head_content tb_sm_none">Titulo Anime</th>
                    <th class="list_head_content tb_sm_none">Nome img_mini</th>
                </tr>
            </thead>
            <tbody class="list_body">
                <?php foreach ($this->data['listAnimes'] as $anime) { extract($anime); ?>
                <tr>
                    <td class="list_body_content"><?=$id_anime;?></td>
                    <td class="list_body_content"><?=$codnome;?></td>
                    <td class="list_body_content tb_sm_none"><?=$tit_anime;?></td>
                    <td class="list_body_content tb_sm_none"><?=$img_mini;?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        </div>
        <?php echo $this->data['pagination']; ?>
    </div>
</main>