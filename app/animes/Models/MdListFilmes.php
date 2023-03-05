<?php
namespace Animes\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ header("Location: https://localhost/animes/"); }
/** @author NinoJP - 05/03/2023 */
class MdListFilmes
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
    public function listFilmes(int $page=null):void
    {
        $this->page = (int) $page ? $page : 1;
        $pagination = new \Animes\Models\helper\MdPagination(URL.'list-filmes/index');
        $pagination->condition($this->page, $this->limitResult);
        $pagination->pagination("SELECT COUNT(id_filme) AS num_result FROM filme");
        $this->resultPg = $pagination->getResult();
        //-------------------------------------------------------------------------------------
        $listFilmes = new \Animes\Models\helper\MdRead();
        $listFilmes->fullRead("SELECT id_filme, titulo_filme, s_titulo_filme, img_mini FROM filme ORDER BY titulo_filme ASC LIMIT :limit OFFSET :offset", "limit={$this->limitResult}&offset={$pagination->getOffset()}");
        $this->resultBd = $listFilmes->getResult();
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 153! Nenhum registro encontrado!</p>";
            $this->result = false;
        }
    }
    /** ============================================================================================ */
    public function listSearchFilmes(int $page=null, string|null $search_name): void
    {
        $this->page = (int) $page ? $page : 1;
        $this->searchName = trim($search_name);
        $this->searchNameValue = "%".$this->searchName."%";
        if ((!empty($this->searchName))) {
            $this->searchNameFilmes();
        } else{
            $this->searchNameFilmes();
        }
    }
    /** ============================================================================================ */
    public function searchNameFilmes(): void
    {
        $pagination = new \Animes\Models\helper\MdPagination(URL . 'list-filmes/index', "?search_name={$this->searchName}");
        $pagination->condition($this->page, $this->limitResult);
        $pagination->pagination("SELECT COUNT(id_filme) AS num_result FROM filme WHERE titulo_filme OR s_titulo_filme LIKE :search_name", "search_name={$this->searchNameValue}");
        $this->resultPg = $pagination->getResult();
        //-------------------------------------------------------------------------------------
        $listNameFilmes = new \Animes\Models\helper\MdRead();
        $listNameFilmes->fullRead("SELECT id_filme, titulo_filme, s_titulo_filme, img_mini FROM filme WHERE titulo_filme OR s_titulo_filme LIKE :search_name ORDER BY titulo_filme ASC LIMIT :limit OFFSET :offset", "search_name={$this->searchNameValue}&limit={$this->limitResult}&offset={$pagination->getOffset()}");
        $this->resultBd = $listNameFilmes->getResult();
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 153.1! Nenhum registro encontrado!</p>";
            $this->result = false;
        }
    }
}