<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe:AdmsEditSitsUsers, Editar Situação da Página no banco de dados */
class AdmsEditSitsPage
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result = false;
    /** @var array - Recebe os dados do conteúdo do e-mail     */
    private array|null $resultBd;
    /** @var integer|string|null - Recebe o ID do registro    */
    private int|string|null $id_sits_page;
    /** @var array|null - Recebe as informações do formulário     */
    private array|null $data;
    /** @var array|null - Recebe os dados da lista de cores   */
    private array|null $resultListCor;

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
    public function viewSitsPgs(int $id_sits_page):void
    {
        $this->id_sits_page = $id_sits_page;

        $viewSitsPgs = new \Adms\Models\helper\AdmsRead();
        $viewSitsPgs->fullRead("SELECT id_sits_page, name_sits_page, id_color FROM adms_sits_page WHERE id_sits_page=:id LIMIT :limit", "id={$this->id_sits_page}&limit=1");

        $this->resultBd = $viewSitsPgs->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 107! Situação da página não encontrada!</p>";
            $this->result = false;
        }
    }
    /** ===========================================================================================
     * @param array|null $data
     * @return void   */
    public function updateSitsPgs(array $data = null):void
    {
        $this->data = $data;
        // var_dump($this->data);
        
        //instancia a classe:AdmsValEmptyField e cria o objeto:$valEmptyField
        $valEmptyField = new \Adms\Models\helper\AdmsValEmptyField();
        //usa o objeto:$valEmptyField para instanciar o método:valField() para validar os dados dentro do atributo:$this->data
        $valEmptyField->valField($this->data);
        //verifica se o método:getResult() retorna true, se sim significa q deu tudo certo se não aprensenta o Erro
        if ($valEmptyField->getResult()) {
            $this->editSitsPgs();
            // $this->result = false;
        } else {
            $this->result = false;
        }
    }
    /** =============================================================================================
     * @return void     */
    private function editSitsPgs():void
    {
        // var_dump($this->data);
        $this->data['modified'] = date("Y-m-d H:i:s");

        $upSitsUser = new \Adms\Models\helper\AdmsUpdate();
        $upSitsUser->exeUpdate("adms_sits_page", $this->data, "WHERE id_sits_page=:id", "id={$this->data['id_sits_page']}");

        if($upSitsUser->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Situação da Página Editada com sucesso</p>";
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 107.1! Não foi possível Editar a Situação da Página</p>";
            $this->result = false;
        }
    }
    /** ==============================================================================
     * @return array     */
    public function listSelectCor():array
    {
        //instância a classe:AdmsRead() para fazer a consulta
        $listCor = new \Adms\Models\helper\AdmsRead();
        //usa o método:fullRead() para fazer a query
        $listCor->fullRead("SELECT id_color, name_color, color_adms FROM adms_color ORDER BY name_color ASC");
        //recebe o resultado da query e o atribui para um NOVO array:$resultCor['cor']
        $resultCor['cor'] = $listCor->getResult();
        //coloca no atributo:$this->resultListCor
        $this->resultListCor = ['cor' => $resultCor['cor']];
        // var_dump($this->resultListCor);
        return $this->resultListCor;
    }
}
