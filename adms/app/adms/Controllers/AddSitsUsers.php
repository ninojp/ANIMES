<?php
namespace Adms\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
     header("Location: https://localhost/adms/");
     die("Erro 000! Página Não encontrada"); }
/** Controller cadastrar situação usuário  */
class AddSitsUsers
{

    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data = [];

    /** @var array $dataForm Recebe os dados do formulario */
    private array|null $dataForm;

    /** ==========================================================================================     
     * Método cadastrar situação usuário 
     * Receber os dados do formulário.
     * Quando o usuário clicar no botão "cadastrar" do formulário da página nova situação usuário. Acessa o IF e instância a classe "AdmsAddSitsUsers" responsável em cadastrar asituação usuário no banco de dados.
     * Situação cadastrada com sucesso, redireciona para a página listar registros.
     * Senão, instância a classe responsável em carregar a View e enviar os dados para View.
     *  @return void     */
    public function index(): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);        

        if(!empty($this->dataForm['SendAddSitUser'])){
            unset($this->dataForm['SendAddSitUser']);
            $createSitUser = new \Adms\Models\AdmsAddSitsUsers();
            $createSitUser->createAddSitsUsers($this->dataForm);
            if($createSitUser->getResult()){
                $urlRedirect = URLADM . "list-sits-users/index";
                header("Location: $urlRedirect");
            }else{
                $this->data['form'] = $this->dataForm;
                $this->viewAddSitUser();
            }   
        }else{
            $this->viewAddSitUser();
        }  
    }
    /** =============================================================================================
     * Instanciar a MODELS e o método "listSelect" responsável em buscar os dados para preencher o campo SELECT 
     * Instanciar a classe responsável em carregar a View e enviar os dados para View. */
    private function viewAddSitUser(): void
    {
        $listSelect = new \Adms\Models\AdmsAddSitsUsers();
        $this->data['selectCor'] = $listSelect->listSelectCor();

        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \Adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();

        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "list-sits-users";

        $loadView = new \AdmsSrc\ConfigViewAdms("adms/Views/sitsUsers/addSitsUsers", $this->data);
        $loadView->loadViewAdms();
    }
}
