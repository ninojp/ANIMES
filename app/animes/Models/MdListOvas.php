<?php
namespace Animes\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ header("Location: https://localhost/animes/"); }
/** @author NinoJP - 05/03/2023 */
class MdListOvas
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
    public function listOvas(int $page=null):void
    {
        $this->page = (int) $page ? $page : 1;
        $pagination = new \Animes\Models\helper\MdPagination(URL.'list-ovas/index');
        $pagination->condition($this->page, $this->limitResult);
        $pagination->pagination("SELECT COUNT(id_ova) AS num_result FROM ova");
        $this->resultPg = $pagination->getResult();
        //-------------------------------------------------------------------------------------
        $listOvas = new \Animes\Models\helper\MdRead();
        $listOvas->fullRead("SELECT id_ova, titulo_ova, s_titulo_ova, img_mini FROM ova ORDER BY titulo_ova ASC LIMIT :limit OFFSET :offset", "limit={$this->limitResult}&offset={$pagination->getOffset()}");
        $this->resultBd = $listOvas->getResult();
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 154! Nenhum registro encontrado!</p>";
            $this->result = false;
        }
    }
    /** ============================================================================================ */
    public function listSearchOvas(int $page=null, string|null $search_name): void
    {
        $this->page = (int) $page ? $page : 1;
        $this->searchName = trim($search_name);
        $this->searchNameValue = "%".$this->searchName."%";
        if ((!empty($this->searchName))) {
            $this->searchNameOvas();
        } else{
            $this->searchNameOvas();
        }
    }
    /** ============================================================================================ */
    public function searchNameOvas(): void
    {
        $pagination = new \Animes\Models\helper\MdPagination(URL . 'list-ovas/index', "?search_name={$this->searchName}");
        $pagination->condition($this->page, $this->limitResult);
        $pagination->pagination("SELECT COUNT(id_ova) AS num_result FROM ova WHERE titulo_ova OR s_titulo_ova LIKE :search_name", "search_name={$this->searchNameValue}");
        $this->resultPg = $pagination->getResult();
        //-------------------------------------------------------------------------------------
        $listNameOvas = new \Animes\Models\helper\MdRead();
        $listNameOvas->fullRead("SELECT id_ova, titulo_ova, s_titulo_ova, img_mini FROM ova WHERE titulo_ova OR s_titulo_ova LIKE :search_name ORDER BY titulo_ova ASC LIMIT :limit OFFSET :offset", "search_name={$this->searchNameValue}&limit={$this->limitResult}&offset={$pagination->getOffset()}");
        $this->resultBd = $listNameOvas->getResult();
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 154.1! Nenhum registro encontrado!</p>";
            $this->result = false;
        }
    }
}