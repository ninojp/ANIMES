<?php
namespace Adms\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe(Controllers) para listar os e-mails cadastrados no DB  */
class ListEmailConfig
{
    /** @var array|string|null - Define que o atributo:$data pode receber(da view) os dados(parametros) de diversos tipos, q devem ser enviados novamente para serem exibidos pela view */
    private array|string|null $data;

    /** @var string|integer|null - Recebe o numero da pagina atual   */
    private string|int|null $page;

    /** ===========================================================================================
     * Método para listar Usuários
     * Instância a models q ira buscar os registros no DB
     * Se encontrar registros, os envia para a view. Se não envia um array vazio
     * Passa o parametro:$page, para fazer a paginação
     * @return void   */
    public function index(string|int|null $page = null)
    {
        //Atribui o parametro recebido:$page para o atributo:$this->page
        //converte para inteiro e verifica se possui valor, se não atribui o valor 1
        $this->page = (int) $page ? $page : 1;
        // var_dump($this->page);

        $listAtualEmails = new \Adms\Models\AdmsListEmailConfig();
        //envia para a models a pagina atual
        $listAtualEmails->listAtualEmails($this->page);
        if($listAtualEmails->getResult()){
            $this->data['listEmails'] = $listAtualEmails->getResultBd();
            // var_dump($this->data['listUsers']);
            // PAGINAÇÃO - cria a POSIÇÃO:['pagination'] no array:$this->data
            $this->data['pagination'] = $listAtualEmails->getResultPg();
        }else{
            $this->data['listEmails'] = [];
        }
        // ----------- Exibir ou ocultar botões conforme o nivel de acesso -------------------
       $button = ['add_email_config' => ['menu_controller' => 'add-email-config', 'menu_metodo' => 'index'], 'view_email_config' => ['menu_controller' => 'view-email-config', 'menu_metodo' => 'index'], 'edit_email_config' => ['menu_controller' => 'edit-email-config', 'menu_metodo' => 'index'], 'delete_email_config' => ['menu_controller' => 'delete-email-config', 'menu_metodo' => 'index']];
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
        $loadView = new \AdmsSrc\ConfigViewAdms("adms/Views/emailConfig/listEmailConfig",$this->data);
        //Instancia o método:loadView() da classe:ConfigView
        $loadView->loadViewAdms();
    }

}