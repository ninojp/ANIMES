<?php
namespace Adms\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
class ViewSitsPage
{
    private array|null $data;
    private int|string|null $id_sits_page;

    public function index(int|string|null $id_sits_page = null):void
    {
        //verifica se existe um ID, se existir prossegue
        if(!empty($id_sits_page)){
            //define o id como um inteiro o o atribui para o atributo:$this->id
            $this->id_sits_page = (int) $id_sits_page;
            //Instância a classe:AdmsViewSitsUsers() e cria um objeto:$resultSitsUsers
            $resultSitsPgs = new \Adms\Models\AdmsViewSitsPage();
            //usa o objeto para instânciar o método:viewSitsUsers(), que faz a consulta com o id 
            $resultSitsPgs->viewSitsPgs($this->id_sits_page);
            //usa o objeto para instanciar o método:getResult() e verificar se o mesmo é true
            if($resultSitsPgs->getResult()){
                //se for, usa o objeto para instânciar o método:getResultBd() e atribuir o resultado do mesmo para uma nova posição no array do atributo:$this->data
                $this->data['viewSitsPgs'] = $resultSitsPgs->getResultBd();
                // var_dump($this->data['viewSitsUsers']);
                $this->loadViewSitsPgs();
            } else {
                $urlRedirect = URLADM."list-sits-page/index";
                header("Location: $urlRedirect");
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 104! Nunhuma Situação da pagina encontrada!</p>";
            $urlRedirect = URLADM."list-sits-page/index";
            header("Location: $urlRedirect");
        }
    }
    /** ==============================================================================================
     * Método privado que intância a classe:ConfigView(parametro:endereço da view, dados) e o método:loadView() para executar a view
     * @return void     */
    private function loadViewSitsPgs()
    {
        // ----------- Exibir ou ocultar botões conforme o nivel de acesso -------------------
        $button = ['add_sits_page'=>['menu_controller'=>'add-sits-page', 'menu_metodo'=>'index'], 'list_sits_page'=>['menu_controller'=>'list-sits-page', 'menu_metodo'=>'index'],
        'edit_sits_page'=>['menu_controller'=>'edit-sits-page', 'menu_metodo'=>'index'],
        'delete_sits_page'=>['menu_controller'=>'delete-sits-page', 'menu_metodo'=>'index']];
        $listButton = new \Adms\Models\helper\AdmsButton();
        $this->data['button'] = $listButton->buttonPermission($button);
        
        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \Adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();
        
        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "view-sits-page";

        $loadView = new \AdmsSrc\ConfigViewAdms("adms/Views/pages/viewSitsPage", $this->data);
        $loadView->loadViewAdms();
    }
}