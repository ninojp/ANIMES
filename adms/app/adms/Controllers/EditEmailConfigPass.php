<?php
namespace Adms\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe(controllers) para editar a senha do E-mail */
class EditEmailConfigPass
{
    /** Apartir do PHP 8, posso definir a TIPAGEM de varios tipos para o mesmo atributo, usando o PIPE| @var array|string|null - Define que o atributo:$data pode receber(da view) os dados(parametros) de diversos tipos, q devem ser enviados novamente para serem exibidos pela view */
    private array|string|null $data = [];
    //Recebe os dados do formulario
    private array|null $dataForm;
    /** @var integer|string|null - Recebe o ID(do usuário) do registro    */
    private int|string|null $id_email_config;
    /** ===================================================================================
     * Método GENÉRICO q instancia a classe:ConfigView() para carregar a View da pagina, 
     * e enviar os dados para a view, através do método:loadView()
     * Quando o usuário clicar no botão cadastrar do formulário da view novo usuário. Acessa o IF e instancia a classe:AdmsAddUsers responsável em cadastrar o usuário no DB.
     * Usuário cadastrado com sucesso, redireciona para a página de listar Registros, senão, instância a classe responsável em carregar a View e enviar os dados para view.  - @return void */
    public function index(int|string|null $id_email_config = null): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        // var_dump($this->dataForm);
        if ((!empty($id_email_config)) and (empty($this->dataForm['SendEditEmailPass']))) {
            $this->id_email_config = (int) $id_email_config;
            // var_dump($this->id_email_config);
            $viewAtualEmailPass = new \Adms\Models\AdmsEditEmailConfigPass();
            $viewAtualEmailPass->viewAtualEmailPass($this->id_email_config);
            //verifica se a query obteve resultado(true, false)
            if($viewAtualEmailPass->getResult()){
                //pega o resultado da query q está dentro de:getResultBd() e atribui para o atributo $data com a POSIÇÃO [FORM]}
                $this->data['form'] = $viewAtualEmailPass->getResultBd();
                // var_dump($this->data['form']);
                $this->loadViewEditEmailPass();
            } else {
                $urlRedirect = URLADM . "list-email-config/index";
                header("Location: $urlRedirect");
            }
        } else {
            $this->editEmailPass();
        }
    }
    /** =============================================================================================
     * Instânciar a classe responsável em carregar a view e enviar os dados para a view
     * @return void     */
    private function loadViewEditEmailPass(): void
    {
       // ----------- Exibir ou ocultar botões conforme o nivel de acesso -------------------
       $button = ['add_email_config' => ['menu_controller' => 'add-email-config', 'menu_metodo' =>'index'], 'list_email_config' => ['menu_controller' => 'list-email-config', 'menu_metodo' =>'index'], 'view_email_config' => ['menu_controller' => 'view-email-config', 'menu_metodo' =>'index'], 'edit_email_config' => ['menu_controller' => 'edit-email-config','menu_metodo' => 'index'], 'delete_email_config' => ['menu_controller' =>'delete-email-config', 'menu_metodo' => 'index']];
       // Instância a classe:AdmsButton() e cria o objeto:$listButton
       $listButton = new \Adms\Models\helper\AdmsButton();
       // E Atribui o resultado para o atributo:$this->data['button'], criando esta posição
       $this->data['button'] = $listButton->buttonPermission($button);

        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \Adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();
        
        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "list-email-config";
        
        //Instancio a classe:ConfigView() e crio o objeto:$loadView
        $loadView = new \AdmsSrc\ConfigViewAdms("adms/Views/emailConfig/editEmailConfigPass", $this->data);
        //Instancia o método:loadView() da classe:ConfigView
        $loadView->loadViewAdms();
    }
    /** ============================================================================================ */
    private function editEmailPass():void
    {
        if(!empty($this->dataForm['SendEditEmailPass'])){
            unset($this->dataForm['SendEditEmailPass']);
            $editEmailConfsPass = new \Adms\Models\AdmsEditEmailConfigPass();
            $editEmailConfsPass->updateEmailPass($this->dataForm);
            if($editEmailConfsPass->getResult()){
                $urlRedirect = URLADM . "view-email-config/index/".$this->dataForm['id_email_config'];
                header("Location: $urlRedirect");
            }else{
                $this->data['form'] = $this->dataForm;
                $this->loadViewEditEmailPass();
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 138! Registro(E-mail) não encontrado!</p>";
            $urlRedirect = URLADM . "list-email-config/index";
            header("Location: $urlRedirect");
        }
    }
}
