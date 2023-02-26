<?php
namespace Adms\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
     header("Location: https://localhost/adms/");
     die("Erro 000! Página Não encontrada"); }
class EditSitsUsers
{
    //Envia os dados a serem editados no formulário da view
    private array|string|null $data = [];
    //recebe os dados do formulário da view
    private array|null $dataForm;
    //Recebe o id do registro a ser editado
    private int|string|null $id_sits_user;

    /** ==============================================================================================
     * @param integer|string|null|null $id_sits_user
     * @return void     */
    public function index(int|string|null $id_sits_user=null):void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        // var_dump($this->dataForm);
        if ((!empty($id_sits_user)) and (empty($this->dataForm['SendEditSitUser']))) {
            $this->id_sits_user = (int) $id_sits_user;
            // var_dump($this->id);
            $atualSitsUsers = new \Adms\Models\AdmsEditSitsUsers();
            $atualSitsUsers->viewSitsUsers($this->id_sits_user);
            if($atualSitsUsers->getResult()){
                //pega o resultado da query q está dentro de:getResultBd() e atribui para o atributo $data com a POSIÇÃO [FORM}
                $this->data['form'] = $atualSitsUsers->getResultBd();
                // var_dump($this->data['form']);
                $this->viewEditSitsUser();
            }else{
                $urlRedirect = URLADM . "list-sits-users/index";
                header("Location: $urlRedirect");
            }
        } else {
            $this->editSitsUser();
        }
    }
    /** =============================================================================================
     * Instânciar a classe responsável em carregar a view e enviar os dados para a view
     * @return void     */
    private function viewEditSitsUser(): void
    {
        $listSelect = new \Adms\Models\AdmsEditSitsUsers();
        $this->data['selectCor'] = $listSelect->listSelectCor();
        // var_dump($this->data);

        // ----------- Exibir ou ocultar botões conforme o nivel de acesso -------------------
        $button = ['list_sits_users' => ['menu_controller' => 'list-sits-users', 'menu_metodo' => 'index'], 'view_sits_users' => ['menu_controller' => 'view-sits-users', 'menu_metodo' => 'index'], 'add_sits_users' => ['menu_controller' => 'add-sits-users', 'menu_metodo' => 'index'], 'delete_sits_users' => ['menu_controller' => 'delete-sits-users', 'menu_metodo' => 'index']];
        // Instância a classe:AdmsButton() e cria o objeto:$listButton
        $listButton = new \Adms\Models\helper\AdmsButton();
        // E Atribui o resultado para o atributo:$this->data['button'], criando esta posição
        $this->data['button'] = $listButton->buttonPermission($button);

        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \Adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();

        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "list-sits-users";

        //Instancio a classe:ConfigView() e crio o objeto:$loadView
        $loadView = new \AdmsSrc\ConfigViewAdms("adms/Views/sitsUsers/editSitsUsers", $this->data);
        //Instancia o método:loadView() da classe:ConfigView
        $loadView->loadViewAdms();
    }
    /** =============================================================================================
     * @return void     */
    private function editSitsUser():void
    {
        if(!empty($this->dataForm['SendEditSitUser'])){
            unset($this->dataForm['SendEditSitUser']);
            $editUser = new \Adms\Models\AdmsEditSitsUsers();
            $editUser->updateSits($this->dataForm);
            if($editUser->getResult()){
                $urlRedirect = URLADM . "view-sits-users/index/".$this->dataForm['id_sits_user'];
                header("Location: $urlRedirect");
            }else{
                $this->data['form'] = $this->dataForm;
                $this->viewEditSitsUser();
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 127! Situação não encontrado!</p>";
            $urlRedirect = URLADM . "list-sits-users/index";
            header("Location: $urlRedirect");
        }
    }
}