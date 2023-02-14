<?php
namespace Adm\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
class ListPage
{
    /** @var array|string|null - Define que o atributo:$data pode receber(da view) os dados(parametros) de diversos tipos, q devem ser enviados novamente para serem exibidos pela view */
    private array|string|null $data;

    /** @var array|null - Recebe os dados do formulário de pesquisa   */
    private array|null $dataForm;

    /** @var string|integer|null - Recebe o numero da pagina atual   */
    private string|int|null $page;

    /** @var string|null -  - Recebe o nome a ser pesquisado  */
    private string|null $searchName;

    /** @var string|null -  - Recebe o E-mail a ser pesquisado  */
    private string|null $searchController;

    /** ===========================================================================================
     * Método para listar Usuários
     * Instância a models q ira buscar os registros no DB
     * Se encontrar registros, os envia para a view. Se não envia um array vazio
     * Passa o parametro:$page, para fazer a paginação
     * @return void   */
    public function index(string|int|null $page = null)
    {
        //Atribui o parametro recebido:$page para o atributo:$this->page
        //converte para inteiro e verifica se possui valor, se não atribui o valor 1
        $this->page = (int) $page ? $page : 1;
        // var_dump($this->page);

        //Recebe os dados do formulário de pesquisa:form_pesquisar
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        // var_dump($this->dataForm);

        $this->searchName = filter_input(INPUT_GET, 'search_name', FILTER_DEFAULT);
        $this->searchController = filter_input(INPUT_GET, 'search_controller', FILTER_DEFAULT);
        // var_dump($this->searchName);
        // var_dump($this->searchController);

        $listPages = new \Adm\Models\AdmListPage();

        //verifica se foi clicado no botão de pesquisar, se foi executa o codigo abaixo
        if(!empty($this->dataForm['SendSearchPages'])) {
            //sempre quando clicar no pesquisar, redireciona para pagina 1
            $this->page = 1;
            
            //instância o método que fara a pesquisa e passa como parametro a pagina e os dados que estão nas posições do array:$this->dataForm['']
            $listPages->listSeachPages($this->page, $this->dataForm['search_name'], $this->dataForm['search_controller']);
            
            //para manter os dados no formulário, na view
            $this->data['form'] = $this->dataForm;

        // verifica se está recebendo via GET na url
        } elseif((!empty($this->searchName)) or (!empty($this->searchController))) {

            //instância o método que fara a pesquisa e passa como parametro a pagina e os dados que estão nas posições do array:$this->dataForm['']
            $listPages->listSeachPages($this->page, $this->searchName, $this->searchController);
            
            //para manter os dados no formulário, na view
            $this->data['form']['search_name'] = $this->searchName;
            $this->data['form']['search_controller'] = $this->searchController;

        //Se não foi clicado carrega os dados do listar normalmente
        } else {
            //envia para a models a pagina atual
            $listPages->listPages($this->page);
        }
        if($listPages->getResult()){
            $this->data['listPages'] = $listPages->getResultBd();
            // var_dump($this->data['listPages']);
            // PAGINAÇÃO - cria a POSIÇÃO:['pagination'] no array:$this->data
            $this->data['pagination'] = $listPages->getResultPg();
        }else{
            $this->data['listPages'] = [];
            $this->data['pagination'] = "";
        }
        // ----------- Exibir ou ocultar botões conforme o nivel de acesso -------------------
        // Cria o array e suas devidas posições
        $button = ['add_page' => ['menu_controller' => 'add-page', 'menu_metodo' => 'index'], 
        'sync_page_level' => ['menu_controller' => 'sync-page-level', 'menu_metodo' => 'index'],
        'view_page' => ['menu_controller' => 'view-page', 'menu_metodo' => 'index'],
        'edit_page' => ['menu_controller' => 'edit-page', 'menu_metodo' => 'index'],
        'delete_page' => ['menu_controller' => 'delete-page', 'menu_metodo' => 'index']];
        // Instância a classe:AdmsButton() e cria o objeto:$listButton
        $listButton = new \Adm\Models\helper\AdmButton();
        // Passa como parametro o array:$button criado acima, para o método:buttonPermission()
        // E Atribui o resultado para o atributo:$this->data['button'], criando esta posição
        $this->data['button'] = $listButton->buttonPermission($button);
        // var_dump($this->data['button']);

        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \Adm\Models\helper\AdmMenu();
        $this->data['menu'] = $listMenu->itemMenu();

        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "list-page";

        //instancia a classe, cria o objeto e passa o parametro:$this->data, recebido da VIEW
        $loadView = new \AdmsSrc\ConfigViewAdm("adm/Views/pages/listPage",$this->data);
        //Instancia o método:loadView() da classe:ConfigView
        $loadView->loadViewAdm();
    }

}