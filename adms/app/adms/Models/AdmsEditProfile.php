<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe:AdmsViewUsers, Editar o perfil do usuário */
class AdmsEditProfile
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result = false;
    /** @var array - Recebe os parametros    */
    private array|null $data;
    /** @var array - Recebe os registros do banco de dados    */
    private array|null $resultBd;

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
    public function viewProfile():void
    {
        $viewUsers = new \Adms\Models\helper\AdmsRead();
        $viewUsers->fullRead("SELECT id_user, adm_user, adm_email FROM adms_user WHERE id_user=:id LIMIT :limit", "id=".$_SESSION['id_user']."&limit=1");

        $this->resultBd = $viewUsers->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 087! Perfil não encontrado!</p>";
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
        //usa o objeto:$valEmptyField para instanciar o método:valField() para validar se existe dados dentro do atributo:$this->data
        $valEmptyField->valField($this->data);
        //verifica se o método:getResult() retorna true, se sim significa q deu tudo certo se não aprensenta o Erro
        if ($valEmptyField->getResult()) {
            //instância o método:valInput() para validar os dados
            $this->valInput();
            // $this->result = false;
        } else {
            $this->result = false;
        }
    }
    /** ============================================================================================
     * Instânciar o Helper:AdmsValEmail para verificar se o e-mail é válido
     * Instânciar o Helper:AdmsValEmailSingle para verificar se o e-mail não está cadastrado no DB, não permitido cadastro com e-mail duplicado.
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
        $valEmailSingle->validateEmailSingle($this->data['adm_email'], true, $_SESSION['id_user']);

        //validar se o USER é único
        $valUserSingle = new \Adms\Models\helper\AdmsValUserSingle();
        $valUserSingle->validateUserSingle($this->data['adm_user'], true, $_SESSION['id_user']);

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

        $upUser = new \Adms\Models\helper\AdmsUpdate();
        $upUser->exeUpdate("adms_user", $this->data, "WHERE id_user=:id", "id=".$_SESSION['id_user']);
        if($upUser->getResult()){
            $_SESSION['adm_user'] = $this->data['adm_user'];
            $_SESSION['adm_email'] = $this->data['adm_email'];
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Perfil Editado com sucesso</p>";
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 087.1! Não foi possível Editar o Perfil</p>";
            $this->result = false;
        }
    }

}
