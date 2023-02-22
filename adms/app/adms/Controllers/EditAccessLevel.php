<?php
// echo "adms/Controller/NewUser.php: <h1> Página(controller) Novo usuário</h1>";
namespace Adms\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe da controller da pagina de novo usuário */
class EditAccessLevel
{
    /** Apartir do PHP 8, posso definir a TIPAGEM de varios tipos para o mesmo atributo, usando o PIPE| @var array|string|null - Define que o atributo:$data pode receber(da view) os dados(parametros) de diversos tipos, q devem ser enviados novamente para serem exibidos pela view */
    private array|string|null $data = [];
    //Recebe os dados do formulario
    private array|null $dataForm;
    /** @var integer|string|null - Recebe o ID(do usuário) do registro    */
    private int|string|null $id_access_level;
    /** ===================================================================================
     * Método GENÉRICO q instancia a classe:ConfigView() para carregar a View da pagina, 
     * e enviar os dados para a view, através do método:loadView()
     * Quando o usuário clicar no botão cadastrar do formulário da view novo usuário. Acessa o IF e instancia a classe:AdmsAddUsers responsável em cadastrar o usuário no DB.
     * Usuário cadastrado com sucesso, redireciona para a página de listar Registros, senão, instância a classe responsável em carregar a View e enviar os dados para view.  - @return void */
    public function index(int|string|null $id_access_level = null): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        // var_dump($this->dataForm);
        if ((!empty($id_access_level)) and (empty($this->dataForm['SendEditAccessLevel']))) {
            $this->id_access_level = (int) $id_access_level;
            // var_dump($this->id);
            $viewEditAccessNivels = new \Adms\Models\AdmsEditAccessLevel();
            $viewEditAccessNivels->viewEditAccessNivels($this->id_access_level);
            //verifica se a query obteve resultado(true, false)
            if($viewEditAccessNivels->getResult()){
                //pega o resultado da query q está dentro de:getResultBd() e atribui para o atributo $data com a POSIÇÃO [FORM}
                $this->data['form'] = $viewEditAccessNivels->getResultBd();
                // var_dump($this->data['form']);
                $this->loadViewEditUser();
            } else {
                $urlRedirect = URLADM . "list-access-level/index";
                header("Location: $urlRedirect");
            }
        } else {
            $this->editAccessNivels();
        }
    }
    /** =============================================================================================
     * Instânciar a classe responsável em carregar a view e enviar os dados para a view
     * @return void     */
    private function loadViewEditUser(): void
    {
        // ----------- Exibir ou ocultar botões conforme o nivel de acesso -------------------
        $button = ['list_access_level'=>['menu_controller'=>'list-access-level', 'menu_metodo'=>'index'], 'view_access_level'=>['menu_controller'=>'view-access-level', 'menu_metodo'=>'index'], 'delete_access_level'=>['menu_controller'=>'delete-access-level', 'menu_metodo'=>'index']];
        // Instância a classe:AdmsButton() e cria o objeto:$listButton
        $listButton = new \Adms\Models\helper\AdmsButton();
        // E Atribui o resultado para o atributo:$this->data['button'], criando esta posição
        $this->data['button'] = $listButton->buttonPermission($button);
        // var_dump($this->data['button']);

        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \Adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();
        
        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "list-access-level";
        
        //Instancio a classe:ConfigView() e crio o objeto:$loadView
        $loadView = new \AdmsSrc\ConfigViewAdms("adms/Views/accessLevel/editAccessLevel", $this->data);
        //Instancia o método:loadView() da classe:ConfigView
        $loadView->loadViewAdms();
    }
    /** =============================================================================================
     * @return void     */
    private function editAccessNivels():void
    {
        if(!empty($this->dataForm['SendEditAccessLevel'])){
            unset($this->dataForm['SendEditAccessLevel']);
            $editUser = new \Adms\Models\AdmsEditAccessLevel();
            $editUser->update($this->dataForm);
            if($editUser->getResult()){
                $urlRedirect = URLADM . "view-access-level/index/".$this->dataForm['id_access_level'];
                header("Location: $urlRedirect");
            }else{
                $this->data['form'] = $this->dataForm;
                $this->loadViewEditUser();
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 062! Nivel de acesso não encontrado!</p>";
            $urlRedirect = URLADM . "list-access-level/index";
            header("Location: $urlRedirect");
        }
    }
}
