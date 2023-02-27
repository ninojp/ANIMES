<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe:AdmsListUsers, deve receber os dados(do DB) dos usuários para listar */
class AdmsListEmailConfig
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result;

    /** @var array - Recebe os dados(registros) do Banco de dados    */
    private array|null $resultBd;

    /** @var int -  - Recebe o numero da pagina atual   */
    private int $page;

    /** @var integer - Recebe a quantidade de registros que deve retornar do DB    */
    private int $limitResult = 8;

    /** @var string|null -  - Recebe a paginação  */
    private string|null $resultPg;

    /** ============================================================================================
     * Retorna true quando executar o processo com sucesso e false quando houver erro
     * @return void     */
    function getResult():bool
    {
        return $this->result;
    }
    /** ============================================================================================
     * Retorna os registros(usuários) do DB 
     * @return void     */
    function getResultBd():array|null
    {
        return $this->resultBd;
    }
    /** ============================================================================================
     * @return string|null  - Retorna a paginação   */
    function getResultPg():string|null
    {
        return $this->resultPg;
    }
    /** ============================================================================================
    */
    public function listAtualEmails(int $page = null):void
    {
        //------------------------------ PAGINAÇÂO -------------------------------------------
        //Atribui o parametro recebido:$page para o atributo:$this->page
        //converte para inteiro e verifica se possui valor, se não atribui o valor 1
        $this->page = (int) $page ? $page : 1;
        // var_dump($this->page);
        //instância a classe:AdmsPagination, cria o objeto:$pagination 
        $pagination = new \Adms\Models\helper\AdmsPagination(URLADM.'list-email-config/index');
        //instância o método para fazer a paginação
        $pagination->condition($this->page, $this->limitResult);
        //cria a query, buscar quantidade total de registros da tabela:adms_users
        $pagination->pagination("SELECT COUNT(id_email_config) AS num_result FROM adms_email_config");
        //recebe o resultado do método:getResult() e atribui para:$this->resultPg
        $this->resultPg = $pagination->getResult();
        // var_dump($this->resultPg);
        // die('AQUI!');
        //-------------------------------------------------------------------------------------

        $listAtualEmails = new \Adms\Models\helper\AdmsRead();
        //INNER JOIN, é obrigátorio(para retornar o registro) q a chave EXTRANGEIRA:adms_sits_user_id exista na tabela outra tabela, a qual está se fazendo o inner join(adms_sits_users)
        $listAtualEmails->fullRead("SELECT id_email_config, title_email_config, name_email_config, email_config FROM adms_email_config ORDER BY id_email_config DESC LIMIT :limit OFFSET :offset", "limit={$this->limitResult}&offset={$pagination->getOffset()}");

        $this->resultBd = $listAtualEmails->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 130! Nenhum E-mail encontrado!</p>";
            $this->result = false;
        }
    }
}
