<?php
namespace Adms\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
class ViewUser
{
    /** Apartir do PHP 8, posso definir a TIPAGEM de varios tipos para o mesmo atributo, usando o PIPE|
     * @var array|string|null - Define que o atributo:$data pode receber(da view) os dados(parametros) de diversos tipos, q devem ser enviados novamente para serem exibidos pela view */
    private array|string|null $data;
    /** @var integer|string|null - Recebe o ID(do usuário) do registro    */
    private int|string|null $id_user;
    /** ===================================================================================
     * Método GENÉRICO q instancia a classe:ConfigView() para carregar a View da pagina, 
     * e enviar os dados para a view, através do método:loadView() - @return void 
     * estou passando o ID:$id_user como parametro, recebido do CORE\CarregarPgAdm.php */
    public function index(int|string|null $id_user = null): void
    {
        // var_dump($id_user);
        if (!empty($id_user)) {
            // var_dump($id_user);
            $this->id_user = (int) $id_user;
            // echo "Existe o ID: {$this->id}<br>";
            $viewUsers = new \Adms\Models\AdmsViewUser();
            $viewUsers->viewUsers($this->id_user);
            if ($viewUsers->getResult()) {
                $this->data['viewUser'] = $viewUsers->getResultBd();
                $this->loadViewUser();
                // var_dump($this->data['viewUsers']);
            } else {
                $urlRedirect = URLADM."list-user/index";
                header("Location: $urlRedirect");
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 036! (necessário enviar o ID)Usuário não encontrado!</p>";
            $urlRedirect = URLADM."list-user/index";
            header("Location: $urlRedirect");
        }
        // echo "adms/Controller/ViewUsers.php: <h1> Página(controller) de ViewUsers</h1>";
        $this->data = [];
    }
    /** ======================================================================================
     * método para carregar a VIEW - @return void     */
    private function loadViewUser():void
    {
        // ----------- Exibir ou ocultar botões conforme o nivel de acesso -------------------
        $button = ['list_user' => ['menu_controller' => 'list-user', 'menu_metodo' => 'index'], 
        'edit_user' => ['menu_controller' => 'edit-user', 'menu_metodo' => 'index'],
        'edit_user_pass' => ['menu_controller' => 'edit-user-pass', 'menu_metodo' => 'index'],
        'edit_user_image' => ['menu_controller' => 'edit-user-image', 'menu_metodo' => 'index'],
        'delete_user' => ['menu_controller' => 'delete-user', 'menu_metodo' => 'index']];
        // Instância a classe:AdmsButton() e cria o objeto:$listButton
        $listButton = new \Adms\Models\helper\AdmsButton();
        // E Atribui o resultado para o atributo:$this->data['button'], criando esta posição
        $this->data['button'] = $listButton->buttonPermission($button);
        // var_dump($this->data['button']);

        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \Adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();


        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "list-user";
        
        //instancia a classe, cria o objeto e passa o parametro:$this->data, recebido da VIEW
        $loadView = new \AdmsSrc\ConfigViewAdms("adms/Views/users/viewUser", $this->data);
        //Instancia o método:loadView() da classe:ConfigView
        $loadView->loadViewAdms();
    }
}
