<?php
namespace Adms\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
class NewUser
{
    /** Apartir do PHP 8, posso definir a TIPAGEM de varios tipos para o mesmo atributo, usando o PIPE|
     * @var array|string|null - Define que o atributo:$data pode receber(da view) os dados(parametros) de diversos tipos, q devem ser enviados novamente para serem exibidos pela view */
    private array|string|null $data = [];
    //Recebe os dados do formulario
    private array|null $dataForm;
    /** ===================================================================================
    * Método GENÉRICO q instancia a classe:ConfigView() para carregar a View da pagina, 
     * e enviar os dados para a view, através do método:loadView()
     * Quando o usuário clicar no botão cadastrar do formulário da view novo usuário. Acessa o IF e instancia a classe:AdmsNewUser responsável em cadastrar o usuário no DB.
     * Usuário cadastrado com sucesso, redireciona para a página de login, senão, instância a classe responsável em carregar a View e enviar os dados para view.  - @return void */
    public function index(): void
    {
        // echo "adms/Controller/NewUser.php: <h1> Página(controller) Novo usuário</h1>";

        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (!empty($this->dataForm['SendNewUser'])) {
            // var_dump($this->dataForm);
            unset($this->dataForm['SendNewUser']);
            $createNewUser = new \Adms\Models\AdmsNewUser();
            $createNewUser->create($this->dataForm);
            //Verifica ee o resultado da QUERY é TRUE, se for faz o redirecionamento para:URLADM
            if($createNewUser->getResult()){
                $urlRedirect = URLADM;
                header("Location: $urlRedirect");
            }else{
                // Se o resultado for FALSE, cria uma nova posição dentro do array $dataForm e mantém os dados no formulário
                $this->data['form'] = $this->dataForm;
                $this->viewNewUser();
            }
        }else{
            $this->viewNewUser();
        }
        // $this->data = null;
    }

    
    private function viewNewUser():void
    {
        //Instancio a classe:ConfigView() e crio o objeto:$loadView
        $loadView = new \AdmsSrc\ConfigViewAdms("adms/Views/login/newUser", $this->data);
        //Instancia o método:loadView() da classe:ConfigView
        $loadView->loadViewLoginAdms();
    }
}
