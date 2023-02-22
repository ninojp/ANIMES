<?php
namespace Adms\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe (Controller): cadastrar Item de Menu DropDown  */
class AddItensMenu
{
 /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data = [];

    /** @var array $dataForm Recebe os dados do formulario */
    private array|null $dataForm;

    /** ==========================================================================================   
     * Método cadastrar Item de Menu DropDown 
     * Receber os dados do formulário.
     * Quando o da pagina clicar no botão "cadastrar" do formulário da página nova Item de Menu DropDown. Acessa o IF e instância a classe "AdmsAddItensMenu" responsável em cadastrar a situação da pagina no banco de dados.
     * Situação cadastrada com sucesso, redireciona para a página listar registros.
     * Senão, instância a classe responsável em carregar a View e enviar os dados para View.
     *  @return void     */
    public function index(): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);        

        if(!empty($this->dataForm['SendAddItemMenu'])){
            unset($this->dataForm['SendAddItemMenu']);
            $createItemMenu = new \Adms\Models\AdmsAddItensMenu();
            $createItemMenu->createAddItemMenu($this->dataForm);
            if($createItemMenu->getResult()){
                $urlRedirect = URLADM . "list-itens-menu/index";
                header("Location: $urlRedirect");
            }else{
                $this->data['form'] = $this->dataForm;
                $this->viewAddItemMenu();
            }   
        }else{
            $this->viewAddItemMenu();
        }  
    }
    /** =========================================================================================
     * Instanciar a classe responsável em carregar a View e enviar os dados para View. */
    private function viewAddItemMenu(): void
    {
        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \Adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();
        
        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "add-itens-menu";

        $loadView = new \AdmsSrc\ConfigViewAdms("adms/Views/itensMenu/addItensMenu", $this->data);
        $loadView->loadViewAdms();
    }
}
