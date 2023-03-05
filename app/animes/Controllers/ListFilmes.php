<?php
namespace Animes\Controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ header("Location: https://localhost/animes/"); }
/** @author NinoJP  - 05/03/2023 */
class ListFilmes
{
    private array|string|null $data;
    private array|null $dataForm;
    private string|int|null $page;
    private string|null $searchName;
    /** ========================================================================================= */
    public function index(string|int|null $page = null):void
    {
        $this->page = (int) $page ? $page : 1;
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->searchName = filter_input(INPUT_GET, 'search_name', FILTER_DEFAULT);

        $listFilmes = new \Animes\Models\MdListFilmes();

        if (!empty($this->dataForm['SendSearchAnime'])) {
        $this->page = 1;
        $listFilmes->listSearchFilmes($this->page, $this->dataForm['search_name']);
        $this->data['form'] = $this->dataForm;
        } elseif ((!empty($this->searchName))) {
            $listFilmes->listSearchFilmes($this->page, $this->searchName);
            $this->data['form']['search_name'] = $this->searchName;
        } else {
            $listFilmes->listFilmes($this->page);
        }
        if ($listFilmes->getResult()) {
            $this->data['listFilmes'] = $listFilmes->getResultBd();
            $this->data['pagination'] = $listFilmes->getResultPg();
        } else {
            $this->data['listFilmes'] = [];
            $this->data['pagination'] = "";
        }
        $loadView = new \Src\ConfigViewAnimes("animes/Views/filmes/listFilmes", $this->data);
        $loadView->loadViewAnimes();
    }
}