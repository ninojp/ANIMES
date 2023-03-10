<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe:AdmsEditEmailConfig, Editar os dados do e-mail de configuração no banco de dados */
class AdmsEditEmailConfig
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result = false;
    /** @var array - Recebe os dados do conteúdo do e-mail     */
    private array|null $resultBd;
    /** @var integer|string|null - Recebe o ID do registro    */
    private int|string|null $id_email_config;
    /** @var array|null - Recebe as informações do formulário     */
    private array|null $data;
    /** @var array|null - Recebe os campos que devem ser retirados da validação   */
    private array|null $dataExitVal;

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
    public function viewAtualEmailConfs(int $id_email_config):void
    {
        $this->id_email_config = $id_email_config;

        $viewAtualEmailConf = new \Adms\Models\helper\AdmsRead();
        $viewAtualEmailConf->fullRead("SELECT id_email_config, title_email_config, name_email_config, email_config, host_email_config, user_email_config, smtpsecure, port, modified FROM adms_email_config WHERE id_email_config=:id LIMIT :limit", "id={$this->id_email_config}&limit=1");

        $this->resultBd = $viewAtualEmailConf->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 135! Nenhum Registro(e-mail) encontrado!</p>";
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
        //o codigo abaixo é apenas para retirar um campo da VALIDAÇÃO
        //atribui o valor que está no campo NICKNAME para o atributo:$dataExitVal
        $this->dataExitVal['smtpsecure'] = $this->data['smtpsecure'];
        $this->dataExitVal['port'] = $this->data['port'];
        //Destroi o valor que está no atributo:$this->data['nickname']
        unset($this->data['smtpsecure'], $this->data['port']);
        // var_dump($this->data);
        // var_dump($this->dataExitVal);

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
     * Instânciar o Método:add quando não houver nenhum erro de preenchimento
     * Retorna flase quando houver algun erro  -  @return void  */
    private function valInput(): void
    {
        //instancia a classe para Validar o email
        $valEmail = new \Adms\Models\helper\AdmsValEmail();
        $valEmail->validateEmail($this->data['email_config']);

        //validar se o email é único
        $valEmailSingleConfs = new \Adms\Models\helper\AdmsValEmailSingleConfig();
        $valEmailSingleConfs->valEmailSingleConfig($this->data['email_config'], true, $this->data['id_email_config']);

        if (($valEmail->getResult()) and ($valEmailSingleConfs->getResult())) {
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
        //Atribui NOVAMENTE(recupera) o valor q está no atributo:$this->dataExitval['nickname'] e coloca no atributo:$this->data['nickname'] para ser inserido no DB
        $this->data['smtpsecure'] = $this->dataExitVal['smtpsecure'];
        $this->data['port'] = $this->dataExitVal['port'];
        // var_dump($this->data);
        // $this->result = false;

        $upUser = new \Adms\Models\helper\AdmsUpdate();
        $upUser->exeUpdate("adms_email_config", $this->data, "WHERE id_email_config=:id", "id={$this->data['id_email_config']}");

        if($upUser->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Configurações de E-mail editadas com sucesso</p>";
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 135.1! Não foi possível Editar as Configurações de E-mail</p>";
            $this->result = false;
        }
    }
    
}
