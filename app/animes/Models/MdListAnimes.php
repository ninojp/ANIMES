<?php
namespace Animes\Models;
if(!defined('$2y!10#OaHjLtR20hiD23TKNv(0$2)TkYur)$23$(zF')){ header("Location: https://localhost/animes/"); }
/** Classe Models, Recebe e envia as requisições(Dados) para a Controller
 * @author NinoJP <ninocriptocoin@gmail.com> - 04/02/2023 */
class MdListAnimes
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result;

    /** @var array - Recebe os dados(registros) do Banco de dados    */
    private array|null $resultBd;

    /** @var int -  - Recebe o numero da pagina atual   */
    private int $page;

    /** @var integer - Recebe a quantidade de registros que deve retornar do DB    */
    private int $limitResult = 30;

    /** @var string|null -  - Recebe a paginação  */
    private string|null $resultPg;

    /** @var string|null -  - Recebe o nome a ser pesquisado  */
    private string|null $searchName;

    /** @var string|null - valor a ser pesquisado, que pode conter caracteres antes e depois  */
    private string|null $searchNameValue;
    
    /** ============================================================================================
     * Retorna true quando executar o processo com sucesso e false quando houver erro
     * @return void     */
    function getResult(): bool
    {
        return $this->result;
    }
    /** ============================================================================================
     * Retorna os registros(usuários) do Bd 
     * @return void     */
    function getResultBd(): array|null
    {
        return $this->resultBd;
    }
    /** ============================================================================================
     * @return string|null  - Retorna a paginação   */
    function getResultPg(): string|null
    {
        return $this->resultPg;
    }
    /** ============================================================================================
     * @return void     */
    public function listAnimes(int $page=null):void
    {
        //------------------------------ PAGINAÇÂO -------------------------------------------
        //converte para inteiro e verifica se possui valor, se não atribui o valor 1
        $this->page = (int) $page ? $page : 1;
        $pagination = new \Animes\Models\helper\MdPagination(URL.'list-animes/index');
        $pagination->condition($this->page, $this->limitResult);
        $pagination->pagination("SELECT COUNT(id_anime) AS num_result FROM anime");
        $this->resultPg = $pagination->getResult();
        // var_dump($this->resultPg);
        //-------------------------------------------------------------------------------------
        $listUsers = new \Animes\Models\helper\MdRead();
        $listUsers->fullRead("SELECT id_anime, codnome, tit_anime, img_mini FROM anime ORDER BY codnome ASC LIMIT :limit OFFSET :offset", "limit={$this->limitResult}&offset={$pagination->getOffset()}");

        $this->resultBd = $listUsers->getResult();
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 151! Nenhum Anime encontrado!</p>";
            $this->result = false;
        }
    }
    /** ============================================================================================
     * Método para pesquisar(formulario de pesquisa) usuários na tabela:adms_users e listar as informações na view
     * Recebe o parametro:$page para que seja feita a paginação do resultado
     * Recebe o parametro:search_name para que seja feita a pesquisa pelo nome    */
    public function listSearchAnimes(int $page = null, string|null $search_name): void
    {
        //atribui os parametros recebidos para os devidos atributos
        $this->page = (int) $page ? $page : 1;

        //usa o trim para retirar os espaços em branco
        $this->searchName = trim($search_name);
        // var_dump($this->searchName);

        //define que a variavel q vai ser usada na query de pesquisa pode ter valores antes e depois
        $this->searchNameValue = "%".$this->searchName."%";
        // var_dump($this->searchNameValue);

        //verifica se está recebendo os dois campos de pesquisa, nome e email
        if ((!empty($this->searchName))) {
            $this->searchNameAnime();
        }
    }
    /** ============================================================================================
     * Método para pesquisar pelo NOME e E-Mail    */
    public function searchNameAnime(): void
    {
        //instância a classe:AdmsPagination, cria o objeto:$pagination 
        $pagination = new \Animes\Models\helper\MdPagination(URL . 'list-animes/index', "?search_name={$this->searchName}");
        //instância o método para fazer a paginação
        $pagination->condition($this->page, $this->limitResult);
        //cria a query, buscar quantidade total de registros da tabela:adms_users
        $pagination->pagination("SELECT COUNT(id_anime) AS num_result FROM anime WHERE codnome LIKE :search_name", "search_name={$this->searchNameValue}");
        //recebe o resultado do método:getResult() e atribui para:$this->resultPg
        $this->resultPg = $pagination->getResult();
        // var_dump($this->resultPg);
        // die("AQUI!");
        //-------------------------------------------------------------------------------------

        $listUsersNameEmail = new \Animes\Models\helper\MdRead();
        $listUsersNameEmail->fullRead("SELECT id_anime, codnome, tit_anime, img_mini 
        FROM anime WHERE codnome LIKE :search_name ORDER BY codnome ASC LIMIT :limit OFFSET :offset", "search_name={$this->searchNameValue}&limit={$this->limitResult}&offset={$pagination->getOffset()}");
        $this->resultBd = $listUsersNameEmail->getResult();
        if ($this->resultBd) {
            // var_dump($this->resultBd);
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 151.1! Nenhum Anime(Pesquisa) encontrado!</p>";
            $this->result = false;
        }
    }
}