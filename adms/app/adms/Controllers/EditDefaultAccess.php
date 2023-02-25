<?php
namespace Adms\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }

/** Classe (controller):EditLevelsForms apra editar os dados da tabela: */
class EditDefaultAccess
{
    /** Apartir do PHP 8, posso definir a TIPAGEM de varios tipos para o mesmo atributo, usando o PIPE| @var array|string|null - Define que o atributo:$data pode receber(da view) os dados(parametros) de diversos tipos, q devem ser enviados novamente para serem exibidos pela view */
    private array|string|null $data = [];
    //Recebe os dados do formulario
    private array|null $dataForm;
    /** @var integer|string|null - Recebe o ID(do usuário) do registro    */
    private int|string|null $id_default_access;
    /** ===================================================================================
     * Método GENÉRICO q instancia a classe:ConfigView() para carregar a View da pagina, 
     * e enviar os dados para a view, através do método:loadView()
     * Quando o usuário clicar no botão cadastrar do formulário da view novo usuário. Acessa o IF e instancia a classe:AdmsAddUsers responsável em cadastrar o usuário no DB.
     * Usuário cadastrado com sucesso, redireciona para a página de listar Registros, senão, instância a classe responsável em carregar a View e enviar os dados para view.  - @return void */
    public function index(int|string|null $id_default_access = null): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        // var_dump($this->dataForm);
        if ((!empty($id_default_access)) and (empty($this->dataForm['SendEditLevelForm']))) {
            $this->id_default_access = (int) $id_default_access;
            // var_dump($this->id);
            $viewLevelsForms = new \Adms\Models\AdmsEditDefaultAccess();
            $viewLevelsForms->viewLevelsForms($this->id_default_access);
            //verifica se a query obteve resultado(true, false)
            if($viewLevelsForms->getResult()){
                //pega o resultado da query q está dentro de:getResultBd() e atribui para o atributo $data com a POSIÇÃO [FORM}
                $this->data['form'] = $viewLevelsForms->getResultBd();
                // var_dump($this->data['form']);
                $this->loagViewEditLevelsForms();
            } else {
                $urlRedirect = URLADM . "view-default-access/index";
                header("Location: $urlRedirect");
            }
        } else {
            // $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! (necessário enviar o ID)Usuário não encontrado!</p>";
            // $urlRedirect = URLADM . "list-users/index";
            // header("Location: $urlRedirect");
            $this->editLevelsForms();
        }
    }
    /** =============================================================================================
     * Instânciar a classe responsável em carregar a view e enviar os dados para a view
     * @return void     */
    private function loagViewEditLevelsForms(): void
    {
        $listSelect = new \Adms\Models\AdmsEditDefaultAccess();
        $this->data['select'] = $listSelect->listSelect();
        // var_dump($this->data);

        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \Adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();


        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "edit-default-access";
        
        //Instancio a classe:ConfigView() e crio o objeto:$loadView
        $loadView = new \AdmsSrc\ConfigViewAdms("adms/Views/defaultAccess/editDefaultAccess", $this->data);
        //Instancia o método:loadView() da classe:ConfigView
        $loadView->loadViewAdms();
    }
    /** =============================================================================================
     * @return void     */
    private function editLevelsForms():void
    {
        if(!empty($this->dataForm['SendEditLevelForm'])){
            unset($this->dataForm['SendEditLevelForm']);
            $editLevelsForms = new \Adms\Models\AdmsEditDefaultAccess();
            $editLevelsForms->updateLevelsForms($this->dataForm);
            if($editLevelsForms->getResult()){
                $urlRedirect = URLADM . "view-default-access/index/".$this->dataForm['id_default_access'];
                header("Location: $urlRedirect");
            }else{
                $this->data['form'] = $this->dataForm;
                $this->loagViewEditLevelsForms();
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 085! Configurações de novos Usuários, não encontrado!</p>";
            $urlRedirect = URLADM . "view-default-access/index";
            header("Location: $urlRedirect");
        }
    }
}
