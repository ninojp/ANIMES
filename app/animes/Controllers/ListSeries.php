<?php
namespace Animes\Controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ header("Location: https://localhost/animes/"); }
/** @author NinoJP  - 05/03/2023 */
class listSeries
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

        $listSeries = new \Animes\Models\MdListSeries();

        if (!empty($this->dataForm['SendSearchAnime'])) {
        $this->page = 1;
        $listSeries->listSearchSerie($this->page, $this->dataForm['search_name']);
        $this->data['form'] = $this->dataForm;
        } elseif ((!empty($this->searchName))) {
            $listSeries->listSearchSerie($this->page, $this->searchName);
            $this->data['form']['search_name'] = $this->searchName;
        } else {
            $listSeries->listSeries($this->page);
        }
        if ($listSeries->getResult()) {
            $this->data['listSeries'] = $listSeries->getResultBd();
            $this->data['pagination'] = $listSeries->getResultPg();
        } else {
            $this->data['listSeries'] = [];
            $this->data['pagination'] = "";
        }
        $loadView = new \Src\ConfigViewAnimes("animes/Views/series/listSeries", $this->data);
        $loadView->loadViewAnimes();
    }
}