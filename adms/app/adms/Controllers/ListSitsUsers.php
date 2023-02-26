<?php
namespace Adms\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
     header("Location: https://localhost/adms/");
     die("Erro 000! Página Não encontrada"); }
class ListSitsUsers
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

        //Instância a classe:$AdmsListSitsUsers e cria o objeto:$listSitsUsers
       $listSitsUsers = new \Adms\Models\AdmsListSitsUsers();
       // Usa o objeto para instanciar o método:listSitsUsers() da classe:$AdmsListSitsUsers 
       //envia para a models a pagina atual:$this->page
       $listSitsUsers->listSitsUsers($this->page);
        //Verifica, através do método:getResult(), se obteve resultado, atribui para:$data
       if($listSitsUsers->getResult()){
            $this->data['listSitsUsers'] = $listSitsUsers->getResultBd();
            // var_dump($this->data['listSitsUsers']);
            // PAGINAÇÃO - cria a POSIÇÃO:['pagination'] no array:$this->data
            $this->data['pagination'] = $listSitsUsers->getResultPg();
       } else {
            $this->data['listSitsUsers'] = [];
       }
       // ----------- Exibir ou ocultar botões conforme o nivel de acesso -------------------
        // Cria o array e suas devidas posições
        $button = ['add_sits_users' => ['menu_controller'=>'add-sits-users', 'menu_metodo'=>'index'], 'view_sits_users'=>['menu_controller'=>'view-sits-users', 'menu_metodo'=>'index'], 'edit_sits_users'=>['menu_controller'=>'edit-sits-users', 'menu_metodo'=>'index'], 'delete_sits_users'=>['menu_controller'=>'delete-sits-users', 'menu_metodo'=>'index']];
        // Instância a classe:AdmsButton() e cria o objeto:$listButton
        $listButton = new \Adms\Models\helper\AdmsButton();
        // Passa como parametro o array:$button criado acima, para o método:buttonPermission()
        // E Atribui o resultado para o atributo:$this->data['button'], criando esta posição
        $this->data['button'] = $listButton->buttonPermission($button);
        // var_dump($this->data['button']);

       // implementação da apresentação dinâmica do menu sidebar
       $listMenu = new \Adms\Models\helper\AdmsMenu();
       $this->data['menu'] = $listMenu->itemMenu();
       
       // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
       $this->data['sidebarActive'] = "list-sits-users";

       $loadSitsUsers = new \AdmsSrc\ConfigViewAdms("adms/Views/sitsUsers/listSitsUsers", $this->data);
       $loadSitsUsers->loadViewAdms();
    }
}