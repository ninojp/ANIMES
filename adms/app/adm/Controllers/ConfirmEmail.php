<?php
namespace Adm\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** ================================================================================================
 * Controller da pagina de confirmar e-mail  */
class ConfirmEmail
{
    /** @var string|null - Recebe da URL a chave para confirmar o cadastro     */
    private string|null $key;
    /** @var array|string|null - Define que o atributo:$data pode receber(da view) os dados(parametros) de diversos tipos, q devem ser enviados novamente para serem exibidos pela view */
    private array|string|null $data;
    /** ===================================================================================
     * Método GENÉRICO q instancia a classe:ConfigView() para carregar a View da pagina, 
     * e enviar os dados para a view, através do método:loadView() - @return void */
    public function index():void
    {
        $this->key = filter_input(INPUT_GET, "key", FILTER_DEFAULT);
        
        if(!empty($this->key)){
            $this->valKey();
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Necessário confirmar o E-mail, Solicite um novo:<a href='".URLADM."new-confirm-email/index'> link aqui!</a></p>";
            $urlRedirect = URLADM."login/index";
            header("Location: $urlRedirect");
        }
    }
    /** ==========================================================================================
     * @return void   */    
    private function valKey():void
    {
        $confEmail = new \App\adms\Models\AdmsConfEmail();
        $confEmail->confEmail($this->key);
        if($confEmail->getResult()) {
            $urlRedirect = URLADM."login/index";
            header("Location: $urlRedirect");
        }else{
            $urlRedirect = URLADM."login/index";
            header("Location: $urlRedirect");
        }
    }
}