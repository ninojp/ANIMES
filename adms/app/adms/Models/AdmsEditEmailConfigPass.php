<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe:AdmsEditEmailConfigPass, Editar a senha do usuário no banco de dados */
class AdmsEditEmailConfigPass
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result = false;
    /** @var array - Recebe os dados do conteúdo do e-mail     */
    private array|null $resultBd;
    /** @var integer|string|null - Recebe o ID do registro    */
    private int|string|null $id_email_config;
    /** Recebe as indomações do formulário
     * @var array|null     */
    private array|null $data;

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
    public function viewAtualEmailPass(int $id_email_config):void
    {
        $this->id_email_config = $id_email_config;

        $viewAtualEmailPass = new \Adms\Models\helper\AdmsRead();
        $viewAtualEmailPass->fullRead("SELECT id_email_config FROM adms_email_config WHERE id_email_config=:id LIMIT :limit", "id={$this->id_email_config}&limit=1");

        $this->resultBd = $viewAtualEmailPass->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 137! Registro(e-mail) não encontrado!</p>";
            $this->result = false;
        }
    }
    public function updateEmailPass(array $data = null):void
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
            // $this->result = true;
        } else {
            $this->result = false;
        }
    }
    /** ============================================================================================
     * Instânciar o Helper:AdmsValPassword Validar a senha
     * Instânciar o Método:add quando não houver nenhum erro de preenchimento
     * Retorna false quando houver algun erro  -  @return void  */
    private function valInput(): void
    {
        //instancia a classe para Validar a senha
        $valPassword = new \Adms\Models\helper\AdmsValPassword();
        $valPassword->validatePassword($this->data['pass_email_config']);

        if ($valPassword->getResult()) {
            $this->edit();
        } else {
            $this->result = false;
        }
    }
    /** ============================================================================================
     * @return void     */
    private function edit():void
    {
        $this->data['pass_email_config'] = password_hash($this->data['pass_email_config'], PASSWORD_DEFAULT);
        $this->data['modified'] = date("Y-m-d H:i:s");

        $upEmailConfs = new \Adms\Models\helper\AdmsUpdate();
        $upEmailConfs->exeUpdate("adms_email_config", $this->data, "WHERE id_email_config=:id", "id={$this->data['id_email_config']}");
        if($upEmailConfs->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! A Senha do E-mail Editado com sucesso</p>";
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 137.1! Não foi possível Editar a Senha do E-mail</p>";
            $this->result = false;
        }
    }
}
