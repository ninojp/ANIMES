<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe (models):AdmsAddPages para cadastrar novas Páginas  */
class AdmsAddPage
{
    //recebido como parametro através do método:create() e colocado neste atributo
    private array|null $data;

    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result;

    private array $listRegistryAdd;

    private array $dataExitVal;

    /** ============================================================================================
     * Recebe o resultado da query e atribui para o atributo:$this->result, Retorna true quando executado com sucesso e false quando houver erro  -  @return void     */
    function getResult():bool
    {
        return $this->result;
    }
    /** ==========================================================================================
     * Este método recebe os PARAMETROS:$data e depois atribui para o atributo:$this->data
     * Recebe os valores do fomulário.   -  @param array|null $data
     * Instância o Helper:AdmsValEmptyField para verificar se todos os campos foram preenchidos
     * Instância o método:valInput para validar os dados dos campos. 
     * Retorna false quando algun campo está vazio  -  @return void    */
    public function createPage(array $data = null)
    {
        //atribui o parametro:$data para o atributo:$this->data
        $this->data = $data;
        // var_dump($this->data);

        //atribui o valor que está no campo OBS para o atributo:$dataExitVal
        $this->dataExitVal['obs_page'] = $this->data['obs_page'];
        $this->dataExitVal['icon_menu_page'] = $this->data['icon_menu_page'];
        //Destroi o valor que está no atributo:$this->data['nickname']
        // unset($this->data['nickname']);
        unset($this->data['obs_page'], $this->data['icon_menu_page']);

        //instancia a classe:AdmsValEmptyField e cria o objeto:$valEmptyField
        $valEmptyField = new \Adms\Models\helper\AdmsValEmptyField();
        //usa o objeto:$valEmptyField para instanciar o método:valField() para validar os dados dentro do atributo:$this->data
        $valEmptyField->valField($this->data);
        //verifica se o método:getResult() retorna true, se sim significa q deu tudo certo se não aprensenta o Erro
        if ($valEmptyField->getResult()) {
            $this->addPage();
        } else {
            $this->result = false;
        }
    }
    /** ===========================================================================================
     * Cadastrar usuário no DB  - @return void
     * Retorna true quando cadastrar com sucesso e false quando não cadastrar   */
    private function addPage(): void
    {
        $this->data['created'] = date("Y-m-d H:i:s");
        // var_dump($this->data);
        //Atribui NOVAMENTE(recupera) o valor q está no atributo:$this->dataExitval['obs'] e coloca no atributo:$this->data['obs'] para ser inserido no DB
        $this->data['obs_page'] = $this->dataExitVal['obs_page'];
        $this->data['icon_menu_page'] = $this->dataExitVal['icon_menu_page'];
        
        // foi usado para encontrar um erro, antes de instânciar a classe(foi comentada) abaixo
        // $this->result = false;
        $createPage = new \Adms\Models\helper\AdmsCreate();
        $createPage->exeCreate("adms_page", $this->data);

        //verifica se existe o ultimo ID inserido
        if ($createPage->getResult()) {
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Página cadastrada com sucesso</p>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 023! Não foi possível cadastrar a Página</p>";
            $this->result = false;
        }
    }
    /** ===========================================================================================
     * @return array     */
    public function listSelect():array
    {
        //listar os dados das tabelas, para utilizar no select da view de adição de Página
        $lists = new \Adms\Models\helper\AdmsRead();
        $lists->fullRead("SELECT asp.id_sits_page, asp.name_sits_page FROM adms_sits_page AS asp ORDER BY asp.name_sits_page ASC");
        $registry['sit'] = $lists->getResult();

        $lists->fullRead("SELECT atp.id_type_page, atp.type_page FROM adms_type_page AS atp ORDER BY atp.type_page ASC");
        $registry['atp'] = $lists->getResult();
        
        $lists->fullRead("SELECT agp.id_group_page, agp.name_group_page FROM adms_group_page AS agp ORDER BY agp.name_group_page ASC");
        $registry['agp'] = $lists->getResult();

        $this->listRegistryAdd = ['sit' => $registry['sit'], 'atp' => $registry['atp'], 'agp' => $registry['agp']];
        // var_dump($this->listRegistryAdd);

        return $this->listRegistryAdd;
    }
}
