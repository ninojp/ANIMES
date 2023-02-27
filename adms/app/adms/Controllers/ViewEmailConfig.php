<?php
namespace Adms\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe(Controlllers) para visualizar os detalhes das configurações de e-mail */
class ViewEmailConfig
{
    /** @var array|string|null - Define que o atributo:$data pode receber(da view) os dados(parametros) de diversos tipos, q devem ser enviados novamente para serem exibidos pela view */
    private array|string|null $data;

    /** @var integer|string|null - Recebe o ID(do usuário) do registro    */
    private int|string|null $id_email_config;

    /** ===================================================================================
     * Método GENÉRICO q instancia a classe:ConfigView() para carregar a View da pagina, 
     * e enviar os dados para a view, através do método:loadView() - @return void 
     * estou passando o ID:$id como parametro, recebido do CORE\CarregarPgAdm.php */
    public function index(int|string|null $id_email_config = null): void
    {
        if (!empty($id_email_config)) {
            // var_dump($id);
            $this->id_email_config = (int) $id_email_config;
            // echo "Existe o ID: {$this->id}<br>";
            $viewEmailConf = new \Adms\Models\AdmsViewEmailConfig();
            $viewEmailConf->ViewEmailConfs($this->id_email_config);
            if ($viewEmailConf->getResult()) {
                $this->data['viewEmailConf'] = $viewEmailConf->getResultBd();
                $this->loadViewEmailConfs();
                // var_dump($this->data['viewUsers']);
            } else {
                $urlRedirect = URLADM."list-email-config/index";
                header("Location: $urlRedirect");
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 134! Nenhum E-mail(registro) encontrado!</p>";
            $urlRedirect = URLADM."list-email-config/index";
            header("Location: $urlRedirect");
        }
    }
    /** ======================================================================================
     * método para carregar a VIEW - @return void     */
    private function loadViewEmailConfs():void
    {
         // ----------- Exibir ou ocultar botões conforme o nivel de acesso -------------------
       $button = ['add_email_config' => ['menu_controller' => 'add-email-config', 'menu_metodo' => 'index'], 'list_email_config' => ['menu_controller' => 'list-email-config', 'menu_metodo' => 'index'], 'edit_email_config' => ['menu_controller' => 'edit-email-config', 'menu_metodo' => 'index'], 'edit_email_config_pass' => ['menu_controller' => 'edit-email-config-pass', 'menu_metodo' => 'index'], 'delete_email_config' => ['menu_controller' => 'delete-email-config', 'menu_metodo' => 'index']];
       // Instância a classe:AdmsButton() e cria o objeto:$listButton
       $listButton = new \Adms\Models\helper\AdmsButton();
       // E Atribui o resultado para o atributo:$this->data['button'], criando esta posição
       $this->data['button'] = $listButton->buttonPermission($button);

        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \Adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();
        
        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "list-email-config";
        
        //instancia a classe, cria o objeto e passa o parametro:$this->data, recebido da VIEW
        $loadView = new \AdmsSrc\ConfigViewAdms("adms/Views/emailConfig/viewEmailConfig", $this->data);
        //Instancia o método:loadView() da classe:ConfigView
        $loadView->loadViewAdms();
    }
}
