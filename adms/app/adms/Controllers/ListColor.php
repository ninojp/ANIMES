<?php
namespace Adms\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
// Classe(controller) para LISTAR as cores da DB
class ListColor
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

        //Instância a classe:$AdmsListColors e cria o objeto:$listColors
       $listColors = new \Adms\Models\AdmsListColor();
       // Usa o objeto para instanciar o método:listColors() da classe:$AdmsListColors 
       //envia para a models a pagina atual:$this->page
       $listColors->listColors($this->page);
        //Verifica, através do método:getResult(), se obteve resultado, atribui para:$data
       if($listColors->getResult()){
            $this->data['listColor'] = $listColors->getResultBd();
            // var_dump($this->data['listColors']);
            // PAGINAÇÃO - cria a POSIÇÃO:['pagination'] no array:$this->data
            $this->data['pagination'] = $listColors->getResultPg();
       } else {
            $this->data['listColor'] = [];
       }
       // ----------- Exibir ou ocultar botões conforme o nivel de acesso -------------------
        // Cria o array e suas devidas posições
        $button = ['add_color' => ['menu_controller' => 'add-color', 'menu_metodo' => 'index'], 
        'view_color' => ['menu_controller' => 'view-color', 'menu_metodo' => 'index'],
        'edit_color' => ['menu_controller' => 'edit-color', 'menu_metodo' => 'index'],
        'delete_color' => ['menu_controller' => 'delete-color', 'menu_metodo' => 'index']];
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
       $this->data['sidebarActive'] = "list-color";

       $loadlistColors = new \AdmsSrc\ConfigViewAdms("adms/Views/color/listColor", $this->data);
       $loadlistColors->loadViewAdms();
    }
}