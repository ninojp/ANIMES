<?php
namespace Adms\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
// Classe(Models) para vizualizar o nivel de acesso para o formulário novo usuário na pagina de login
class ViewDefaultAccess
{
    private array|string|null $data;
    // private int|string|null $id;

    /** ===========================================================================================
     * @param integer|string|null|null $id -      @return void     */
    public function index():void
    {
            //Instância a classe:AdmsViewSitsUsers() e cria um objeto:$resultSitsUsers
            $viewLevelsForm = new \Adms\Models\AdmsViewDefaultAccess();
            //usa o objeto para instânciar o método:viewSitsUsers(), que faz a consulta com o id 
            $viewLevelsForm->viewLevelsForms();
            //usa o objeto para instanciar o método:getResult() e verificar se o mesmo é true
            if($viewLevelsForm->getResult()){
                //se for, usa o objeto para instânciar o método:getResultBd() e atribuir o resultado do mesmo para uma nova posição no array do atributo:$this->data
                $this->data['viewLevelsForm'] = $viewLevelsForm->getResultBd();
                // var_dump($this->data['viewSitsUsers']);
                $this->loadViewLevelsForm();
            } else {
            // $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Página de configuração não encontrada!</p>";
            $urlRedirect = URLADM."dashboard/index";
            header("Location: $urlRedirect");
            }
    }
    /** ===========================================================================================
     * Método privado que intância a classe:ConfigView(parametro:endereço da view, dados) e o método:loadView() para executar a view
     * @return void     */
    private function loadViewLevelsForm()
    {
        // ----------- Exibir ou ocultar botões conforme o nivel de acesso -------------------
        $button = ['edit_default_access'=>['menu_controller'=>'edit-default-access', 'menu_metodo'=>'index']];
        $listButton = new \Adms\Models\helper\AdmsButton();
        $this->data['button'] = $listButton->buttonPermission($button);

        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \Adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();
        
        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "view-levels-forms";

        $loadView = new \AdmsSrc\ConfigViewAdms("adms/Views/defaultAccess/viewDefaultAccess", $this->data);
        $loadView->loadViewAdms();
    }
}