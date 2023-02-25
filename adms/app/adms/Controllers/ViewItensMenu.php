<?php
namespace Adms\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
class ViewItensMenu
{
    private array|null $data;

    private int|string|null $id_item_menu;

    /** ============================================================================================
     * @param integer|string|null|null $id_item_menu  -  @return void      */
    public function index(int|string|null $id_item_menu = null):void
    {
        //verifica se existe um ID, se existir prossegue
        if(!empty($id_item_menu)){
            //define o id como um inteiro o o atribui para o atributo:$this->id
            $this->id_item_menu = (int) $id_item_menu;
            //Instância a classe:AdmsViewSitsUsers() e cria um objeto:$resultSitsUsers
            $resultItensMenu = new \Adms\Models\AdmsViewItensMenu();
            //usa o objeto para instânciar o método:viewSitsUsers(), que faz a consulta com o id 
            $resultItensMenu->viewItensMenu($this->id_item_menu);
            //usa o objeto para instanciar o método:getResult() e verificar se o mesmo é true
            if($resultItensMenu->getResult()){
                //se for, usa o objeto para instânciar o método:getResultBd() e atribuir o resultado do mesmo para uma nova posição no array do atributo:$this->data
                $this->data['viewItensMenu'] = $resultItensMenu->getResultBd();
                // var_dump($this->data['viewSitsUsers']);
                $this->loadViewItensMenu();
            } else {
                $urlRedirect = URLADM."list-itens-menu/index";
                header("Location: $urlRedirect");
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 080! Nunhum Item de Menu encontrada!</p>";
            $urlRedirect = URLADM."list-itens-menu/index";
            header("Location: $urlRedirect");
        }
    }
    /** ==========================================================================================
     * Método privado que intância a classe:ConfigView(parametro:endereço da view, dados) e o método:loadView() para executar a view
     * @return void     */
    private function loadViewItensMenu()
    {
        // ----------- Exibir ou ocultar botões conforme o nivel de acesso -------------------
        $button = ['add_itens_menu'=>['menu_controller'=>'add-itens-menu', 'menu_metodo'=>'index'], 'list_itens_menu'=>['menu_controller'=>'list-itens-menu', 'menu_metodo'=>'index'],
        'edit_itens_menu'=>['menu_controller'=>'edit-itens-menu', 'menu_metodo'=>'index'],
        'delete_itens_menu'=>['menu_controller'=>'delete-itens-menu', 'menu_metodo'=>'index']];
        $listButton = new \Adms\Models\helper\AdmsButton();
        $this->data['button'] = $listButton->buttonPermission($button);

        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \Adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();
        
        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "view-itens-menu";

        $loadView = new \AdmsSrc\ConfigViewAdms("adms/Views/itensMenu/viewItensMenu", $this->data);
        $loadView->loadViewAdms();
    }
}