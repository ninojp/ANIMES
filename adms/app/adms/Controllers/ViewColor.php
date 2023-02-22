<?php
namespace Adms\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
// Classe(Controller) para vizualizar os detalhes da cor
class ViewColor
{
    private array|string|null $data;
    private int|string|null $id_color;

    /** ========================================================================================
     * @param integer|string|null|null $id  -  @return void
     */
    public function index(int|string|null $id_color = null):void
    {
        //verifica se existe um ID, se existir prossegue
        if(!empty($id_color)){
            //define o id como um inteiro o o atribui para o atributo:$this->id
            $this->id_color = (int) $id_color;
            //Instância a classe:AdmsViewSitsUsers() e cria um objeto:$resultSitsUsers
            $resultColors = new \Adms\Models\AdmsViewColor();
            //usa o objeto para instânciar o método:viewSitsUsers(), que faz a consulta com o id 
            $resultColors->viewColors($this->id_color);
            //usa o objeto para instanciar o método:getResult() e verificar se o mesmo é true
            if($resultColors->getResult()){
                //se for, usa o objeto para instânciar o método:getResultBd() e atribuir o resultado do mesmo para uma nova posição no array do atributo:$this->data
                $this->data['viewColor'] = $resultColors->getResultBd();
                // var_dump($this->data['viewSitsUsers']);
                $this->loadViewColors();
            } else {
                $urlRedirect = URLADM."list-color/index";
                header("Location: $urlRedirect");
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 070! Nunhuma Cor encontrada!</p>";
            $urlRedirect = URLADM."list-color/index";
            header("Location: $urlRedirect");
        }
    }
    /** ============================================================================================
     * Método privado que intância a classe:ConfigView(parametro:endereço da view, dados) e o método:loadView() para executar a view
     * @return void     */
    private function loadViewColors()
    {
        // ----------- Exibir ou ocultar botões conforme o nivel de acesso -------------------
        $button = ['add_color' => ['menu_controller' => 'add-color', 'menu_metodo' => 'index'], 
        'list_color' => ['menu_controller' => 'list-color', 'menu_metodo' => 'index'],
        'edit_color' => ['menu_controller' => 'edit-color', 'menu_metodo' => 'index'],
        'delete_color' => ['menu_controller' => 'delete-color', 'menu_metodo' => 'index']];
        $listButton = new \Adms\Models\helper\AdmsButton();
        $this->data['button'] = $listButton->buttonPermission($button);

        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \Adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();
        
        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "list-color";

        $loadView = new \AdmsSrc\ConfigViewAdms("adms/Views/color/viewColor", $this->data);
        $loadView->loadViewAdms();
    }
}