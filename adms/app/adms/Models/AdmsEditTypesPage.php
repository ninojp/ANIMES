<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe:AdmsEditTypesPgs, Editar os dados do Tipo de pagina no banco de dados */
class AdmsEditTypesPage
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result = false;

    /** @var array - Recebe os dados do conteúdo do e-mail     */
    private array|null $resultBd;

    /** @var integer|string|null - Recebe o ID do registro    */
    private int|string|null $id_type_page;
    
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
    public function viewTypesPgs(int $id_type_page):void
    {
        $this->id_type_page = $id_type_page;

        $viewTypesPgs = new \Adms\Models\helper\AdmsRead();
        $viewTypesPgs->fullRead("SELECT id_type_page, type_page, name_type_page, order_type_page, obs_type_page FROM adms_type_page WHERE id_type_page=:id LIMIT :limit", "id={$this->id_type_page}&limit=1");

        $this->resultBd = $viewTypesPgs->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 115! Tipo de pagina não encontrada!</p>";
            $this->result = false;
        }
    }
    /** ===========================================================================================
     * @param array|null $data
     * @return void   */
    public function updateTypePg(array $data = null):void
    {
        $this->data = $data;
        // var_dump($this->data);
        
        //instancia a classe:AdmsValEmptyField e cria o objeto:$valEmptyField
        $valEmptyField = new \Adms\Models\helper\AdmsValEmptyField();
        //usa o objeto:$valEmptyField para instanciar o método:valField() para validar os dados dentro do atributo:$this->data
        $valEmptyField->valField($this->data);
        //verifica se o método:getResult() retorna true, se sim significa q deu tudo certo se não aprensenta o Erro
        if ($valEmptyField->getResult()) {
            $this->editTypePg();
            // $this->result = false;
        } else {
            $this->result = false;
        }
    }
    /** =============================================================================================
     * @return void     */
    private function editTypePg():void
    {
        // var_dump($this->data);
        $this->data['modified'] = date("Y-m-d H:i:s");

        $upTypePg = new \Adms\Models\helper\AdmsUpdate();
        $upTypePg->exeUpdate("adms_type_page", $this->data, "WHERE id_type_page=:id", "id={$this->data['id_type_page']}");

        if($upTypePg->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Tipo da pagina Editada com sucesso</p>";
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 115.1! Não foi possível Editar o Tipo da pagina</p>";
            $this->result = false;
        }
    }
}
