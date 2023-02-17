<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe:AdmsViewUsers, Visualizar os usuários no banco de dados */
class AdmsViewPage
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result = false;

    /** @var array - Recebe os registros do banco de dados    */
    private array|null $resultBd;

    /** @var integer|string|null - Recebe o ID do registro    */
    private int|string|null $id_page;

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
    public function viewPages(int $id_page):void
    {
        $this->id_page = $id_page;
        // var_dump($id_page);
        $viewPages = new \Adms\Models\helper\AdmsRead();
        $viewPages->fullRead("SELECT pgs.id_page, pgs.controller_page, pgs.metodo_page, pgs.menu_controller, pgs.menu_metodo, pgs.name_page, pgs.public_page, pgs.icon_menu_page, pgs.obs_page, pgs.id_sits_page, pgs.id_type_page, pgs.id_group_page, pgs.created, pgs.modified, asp.name_sits_page, atp.type_page, agp.name_group_page FROM adms_page AS pgs INNER JOIN adms_sits_page AS asp ON asp.id_sits_page=pgs.id_sits_page INNER JOIN adms_type_page AS atp ON atp.id_type_page=pgs.id_type_page INNER JOIN adms_group_page AS agp ON agp.id_group_page=pgs.id_group_page WHERE pgs.id_page=:id_page LIMIT :limit", "id_page={$this->id_page}&limit=1");

        $this->resultBd = $viewPages->getResult();
        // var_dump($this->resultBd);
        if($this->resultBd){
            // var_dump($this->resultBd);
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 026! Página não encontrado!</p>";
            $this->result = false;
        }
    }
}
