<?php
namespace AdmsSit\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ header("Location: https://localhost/animes/"); }
/** @author NinoJP - 09/03/2023 */
class MdListSeries
{
    private bool $result;
    private array|null $resultBd;
    private int $page;
    private int $limitResult = 30;
    private string|null $resultPg;
    private string|null $searchName;
    private string|null $searchNameValue;
    /** ============================================================================================ */
    function getResult():bool
    {
        return $this->result;
    }
    /** ============================================================================================ */
    function getResultBd():array|null
    {
        return $this->resultBd;
    }
    /** ============================================================================================ */
    function getResultPg(): string|null
    {
        return $this->resultPg;
    }
    /** ============================================================================================ */
    public function listSeries(int $page=null):void
    {
        $this->page = (int) $page ? $page : 1;
        $pagination = new \Animes\Models\helper\MdPagination(URL.'list-series/index');
        $pagination->condition($this->page, $this->limitResult);
        $pagination->pagination("SELECT COUNT(id_serie) AS num_result FROM serie");
        $this->resultPg = $pagination->getResult();
        //-------------------------------------------------------------------------------------
        $listSeries = new \Animes\Models\helper\MdRead();
        $listSeries->fullRead("SELECT id_serie, titulo_serie, s_titulo_serie, img_mini FROM serie ORDER BY titulo_serie ASC LIMIT :limit OFFSET :offset", "limit={$this->limitResult}&offset={$pagination->getOffset()}");
        $this->resultBd = $listSeries->getResult();
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 152! Nenhum registro encontrado!</p>";
            $this->result = false;
        }
    }
    /** ============================================================================================ */
    public function listSearchSerie(int $page=null, string|null $search_name): void
    {
        $this->page = (int) $page ? $page : 1;
        $this->searchName = trim($search_name);
        $this->searchNameValue = "%".$this->searchName."%";
        if ((!empty($this->searchName))) {
            $this->searchNameSerie();
        } else{
            $this->searchNameSerie();
        }
    }
    /** ============================================================================================ */
    public function searchNameSerie(): void
    {
        $pagination = new \Animes\Models\helper\MdPagination(URL . 'list-series/index', "?search_name={$this->searchName}");
        $pagination->condition($this->page, $this->limitResult);
        $pagination->pagination("SELECT COUNT(id_serie) AS num_result FROM serie WHERE titulo_serie OR s_titulo_serie LIKE :search_name", "search_name={$this->searchNameValue}");
        $this->resultPg = $pagination->getResult();
        //-------------------------------------------------------------------------------------
        $listUsersNameSerie = new \Animes\Models\helper\MdRead();
        $listUsersNameSerie->fullRead("SELECT id_serie, titulo_serie, s_titulo_serie, img_mini FROM serie WHERE titulo_serie OR s_titulo_serie LIKE :search_name ORDER BY titulo_serie ASC LIMIT :limit OFFSET :offset", "search_name={$this->searchNameValue}&limit={$this->limitResult}&offset={$pagination->getOffset()}");
        $this->resultBd = $listUsersNameSerie->getResult();
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 152.1! Nenhum registro encontrado!</p>";
            $this->result = false;
        }
    }
}