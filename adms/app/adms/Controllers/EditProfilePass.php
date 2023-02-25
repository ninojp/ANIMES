<?php
namespace Adms\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe da controller da pagina de editar senha perfil */
class EditProfilePass
{
    /** Apartir do PHP 8, posso definir a TIPAGEM de varios tipos para o mesmo atributo, usando o PIPE| @var array|string|null - Define que o atributo:$data pode receber(da view) os dados(parametros) de diversos tipos, q devem ser enviados novamente para serem exibidos pela view */
    private array|string|null $data = [];
    //Recebe os dados do formulario
    private array|null $dataForm;

    /** ===================================================================================
     * Método GENÉRICO q instancia a classe:ConfigView() para carregar a View da pagina, 
     * e enviar os dados para a view, através do método:loadView()
     * Quando o usuário clicar no botão cadastrar do formulário da view novo usuário. Acessa o IF e instancia a classe:AdmsAddUsers responsável em cadastrar o usuário no DB.
     * Usuário cadastrado com sucesso, redireciona para a página de listar Registros, senão, instância a classe responsável em carregar a View e enviar os dados para view.  - @return void */
    public function index(): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        // var_dump($this->dataForm);
        if (!empty($this->dataForm['SendEditProfPass'])) {
            // var_dump($this->dataForm);
            $this->editProfPass();
        } else {
            //instância a classe:AdmsEditProfile e cria o objeto para instanciar o método
            $viewProfPass = new \Adms\Models\AdmsEditProfilePass();
            //método:viewProfile() q vai solicitar as informações no db
            $viewProfPass->viewProfile();
            //verifica se existe resultado da query, através do método:getResult()=true
            if($viewProfPass->getResult()){
                //se existir, pega os resultados no método:getResultBd() e os coloca no atributo:$this->data['form'], com a posição FORM, para enviar para View
                $this->data['form'] = $viewProfPass->getResultBd();
                $this->viewEditProfPass();
            } else {
                $urlRedirect = URLADM."login/index";
                header("Location: $urlRedirect");
            }
        }
    }
    /** =============================================================================================
     * Instânciar a classe responsável em carregar a view e enviar os dados para a view
     * @return void     */
    private function viewEditProfPass(): void
    {
        // ----------- Exibir ou ocultar botões conforme o nivel de acesso -------------------
        $button = ['view_profile' => ['menu_controller' => 'view-profile', 'menu_metodo' => 'index'],
        'edit_profile_image' => ['menu_controller' => 'edit-profile-image', 'menu_metodo' => 'index'],
        'edit_profile' => ['menu_controller' => 'edit-profile', 'menu_metodo' => 'index'],
        'logout' => ['menu_controller' => 'logout', 'menu_metodo' => 'index']];
        // Instância a classe:AdmsButton() e cria o objeto:$listButton
        $listButton = new \Adms\Models\helper\AdmsButton();
        // E Atribui o resultado para o atributo:$this->data['button'], criando esta posição
        $this->data['button'] = $listButton->buttonPermission($button);

        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \Adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();
        
        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "edit-profile-pass";

        //Instancio a classe:ConfigView() e crio o objeto:$loadView
        $loadView = new \AdmsSrc\ConfigViewAdms("adms/Views/users/editProfilePass", $this->data);
        //Instancia o método:loadView() da classe:ConfigView
        $loadView->loadViewAdms();
    }
    /** =============================================================================================
     * @return void     */
    private function editProfPass():void
    {
        if(!empty($this->dataForm['SendEditProfPass'])){
            unset($this->dataForm['SendEditProfPass']);
            $editProfPass = new \Adms\Models\AdmsEditProfilePass();
            $editProfPass->update($this->dataForm);
            if($editProfPass->getResult()){
                $urlRedirect = URLADM . "view-profile/index";
                header("Location: $urlRedirect");
            }else{
                $this->data['form'] = $this->dataForm;
                $this->viewEditProfPass();
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 092! Perfil não encontrado!</p>";
            $urlRedirect = URLADM . "login/index";
            header("Location: $urlRedirect");
        }
    }
}
