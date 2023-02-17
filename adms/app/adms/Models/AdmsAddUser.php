<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe:AdmsAddUsers para realizar a adição de novos usuário  */
class AdmsAddUser
{
    //recebido como parametro através do método:create() e colocado neste atributo
    private array|null $data;

    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result;

    private array $listRegistryAdd;

    /** ============================================================================================
     * Recebe o resultado da query e atribui para o atributo:$this->result, Retorna true quando executado com sucesso e false quando houver erro  -  @return void     */
    function getResult():bool
    {
        return $this->result;
    }
    /** ==========================================================================================
     * Este método recebe os PARAMETROS:$data e depois atribui para o atributo:$this->data
     * Recebe os valores do fomulário.   -  @param array|null $data
     * Instância o Helper:AdmsValEmptyField para verificar se todos os campos foram preenchidos
     * Instância o método:valInput para validar os dados dos campos. 
     * Retorna false quando algun campo está vazio  -  @return void    */
    public function create(array $data = null)
    {
        //atribui o parametro:$data para o atributo:$this->data
        $this->data = $data;
        // var_dump($this->data);
        //instancia a classe:AdmsValEmptyField e cria o objeto:$valEmptyField
        $valEmptyField = new \Adms\Models\helper\AdmsValEmptyField();
        //usa o objeto:$valEmptyField para instanciar o método:valField() para validar os dados dentro do atributo:$this->data
        $valEmptyField->valField($this->data);
        //verifica se o método:getResult() retorna true, se sim significa q deu tudo certo se não aprensenta o Erro
        if ($valEmptyField->getResult()) {
            $this->valInput();
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

        //instancia a classe para Validar se o email já existe no banco de dados
        $valEmailSingle = new \Adms\Models\helper\AdmsValEmailSingle();
        $valEmailSingle->validateEmailSingle($this->data['adm_email']);

        //instancia a classe para Validar a senha
        $valPassword = new \Adms\Models\helper\AdmsValPassword();
        $valPassword->validatePassword($this->data['adm_pass']);

        //instancia a classe para validadr se o usuário já existe no DB
        $valUserSingleLogin = new \Adms\Models\helper\AdmsValUserSingle();
        $valUserSingleLogin->validateUserSingle($this->data['adm_user']);

        if (($valEmail->getResult()) and ($valEmailSingle->getResult()) and ($valPassword->getResult()) and ($valUserSingleLogin->getResult())) {
            $this->add();
        } else {
            $this->result = false;
        }
    }
    /** ===========================================================================================
     * Cadastrar usuário no DB  - @return void
     * Retorna true quando cadastrar com sucesso e false quando não cadastrar   */
    private function add(): void
    {
        // Criptografar a senha
        $this->data['adm_pass'] = password_hash($this->data['adm_pass'], PASSWORD_DEFAULT);
        $this->data['confirm_email'] = password_hash($this->data['adm_pass'].date("Y-m-d H:i:s"), PASSWORD_DEFAULT);
        $this->data['created'] = date("Y-m-d H:i:s");
        // var_dump($this->data);
        // foi usado para encontrar um erro, antes de instânciar a classe(foi comentada) abaixo
        // $this->result = false;
        $createUser = new \Adms\Models\helper\AdmsCreate();
        $createUser->exeCreate("adms_user", $this->data);

        //verifica se existe o ultimo ID inserido
        if ($createUser->getResult()) {
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Usuário cadastrado com sucesso</p>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 034! Não foi possível cadastrar o usuário</p>";
            $this->result = false;
        }
    }
    /** ===========================================================================================
     * @return array     */
    public function listSelect():array
    {
        //listar os dados da tabela:adms_sits_users para utilizar no select da view de adição de usuário
        $list = new \Adms\Models\helper\AdmsRead();
        $list->fullRead("SELECT id_sits_user, name_sits_user FROM adms_sits_user ORDER BY name_sits_user ASC");
        $registry['sit'] = $list->getResult();

        //listar o nivel de acesso da tabela:adms_access_levels para utilizar no select da view de adição de usuário, só pode adicionar usuários com NIVEL de ACESSO inferior aos dele
        $list->fullRead("SELECT id_access_level, access_level FROM adms_access_level WHERE order_level >:order_level ORDER BY access_level ASC", "order_level=".$_SESSION['order_level']);
        $registry['lev'] = $list->getResult();

        $this->listRegistryAdd = ['sit' => $registry['sit'], 'lev' =>$registry['lev']];
        // var_dump($this->listRegistryAdd);

        return $this->listRegistryAdd;
    }
}
