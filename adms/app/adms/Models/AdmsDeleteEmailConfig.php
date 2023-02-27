<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe(Controllers):AdmsDeleteEmailConfs para Apagar um E-mail de configuração  */
class AdmsDeleteEmailConfig
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result = false;

    /** @var integer|string|null - Recebe o ID do registro    */
    private int|string|null $id_email_config;

    /** @var array - Recebe os registros do banco de dados    */
    private array|null $resultBd;

    /** ============================================================================================
     * Retorna TRUE se executar o processo com sucesso, FALSE quando houver erro e atribui para o atributo:$this->result    -  @return void     */
    function getResult():bool
    {
        return $this->result;
    }
    /** ============================================================================================
     *  @return void      */
    public function deleteEmailConfs(int $id_email_config):void
    {
        $this->id_email_config = (int) $id_email_config;
        // var_dump($this->id_email_config);
        if($this->viewAtualEmailConfs()){
            $deleteUser = new \Adms\Models\helper\AdmsDelete();
            $deleteUser->exeDelete("adms_email_config", "WHERE id_email_config=:id", "id={$this->id_email_config}");

            if($deleteUser->getResult()){
                $_SESSION['msg'] = "<p class='alert alert-warning'>OK! E-mail de configuração APAGADO com sucesso!</p>";
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 139! E-mail de configuração Não APAGADO com sucesso!!</p>";
                $this->result = false;
            }
        } else {
            $this->result = false;
        }
    }
    /** ============================================================================================
    * @return boolean   */
    private function viewAtualEmailConfs():bool
    {
        $viewAtualEmailConfs = new \Adms\Models\helper\AdmsRead();
        $viewAtualEmailConfs->fullRead("SELECT id_email_config FROM adms_email_config WHERE id_email_config=:id LIMIT :limit", "id={$this->id_email_config}&limit=1");

        $this->resultBd = $viewAtualEmailConfs->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            return true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 139.1! E-mail de configuração não encontrado!</p>";
            return false;
        }
    }
    
}
