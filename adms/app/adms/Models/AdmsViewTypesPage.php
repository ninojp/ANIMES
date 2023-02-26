<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe:AdmsViewUsers, Visualizar os usuários no banco de dados */
class AdmsViewTypesPage
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result = false;

    /** @var array - Recebe os registros do banco de dados    */
    private array|null $resultBd;

    /** @var integer|string|null - Recebe o ID do registro    */
    private int|string|null $id_type_page;

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
    public function viewTypesPgs(int $id_type_page):void
    {
        $this->id_type_page = $id_type_page;

        $viewTypesPgs = new \Adms\Models\helper\AdmsRead();
        $viewTypesPgs->fullRead("SELECT atp.id_type_page, atp.type_page, atp.name_type_page, atp.order_type_page, atp.obs_type_page, atp.created, atp.modified FROM adms_type_page AS atp WHERE atp.id_type_page=:id LIMIT :limit", "id={$this->id_type_page}&limit=1");

        $this->resultBd = $viewTypesPgs->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 113! Tipo da pagina não encontrado!</p>";
            $this->result = false;
        }
    }
}
