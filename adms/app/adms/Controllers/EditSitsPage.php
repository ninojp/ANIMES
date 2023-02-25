<?php
namespace Adms\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
    // echo "adms/Controller/EditSitsUsers.php: <h1> Página(controller) Editar Situação</h1>";

class EditSitsPage
{
    //Envia os dados a serem editados no formulário da view
    private array|string|null $data = [];
    //recebe os dados do formulário da view
    private array|null $dataForm;
    //Recebe o id do registro a ser editado
    private int|string|null $id_sits_page;

    public function index(int|string|null $id_sits_page=null):void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        // var_dump($this->dataForm);
        if ((!empty($id_sits_page)) and (empty($this->dataForm['SendEditSitPgs']))) {
            $this->id_sits_page = (int) $id_sits_page;
            // var_dump($this->id);
            $atualSitsPgs = new \Adms\Models\AdmsEditSitsPage();
            $atualSitsPgs->viewSitsPgs($this->id_sits_page);
            if($atualSitsPgs->getResult()){
                //pega o resultado da query q está dentro de:getResultBd() e atribui para o atributo $data com a POSIÇÃO [FORM}
                $this->data['form'] = $atualSitsPgs->getResultBd();
                // var_dump($this->data['form']);
                $this->viewEditSitsPgs();
            }else{
                $urlRedirect = URLADM . "list-sits-page/index";
                header("Location: $urlRedirect");
            }
        } else {
            $this->editSitsPgs();
        }
        
    }
    /** =============================================================================================
     * Instânciar a classe responsável em carregar a view e enviar os dados para a view
     * @return void     */
    private function viewEditSitsPgs(): void
    {
        // ----------- Exibir ou ocultar botões conforme o nivel de acesso -------------------
        $button = ['add_sits_page'=>['menu_controller'=>'add-sits-page', 'menu_metodo'=>'index'], 'list_sits_page'=>['menu_controller'=>'list-sits-page', 'menu_metodo'=>'index'],
        'view_sits_page'=>['menu_controller'=>'view-sits-page', 'menu_metodo'=>'index'],
        'delete_sits_page'=>['menu_controller'=>'delete-sits-page', 'menu_metodo'=>'index']];
        $listButton = new \Adms\Models\helper\AdmsButton();
        $this->data['button'] = $listButton->buttonPermission($button);

        $listSelect = new \Adms\Models\AdmsEditSitsPage();
        $this->data['selectCor'] = $listSelect->listSelectCor();
        // var_dump($this->data);

        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \Adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();

        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "edit-sits-page";

        //Instancio a classe:ConfigView() e crio o objeto:$loadView
        $loadView = new \AdmsSrc\ConfigViewAdms("adms/Views/pages/editSitsPage", $this->data);
        //Instancia o método:loadView() da classe:ConfigView
        $loadView->loadViewAdms();
    }
    /** =============================================================================================
     * @return void     */
    private function editSitsPgs():void
    {
        if(!empty($this->dataForm['SendEditSitPgs'])){
            unset($this->dataForm['SendEditSitPgs']);
            $editSitsPg = new \Adms\Models\AdmsEditSitsPage();
            $editSitsPg->updateSitsPgs($this->dataForm);
            if($editSitsPg->getResult()){
                $urlRedirect = URLADM . "view-sits-page/index/".$this->dataForm['id_sits_page'];
                header("Location: $urlRedirect");
            }else{
                $this->data['form'] = $this->dataForm;
                $this->viewEditSitsPgs();
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 108! Situação da Página não encontrado!</p>";
            $urlRedirect = URLADM . "list-sits-page/index";
            header("Location: $urlRedirect");
        }
    }
}