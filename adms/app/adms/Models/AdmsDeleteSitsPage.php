<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe:AdmsDeleteSitsUsers, para Apagar uma situação no banco de dados */
class AdmsDeleteSitsPage
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result = false;

    /** @var integer|string|null - Recebe o ID do registro    */
    private int|string|null $id_sits_page;

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
    public function deleteSitsPgs(int $id_sits_page):void
    {
        $this->id_sits_page = (int) $id_sits_page;
        // var_dump($this->id);
        if(($this->viewSitsUsers()) and ($this->checkStatusUsed())){
            $deleteSitsPgs = new \Adms\Models\helper\AdmsDelete();
            $deleteSitsPgs->exeDelete("adms_sits_page", "WHERE id_sits_page=:id", "id={$this->id_sits_page}");

            if($deleteSitsPgs->getResult()){
                $_SESSION['msg'] = "<p class='alert alert-warning'>OK! Situação da Página APAGADO com sucesso!</p>";
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 109! Situação da Página NÃO APAGADA!!</p>";
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
        $viewSitsPgs = new \Adms\Models\helper\AdmsRead();
        $viewSitsPgs->fullRead("SELECT id_sits_page FROM adms_sits_page WHERE id_sits_page=:id LIMIT :limit", "id={$this->id_sits_page}&limit=1");

        $this->resultBd = $viewSitsPgs->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            return true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 109.1! Situação da Página não encontrado!</p>";
            return false;
        }
    }
    /** ==============================================================================================
     * Método para verificar se existe algum usuário utilizando a situação q será apagada
     * @return void     */
    private function checkStatusUsed():bool
    {
        $viewUserSits = new \Adms\Models\helper\AdmsRead();
        $viewUserSits->fullRead("SELECT id_page FROM adms_page WHERE id_sits_page=:adms_sits_pgs_id LIMIT :limit", "adms_sits_pgs_id={$this->id_sits_page}&limit=1",);
        if($viewUserSits->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 109.2! Situação não pode ser apagada, pois existe uma pagina utilizando!</p>";
            return false;
        } else {
            return true;
        }
    }
}
