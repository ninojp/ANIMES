<?php
namespace Adms\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe da controller da pagina Editar imagem do usuário */
class EditUserImage
{
    /** Apartir do PHP 8, posso definir a TIPAGEM de varios tipos para o mesmo atributo, usando o PIPE| @var array|string|null - Define que o atributo:$data pode receber(da view) os dados(parametros) de diversos tipos, q devem ser enviados novamente para serem exibidos pela view */
    private array|string|null $data = [];
    //Recebe os dados do formulario
    private array|null $dataForm;
    /** @var integer|string|null - Recebe o ID(do usuário) do registro    */
    private int|string|null $id_user;
    /** ===================================================================================
     * Método GENÉRICO q instancia a classe:ConfigView() para carregar a View da pagina, 
     * e enviar os dados para a view, através do método:loadView()
     * Quando o usuário clicar no botão cadastrar do formulário da view novo usuário. Acessa o IF e instancia a classe:AdmsAddUsers responsável em cadastrar o usuário no DB.
     * Usuário cadastrado com sucesso, redireciona para a página de listar Registros, senão, instância a classe responsável em carregar a View e enviar os dados para view.  - @return void */
    public function index(int|string|null $id_user = null): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        // var_dump($this->dataForm);
        if ((!empty($id_user)) and (empty($this->dataForm['SendEditUserImage']))) {
            $this->id_user = (int) $id_user;
            // var_dump($this->id);
            $viewUser = new \Adms\Models\AdmsEditUserImage();
            $viewUser->viewUsers($this->id_user);
            //verifica se a query obteve resultado(true, false)
            if($viewUser->getResult()){
                //pega o resultado da query q está dentro de:getResultBd() e atribui para o atributo $data com a POSIÇÃO [FORM}
                $this->data['form'] = $viewUser->getResultBd();
                // var_dump($this->data['form']);
                $this->viewEditUserImage();
            } else {
                $urlRedirect = URLADM . "list-user/index";
                header("Location: $urlRedirect");
            }
        } else {
            // $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! (necessário enviar o ID)Usuário não encontrado!</p>";
            // $urlRedirect = URLADM . "list-users/index";
            // header("Location: $urlRedirect");
            $this->editUserImage();
        }
    }
    /** =============================================================================================
     * Instânciar a classe responsável em carregar a view e enviar os dados para a view
     * @return void     */
    private function viewEditUserImage(): void
    {
        // ----------- Exibir ou ocultar botões conforme o nivel de acesso -------------------
        $button = ['list_user' => ['menu_controller' => 'list-user', 'menu_metodo' => 'index'], 
        'view_user' => ['menu_controller' => 'view-user', 'menu_metodo' => 'index']];
        // Instância a classe:AdmsButton() e cria o objeto:$listButton
        $listButton = new \Adms\Models\helper\AdmsButton();
        // E Atribui o resultado para o atributo:$this->data['button'], criando esta posição
        $this->data['button'] = $listButton->buttonPermission($button);

        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \Adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();
        
        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "list-user";
        
        //Instancio a classe:ConfigView() e crio o objeto:$loadView
        $loadView = new \AdmsSrc\ConfigViewAdms("adms/Views/users/editUserImage", $this->data);
        //Instancia o método:loadView() da classe:ConfigView
        $loadView->loadViewAdms();
    }
    /** =============================================================================================
     * @return void     */
    private function editUserImage():void
    {
        if(!empty($this->dataForm['SendEditUserImage'])){
            unset($this->dataForm['SendEditUserImage']);
            // Operador ternário, se for (verdadeiro)true utiliza a própria imagem se não atribui null
            $this->dataForm['new_image'] = $_FILES['new_image'] ? $_FILES['new_image'] : null;
            $editUserImage = new \Adms\Models\AdmsEditUserImage();
            $editUserImage->update($this->dataForm);
            if($editUserImage->getResult()){
                $urlRedirect = URLADM . "view-user/index/".$this->dataForm['id_user'];
                header("Location: $urlRedirect");
            } else {
                $this->data['form'] = $this->dataForm;
                $this->viewEditUserImage();
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 041! Usuário não encontrado!</p>";
            $urlRedirect = URLADM . "list-user/index";
            header("Location: $urlRedirect");
        }
    }
}
