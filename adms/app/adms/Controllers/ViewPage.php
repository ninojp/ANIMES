<?php
namespace Adms\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
class ViewPage
{
    /** @var array|string|null - Define que o atributo:$data pode receber(da view) os dados(parametros) de diversos tipos, q devem ser enviados novamente para serem exibidos pela view */
    private array|string|null $data;

    /** @var integer|string|null - Recebe o ID(do usuário) do registro    */
    private int|string|null $id_page;
    /** ===================================================================================
     * Método GENÉRICO q instancia a classe:ConfigView() para carregar a View da pagina, 
     * e enviar os dados para a view, através do método:loadView() - @return void 
     * estou passando o ID:$id como parametro, recebido do CORE\CarregarPgAdm.php */
    public function index(int|string|null $id_page = null): void
    {
        // var_dump($id);
        if (!empty($id_page)) {
            // var_dump($id);
            $this->id_page = (int) $id_page;
            // echo "Existe o ID: {$this->id}<br>";
            $viewPages = new \Adms\Models\AdmsViewPage();
            $viewPages->viewPages($this->id_page);
            if ($viewPages->getResult()) {
                $this->data['viewPage'] = $viewPages->getResultBd();
                $this->loadViewPages();
                // var_dump($this->data['viewUsers']);
            } else {
                $urlRedirect = URLADM."list-page/index";
                header("Location: $urlRedirect");
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 027! (ID)pagina não encontrado!</p>";
            $urlRedirect = URLADM."list-page/index";
            header("Location: $urlRedirect");
            // echo "Erro!";
        }
    }
    /** ======================================================================================
     * método para carregar a VIEW - @return void     */
    private function loadViewPages():void
    {
        // ----------- Exibir ou ocultar botões conforme o nivel de acesso -------------------
        $button = ['add_page' => ['menu_controller' => 'add-page', 'menu_metodo' => 'index'], 'list_page' => ['menu_controller' => 'list-page', 'menu_metodo' => 'index'],
        'edit_page' => ['menu_controller' => 'edit-page', 'menu_metodo' => 'index'],
        'delete_page' => ['menu_controller' => 'delete-page', 'menu_metodo' => 'index']];
        $listButton = new \Adms\Models\helper\AdmsButton();
        $this->data['button'] = $listButton->buttonPermission($button);

        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \Adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();

        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "view-page";
        
        //instancia a classe, cria o objeto e passa o parametro:$this->data, recebido da VIEW
        $loadView = new \AdmsSrc\ConfigViewAdms("adms/Views/pages/viewPage", $this->data);
        //Instancia o método:loadView() da classe:ConfigView
        $loadView->loadViewAdms();
    }
}
