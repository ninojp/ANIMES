<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe:AdmsEditPages, Editar as paginas no banco de dados */
class AdmsEditPage
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result = false;
    /** @var array - Recebe os dados do conteúdo do e-mail     */
    private array|null $resultBd;
    /** @var integer|string|null - Recebe o ID do registro    */
    private int|string|null $id_page;
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
    public function viewPages(int $id_page):void
    {
        $this->id_page = $id_page;

        $viewPages = new \Adms\Models\helper\AdmsRead();
        $viewPages->fullRead("SELECT pgs.id_page, pgs.controller_page, pgs.metodo_page, pgs.menu_controller, pgs.menu_metodo, pgs.name_page, pgs.public_page, pgs.icon_menu_page, pgs.obs_page, pgs.id_sits_page, pgs.id_type_page, pgs.id_group_page, pgs.created, pgs.modified, asp.name_sits_page, atp.name_type_page, agp.name_group_page FROM adms_page AS pgs INNER JOIN adms_sits_page AS asp ON asp.id_sits_page=pgs.id_sits_page INNER JOIN adms_type_page AS atp ON atp.id_type_page=pgs.id_type_page INNER JOIN adms_group_page AS agp ON agp.id_group_page=pgs.id_group_page WHERE pgs.id_page=:id_page LIMIT :limit", "id_page={$this->id_page}&limit=1");

        $this->resultBd = $viewPages->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 028! Pagina não encontrado!</p>";
            $this->result = false;
        }
    }
    /** ===========================================================================================
     * @param array|null $data
     * @return void   */
    public function updatePage(array $data = null):void
    {
        $this->data = $data;
        // var_dump($this->data);
        //o codigo abaixo é apenas para retirar um campo da VALIDAÇÃO
        //atribui o valor que está no campo OBS para o atributo:$dataExitVal
        $this->dataExitVal['obs_page'] = $this->data['obs_page'];
        $this->dataExitVal['icon_menu_page'] = $this->data['icon_menu_page'];
        //Destroi o valor que está no atributo:$this->data['nickname']
        // unset($this->data['nickname']);
        unset($this->data['obs_page'], $this->data['icon_menu_page']);
        // var_dump($this->data);
        // var_dump($this->dataExitVal);

        //instancia a classe:AdmsValEmptyField e cria o objeto:$valEmptyField
        $valEmptyField = new \Adms\Models\helper\AdmsValEmptyField();
        //usa o objeto:$valEmptyField para instanciar o método:valField() para validar os dados dentro do atributo:$this->data
        $valEmptyField->valField($this->data);
        //verifica se o método:getResult() retorna true, se sim significa q deu tudo certo se não aprensenta o Erro
        if ($valEmptyField->getResult()) {
            $this->editPage();
            // $this->result = false;
        } else {
            $this->result = false;
        }
    }
     /** ========================================================================================
     * @return void     */
    private function editPage():void
    {
        // var_dump($this->data);
        $this->data['modified'] = date("Y-m-d H:i:s");
        //Atribui NOVAMENTE(recupera) o valor q está no atributo:$this->dataExitval['obs'] e coloca no atributo:$this->data['obs'] para ser inserido no DB
        $this->data['obs_page'] = $this->dataExitVal['obs_page'];
        $this->data['icon_menu_page'] = $this->dataExitVal['icon_menu_page'];
        // var_dump($this->data);
        // $this->result = false;TESTE

        $upPage = new \Adms\Models\helper\AdmsUpdate();
        $upPage->exeUpdate("adms_page", $this->data, "WHERE id_page=:id_page", "id_page={$this->data['id_page']}");

        if($upPage->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Página Editada com sucesso</p>";
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 28.1! Não foi possível Editar a página</p>";
            $this->result = false;
        }
    }
    /** ===========================================================================================
     * @return array     */
    public function listSelect():array
    {
        $lists = new \Adms\Models\helper\AdmsRead();
        $lists->fullRead("SELECT astp.id_sits_page AS id_sit, astp.name_sits_page AS name_sit FROM adms_sits_page AS astp ORDER BY astp.name_sits_page ASC");
        $registry['sit'] = $lists->getResult();

        $lists->fullRead("SELECT atp.id_type_page AS id_atp, atp.type_page AS type_atp FROM adms_type_page AS atp ORDER BY atp.type_page ASC");
        $registry['atp'] = $lists->getResult();
        
        $lists->fullRead("SELECT agp.id_group_page AS id_agp, agp.name_group_page AS name_agp FROM adms_group_page AS agp ORDER BY agp.name_group_page ASC");
        $registry['agp'] = $lists->getResult();

        $this->listRegistryAdd = ['sit' => $registry['sit'], 'atp' => $registry['atp'], 'agp' => $registry['agp']];
        // var_dump($this->listRegistryAdd);

        return $this->listRegistryAdd;
    }
}
