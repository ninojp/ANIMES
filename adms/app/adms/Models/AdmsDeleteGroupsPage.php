<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe:AdmsDeleteSitsUsers, para Apagar uma situação no banco de dados */
class AdmsDeleteGroupsPage
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result = false;

    /** @var integer|string|null - Recebe o ID do registro    */
    private int|string|null $id_group_page;

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
    public function deleteGroupPgs(int $id_group_page):void
    {
        $this->id_group_page = (int) $id_group_page;
        // var_dump($this->id);
        if(($this->viewGroupsPgs()) and ($this->checkStatusUsed())){
            $deleteUser = new \Adms\Models\helper\AdmsDelete();
            $deleteUser->exeDelete("adms_group_page", "WHERE id_group_page=:id", "id={$this->id_group_page}");

            if($deleteUser->getResult()){
                $_SESSION['msg'] = "<p class='alert alert-warning'>OK! Tipo de Pagina APAGADO com sucesso!</p>";
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 099! Tipo de Pagina NÃO APAGADA!!</p>";
                $this->result = false;
            }
        } else {
            $this->result = false;
        }
    }
    /** ============================================================================================
    * @return boolean   */
    private function viewGroupsPgs():bool
    {
        $viewGroupsPgs = new \Adms\Models\helper\AdmsRead();
        $viewGroupsPgs->fullRead("SELECT id_group_page FROM adms_group_page WHERE id_group_page=:id LIMIT :limit", "id={$this->id_group_page}&limit=1");

        $this->resultBd = $viewGroupsPgs->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            return true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 099.1! Grupo de página não encontrado!</p>";
            return false;
        }
    }
    /** ==============================================================================================
     * Método para verificar se existe algum usuário utilizando a situação q será apagada
     * @return void     */
    private function checkStatusUsed():bool
    {
        $checkStatusUsed = new \Adms\Models\helper\AdmsRead();
        $checkStatusUsed->fullRead("SELECT id_page FROM adms_page WHERE id_group_page=:id_group_page  LIMIT :limit", "id_group_page={$this->id_group_page}&limit=1",);
        if($checkStatusUsed->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 099.2! Grupo de pagina não pode ser apagada, pois existe um registro o utilizando!</p>";
            return false;
        } else {
            return true;
        }
    }
}
