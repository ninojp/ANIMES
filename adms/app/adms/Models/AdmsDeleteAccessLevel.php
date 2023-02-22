<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe:AdmsDeleteSitsUsers, para Apagar uma situação no banco de dados */
class AdmsDeleteAccessLevel
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result = false;

    /** @var integer|string|null - Recebe o ID do registro    */
    private int|string|null $id_access_level;

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
    public function deleteAccessNivels(int $id_access_level):void
    {
        $this->id_access_level = (int) $id_access_level;
        // var_dump($this->id);
        if(($this->viewAtualAccessNivels()) and ($this->checkStatusUsed())){
            // Forma de deletar registros relacionados via PHP
            // $deleteLevelPages = new \App\adms\Models\helper\AdmsDelete();
            // $deleteLevelPages->exeDelete("adms_levels_pages", "WHERE adms_access_level_id=:adms_access_level_id", "adms_access_level_id={$this->id}");

            $deleteAccessNivels = new \Adms\Models\helper\AdmsDelete();
            $deleteAccessNivels->exeDelete("adms_access_level", "WHERE id_access_level=:id", "id={$this->id_access_level}");

            if($deleteAccessNivels->getResult()){
                $_SESSION['msg'] = "<p class='alert alert-warning'>OK! O Nivel de Acesso APAGADO com sucesso!</p>";
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 063! O Nivel de Acesso NÃO APAGADO!!</p>";
                $this->result = false;
            }
        } else {
            $this->result = false;
        }
    }
    /** ============================================================================================
    * @return boolean   */
    private function viewAtualAccessNivels():bool
    {
        $viewAtualAccessNivels = new \Adms\Models\helper\AdmsRead();
        $viewAtualAccessNivels->fullRead("SELECT id_access_level FROM adms_access_level WHERE id_access_level=:id AND order_level >:order_level LIMIT :limit", "id={$this->id_access_level}&order_level=".$_SESSION['order_level']."&limit=1");

        $this->resultBd = $viewAtualAccessNivels->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            return true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 063.1! O Nivel de Acesso não encontrado!</p>";
            return false;
        }
    }
    /** ==============================================================================================
     * Método para verificar se existe algum usuário utilizando a situação q será apagada
     * @return void     */
    private function checkStatusUsed():bool
    {
        $checkStatusUsed = new \Adms\Models\helper\AdmsRead();
        $checkStatusUsed->fullRead("SELECT id_user FROM adms_user WHERE id_access_level =:id_access_level LIMIT :limit", "id_access_level={$this->id_access_level}&limit=1",);
        if($checkStatusUsed->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 063.2! O Nivel de Acesso não pode ser apagada, pois existe um usuário o utilizando!</p>";
            return false;
        } else {
            return true;
        }
    }
}
