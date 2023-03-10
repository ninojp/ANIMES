<?php
namespace Adms\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
class Login
{
    /** Apartir do PHP 8, posso definir a TIPAGEM de varios tipos para o mesmo atributo, usando o PIPE|
     * @var array|string|null - Define que o atributo:$data pode receber(da view) os dados(parametros) de diversos tipos, q devem ser enviados novamente para serem exibidos pela view */
    private array|string|null $data = [];
    //Recebe os dados do formulario
    private array|null $dataForm;
    /** ===================================================================================
     * Método GENÉRICO q instancia a classe:ConfigView() para carregar a View da pagina, 
     * e enviar os dados para a view, através do método:loadView() - @return void */
    public function index(): void
    {
        // echo "adms/Controller/Login.php: <h1> Página(controller) de Login do ADMS</h1>";

        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (!empty($this->dataForm['SendLogin'])) {
            // var_dump($this->dataForm);
    
            $valLogin = new \Adms\Models\AdmsLogin();
            $valLogin->login($this->dataForm);
            if($valLogin->getResult()){
                $urlRedirect = URLADM."dashboard/index";
                header("Location: $urlRedirect");
                // echo "<h1>OK! Login com sucesso!</h1>";
            }else{
                //cria uma nova posição dentro do array $dataForm,(mantém os dados no formulário)
                $this->data['form'] = $this->dataForm;
            }
        }

        // $this->data = null;
        // Instancio a classe:ConfigView() e crio o objeto:$loadView
        $loadView = new \AdmsSrc\ConfigViewAdms("adms/Views/login/login", $this->data);
        // Instancia o método:loadView() da classe:ConfigView
        $loadView->loadViewLoginAdms();
    }
}
