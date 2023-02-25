<?php
namespace Adms\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
class ViewGroupsPage
{
    private array|null $data;

    private int|string|null $id_group_page;

    /** ============================================================================================
     * @param integer|string|null|null $id_group_page  -  @return void      */
    public function index(int|string|null $id_group_page = null):void
    {
        //verifica se existe um ID, se existir prossegue
        if(!empty($id_group_page)){
            //define o id como um inteiro o o atribui para o atributo:$this->id
            $this->id_group_page = (int) $id_group_page;
            //Instância a classe:AdmsViewSitsUsers() e cria um objeto:$resultSitsUsers
            $resultGroupsPgs = new \Adms\Models\AdmsViewGroupsPage();
            //usa o objeto para instânciar o método:viewSitsUsers(), que faz a consulta com o id 
            $resultGroupsPgs->viewGroupsPage($this->id_group_page);
            //usa o objeto para instanciar o método:getResult() e verificar se o mesmo é true
            if($resultGroupsPgs->getResult()){
                //se for, usa o objeto para instânciar o método:getResultBd() e atribuir o resultado do mesmo para uma nova posição no array do atributo:$this->data
                $this->data['viewGroupsPgs'] = $resultGroupsPgs->getResultBd();
                // var_dump($this->data['viewSitsUsers']);
                $this->loadViewGroupsPgs();
            } else {
                $urlRedirect = URLADM."list-groups-page/index";
                header("Location: $urlRedirect");
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 095! Nunhum Grupo da pagina encontrada!</p>";
            $urlRedirect = URLADM."list-groups-page/index";
            header("Location: $urlRedirect");
        }
    }
    /** ==========================================================================================
     * Método privado que intância a classe:ConfigView(parametro:endereço da view, dados) e o método:loadView() para executar a view
     * @return void     */
    private function loadViewGroupsPgs()
    {
        // ----------- Exibir ou ocultar botões conforme o nivel de acesso -------------------
       $button = ['add_groups_page' => ['menu_controller' => 'add-groups-page', 'menu_metodo' => 'index'], 'list_groups_page' => ['menu_controller' => 'list-groups-page', 'menu_metodo' => 'index'], 'edit_groups_page' => ['menu_controller' => 'edit-groups-page', 'menu_metodo' => 'index'], 'delete_groups_page' => ['menu_controller' => 'delete-groups-page', 'menu_metodo' => 'index']];
       // Instância a classe:AdmsButton() e cria o objeto:$listButton
       $listButton = new \Adms\Models\helper\AdmsButton();
       // E Atribui o resultado para o atributo:$this->data['button'], criando esta posição
       $this->data['button'] = $listButton->buttonPermission($button);

        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \Adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();
        
        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "view-groups-page";

        $loadView = new \AdmsSrc\ConfigViewAdms("adms/Views/pages/viewGroupsPage", $this->data);
        $loadView->loadViewAdms();
    }
}