<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe:AdmsEditTypesPgs, Editar os dados do Tipo de pagina no banco de dados */
class AdmsEditGroupsPage
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result = false;

    /** @var array - Recebe os dados do conteúdo do e-mail     */
    private array|null $resultBd;

    /** @var integer|string|null - Recebe o ID do registro    */
    private int|string|null $id_group_page;
    
    /** @var array|null - Recebe as informações do formulário     */
    private array|null $data;
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
    public function viewGroupsPgs(int $id_group_page):void
    {
        $this->id_group_page = $id_group_page;

        $viewGroupsPgs = new \Adms\Models\helper\AdmsRead();
        $viewGroupsPgs->fullRead("SELECT id_group_page, name_group_page, order_group_page FROM adms_group_page WHERE id_group_page=:id LIMIT :limit", "id={$this->id_group_page}&limit=1");

        $this->resultBd = $viewGroupsPgs->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 097! Grupo de pagina não encontrada!</p>";
            $this->result = false;
        }
    }
    /** ===========================================================================================
     * @param array|null $data
     * @return void   */
    public function updateGroupsPgs(array $data = null):void
    {
        $this->data = $data;
        // var_dump($this->data);
        
        //instancia a classe:AdmsValEmptyField e cria o objeto:$valEmptyField
        $valEmptyField = new \Adms\Models\helper\AdmsValEmptyField();
        //usa o objeto:$valEmptyField para instanciar o método:valField() para validar os dados dentro do atributo:$this->data
        $valEmptyField->valField($this->data);
        //verifica se o método:getResult() retorna true, se sim significa q deu tudo certo se não aprensenta o Erro
        if ($valEmptyField->getResult()) {
            $this->editGroupsPgs();
            // $this->result = false;
        } else {
            $this->result = false;
        }
    }
    /** =============================================================================================
     * @return void     */
    private function editGroupsPgs():void
    {
        // var_dump($this->data);
        $this->data['modified'] = date("Y-m-d H:i:s");

        $upTypePg = new \Adms\Models\helper\AdmsUpdate();
        $upTypePg->exeUpdate("adms_group_page", $this->data, "WHERE id_group_page=:id", "id={$this->data['id_group_page']}");

        if($upTypePg->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Grupo da pagina Editada com sucesso</p>";
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 097.1! Não foi possível Editar o Grupo da pagina</p>";
            $this->result = false;
        }
    }
}
