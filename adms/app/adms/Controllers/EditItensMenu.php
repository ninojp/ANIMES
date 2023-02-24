<?php
namespace Adms\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
class EditItensMenu
{
    //Envia os dados a serem editados no formulário da view
    private array|string|null $data = [];
    //recebe os dados do formulário da view
    private array|null $dataForm;
    //Recebe o id do registro a ser editado
    private int|string|null $id_item_menu;

    public function index(int|string|null $id_item_menu=null):void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        // var_dump($this->dataForm);
        if ((!empty($id_item_menu)) and (empty($this->dataForm['SendEditItensMenu']))) {
            $this->id_item_menu = (int) $id_item_menu;
            // var_dump($this->id);
            $viewItensMenu = new \Adms\Models\AdmsEditItensMenu();
            $viewItensMenu->viewItensMenu($this->id_item_menu);
            if($viewItensMenu->getResult()){
                //pega o resultado da query q está dentro de:getResultBd() e atribui para o atributo $data com a POSIÇÃO [FORM}
                $this->data['form'] = $viewItensMenu->getResultBd();
                // var_dump($this->data['form']);
                $this->loadViewEditItensMenu();
            }else{
                $urlRedirect = URLADM . "list-itens-menu/index";
                header("Location: $urlRedirect");
            }
        } else {
            $this->editItensMenu();
        }
        
    }
    /** =============================================================================================
     * Instânciar a classe responsável em carregar a view e enviar os dados para a view
     * @return void     */
    private function loadViewEditItensMenu(): void
    {
        // ----------- Exibir ou ocultar botões conforme o nivel de acesso -------------------
        // Cria o array e suas devidas posições
        $button = ['list_itens_menu' => ['menu_controller' => 'list-itens-menu', 'menu_metodo' => 'index'], 'view_itens_menu' => ['menu_controller' => 'view-itens-menu', 'menu_metodo' => 'index'], 'add_itens_menu' => ['menu_controller' => 'add-itens-menu', 'menu_metodo' => 'index'], 'delete_itens_menu' => ['menu_controller' => 'delete-itens-menu', 'menu_metodo' => 'index']];
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
        $this->data['sidebarActive'] = "edit-itens-menu";

        //Instancio a classe:ConfigView() e crio o objeto:$loadView
        $loadView = new \AdmsSrc\ConfigViewAdms("adms/Views/itensmenu/editItensMenu", $this->data);
        //Instancia o método:loadView() da classe:ConfigView
        $loadView->loadViewAdms();
    }
    /** =============================================================================================
     * @return void     */
    private function editItensMenu():void
    {
        if(!empty($this->dataForm['SendEditItensMenu'])){
            unset($this->dataForm['SendEditItensMenu']);
            $editItensMenu = new \Adms\Models\AdmsEditItensMenu();
            $editItensMenu->updateItensMenu($this->dataForm);
            if($editItensMenu->getResult()){
                $urlRedirect = URLADM . "view-itens-menu/index/".$this->dataForm['id_item_menu'];
                header("Location: $urlRedirect");
            }else{
                $this->data['form'] = $this->dataForm;
                $this->loadViewEditItensMenu();
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 079! Item de Menu não encontrado!</p>";
            $urlRedirect = URLADM . "list-itens-menu/index";
            header("Location: $urlRedirect");
        }
    }
}