<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe(Models):AdmsEditColors, para editar uma Cor no banco de dados */
class AdmsEditColor
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result = false;
    /** @var array - Recebe os dados do conteúdo do e-mail     */
    private array|null $resultBd;
    /** @var integer|string|null - Recebe o ID do registro    */
    private int|string|null $id_color;
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
    public function viewColorsBd(int $id_color):void
    {
        $this->id_color = $id_color;

        $viewColorsBd = new \Adms\Models\helper\AdmsRead();
        $viewColorsBd->fullRead("SELECT id_color, name_color, color_adms FROM adms_color WHERE id_color=:id LIMIT :limit", "id={$this->id_color}&limit=1");

        $this->resultBd = $viewColorsBd->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 071! Cor não encontrada no DB!</p>";
            $this->result = false;
        }
    }
    /** ===========================================================================================
     * Recebe como parametro as informações que devem ser editadas
     * Instância a classe HELPER:AdmsValEmptyField(), validar se os campos foram preenchidos
     * instância o método:editColors para atualizar os dados no DB
     * @param array|null $data    -   @return void   */
    public function updateColors(array $data = null):void
    {
        $this->data = $data;
        // var_dump($this->data);
        
        //instancia a classe:AdmsValEmptyField e cria o objeto:$valEmptyField
        $valEmptyField = new \Adms\Models\helper\AdmsValEmptyField();
        //usa o objeto:$valEmptyField para instanciar o método:valField() para validar os dados dentro do atributo:$this->data
        $valEmptyField->valField($this->data);
        //verifica se o método:getResult() retorna true, se sim significa q deu tudo certo se não aprensenta o Erro
        if ($valEmptyField->getResult()) {
            $this->editColors();
            // $this->result = false;
        } else {
            $this->result = false;
        }
    }
    /** =============================================================================================
     * Método:editColors para atualizar os dados no DB
     * @return void     */
    private function editColors():void
    {
        // var_dump($this->data);
        $this->data['modified'] = date("Y-m-d H:i:s");

        $updateColors = new \Adms\Models\helper\AdmsUpdate();
        $updateColors->exeUpdate("adms_color", $this->data, "WHERE id_color=:id", "id={$this->data['id_color']}");

        if($updateColors->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Cor Editada com sucesso</p>";
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 071.1! Não foi possível Editar a Cor</p>";
            $this->result = false;
        }
    }

}
