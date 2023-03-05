<?php
namespace Animes\Views;
if (!defined('$2y!10#OaHjLtR20hiD23TKNv(0$2)TkYur)$23$(zF')) {
    header("Location: https://localhost/animes/"); } ?>
<div class="row align_center">
    <!-- coluna do campo Busca por letras -->
    <div class="row align_center">
        <div data-bs-placement="top" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Listar os Animes por LETRA" class="col-8 nav nav-tabs align_center">
            <div class="nav-item px-1"><a class="nav-link active px-1" href="form_busca.php?input_busca=a">B</a></div>
            <div class="nav-item px-1"><a class="nav-link px-1" href="">C</a></div>
            <div class="nav-item px-1"><a class="nav-link px-1" href="">D</a></div>
            <div class="nav-item px-1"><a class="nav-link px-1" href="">E</a></div>
            <div class="nav-item px-1"><a class="nav-link px-1" href="">F</a></div>
            <div class="nav-item px-1"><a class="nav-link px-1" href="">G</a></div>
            <div class="nav-item px-1"><a class="nav-link px-1" href="">H</a></div>
            <div class="nav-item px-1"><a class="nav-link px-1" href="">I</a></div>
            <div class="nav-item px-1"><a class="nav-link px-1" href="">J</a></div>
            <div class="nav-item px-1"><a class="nav-link px-1" href="">K</a></div>
            <div class="nav-item px-1"><a class="nav-link px-1" href="">L</a></div>
            <div class="nav-item px-1"><a class="nav-link px-1" href="">M</a></div>
            <div class="nav-item px-1"><a class="nav-link px-1" href="">N</a></div>
            <div class="nav-item px-1"><a class="nav-link px-1" href="">O</a></div>
            <div class="nav-item px-1"><a class="nav-link px-1" href="">P</a></div>
            <div class="nav-item px-1"><a class="nav-link px-1" href="">Q</a></div>
            <div class="nav-item px-1"><a class="nav-link px-1" href="">R</a></div>
            <div class="nav-item px-1"><a class="nav-link px-1" href="">S</a></div>
            <div class="nav-item px-1"><a class="nav-link px-1" href="">T</a></div>
            <div class="nav-item px-1"><a class="nav-link px-1" href="">U</a></div>
            <div class="nav-item px-1"><a class="nav-link px-1" href="">V</a></div>
            <div class="nav-item px-1"><a class="nav-link px-1" href="">X</a></div>
            <div class="nav-item px-1"><a class="nav-link px-1" href="">Y</a></div>
            <div class="nav-item px-1"><a class="nav-link px-1" href="">W</a></div>
            <div class="nav-item px-1"><a class="nav-link px-1" href="">Z</a></div>
        </div>
        <div class="col-4 align_center" data-bs-placement="top" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Pesquise por nome, termo ou título">
            <!-- Manter os dados no formulário de PESQUISA   -->
            <?php if (isset($this->data['form'])) {
            $valorForm = $this->data['form']; } ?>
            <form class="form_pesquisar" action="" name="form_pesquisar" method="POST">
                <div class="d-inline">
                    <?php $search_name = "";
                    if (isset($valorForm['search_name'])) {
                        $search_name = $valorForm['search_name'];
                    } ?>
                    <!-- <label for="search_name">Nome: </label> -->
                    <input type="text" name="search_name" id="search_name" value="<?php echo $search_name; ?>" placeholder="Pesquise Aqui!">
                </div>
                <div class="d-inline">
                    <button class="btn_tranp" type="submit" name="SendSearchAnime" value="Pesquisar"><img src="<?=URL;?>app/animes/assets/imgs/pesquisar.png"></button>
                </div>
            </form>
        </div>
    </div>
</div>
    