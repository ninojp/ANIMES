<?php
namespace Adms\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
class ListUser
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
    private string|null $searchEmail;

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
        $this->searchEmail = filter_input(INPUT_GET, 'search_email', FILTER_DEFAULT);
        // var_dump($this->searchName);
        // var_dump($this->searchEmail);

        $listUsers = new \Adms\Models\AdmsListUser();

        //verifica se foi clicado no botão de pesquisar, se foi executa o codigo abaixo
        if (!empty($this->dataForm['SendSearchUser'])) {
            //sempre quando clicar no pesquisar, redireciona para pagina 1
            $this->page = 1;

            //instância o método que fara a pesquisa e passa como parametro a pagina e os dados que estão nas posições do array:$this->dataForm['']
            $listUsers->listSearchUsers($this->page, $this->dataForm['search_name'], $this->dataForm['search_email']);

            //para manter os dados no formulário, na view
            $this->data['form'] = $this->dataForm;

            // verifica se está recebendo via GET na url
        } elseif ((!empty($this->searchName)) or (!empty($this->searchEmail))) {

            //instância o método que fara a pesquisa e passa como parametro a pagina e os dados que estão nas posições do array:$this->dataForm['']
            $listUsers->listSearchUsers($this->page, $this->searchName, $this->searchEmail);

            //para manter os dados no formulário, na view
            $this->data['form']['search_name'] = $this->searchName;
            $this->data['form']['search_email'] = $this->searchEmail;

            //Se não foi clicado carrega os dados do listar normalmente
        } else {
            //envia para a models a pagina atual
            $listUsers->listUsers($this->page);
        }
        if ($listUsers->getResult()) {
            $this->data['listUser'] = $listUsers->getResultBd();
            // var_dump($this->data['listUsers']);
            // PAGINAÇÃO - cria a POSIÇÃO:['pagination'] no array:$this->data
            $this->data['pagination'] = $listUsers->getResultPg();
        } else {
            $this->data['listUser'] = [];
            $this->data['pagination'] = "";
        }
        // ----------- Exibir ou ocultar botões conforme o nivel de acesso -------------------
        // Cria o array e suas devidas posições
        $button = ['add_user'=>['menu_controller'=>'add-user', 'menu_metodo'=>'index'], 'view_user' =>['menu_controller'=>'view-user', 'menu_metodo'=>'index'], 'edit_user'=>['menu_controller' =>'edit-user', 'menu_metodo'=>'index'], 'delete_user'=>['menu_controller'=>'delete-user', 'menu_metodo'=>'index']];
        // Instância a classe:AdmsButton() e cria o objeto:$listButton
        $listButton = new \Adms\Models\helper\AdmsButton();
        // Passa como parametro o array:$button criado acima, para o método:buttonPermission()
        // E Atribui o resultado para o atributo:$this->data['button'], criando esta posição
        $this->data['button'] = $listButton->buttonPermission($button);
        // var_dump($this->data['button']);

        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \Adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();

        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "list-user";

        //instancia a classe, cria o objeto e passa o parametro:$this->data, recebido da VIEW
        $loadView = new \AdmsSrc\ConfigViewAdms("adms/Views/users/listUser", $this->data);
        //Instancia o método:loadView() da classe:ConfigView
        $loadView->loadViewAdms();
    }
}
