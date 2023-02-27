<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe(Models):AdmsEditPageMenu, para editar a página no Item de menu(sidebar) */
class AdmsEditPageMenu
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result = false;

    /** @var array - Recebe os dados do conteúdo do e-mail     */
    private array|null $resultBd;

    /** @var integer|string|null - Recebe o ID do registro    */
    private int|string|null $id_level_page;

    /** @var array|null - Recebe as informações do formulário     */
    private array|null $data;

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
    /** ===========================================================================================
     * Método para visualizar os detalhes da página no Item de menu(sidebar)    */
    public function viewPageMenu(int $id_level_page):bool
    {
        $this->id_level_page = $id_level_page;

        $viewPageMenu = new \Adms\Models\helper\AdmsRead();
        $viewPageMenu->fullRead("SELECT lev_p.id_level_page, lev_p.id_item_menu, pag.name_page
        FROM adms_level_page AS lev_p
        INNER JOIN adms_page AS pag ON pag.id_page=lev_p.id_page
        INNER JOIN adms_access_level AS a_lev ON a_lev.id_access_level=lev_p.id_access_level        WHERE lev_p.id_level_page=:id AND a_lev.order_level >=:order_level
        AND (((SELECT permission_level_page FROM adms_level_page WHERE id_page=lev_p.id_page 
        AND id_access_level={$_SESSION['id_access_level']}) = 1) OR (public_page = 1)) LIMIT :limit", "id={$this->id_level_page}&order_level=".$_SESSION['order_level']."&limit=1");

        $this->resultBd = $viewPageMenu->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            $this->result = true;
            //retorna true, pode continuar o processamento
            return true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 141! Item de Menu da página, não encontrada no DB!</p>";
            $this->result = false;
            return false;
        }
    }
/** ===========================================================================================
     * Recebe como parametro as informações que devem ser editadas
     * Instância a classe HELPER:AdmsValEmptyField(), validar se os campos foram preenchidos
     * instância o método:editColors para atualizar os dados no DB
     * @param array|null $data    -   @return void   */
    public function updatePageMenu(array $data = null):void
    {
        $this->data = $data;
        // var_dump($this->data);
        
        //instancia a classe:AdmsValEmptyField e cria o objeto:$valEmptyField
        $valEmptyField = new \Adms\Models\helper\AdmsValEmptyField();
        //usa o objeto:$valEmptyField para instanciar o método:valField() para validar os dados dentro do atributo:$this->data
        $valEmptyField->valField($this->data);
        //verifica se o método:getResult() retorna true, se sim significa q deu tudo certo se não aprensenta o Erro
        if ($valEmptyField->getResult()) {
            //se retornou true(usuário tem a permissão de acessar)
            if($this->viewPageMenu($this->data['id_level_page'])){
                // então instancia o método:editPageMenu(), e pode editar o item;
                $this->editPageMenu();
            } else {
                $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 141.1!Sem permissão de editar!</p>";
            $this->result = false;
            }
            // $this->result = false;
        } else {
            $this->result = false;
        }
    }
    /** =============================================================================================
     * Método:editPageMenu para atualizar os dados no DB
     * @return void     */
    private function editPageMenu():void
    {
        // var_dump($this->data);
        $this->data['modified'] = date("Y-m-d H:i:s");

        $updatePageMenu = new \Adms\Models\helper\AdmsUpdate();
        $updatePageMenu->exeUpdate("adms_level_page", $this->data, "WHERE id_level_page=:id", "id={$this->data['id_level_page']}");

        if($updatePageMenu->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Item de Menu da página Editada com sucesso</p>";
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 141.2! Não foi possível Editar o Item de Menu da página!</p>";
            $this->result = false;
        }
    }
    /** ===========================================================================================
     * @return array     */
    public function listSelect():array
    {
        $lists = new \Adms\Models\helper\AdmsRead();
        $lists->fullRead("SELECT id_item_menu, name_item_menu FROM adms_item_menu ORDER BY name_item_menu ASC");
        $registry['itm'] = $lists->getResult();

        $this->listRegistryAdd = ['itm' => $registry['itm']];
        // var_dump($this->listRegistryAdd);

        return $this->listRegistryAdd;
    }

}
