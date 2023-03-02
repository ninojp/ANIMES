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
    private array|null $resultDb;

    /** @var int -  - Recebe o numero da pagina atual   */
    private int $page;

    /** @var integer - Recebe a quantidade de registros que deve retornar do DB    */
    private int $limitResult = 20;

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
     * Retorna os registros(usuários) do DB 
     * @return void     */
    function getResultBd(): array|null
    {
        return $this->resultDb;
    }
    /** ============================================================================================
     * @return string|null  - Retorna a paginação   */
    function getResultPg(): string|null
    {
        return $this->resultPg;
    }
    /** ============================================================================================
     * @return void     */
    public function viewAnimes(int $page = null):void
    {
        //------------------------------ PAGINAÇÂO -------------------------------------------
        //converte para inteiro e verifica se possui valor, se não atribui o valor 1
        $this->page = (int) $page ? $page : 1;
        $pagination = new \Adms\Models\helper\AdmsPagination(URL.'list-animes/index');
        $pagination->condition($this->page, $this->limitResult);
        $pagination->pagination("SELECT COUNT(id_anime) AS num_result FROM anime");
        $this->resultPg = $pagination->getResult();
        //-------------------------------------------------------------------------------------
        $listUsers = new \Adms\Models\helper\AdmsRead();
        $listUsers->fullRead("SELECT usr.id_user, usr.adm_user, usr.adm_email, usr.id_sits_user, sit.name_sits_user, col.name_color, col.color_adms FROM adms_user AS usr ORDER BY usr.id_user DESC LIMIT :limit OFFSET :offset", "limit={$this->limitResult}&offset={$pagination->getOffset()}");

        $this->resultDb = $listUsers->getResult();
        if ($this->resultDb) {
            // var_dump($this->resultBd);
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 151! Nenhum Anime encontrado!</p>";
            $this->result = false;
        }
    }
}