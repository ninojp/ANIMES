<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe:AdmsViewUsers, Editar o usuário no banco de dados */
class AdmsEditAccessLevel
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result = false;

    /** @var array - Recebe os dados do conteúdo do e-mail     */
    private array|null $resultBd;

    /** @var integer|string|null - Recebe o ID do registro    */
    private int|string|null $id_access_level;

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
    public function viewEditAccessNivels(int $id_access_level):void
    {
        $this->id_access_level = $id_access_level;

        $viewEditAccessNivels = new \Adms\Models\helper\AdmsRead();
        $viewEditAccessNivels->fullRead("SELECT id_access_level, access_level, order_level FROM adms_access_level WHERE id_access_level=:id AND order_level > :order_level LIMIT :limit", "id={$this->id_access_level}&order_level=".$_SESSION['order_level']."&limit=1");

        $this->resultBd = $viewEditAccessNivels->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 061! Nivel de Acesso não encontrado!</p>";
            $this->result = false;
        }
    }
    /** ===========================================================================================
     * @param array|null $data
     * @return void   */
    public function update(array $data = null):void
    {
        $this->data = $data;

        //instancia a classe:AdmsValEmptyField e cria o objeto:$valEmptyField
        $valEmptyField = new \Adms\Models\helper\AdmsValEmptyField();
        //usa o objeto:$valEmptyField para instanciar o método:valField() para validar os dados dentro do atributo:$this->data
        $valEmptyField->valField($this->data);
        //verifica se o método:getResult() retorna true, se sim significa q deu tudo certo se não aprensenta o Erro
        if ($valEmptyField->getResult()) {
            $this->edit();
            // $this->result = false;
        } else {
            $this->result = false;
        }
    }
 
    /** =============================================================================================
     * @return void     */
    private function edit():void
    {
        // var_dump($this->data);
        $this->data['modified'] = date("Y-m-d H:i:s");
        // var_dump($this->data);
        // $this->result = false;TESTE

        $upAccessNivels = new \Adms\Models\helper\AdmsUpdate();
        $upAccessNivels->exeUpdate("adms_access_level", $this->data, "WHERE id_access_level=:id", "id={$this->data['id_access_level']}");

        if($upAccessNivels->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Nivel de Acesso Editado com sucesso</p>";
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 061.1! Não foi possível Editar o Nivel de Acesso</p>";
            $this->result = false;
        }
    }
}
