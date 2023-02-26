<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe:AdmsListUsers, deve receber os dados(do DB) dos usuários para listar */
class AdmsListTypesPage
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result;

    /** @var array - Recebe os dados(registros) do Banco de dados    */
    private array|null $resultBd;

    /** @var int -  - Recebe o numero da pagina atual   */
    private int $page;

    /** @var integer - Recebe a quantidade de registros que deve retornar do DB    */
    private int $limitResult = 10;

    /** @var string|null -  - Recebe a paginação  */
    private string|null $resultPg;

    /** @var string|null -  - Recebe o nome a ser pesquisado  */
    private string|null $searchName;

    /** @var string|null -  - Recebe o E-mail a ser pesquisado  */
    private string|null $searchTypes;

    /** @var string|null - Recebe o nome a ser pesquisado, que pode conter caracteres antes e depois  */
    private string|null $searchNameValue;

    /** @var string|null - Recebe o E-mail a ser pesquisado, que pode conter caracteres antes e depois  */
    private string|null $searchTypesPgsValue;

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
     * @return string|null  - Retorna a paginação   */
    function getResultPg(): string|null
    {
        return $this->resultPg;
    }
    /** ============================================================================================
     * Método para pesquisar Tipos de pgs na tabela:adms_types_pgs e listar as informações na view
     * Recebe o parametro:$page para que seja feita a paginação do resultado    */
    public function listTypesPgs(int $page = null): void
    {
        //------------------------------ PAGINAÇÂO -------------------------------------------
        //Atribui o parametro recebido:$page para o atributo:$this->page
        //converte para inteiro e verifica se possui valor, se não atribui o valor 1
        $this->page = (int) $page ? $page : 1;
        // var_dump($this->page);
        //instância a classe:AdmsPagination, cria o objeto:$pagination 
        $pagination = new \Adms\Models\helper\AdmsPagination(URLADM . 'list-types-page/index');
        //instância o método para fazer a paginação
        $pagination->condition($this->page, $this->limitResult);
        //cria a query, buscar quantidade total de registros da tabela:adms_users
        $pagination->pagination("SELECT COUNT(id_type_page) AS num_result FROM adms_type_page");
        //recebe o resultado do método:getResult() e atribui para:$this->resultPg
        $this->resultPg = $pagination->getResult();
        // var_dump($this->resultPg);
        //-------------------------------------------------------------------------------------

        $listTypespgs = new \Adms\Models\helper\AdmsRead();
        //INNER JOIN, é obrigátorio(para retornar o registro) q a chave EXTRANGEIRA:adms_sits_user_id exista na tabela outra tabela, a qual está se fazendo o inner join(adms_sits_users)
        $listTypespgs->fullRead("SELECT id_type_page, type_page, name_type_page, order_type_page FROM adms_type_page ORDER BY id_type_page DESC LIMIT :limit OFFSET :offset", "limit={$this->limitResult}&offset={$pagination->getOffset()}");

        $this->resultBd = $listTypespgs->getResult();
        if ($this->resultBd) {
            // var_dump($this->resultBd);
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 111! Nenhum Tipo de pagina encontrado!</p>";
            $this->result = false;
        }
    }
    /** ============================================================================================
     * Método para pesquisar(formulario de pesquisa) usuários na tabela:adms_users e listar as informações na view
     * Recebe o parametro:$page para que seja feita a paginação do resultado    */
    public function listSeachTypesPgs(int $page = null, string|null $search_name, string|null $search_type): void
    {
        //atribui os parametros recebidos para os devidos atributos
        $this->page = (int) $page ? $page : 1;
        //usa o trim para retirar os espaços em branco
        $this->searchName = trim($search_name);
        $this->searchTypes = trim($search_type);
        // var_dump($this->searchName);
        // var_dump($this->searchEmail);

        //define que a variavel q vai ser usada na query de pesquisa pode ter valores antes e depois
        $this->searchNameValue = "%" . $this->searchName . "%";
        $this->searchTypesPgsValue = "%" . $this->searchTypes . "%";
        // var_dump($this->searchNameValue);
        // var_dump($this->searchEmailValue);

        //verifica se está recebendo os dois campos de pesquisa, nome e email
        if ((!empty($this->searchName)) and (!empty($this->searchTypes))) {
            $this->searchTypesPgsName();
            //verifica se está recebendo o NOME
        } elseif ((!empty($this->searchName)) and (empty($this->searchTypes))) {
            $this->searchName();
            //verifica se está recebendo o E-MAIL
        } elseif ((empty($this->searchName)) and (!empty($this->searchTypes))) {
            $this->searchType();
        } else {
            $this->searchTypesPgsName();
        }
    }
    /** ============================================================================================
     * Método para pesquisar pelo NOME e E-Mail    */
    public function searchTypesPgsName(): void
    {
        //instância a classe:AdmsPagination, cria o objeto:$pagination 
        $pagination = new \Adms\Models\helper\AdmsPagination(URLADM . 'list-types-page/index', "?search_name={$this->searchName}&search_type={$this->searchTypes}");
        //instância o método para fazer a paginação
        $pagination->condition($this->page, $this->limitResult);
        //cria a query, buscar quantidade total de registros da tabela:adms_users
        $pagination->pagination("SELECT COUNT(atp.id_type_page) AS num_result FROM adms_type_page AS atp WHERE atp.name_type_page LIKE :search_name OR atp.type_page LIKE :search_type", "search_name={$this->searchNameValue}&search_type={$this->searchTypesPgsValue}");
        //recebe o resultado do método:getResult() e atribui para:$this->resultPg
        $this->resultPg = $pagination->getResult();
        // var_dump($this->resultPg);
        //-------------------------------------------------------------------------------------

        $listTypesPgsName = new \Adms\Models\helper\AdmsRead();
        //INNER JOIN, é obrigátorio(para retornar o registro) q a chave EXTRANGEIRA:adms_sits_user_id exista na tabela outra tabela, a qual está se fazendo o inner join(adms_sits_users)
        $listTypesPgsName->fullRead("SELECT atp.id_type_page, atp.type_page, atp.name_type_page, atp.order_type_page FROM adms_type_page AS atp WHERE atp.name_type_page LIKE :search_name OR atp.type_page LIKE :search_type ORDER BY atp.id_type_page DESC LIMIT :limit OFFSET :offset", "search_name={$this->searchNameValue}&search_type={$this->searchTypesPgsValue}&limit={$this->limitResult}&offset={$pagination->getOffset()}");

        $this->resultBd = $listTypesPgsName->getResult();
        if ($this->resultBd) {
            // var_dump($this->resultBd);
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 111.1! Nenhum Nome ou Tipo de pagina encontrado!</p>";
            $this->result = false;
        }
    }
    /** ============================================================================================
     * Método para pesquisar somente pelo NOME    */
    public function searchName(): void
    {
        //instância a classe:AdmsPagination, cria o objeto:$pagination 
        $pagination = new \Adms\Models\helper\AdmsPagination(URLADM . 'list-types-page/index', "?search_name={$this->searchName}&search_type={$this->searchTypes}");
        //instância o método para fazer a paginação
        $pagination->condition($this->page, $this->limitResult);
        //cria a query, buscar quantidade total de registros da tabela:adms_users
        $pagination->pagination("SELECT COUNT(atp.id_type_page) AS num_result FROM adms_type_page AS atp WHERE atp.name_type_page LIKE :search_name", "search_name={$this->searchNameValue}");
        //recebe o resultado do método:getResult() e atribui para:$this->resultPg
        $this->resultPg = $pagination->getResult();
        // var_dump($this->resultPg);
        //-------------------------------------------------------------------------------------

        $listName = new \Adms\Models\helper\AdmsRead();
        //INNER JOIN, é obrigátorio(para retornar o registro) q a chave EXTRANGEIRA:adms_sits_user_id exista na tabela outra tabela, a qual está se fazendo o inner join(adms_sits_users)
        $listName->fullRead("SELECT atp.id_type_page, atp.type_page, atp.name_type_page, atp.order_type_page FROM adms_type_page AS atp WHERE atp.name_type_page LIKE :search_name ORDER BY atp.id_type_page DESC LIMIT :limit OFFSET :offset", "search_name={$this->searchNameValue}&limit={$this->limitResult}&offset={$pagination->getOffset()}");

        $this->resultBd = $listName->getResult();
        if ($this->resultBd) {
            // var_dump($this->resultBd);
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 111.2! Nome de tipo de pgs encontrado!</p>";
            $this->result = false;
        }
    }
    /** ============================================================================================
     * Método para pesquisar somente pelo E-Mail    */
    public function searchType(): void
    {
        //instância a classe:AdmsPagination, cria o objeto:$pagination 
        $pagination = new \Adms\Models\helper\AdmsPagination(URLADM . 'list-types-pages/index', "?search_name={$this->searchName}&search_type={$this->searchTypes}");
        //instância o método para fazer a paginação
        $pagination->condition($this->page, $this->limitResult);
        //cria a query, buscar quantidade total de registros da tabela:adms_users
        $pagination->pagination("SELECT COUNT(atp.id_type_page) AS num_result FROM adms_type_page AS atp WHERE atp.type_page LIKE :search_type", "search_type={$this->searchTypesPgsValue}");
        //recebe o resultado do método:getResult() e atribui para:$this->resultPg
        $this->resultPg = $pagination->getResult();
        // var_dump($this->resultPg);
        //-------------------------------------------------------------------------------------

        $listUsersEmail = new \Adms\Models\helper\AdmsRead();
        //INNER JOIN, é obrigátorio(para retornar o registro) q a chave EXTRANGEIRA:adms_sits_user_id exista na tabela outra tabela, a qual está se fazendo o inner join(adms_sits_users)
        $listUsersEmail->fullRead("SELECT atp.id_type_page, atp.type_page, atp.name_type_page, atp.order_type_page FROM adms_type_page AS atp WHERE atp.type_page LIKE :search_type ORDER BY atp.order_type_page ASC LIMIT :limit OFFSET :offset", "search_type={$this->searchTypesPgsValue}&limit={$this->limitResult}&offset={$pagination->getOffset()}");

        $this->resultBd = $listUsersEmail->getResult();
        if ($this->resultBd) {
            // var_dump($this->resultBd);
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 111.3! Nenhum Tipo de pgs encontrado!</p>";
            $this->result = false;
        }
    }
}
