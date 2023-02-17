<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Confirmar a chave atualizar senha. Cadastrar nova senha */
class AdmsUpdatePass
{
    /** @var string - Recebe da URL a chave para atualizar a senha  */
    private string $key;
    /** @var boolean - Recebe do método:getResult(true or false), q será atribuido aqui */
    private bool $result;
    /** @var array - Recebe os dados do conteúdo do e-mail  */
    private array $resultBd;
    /** @var array - Recebe os valores q devem ser salvos no banco de dados  */
    private array $dataSave;
    /** @var array|null - recebe as informações do formulário    */
    private array|null $data;

    /** ============================================================================================
     * Recebe o resultado da query e atribui para o atributo:$this->result o valor true ou false
     * @return void  */
    function getResult()
    {
        return $this->result;
    }
    /** ==========================================================================================
     * @param array|null $data
     * @return void    */
    // este método recebe os PARAMETROS:$data e depois atribui para o atributo:$this->data
    public function valKey(string $key):bool
    {
        $this->key = $key;
        // var_dump($this->key);
        $viewKeyUpPass = new \Adms\Models\helper\AdmsRead();
        $viewKeyUpPass->fullRead("SELECT id_user FROM adms_user WHERE adm_pass_recover=:adm_pass_recover LIMIT :limit", "adm_pass_recover={$this->key}&limit=1");
        $this->resultBd = $viewKeyUpPass->getResult();
        if($this->resultBd){
            $this->result = true;
            return true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 022! Link inválido, Solicite um novo Link <a href='".URLADM."recover-pass/index'>Clique aqui</a></p>";
            $this->result = false;
            return false;
        }
    }
    /** =============================================================================================
     * @param array|null $data
     * @return void     */
    public function editPassword(array $data = null):void
    {
        $this->data = $data;
        // var_dump($this->data);
        $valEmptyField = new \Adms\Models\helper\AdmsValEmptyField();
        $valEmptyField->valField($this->data);
        if($valEmptyField->getResult()){
            $this->valInput();
        }else{
            $this->result = false;
        }
    }
    /** ==============================================================================================
     * @return void     */
    private function valInput():void
    {
        $valPasword = new \Adms\Models\helper\AdmsValPassword(); 
        $valPasword->validatePassword($this->data['adm_pass']); 
        if($valPasword->getResult()){
            if($this->valKey($this->data['key'])){
                $this->updatePassword();
            }else{
                $this->result = false;
            }
        }else{
            $this->result = false;
        }
    }
    /** ============================================================================================
     * @return void     */
    private function updatePassword():void
    {
        $this->dataSave['adm_pass_recover'] = null;
        $this->dataSave['adm_pass'] = password_hash($this->data['adm_pass'], PASSWORD_DEFAULT);
        $this->dataSave['modified'] = date("Y-m-d H:i:s");

        $upPassword = new \Adms\Models\helper\AdmsUpdate();
        $upPassword->exeUpdate("adms_user", $this->dataSave, "WHERE id_user=:id", "id={$this->resultBd[0]['id_user']}");
        if($upPassword->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-success'>OK! Senha atualizada com sucesso</p>";
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 021.1! Não foi possível atualizar a senha</p>";
            $this->result = false;
        }
    }
}
