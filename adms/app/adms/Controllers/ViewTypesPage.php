<?php
namespace Adms\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
class ViewTypesPage
{
    /** @var array|string|null - Define que o atributo:$data pode receber(da view) os dados(parametros) de diversos tipos, q devem ser enviados novamente para serem exibidos pela view */
    private array|string|null $data;

    /** @var integer|string|null - Recebe o ID(do usuário) do registro    */
    private int|string|null $id_type_page;
    /** ===================================================================================
     * Método GENÉRICO q instancia a classe:ConfigView() para carregar a View da pagina, 
     * e enviar os dados para a view, através do método:loadView() - @return void 
     * estou passando o ID:$id_type_page como parametro, recebido do CORE\CarregarPgAdm.php */
    public function index(int|string|null $id_type_page = null): void
    {
        if (!empty($id_type_page)) {
            // var_dump($id);
            $this->id_type_page = (int) $id_type_page;
            // echo "Existe o ID: {$this->id}<br>";
            $viewTypesPgs = new \Adms\Models\AdmsViewTypesPage();
            $viewTypesPgs->viewTypesPgs($this->id_type_page);
            if ($viewTypesPgs->getResult()) {
                $this->data['viewTypesPgs'] = $viewTypesPgs->getResultBd();
                $this->loadViewTypesPgs();
                // var_dump($this->data['viewUsers']);
            } else {
                $urlRedirect = URLADM."list-types-page/index";
                header("Location: $urlRedirect");
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 114! Tipo de pagina não encontrado!</p>";
            $urlRedirect = URLADM."list-types-page/index";
            header("Location: $urlRedirect");
        }
    }
    /** ======================================================================================
     * método para carregar a VIEW - @return void     */
    private function loadViewTypesPgs():void
    {
        // ----------- Exibir ou ocultar botões conforme o nivel de acesso -------------------
        $button = ['add_types_page'=>['menu_controller'=>'add-types-page', 'menu_metodo'=>'index'], 'list_types_page'=>['menu_controller'=>'list-types-page', 'menu_metodo'=>'index'],
        'edit_types_page'=>['menu_controller'=>'edit-types-page', 'menu_metodo'=>'index'],
        'delete_types_page'=>['menu_controller'=>'delete-types-page', 'menu_metodo'=>'index']];
        $listButton = new \Adms\Models\helper\AdmsButton();
        $this->data['button'] = $listButton->buttonPermission($button);

        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \Adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();
        
        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "view-types-page";
        
        //instancia a classe, cria o objeto e passa o parametro:$this->data, recebido da VIEW
        $loadView = new \AdmsSrc\ConfigViewAdms("adms/Views/pages/viewTypesPage", $this->data);
        //Instancia o método:loadView() da classe:ConfigView
        $loadView->loadViewAdms();
    }
}
