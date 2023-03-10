<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe:AdmsNewUser, é filha(Herda) da classe:AdmsConn(abstrata responsável pela conexão) */
class AdmsAddEmailConfig
{
    //recebido como parametro através do método:create() e colocado neste atributo
    private array|null $data;
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result;

    /** @var array|null - Recebe os campos que devem ser retirados da validação   */
    private array|null $tempExitVal;

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
    public function createEmailConfs(array $data = null)
    {
        //atribui o parametro:$data para o atributo:$this->data
        $this->data = $data;
        // var_dump($this->data);

        //Retirar temporáriamente os campos da VALIDAÇÃO
        //atribui o valor que está na posição:['...'] para o atributo:$tempExitVal
        $this->tempExitVal['smtpsecure'] = $this->data['smtpsecure'];
        $this->tempExitVal['port'] = $this->data['port'];
        //Destroi os valores que está na posição do atributo:$this->data['...']
        unset($this->data['smtpsecure'], $this->data['port']);

        //instancia a classe:AdmsValEmptyField e cria o objeto:$valEmptyField
        $valEmptyField = new \Adms\Models\helper\AdmsValEmptyField();
        //usa o objeto:$valEmptyField para instanciar o método:valField() para validar os dados dentro do atributo:$this->data
        $valEmptyField->valField($this->data);
        //verifica se o método:getResult() retorna true, se sim significa q deu tudo certo se não aprensenta o Erro
        if ($valEmptyField->getResult()) {
            $this->valInputEmailConfs();
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
    private function valInputEmailConfs(): void
    {
        //instancia a classe para Validar o email
        $valEmail = new \Adms\Models\helper\AdmsValEmail();
        $valEmail->validateEmail($this->data['email_config']);

        //instancia a classe para Validar se o email já existe no banco de dados
        $valEmailConfsSingle = new \Adms\Models\helper\AdmsValEmailSingleConfig();
        $valEmailConfsSingle->valEmailSingleConfig($this->data['email_config']);

        //instancia a classe para Validar a senha
        $valPassword = new \Adms\Models\helper\AdmsValPassword();
        $valPassword->validatePassword($this->data['pass_email_config']);

        if (($valEmail->getResult()) and ($valEmailConfsSingle->getResult()) and ($valPassword->getResult())) {
            $this->addEmailConfs();
        } else {
            $this->result = false;
        }
    }
    /** ===========================================================================================
     * Cadastrar usuário no DB  - @return void
     * Retorna true quando cadastrar com sucesso e false quando não cadastrar   */
    private function addEmailConfs(): void
    {
        // Criptografar a senha
        $this->data['pass_email_config'] = password_hash($this->data['pass_email_config'], PASSWORD_DEFAULT);
        $this->data['created'] = date("Y-m-d H:i:s");
        //Atribui NOVAMENTE(recupera) os valores q está no atributo:$this->temExitval['...'] e coloca no atributo:$this->data['...'] para ser inserido no DB se necessário
        $this->data['smtpsecure'] = $this->tempExitVal['smtpsecure'];
        $this->data['port'] = $this->tempExitVal['port'];
        // var_dump($this->data);
        // foi usado para encontrar um erro, antes de instânciar a classe(foi comentada) abaixo
        // $this->result = false;
        
        $addEmailConfs = new \Adms\Models\helper\AdmsCreate();
        $addEmailConfs->exeCreate("adms_email_config", $this->data);

        //verifica se existe o ultimo ID inserido
        if ($addEmailConfs->getResult()) {
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! E-mail de Configuração cadastrado com sucesso</p>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 132! Não foi possível cadastrar o E-mail de Configuração</p>";
            $this->result = false;
        }
    }

}
