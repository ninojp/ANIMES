<?php
namespace AdmsSit\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** NinoJP - 08/03/2023 */
class EditSeries
{
    private array|string|null $data = [];
    private array|null $dataForm;
    private int|string|null $id_serie;
    /** ================================================================================== */
    public function index(int|string|null $id_serie = null): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        // var_dump($this->dataForm);
        if ((!empty($id_serie)) and (empty($this->dataForm['SendEditSeries']))) {
            $this->id_serie = (int) $id_serie;
            // var_dump($this->id);
            $viewSeries = new \AdmsSit\Models\MdEditSeries();
            $viewSeries->viewSeries($this->id_serie);
            //verifica se a query obteve resultado(true, false)
            if($viewSeries->getResult()){
                //pega o resultado da query q está dentro de:getResultBd() e atribui para o atributo $data com a POSIÇÃO [FORM}
                $this->data['form'] = $viewSeries->getResultBd();
                // var_dump($this->data['form']);
                $this->loadViewEditSeries();
            } else {
                $urlRedirect = URL."list-animes/index";
                header("Location: $urlRedirect");
            }
        } else {
            $this->loadEditSeries();
        }
    }
    /** =============================================================================================
     * Instânciar a classe responsável em carregar a view e enviar os dados para a view
     * @return void     */
    private function loadViewEditSeries(): void
    {
        $listSelect = new \AdmsSit\Models\MdEditSeries();
        $this->data['select'] = $listSelect->listSelect();
        // var_dump($this->data);

        // ----------- Exibir ou ocultar botões conforme o nivel de acesso -------------------
        // $button = ['list_user' => ['menu_controller' => 'list-user', 'menu_metodo' => 'index'], 
        // 'view_user' => ['menu_controller' => 'view-user', 'menu_metodo' => 'index'],
        // 'edit_user_pass' => ['menu_controller' => 'edit-user-pass', 'menu_metodo' => 'index'],
        // 'edit_user_image' => ['menu_controller' => 'edit-user-image', 'menu_metodo' => 'index'],
        // 'delete_user' => ['menu_controller' => 'delete-user', 'menu_metodo' => 'index']];
        // $listButton = new \Adms\Models\helper\AdmsButton();
        // $this->data['button'] = $listButton->buttonPermission($button);

        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \Adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();


        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "edit-series";
        
        //Instancio a classe:ConfigView() e crio o objeto:$loadView
        $loadView = new \AdmsSrc\ConfigViewAdms("site/views/series/editSeries", $this->data);
        //Instancia o método:loadView() da classe:ConfigView
        $loadView->loadViewAdms();
    }
    /** =============================================================================================
     * @return void     */
    private function loadEditSeries():void
    {
        if(!empty($this->dataForm['SendEditSeries'])){
            unset($this->dataForm['SendEditSeries']);
            $loadEditSeries = new \AdmsSit\Models\MdEditSeries();
            $loadEditSeries->editSeries($this->dataForm);
            if($loadEditSeries->getResult()){
                $urlRedirect = URLADM."edit-series/index/".$this->dataForm['id_serie'];
                header("Location: $urlRedirect");
                $_SESSION['msg'] = "<p class='alert alert-success'>Série EDITADA com Sucesso!</p>";
            }else{
                $this->data['form'] = $this->dataForm;
                $this->loadViewEditSeries();
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 156! Registro não encontrado!</p>";
            $urlRedirect = URL."list-animes/index";
            header("Location: $urlRedirect");
        }
    }
}
