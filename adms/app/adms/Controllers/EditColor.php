<?php
namespace Adms\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe(Controlles) para editar uma Cor existente */
class EditColor
{
    //Envia os dados a serem editados no formulário da view
    private array|string|null $data = [];
    //recebe os dados do formulário da view
    private array|null $dataForm;
    //Recebe o id do registro a ser editado
    private int|string|null $id_color;

    public function index(int|string|null $id_color=null):void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        // var_dump($this->dataForm);
        if ((!empty($id_color)) and (empty($this->dataForm['SendEditColor']))) {
            $this->id_color = (int) $id_color;
            // var_dump($this->id_color);
            $atualColors = new \Adms\Models\AdmsEditColor();
            $atualColors->viewColorsBd($this->id_color);
            if($atualColors->getResult()){
                //pega o resultado da query q está dentro de:getResultBd() e atribui para o atributo $data com a POSIÇÃO [FORM}
                $this->data['form'] = $atualColors->getResultBd();
                // var_dump($this->data['form']);
                $this->viewEditColors();
            }else{
                $urlRedirect = URLADM . "list-color/index";
                header("Location: $urlRedirect");
            }
        } else {
            $this->editColors();
        }
        
    }
    /** =============================================================================================
     * Instânciar a classe responsável em carregar a view e enviar os dados para a view
     * @return void     */
    private function viewEditColors(): void
    {
        // ----------- Exibir ou ocultar botões conforme o nivel de acesso -------------------
        $button = ['add_color' => ['menu_controller' => 'add-color', 'menu_metodo' => 'index'], 'view_color' => ['menu_controller' => 'view-color', 'menu_metodo' => 'index'],
        'list_color' => ['menu_controller' => 'list-color', 'menu_metodo' => 'index'],
        'delete_color' => ['menu_controller' => 'delete-color', 'menu_metodo' => 'index']];
        $listButton = new \Adms\Models\helper\AdmsButton();
        $this->data['button'] = $listButton->buttonPermission($button);

        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \Adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();
        
        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "list-color";

        //Instancio a classe:ConfigView() e crio o objeto:$loadView
        $loadView = new \AdmsSrc\ConfigViewAdms("adms/Views/color/editColor", $this->data);
        //Instancia o método:loadView() da classe:ConfigView
        $loadView->loadViewAdms();
    }
    /** =============================================================================================
     * @return void     */
    private function editColors():void
    {
        if(!empty($this->dataForm['SendEditColor'])){
            unset($this->dataForm['SendEditColor']);
            $editColors = new \Adms\Models\AdmsEditColor();
            $editColors->updateColors($this->dataForm);
            if($editColors->getResult()){
                $urlRedirect = URLADM . "view-color/index/".$this->dataForm['id_color'];
                header("Location: $urlRedirect");
            }else{
                $this->data['form'] = $this->dataForm;
                $this->viewEditColors();
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 072! Cor não encontrado!</p>";
            $urlRedirect = URLADM . "list-color/index";
            header("Location: $urlRedirect");
        }
    }
}