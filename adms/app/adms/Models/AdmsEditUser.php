<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe:AdmsViewUsers, Editar o usuário no banco de dados */
class AdmsEditUser
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result = false;
    /** @var array - Recebe os dados do conteúdo do e-mail     */
    private array|null $resultBd;
    /** @var integer|string|null - Recebe o ID do registro    */
    private int|string|null $id_user;
    /** @var array|null - Recebe as informações do formulário     */
    private array|null $data;
    /** @var array|null - Recebe os campos que devem ser retirados da validação   */
    private array|null $dataExitVal;

    private array $listRegistryAdd;

    /** ============================================================================================
     * Retorna TRUE se executar o processo com sucesso, FALSE quando houver erro e atribui para o atributo:$this->result    -  @return void     */
    function getResult():bool
    {
        return $this->result;
    }
    /** ============================================================================================
     * Retorna os detalhes do registro
     * @return void     */
    function getResultBd():array|null
    {
        return $this->resultBd;
    }
    /** ============================================================================================
    */
    public function viewUsers(int $id_user):void
    {
        $this->id_user = $id_user;

        $viewUsers = new \Adms\Models\helper\AdmsRead();
        $viewUsers->fullRead("SELECT usr.id_user, usr.adm_user, usr.adm_email, usr.id_sits_user, usr.id_access_level FROM adms_user AS usr INNER JOIN adms_access_level AS lev ON lev.id_access_level=usr.id_access_level WHERE usr.id_user=:id_user AND lev.order_level >:order_level LIMIT :limit", "id_user={$this->id_user}&order_level=".$_SESSION['order_level']."&limit=1");

        $this->resultBd = $viewUsers->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 037! Usuário não encontrado!</p>";
            $this->result = false;
        }
    }
    /** ===========================================================================================
     * @param array|null $data
     * @return void   */
    public function update(array $data = null):void
    {
        $this->data = $data;
        // var_dump($this->data);

        //instancia a classe:AdmsValEmptyField e cria o objeto:$valEmptyField
        $valEmptyField = new \Adms\Models\helper\AdmsValEmptyField();
        //usa o objeto:$valEmptyField para instanciar o método:valField() para validar os dados dentro do atributo:$this->data
        $valEmptyField->valField($this->data);
        //verifica se o método:getResult() retorna true, se sim significa q deu tudo certo se não aprensenta o Erro
        if ($valEmptyField->getResult()) {
            $this->valInput();
            // $this->result = false;
        } else {
            $this->result = false;
        }
    }
    /** ============================================================================================
     * Instânciar o Helper:AdmsValEmail para verificar se o e-mail é válido
     * Instânciar o Helper:AdmsValEmailSingle para verificar se o e-mail não está cadastrado no DB, não permitido cadastro com e-mail duplicado.
     * Instânciar o Helper:validatePassword para validar a senha
     * Instânciar o Helper:validateUserSingleLogin para verificar se o usuário não está cadastrado no DB, não permitido cadastro duplicado
     * Instânciar o Método:add quando não houver nenhum erro de preenchimento
     * Retorna flase quando houver algun erro  -  @return void  */
    private function valInput(): void
    {
        //instancia a classe para Validar o email
        $valEmail = new \Adms\Models\helper\AdmsValEmail();
        $valEmail->validateEmail($this->data['adm_email']);

        //validar se o email é único
        $valEmailSingle = new \Adms\Models\helper\AdmsValEmailSingle();
        $valEmailSingle->validateEmailSingle($this->data['adm_email'], true, $this->data['id_user']);

        //validar se o USER é único
        $valUserSingle = new \Adms\Models\helper\AdmsValUserSingle();
        $valUserSingle->validateUserSingle($this->data['adm_user'], true, $this->data['id_user']);

        if (($valEmail->getResult()) and ($valEmailSingle->getResult()) and ($valUserSingle->getResult())) {
            $this->edit();
        } else {
            $this->result = false;
        }
    }
    /** =============================================================================================
     * @return void     */
    private function edit():void
    {
        // var_dump($this->data);
        $this->data['modified'] = date("Y-m-d H:i:s");
        // var_dump($this->data);
        // $this->result = false;TESTE

        $upUser = new \Adms\Models\helper\AdmsUpdate();
        $upUser->exeUpdate("adms_user", $this->data, "WHERE id_user=:id_user", "id_user={$this->data['id_user']}");

        if($upUser->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Usuário Editado com sucesso</p>";
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 037.1! Não foi possível Editar o usuário</p>";
            $this->result = false;
        }
    }
    /** ===========================================================================================
     * @return array     */
    public function listSelect():array
    {
        $list = new \Adms\Models\helper\AdmsRead();
        $list->fullRead("SELECT id_sits_user, name_sits_user FROM adms_sits_user ORDER BY name_sits_user ASC");
        $registry['sit'] = $list->getResult();

        //listar o nivel de acesso da tabela:adms_access_levels para utilizar no select da view de adição de usuário, só pode adicionar usuários com NIVEL de ACESSO inferior aos dele
        $list->fullRead("SELECT id_access_level, access_level FROM adms_access_level WHERE order_level >:order_level ORDER BY access_level ASC", "order_level=".$_SESSION['order_level']);
        $registry['lev'] = $list->getResult();

        $this->listRegistryAdd = ['sit' => $registry['sit'], 'lev' => $registry['lev']];
        // var_dump($this->listRegistryAdd);

        return $this->listRegistryAdd;
    }
}
