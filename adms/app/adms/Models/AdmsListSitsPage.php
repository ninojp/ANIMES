<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
class AdmsListSitsPage
{
    //recebe o resultado true|fasse e os retorna quando solicitado
    private bool $result;

    //Recebe o resultado da query ao DB
    private array|null $resultBd;

    /** @var int -  - Recebe o numero da pagina atual   */
    private int $page;

    /** @var integer - Recebe a quantidade de registros que deve retornar do DB    */
    private int $limitResult = 5;

    /** @var string|null -  - Recebe a paginação  */
    private string|null $resultPg;

    /** =============================================================================================
     * Método que atribui o true ou false para o atributo:$result
     * @return boolean     */
    public function getResult():bool
    {
        return $this->result;
    }
    /** =============================================================================================
     *  Método que recebe os dados da query ao DB e os atribui para o atributo:$resultBd 
     * @return array|null
     */
    public function getResultBd():array|null
    {
        return $this->resultBd;
    }
    /** ============================================================================================
     * @return string|null  - Retorna a paginação   */
    function getResultPg():string|null
    {
        return $this->resultPg;
    }
    /** =============================================================================================
     * @return void     */
    public function listSitsPgs(int $page = null):void
    {
        //------------------------------ PAGINAÇÂO -------------------------------------------
        //Atribui o parametro recebido:$page para o atributo:$this->page
        //converte para inteiro e verifica se possui valor, se não atribui o valor 1
        $this->page = (int) $page ? $page : 1;
        // var_dump($this->page);
        //instância a classe:AdmsPagination, cria o objeto:$pagination 
        $pagination = new \Adms\Models\helper\AdmsPagination(URLADM.'list-sits-page/index');
        //instância o método para fazer a paginação
        $pagination->condition($this->page, $this->limitResult);
        //cria a query, buscar quantidade total de registros da tabela:adms_users
        $pagination->pagination("SELECT COUNT(id_sits_page) AS num_result FROM adms_sits_page");
        //recebe o resultado do método:getResult() e atribui para:$this->resultPg
        $this->resultPg = $pagination->getResult();
        // var_dump($this->resultPg);
        //-------------------------------------------------------------------------------------

        $listSitUsers = new \Adms\Models\helper\AdmsRead();
        $listSitUsers->fullRead("SELECT sits.id_sits_page, sits.name_sits_page, col.name_color, col.color_adms FROM adms_sits_page AS sits INNER JOIN adms_color AS col ON col.id_color=sits.id_color ORDER BY sits.id_sits_page DESC LIMIT :limit OFFSET :offset", "limit={$this->limitResult}&offset={$pagination->getOffset()}");

        $this->resultBd = $listSitUsers->getResult();

        if($this->resultBd){
            // var_dump($this->resultBd);
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 103! Nenhuma Situação de pagina encontrada!</p>";
            $this->result - false;
        }
    }
}