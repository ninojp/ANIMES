<?php
namespace Adms\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
class Erro
{
    /** Apartir do PHP 8, posso definir a TIPAGEM de varios tipos para o mesmo atributo, usando o PIPE|
     * @var array|string|null - Define que o atributo:$data pode receber(da view) os dados(parametros) de diversos tipos, q devem ser enviados novamente para serem exibidos pela view */
    private array|string|null $data;
    /** ===================================================================================
     * Método GENÉRICO q instancia a classe:ConfigView() para carregar a View da pagina, 
     * e enviar os dados para a view, através do método:loadView() - @return void */
    public function index():void
    {
        // echo "adms/Controller/Erro.php: <h1> Página(controller) de ERRO!</h1>";

        $this->data = "<h1 class='alert alert-danger'>Página não encontrada</h1>";
        // $this->data = [];

        //instancia a classe, cria o objeto e passa o parametro:$this->data
        $loadView = new \AdmsSrc\ConfigViewAdms("adms/Views/erro/erro", $this->data);
        //Instancia o método:loadView() da classe:ConfigView
        $loadView->loadViewLoginAdms();

    }
}