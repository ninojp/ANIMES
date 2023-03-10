<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe:AdmsDeleteSitsUsers, para Apagar uma situação no banco de dados */
class AdmsDeleteSitsUsers
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result = false;

    /** @var integer|string|null - Recebe o ID do registro    */
    private int|string|null $id_sits_user;

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
    public function deleteSitsUsers(int $id_sits_user):void
    {
        $this->id_sits_user = (int) $id_sits_user;
        // var_dump($this->id);
        if(($this->viewSitsUsers()) and ($this->checkStatusUsed())){
            $deleteUser = new \Adms\Models\helper\AdmsDelete();
            $deleteUser->exeDelete("adms_sits_user", "WHERE id_sits_user=:id", "id={$this->id_sits_user}");

            if($deleteUser->getResult()){
                $_SESSION['msg'] = "<p class='alert alert-warning'>OK! Situação APAGADO com sucesso!</p>";
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 128! Situação NÃO APAGADA!!</p>";
                $this->result = false;
            }
        } else {
            $this->result = false;
        }
    }
    /** ============================================================================================
    * @return boolean   */
    private function viewSitsUsers():bool
    {
        $viewSitsUsers = new \Adms\Models\helper\AdmsRead();
        $viewSitsUsers->fullRead("SELECT id_sits_user FROM adms_sits_user WHERE id_sits_user=:id LIMIT :limit", "id={$this->id_sits_user}&limit=1");

        $this->resultBd = $viewSitsUsers->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            return true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 128.1! Situação não encontrado!</p>";
            return false;
        }
    }
    /** ==============================================================================================
     * Método para verificar se existe algum usuário utilizando a situação q será apagada
     * @return void     */
    private function checkStatusUsed():bool
    {
        $viewUserSits = new \Adms\Models\helper\AdmsRead();
        $viewUserSits->fullRead("SELECT id_user FROM adms_user WHERE id_sits_user=:sits_user_id LIMIT :limit", "sits_user_id={$this->id_sits_user}&limit=1",);
        if($viewUserSits->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 128.2! Situação não pode ser apagada, pois existe um usuário hà utilizando!</p>";
            return false;
        } else {
            return true;
        }
    }
}
