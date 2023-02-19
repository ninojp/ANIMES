<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe:AdmsListPermission, listar as permissões do nivel de acesso do DB */
class AdmsListPermission
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result;

    /** @var array - Recebe os dados(registros) do Banco de dados    */
    private array|null $resultBd;

    /** @var array - Recebe o registro do Banco de dados referente ao nivel de acesso   */
    private array|null $resultBdLevel;

    /** @var int -  - Recebe o numero da pagina atual   */
    private int $page;
    
    /** @var int - $level - Recebe o id do nivel de acesso   */
    private int $level;

    /** @var integer - Recebe a quantidade de registros que deve retornar do DB    */
    private int $limitResult = 40;

    /** @var string|null -  - Recebe a paginação  */
    private string|null $resultPg;

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
        return $this->resultBd;
    }
    /** ============================================================================================
     * Retorna os registro do Banco de dados referente ao nivel de acesso
     * @return void     */
    function getResultBdLevel(): array|null
    {
        return $this->resultBdLevel;
    }
    /** ============================================================================================
     * @return string|null  - Retorna a paginação   */
    function getResultPg(): string|null
    {
        return $this->resultPg;
    }
    /** ============================================================================================
     * Método para pesquisar Niveis de acesso na tabela:adms_levels_pages e listar as informações na view
     * Recebe o parametro:$page para que seja feita a paginação do resultado e o nivel de acesso   */
    public function listPermission(int $page = null, int $level = null): void
    {
        //------------------------------ PAGINAÇÂO -------------------------------------------
        //Atribui o parametro recebido:$page para o atributo:$this->page
        //converte para inteiro e verifica se possui valor, se não atribui o valor 1
        $this->page = (int) $page ? $page : 1;
        // var_dump($this->page);
        $this->level = (int) $level;

        if($this->viewAccessNivels()){
            //instância a classe:AdmsPagination, cria o objeto:$pagination 
            $pagination = new \Adms\Models\helper\AdmsPagination(URLADM . 'list-permission/index', "?level={$this->level}");
            //instância o método para fazer a paginação
            $pagination->condition($this->page, $this->limitResult);
            //cria a query, buscar quantidade total de registros da tabela:adms_users
            $pagination->pagination("SELECT COUNT(lev_pag.id_level_page) AS num_result FROM adms_level_page AS lev_pag LEFT JOIN adms_page AS pag ON pag.id_page=lev_pag.id_page 
            WHERE lev_pag.id_access_level=:id_access_level
            AND (((SELECT permission_level_page FROM adms_level_page WHERE id_page=lev_pag.id_page 
            AND id_access_level={$_SESSION['id_access_level']}) = 1) OR (pag.public_page = 1))", "id_access_level={$this->level}");
            //recebe o resultado do método:getResult() e atribui para:$this->resultPg
            $this->resultPg = $pagination->getResult();
            // var_dump($this->resultPg);
            //-------------------------------------------------------------------------------------

            $listPermission = new \Adms\Models\helper\AdmsRead();
            // CONCEITO NOVO - QUERY dentro de outra QUERY
            $listPermission->fullRead("SELECT lev_pag.id_level_page, lev_pag.permission_level_page, lev_pag.order_level_page, lev_pag.print_menu, lev_pag.dropdown_menu, lev_pag.id_access_level, lev_pag.id_page, pag.name_page FROM adms_level_page AS lev_pag 
            LEFT JOIN adms_page AS pag ON pag.id_page=lev_pag.id_page 
            INNER JOIN adms_access_level AS lev ON lev.id_access_level=lev_pag.id_access_level 
            WHERE lev_pag.id_access_level=:id_access_level AND lev.order_level >=:order_level
            AND (((SELECT permission_level_page FROM adms_level_page WHERE id_page=lev_pag.id_page 
            AND id_access_level={$_SESSION['access_level_id']}) = 1) OR (pag.public_page = 1))
            ORDER BY pag.id_page DESC LIMIT :limit OFFSET :offset", "id_access_level={$this->level}&order_level=".$_SESSION['order_level']."&limit={$this->limitResult}&offset={$pagination->getOffset()}");

            $this->resultBd = $listPermission->getResult();
            if ($this->resultBd) {
                // var_dump($this->resultBd);
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 052! Nenhuma permissão para o Nivel de Acesso encontrado!</p>";
                $this->result = false;
            }
        } else {
            // $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Nenhuma permissão para o Nivel de Acesso encontrado!</p>";
                $this->result = false;
        }
    }
    /** ========================================================================================
    */
    private function viewAccessNivels():bool
    {
        $viewAccessNivels = new \Adms\Models\helper\AdmsRead();
        $viewAccessNivels->fullRead("SELECT access_level FROM adms_access_level WHERE id_access_level=:id_access_level AND order_level >=:order_level LIMIT :limit", "id_access_level={$this->level}&order_level=".$_SESSION['order_level']."&limit=1");

        $this->resultBdLevel = $viewAccessNivels->getResult();
        if($this->resultBdLevel){
            // var_dump($this->resultBd);
            return true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 052.1(viewAccessNivels())! Nivel de acesso não encontrado!</p>";
            return false;
        }
    }
}
