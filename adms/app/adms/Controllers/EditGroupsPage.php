<?php
namespace Adms\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
class EditGroupsPage
{
    //Envia os dados a serem editados no formulário da view
    private array|string|null $data = [];
    //recebe os dados do formulário da view
    private array|null $dataForm;
    //Recebe o id do registro a ser editado
    private int|string|null $id_group_page;

    public function index(int|string|null $id_group_page=null):void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        // var_dump($this->dataForm);
        if ((!empty($id_group_page)) and (empty($this->dataForm['SendEditGroupsPgs']))) {
            $this->id_group_page = (int) $id_group_page;
            // var_dump($this->id);
            $atualGroupsPgs = new \Adms\Models\AdmsEditGroupsPage();
            $atualGroupsPgs->viewGroupsPgs($this->id_group_page);
            if($atualGroupsPgs->getResult()){
                //pega o resultado da query q está dentro de:getResultBd() e atribui para o atributo $data com a POSIÇÃO [FORM}
                $this->data['form'] = $atualGroupsPgs->getResultBd();
                // var_dump($this->data['form']);
                $this->loadViewEditGroupsPgs();
            }else{
                $urlRedirect = URLADM . "list-groups-page/index";
                header("Location: $urlRedirect");
            }
        } else {
            $this->editGroupsPgs();
        }
        
    }
    /** =============================================================================================
     * Instânciar a classe responsável em carregar a view e enviar os dados para a view
     * @return void     */
    private function loadViewEditGroupsPgs(): void
    {
         // ----------- Exibir ou ocultar botões conforme o nivel de acesso -------------------
       $button = ['add_groups_page' => ['menu_controller' => 'add-groups-page', 'menu_metodo' => 'index'], 'list_groups_page' => ['menu_controller' => 'list-groups-page', 'menu_metodo' => 'index'], 'view_groups_page' => ['menu_controller' => 'view-groups-page', 'menu_metodo' => 'index'], 'delete_groups_page' => ['menu_controller' => 'delete-groups-page', 'menu_metodo' => 'index']];
       // Instância a classe:AdmsButton() e cria o objeto:$listButton
       $listButton = new \Adms\Models\helper\AdmsButton();
       // E Atribui o resultado para o atributo:$this->data['button'], criando esta posição
       $this->data['button'] = $listButton->buttonPermission($button);

        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \Adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();
        
        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "edit-groups-page";

        //Instancio a classe:ConfigView() e crio o objeto:$loadView
        $loadView = new \AdmsSrc\ConfigViewAdms("adms/Views/pages/editGroupsPage", $this->data);
        //Instancia o método:loadView() da classe:ConfigView
        $loadView->loadViewAdms();
    }
    /** =============================================================================================
     * @return void     */
    private function editGroupsPgs():void
    {
        if(!empty($this->dataForm['SendEditGroupsPgs'])){
            unset($this->dataForm['SendEditGroupsPgs']);
            $editGroupsPgs = new \Adms\Models\AdmsEditGroupsPage();
            $editGroupsPgs->updateGroupsPgs($this->dataForm);
            if($editGroupsPgs->getResult()){
                $urlRedirect = URLADM . "view-groups-page/index/".$this->dataForm['id_group_page'];
                header("Location: $urlRedirect");
            }else{
                $this->data['form'] = $this->dataForm;
                $this->loadViewEditGroupsPgs();
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 098! Grupo de Pagina não encontrado!</p>";
            $urlRedirect = URLADM . "list-groups-page/index";
            header("Location: $urlRedirect");
        }
    }
}