<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe:AdmsDeleteUsers, Apagar o usuário no banco de dados */
class AdmsDeleteItensMenu
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result = false;

    /** @var integer|string|null - Recebe o ID do registro    */
    private int|string|null $id_item_menu;

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
    public function deleteItensMenu(int $id_item_menu):void
    {
        $this->id_item_menu = (int) $id_item_menu;
        // var_dump($this->id);
        if($this->viewItemMenu()){
            $deletetemMenu = new \Adms\Models\helper\AdmsDelete();
            $deletetemMenu->exeDelete("adms_item_menu", "WHERE id_item_menu=:id", "id={$this->id_item_menu}");

            if($deletetemMenu->getResult()){
                $_SESSION['msg'] = "<p class='alert alert-warning'>OK! Item de Menu APAGADO com sucesso!</p>";
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<p class='alert alert-danger'>Erro 081! Item de Menu Não APAGADO com sucesso!!</p>";
                $this->result = false;
            }
        } else {
            $this->result = false;
        }
    }
    /** ============================================================================================
    * @return boolean   */
    private function viewItemMenu():bool
    {
        $viewItemMenu = new \Adms\Models\helper\AdmsRead();
        $viewItemMenu->fullRead("SELECT aim.id_item_menu FROM adms_item_menu AS aim
        WHERE aim.id_item_menu=:id LIMIT :limit", "id={$this->id_item_menu}&limit=1");

        $this->resultBd = $viewItemMenu->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            return true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 081.1! Item de Menu não encontrado!</p>";
            return false;
        }
    }
}
