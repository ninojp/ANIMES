<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe:AdmsEditLevelsForms, Editar configurações para novos usuários no banco de dados */
class AdmsEditDefaultAccess
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result = false;
    /** @var array - Recebe os dados do conteúdo do e-mail     */
    private array|null $resultBd;
    /** @var integer|string|null - Recebe o ID do registro    */
    private int|string|null $id_default_access;
    /** @var array|null - Recebe as informações do formulário     */
    private array|null $data;
    /** @var array|null - Recebe os campos que devem ser retirados da validação   */
    private array|null $dataExitVal;

    private array $listRegistryAdd;

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
    public function viewLevelsForms(int $id_default_access):void
    {
        $this->id_default_access = $id_default_access;

        $viewLevelsForms = new \Adms\Models\helper\AdmsRead();
        $viewLevelsForms->fullRead("SELECT alf.id_default_access, alf.id_access_level, alf.id_sits_user, alf.created, alf.modified, aal.access_level, asu.name_sits_user FROM adms_default_access AS alf INNER JOIN adms_access_level AS aal ON aal.id_access_level=alf.id_access_level INNER JOIN adms_sits_user AS asu ON asu.id_sits_user=alf.id_sits_user
        WHERE alf.id_default_access=:id", "id={$this->id_default_access}");

        // $viewLevelsForms->fullRead("SELECT alf.id, alf.created, alf.modified, aal.name AS name_aal, asu.name AS name_asu
        // FROM adms_levels_forms AS alf
        // INNER JOIN adms_users AS usr ON usr.access_level_id=aal.id
        // INNER JOIN adms_access_levels AS aal ON aal.id=alf.adms_access_level_id
        // INNER JOIN adms_sits_users AS asu ON asu.id=alf.adms_sits_user_id
        // WHERE alf.id=:id AND aal.order_levels >:order_levels LIMIT :limit",
        // "id={$this->id}&order_levels=".$_SESSION['order_levels']."&limit=1");

        $this->resultBd = $viewLevelsForms->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 084! Registro não encontrado!</p>";
            $this->result = false;
        }
    }
    /** ===========================================================================================
     * @param array|null $data
     * @return void   */
    public function updateLevelsForms(array $data = null):void
    {
        $this->data = $data;
        //instancia a classe:AdmsValEmptyField e cria o objeto:$valEmptyField
        $valEmptyField = new \Adms\Models\helper\AdmsValEmptyField();
        //usa o objeto:$valEmptyField para instanciar o método:valField() para validar os dados dentro do atributo:$this->data
        $valEmptyField->valField($this->data);
        //verifica se o método:getResult() retorna true, se sim significa q deu tudo certo se não aprensenta o Erro
        if ($valEmptyField->getResult()) {
            $this->editLevelsForms();
            // $this->result = false;
        } else {
            $this->result = false;
        }
    }

    /** =============================================================================================
     * @return void     */
    private function editLevelsForms():void
    {
        // var_dump($this->data);
        $this->data['modified'] = date("Y-m-d H:i:s");

        $upUser = new \Adms\Models\helper\AdmsUpdate();
        $upUser->exeUpdate("adms_default_access", $this->data, "WHERE id_default_access=:id", "id={$this->data['id_default_access']}");

        if($upUser->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Configurções de novos usuários editado com sucesso</p>";
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 084.1! Registro Não Editado!</p>";
            $this->result = false;
        }
    }
    /** ===========================================================================================
     * @return array     */
    public function listSelect():array
    {
        $list = new \Adms\Models\helper\AdmsRead();

        $list->fullRead("SELECT id_sits_user, name_sits_user FROM adms_sits_user ORDER BY name_sits_user ASC");
        $registry['sit'] = $list->getResult();

        //listar o nivel de acesso da tabela:adms_access_levels para utilizar no select da view de adição de usuário, só pode adicionar usuários com NIVEL de ACESSO inferior aos dele
        $list->fullRead("SELECT id_access_level, access_level FROM adms_access_level WHERE order_level >:order_level ORDER BY access_level ASC", "order_level=".$_SESSION['order_level']);
        $registry['lev'] = $list->getResult();

        $this->listRegistryAdd = ['sit' => $registry['sit'], 'lev' => $registry['lev']];
        // var_dump($this->listRegistryAdd);

        return $this->listRegistryAdd;
    }
}
