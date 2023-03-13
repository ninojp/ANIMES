<?php
namespace AdmsSit\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** NinoJP - 08/03/2023 */
class EditSeriesAdm
{
    private array|string|null $data = [];
    private array|null $dataForm;
    private int|string|null $id_serie;
    /** ================================================================================== */
    public function index(int|string|null $id_serie=null): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if ((!empty($id_serie)) and (empty($this->dataForm['SendEditSeries']))) {
            $this->id_serie = (int) $id_serie;
            $viewSeries = new \AdmsSit\Models\MdEditSeriesAdm();
            $viewSeries->viewSeries($this->id_serie);
           if($viewSeries->getResult()){
                $this->data['form'] = $viewSeries->getResultBd();
                $this->loadViewEditSeries();
            } else {
                $urlRedirect = URLADM."list-animes-adm/index";
                header("Location: $urlRedirect");
            }
        } else {
            $this->loadEditSeries();
        }
    }
    /** ========================================================================================== */
    private function loadViewEditSeries(): void
    {
        $listSelect = new \AdmsSit\Models\MdEditSeriesAdm();
        $this->data['select'] = $listSelect->listSelect();
        
        // ----------- Exibir ou ocultar botões conforme o nivel de acesso -------------------
        $button = ['list_series_adm' => ['menu_controller' => 'list-series-adm', 'menu_metodo' => 'index'],
        'edit_series_down' => ['menu_controller' => 'edit-series-down', 'menu_metodo' => 'index'],
        'edit_series_image' => ['menu_controller' => 'edit-series-image', 'menu_metodo' => 'index'],
        'delete_series' => ['menu_controller' => 'delete-series', 'menu_metodo' => 'index']];
        $listButton = new \Adms\Models\helper\AdmsButton();
        $this->data['button'] = $listButton->buttonPermission($button);
        $listMenu = new \Adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();
        $this->data['sidebarActive'] = "edit-series-adm";
        
        $loadView = new \AdmsSrc\ConfigViewAdms("site/views/series/editSeriesAdm", $this->data);
        $loadView->loadViewSite();
    }
    /** ========================================================================================== */
    private function loadEditSeries():void
    {
        if(!empty($this->dataForm['SendEditSeries'])){
            unset($this->dataForm['SendEditSeries']);
            $loadEditSeries = new \AdmsSit\Models\MdEditSeriesAdm();
            $loadEditSeries->editSeries($this->dataForm);
            if($loadEditSeries->getResult()){
                $urlRedirect = URLADM."edit-series-adm/index/".$this->dataForm['id_serie'];
                header("Location: $urlRedirect");
                $_SESSION['msg'] = "<p class='alert alert-success'>Série EDITADA com Sucesso!</p>";
            }else{
                $this->data['form'] = $this->dataForm;
                $this->loadViewEditSeries();
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 156! Registro não encontrado!</p>";
            $urlRedirect = URLADM."list-animes-adm/index";
            header("Location: $urlRedirect");
        }
    }
}
