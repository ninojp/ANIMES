<?php
namespace Adms\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
    // echo "adms/Controller/EditSitsUsers.php: <h1> Página(controller) Editar Situação</h1>";

class EditTypesPage
{
    //Envia os dados a serem editados no formulário da view
    private array|string|null $data = [];
    //recebe os dados do formulário da view
    private array|null $dataForm;
    //Recebe o id do registro a ser editado
    private int|string|null $id_type_page;

    public function index(int|string|null $id_type_page=null):void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        // var_dump($this->dataForm);
        if ((!empty($id_type_page)) and (empty($this->dataForm['SendEditTypesPgs']))) {
            $this->id_type_page = (int) $id_type_page;
            // var_dump($this->id);
            $atualTypesPgs = new \Adms\Models\AdmsEditTypesPage();
            $atualTypesPgs->viewTypesPgs($this->id_type_page);
            if($atualTypesPgs->getResult()){
                //pega o resultado da query q está dentro de:getResultBd() e atribui para o atributo $data com a POSIÇÃO [FORM}
                $this->data['form'] = $atualTypesPgs->getResultBd();
                // var_dump($this->data['form']);
                $this->loadViewEditTypesPgs();
            }else{
                $urlRedirect = URLADM . "list-types-page/index";
                header("Location: $urlRedirect");
            }
        } else {
            $this->editTypesPgs();
        }
    }
    /** =============================================================================================
     * Instânciar a classe responsável em carregar a view e enviar os dados para a view
     * @return void     */
    private function loadViewEditTypesPgs(): void
    {
        // ----------- Exibir ou ocultar botões conforme o nivel de acesso -------------------
        $button = ['add_types_page'=>['menu_controller'=>'add-types-page', 'menu_metodo'=>'index'], 'list_types_page'=>['menu_controller'=>'list-types-page', 'menu_metodo'=>'index'],
        'view_types_page'=>['menu_controller'=>'view-types-page', 'menu_metodo'=>'index'],
        'delete_types_page'=>['menu_controller'=>'delete-types-page', 'menu_metodo'=>'index']];
        $listButton = new \Adms\Models\helper\AdmsButton();
        $this->data['button'] = $listButton->buttonPermission($button);

        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \Adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();
        
        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "edit-types-page";

        //Instancio a classe:ConfigView() e crio o objeto:$loadView
        $loadView = new \AdmsSrc\ConfigViewAdms("adms/Views/pages/editTypesPage", $this->data);
        //Instancia o método:loadView() da classe:ConfigView
        $loadView->loadViewAdms();
    }
    /** =============================================================================================
     * @return void     */
    private function editTypesPgs():void
    {
        if(!empty($this->dataForm['SendEditTypesPgs'])){
            unset($this->dataForm['SendEditTypesPgs']);
            $editTypesPgs = new \Adms\Models\AdmsEditTypesPage();
            $editTypesPgs->updateTypePg($this->dataForm);
            if($editTypesPgs->getResult()){
                $urlRedirect = URLADM . "view-types-page/index/".$this->dataForm['id_type_page'];
                header("Location: $urlRedirect");
            }else{
                $this->data['form'] = $this->dataForm;
                $this->loadViewEditTypesPgs();
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 116! Tipo de Pagina não encontrado!</p>";
            $urlRedirect = URLADM . "list-types-page/index";
            header("Location: $urlRedirect");
        }
    }
}