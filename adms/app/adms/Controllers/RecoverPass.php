<?php
namespace Adms\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
class RecoverPass
{
    /** @var array|string|null - Define que o atributo:$data pode receber(da view) os dados(parametros) de diversos tipos, q devem ser enviados novamente para serem exibidos pela view */
    private array|string|null $data = [];

    //Recebe os dados do formulario
    private array|null $dataForm;

    /** ===================================================================================
     * Método para instanciar a classe responsável em carregar a View e enviar os dados para a View.
     * @return void */
    public function index():void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if(!empty($this->dataForm['SendRecoverPass'])){
            unset($this->dataForm['SendRecoverPass']);
            $recoverPass = new \Adms\Models\AdmsRecoverPass();
            $recoverPass->recoverPassword($this->dataForm);

            if($recoverPass->getResult()){
                $urlRedirect = URLADM."login/index";
                header("Location: $urlRedirect");
            }else{
                $this->data['form'] = $this->dataForm;
                $this->viewRecoverPass();
            }
        }else{
            $this->viewRecoverPass();
        }
    }
    /** ======================================================================================== */
    private function viewRecoverPass():void
    {
       $loadView = new \AdmsSrc\ConfigViewAdms("adms/Views/login/recoverPass", $this->data);
       $loadView->loadViewLoginAdms();
    }
}