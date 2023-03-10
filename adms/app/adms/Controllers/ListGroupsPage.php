<?php
namespace Adms\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
class ListGroupsPage
{
    /** @var array|string|null - Atributo:$data pode receber(da view) os dados(parametros) de diversos tipos, q devem ser enviados novamente para serem exibidos pela view */
    private array|string|null $data;

    /** @var string|integer|null - Recebe o numero da pagina atual   */
    private string|int|null $page;

    /** ==============================================================================================
     * @return void     */
    public function index(string|int|null $page = null):void
    {
          //Atribui o parametro recebido:$page para o atributo:$this->page
          //converte para inteiro e verifica se possui valor, se não atribui o valor 1
          $this->page = (int) $page ? $page : 1;
          // var_dump($this->page);

        //Instância a classe:$AdmsListSitsPgs e cria o objeto:$listSitsUsers
       $listGroupsPgs = new \Adms\Models\AdmsListGroupsPage();
       // Usa o objeto para instanciar o método:listSitsUsers() da classe:$AdmsListSitsUsers 
       //envia para a models a pagina atual:$this->page
       $listGroupsPgs->listGroupsPgs($this->page);
        //Verifica, através do método:getResult(), se obteve resultado, atribui para:$data
       if($listGroupsPgs->getResult()){
            $this->data['listGroupsPgs'] = $listGroupsPgs->getResultBd();
            // var_dump($this->data['listSitsUsers']);
            // PAGINAÇÃO - cria a POSIÇÃO:['pagination'] no array:$this->data
            $this->data['pagination'] = $listGroupsPgs->getResultPg();
       } else {
            $this->data['listGroupsPgs'] = [];
       }
       // coloca na posição:$this->data['pag'], o numero da pagina atual
       $this->data['pag'] = $this->page;

       // ----------- Exibir ou ocultar botões conforme o nivel de acesso -------------------
       $button = ['add_groups_page' => ['menu_controller' => 'add-groups-page', 'menu_metodo' => 'index'], 'view_groups_page' => ['menu_controller' => 'view-groups-page', 'menu_metodo' => 'index'], 'order_groups_page' => ['menu_controller' => 'order-groups-page', 'menu_metodo' => 'index'], 'edit_groups_page' => ['menu_controller' => 'edit-groups-page', 'menu_metodo' => 'index'], 'delete_groups_page' => ['menu_controller' => 'delete-groups-page', 'menu_metodo' => 'index']];
       // Instância a classe:AdmsButton() e cria o objeto:$listButton
       $listButton = new \Adms\Models\helper\AdmsButton();
       // E Atribui o resultado para o atributo:$this->data['button'], criando esta posição
       $this->data['button'] = $listButton->buttonPermission($button);
       
       // implementação da apresentação dinâmica do menu sidebar
       $listMenu = new \Adms\Models\helper\AdmsMenu();
       $this->data['menu'] = $listMenu->itemMenu();
       
       // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
       $this->data['sidebarActive'] = "list-groups-page";

       $loadSitsUsers = new \AdmsSrc\ConfigViewAdms("adms/Views/pages/listGroupsPage", $this->data);
       $loadSitsUsers->loadViewAdms();
    }
}