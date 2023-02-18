<?php
namespace Adms\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe(controller): para editar os dados da página  */
class EditPage
{
    /** Apartir do PHP 8, posso definir a TIPAGEM de varios tipos para o mesmo atributo, usando o PIPE| @var array|string|null - Define que o atributo:$data pode receber(da view) os dados(parametros) de diversos tipos, q devem ser enviados novamente para serem exibidos pela view */
    private array|string|null $data = [];
    //Recebe os dados do formulario
    private array|null $dataForm;
    /** @var integer|string|null - Recebe o ID do registro    */
    private int|string|null $id_page;
    /** ===================================================================================
     * Método GENÉRICO q instancia a classe:ConfigView() para carregar a View da pagina, 
     * e enviar os dados para a view, através do método:loadView()
     * Quando o usuário clicar no botão cadastrar do formulário da view novo usuário. Acessa o IF e instancia a classe:AdmEditPage responsável em editar o registro no DB.
     * Usuário cadastrado com sucesso, redireciona para a página de listar Registros, senão, instância a classe responsável em carregar a View e enviar os dados para view.  - @return void */
    public function index(int|string|null $id_page = null): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        // var_dump($this->dataForm);
        if ((!empty($id_page)) and (empty($this->dataForm['SendEditPage']))) {
            $this->id_page = (int) $id_page;
            // var_dump($this->id);
            $viewPages = new \Adms\Models\AdmsEditPage();
            $viewPages->viewPages($this->id_page);
            //verifica se a query obteve resultado(true, false)
            if($viewPages->getResult()){
                //pega o resultado da query q está dentro de:getResultBd() e atribui para o atributo $data com a POSIÇÃO [FORM}
                $this->data['form'] = $viewPages->getResultBd();
                // var_dump($this->data['form']);
                $this->viewEditPages();
            } else {
                $urlRedirect = URLADM . "list-page/index";
                header("Location: $urlRedirect");
            }
        } else {
            $this->editPage();
        }
    }
    /** =============================================================================================
     * Instânciar a classe responsável em carregar a view e enviar os dados para a view
     * @return void     */
    private function viewEditPages(): void
    {
        $listSelect = new \Adms\Models\AdmsEditPage();
        $this->data['select'] = $listSelect->listSelect();
        // var_dump($this->data);

        // ----------- Exibir ou ocultar botões conforme o nivel de acesso -------------------
        // Cria o array e suas devidas posições
        $button = ['list_page' => ['menu_controller' => 'list-page', 'menu_metodo' => 'index'], 'add_page' => ['menu_controller' => 'add-page', 'menu_metodo' => 'index'],
        'view_page' => ['menu_controller' => 'view-page', 'menu_metodo' => 'index'],
        'delete_page' => ['menu_controller' => 'delete-page', 'menu_metodo' => 'index']];
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
        $this->data['sidebarActive'] = "edit-page";
        
        //Instancio a classe:ConfigView() e crio o objeto:$loadView
        $loadView = new \AdmsSrc\ConfigViewAdms("adms/Views/pages/editPage", $this->data);
        //Instancia o método:loadView() da classe:ConfigView
        $loadView->loadViewAdms();
    }
    /** =============================================================================================
     * @return void     */
    private function editPage():void
    {
        if(!empty($this->dataForm['SendEditPage'])){
            unset($this->dataForm['SendEditPage']);
            $editPage = new \Adms\Models\AdmsEditPage();
            $editPage->updatePage($this->dataForm);
            if($editPage->getResult()){
                $urlRedirect = URLADM . "view-page/index/".$this->dataForm['id_page'];
                header("Location: $urlRedirect");
            }else{
                $this->data['form'] = $this->dataForm;
                $this->viewEditPages();
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 029! (ID)Página não encontrado!</p>";
            $urlRedirect = URLADM . "list-page/index";
            header("Location: $urlRedirect");
        }
    }
}
