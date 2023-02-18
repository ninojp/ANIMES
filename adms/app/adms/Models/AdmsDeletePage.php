<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe:AdmsDeleteUsers, Apagar o usuário no banco de dados */
class AdmsDeletePage
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result = false;

    /** @var integer|string|null - Recebe o ID do registro    */
    private int|string|null $id_page;

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
    public function deletePages(int $id_page):void
    {
        $this->id_page = (int) $id_page;
        // var_dump($this->id_page);
        if($this->viewPages()) {
            // Forma de apagar os registros relacionados a tabela PAGES(depois de liberar no PHPMyAdmin)
            // $deleteLevelPages = new \App\adms\Models\helper\AdmsDelete();
            // $deleteLevelPages->exeDelete("adms_levels_pages", "WHERE adms_page_id=:adms_page_id", "adms_page_id={$this->id}");

            $deletePages = new \Adms\Models\helper\AdmsDelete();
            $deletePages->exeDelete("adms_page", "WHERE id_page=:id_page", "id_page={$this->id_page}");

            if($deletePages->getResult()) {
                $_SESSION['msg'] = "<p class='alert alert-warning'>OK! Página APAGADA com sucesso!</p>";
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 048! Página Não APAGADO com sucesso!!</p>";
                $this->result = false;
            }
        } else {
            $this->result = false;
        }
    }
    /** ============================================================================================
     * Método para verificar se a pagina esta cadastrada na tabela e envia o resultado para a fução deletePage    -   @return boolean   */
    private function viewPages():bool
    {
        $viewPages = new \Adms\Models\helper\AdmsRead();
        $viewPages->fullRead("SELECT pgs.id_page FROM adms_page AS pgs WHERE pgs.id_page=:id_page LIMIT :limit", "id_page={$this->id_page}&limit=1");

        $this->resultBd = $viewPages->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            return true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 048.1! Pagina não encontrado!</p>";
            return false;
        }
    }
}
