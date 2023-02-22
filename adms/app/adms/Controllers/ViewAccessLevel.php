<?php
namespace Adms\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
class ViewAccessLevel
{
    /** Apartir do PHP 8, posso definir a TIPAGEM de varios tipos para o mesmo atributo, usando o PIPE|
     * @var array|string|null - Define que o atributo:$data pode receber(da view) os dados(parametros) de diversos tipos, q devem ser enviados novamente para serem exibidos pela view */
    private array|string|null $data;
    /** @var integer|string|null - Recebe o ID(do usuário) do registro    */
    private int|string|null $id_access_level;
    /** ===================================================================================
     * Método GENÉRICO q instancia a classe:ConfigView() para carregar a View da pagina, 
     * e enviar os dados para a view, através do método:loadView() - @return void 
     * estou passando o ID:$id como parametro, recebido do CORE\CarregarPgAdm.php */
    public function index(int|string|null $id_access_level = null): void
    {
        if (!empty($id_access_level)) {
            // var_dump($id);
            $this->id_access_level = (int) $id_access_level;
            // echo "Existe o ID: {$this->id}<br>";
            $viewAccessNivels = new \Adms\Models\AdmsViewAccessLevel();
            $viewAccessNivels->viewAccessNivels($this->id_access_level);
            if ($viewAccessNivels->getResult()) {
                $this->data['viewAccessLevel'] = $viewAccessNivels->getResultBd();
                $this->loadViewAccessNivels();
                // var_dump($this->data['viewUsers']);
            } else {
                $urlRedirect = URLADM."list-access-level/index";
                header("Location: $urlRedirect");
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 060! Nivel de acesso não encontrado!</p>";
            $urlRedirect = URLADM."list-access-level/index";
            header("Location: $urlRedirect");
        }
    }
    /** ======================================================================================
     * método para carregar a VIEW - @return void     */
    private function loadViewAccessNivels():void
    {
        // ----------- Exibir ou ocultar botões conforme o nivel de acesso -------------------
        $button = ['list_access_level'=>['menu_controller'=>'list-access-level', 'menu_metodo'=>'index'], 'edit_access_level'=>['menu_controller'=>'edit-access-level', 'menu_metodo'=>'index'], 'delete_access_level'=>['menu_controller'=>'delete-access-level', 'menu_metodo'=>'index']];
        // Instância a classe:AdmsButton() e cria o objeto:$listButton
        $listButton = new \Adms\Models\helper\AdmsButton();
        // E Atribui o resultado para o atributo:$this->data['button'], criando esta posição
        $this->data['button'] = $listButton->buttonPermission($button);
        // var_dump($this->data['button']);

        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \Adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();
        
        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "list-access-level";
        
        //instancia a classe, cria o objeto e passa o parametro:$this->data, recebido da VIEW
        $loadView = new \AdmsSrc\ConfigViewAdms("adms/Views/accessLevel/viewAccessLevel", $this->data);
        //Instancia o método:loadView() da classe:ConfigView
        $loadView->loadViewAdms();
    }
}
