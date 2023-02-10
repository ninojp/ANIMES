<?php
namespace Adm\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe:AdmsNewUser, é filha(Herda) da classe:AdmsConn(abstrata responsável pela conexão) */
class AdmNewUser
{
    //recebido como parametro através do método:create() e colocado neste atributo
    private array|null $data;

    /** @var array|null - Recebe os registros do banco de dados    */
    private array|null $resultBd;
    
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result;

    /** @var string - Recebe o e-mail do remetente    */
    private string $fromEmail;

    /** @var string - Recebe o primeiro nome(digitado) do usuário    */
    private string $firstName;

    /** @var string - Recebe a URL com o endereço para o usuário confirmar o e-mail   */
    private string $url;

    /** @var array - Recebe os dados do conteúdo do e-mail     */
    private array $emailData;

    /** ============================================================================================
     * Recebe o resultado da query e atribui para o atributo:$this->result, Retorna true quando executado com sucesso e false quando houver erro  -  @return void     */
    function getResult()
    {
        return $this->result;
    }
    /** ==========================================================================================
     * Este método recebe os PARAMETROS:$data e depois atribui para o atributo:$this->data
     * Recebe os valores do fomulário.   -  @param array|null $data
     * Instância o Helper:AdmsValEmptyField para verificar se todos os campos foram preenchidos
     * Instância o método:valInput para validar os dados dos campos. 
     * Retorna false quando algun campo está vazio  -  @return void    */
    public function create(array $data = null)
    {
        //atribui o parametro:$data para o atributo:$this->data
        $this->data = $data;
        // var_dump($this->data);
        //instancia a classe:AdmsValEmptyField e cria o objeto:$valEmptyField
        $valEmptyField = new \Adm\Models\helper\AdmValEmptyField();
        //usa o objeto:$valEmptyField para instanciar o método:valField() para validar os dados dentro do atributo:$this->data
        $valEmptyField->valField($this->data);
        //verifica se o método:getResult() retorna true, se sim significa q deu tudo certo se não aprensenta o Erro
        if ($valEmptyField->getResult()) {
            $this->valInput();
        } else {
            $this->result = false;
        }
    }
    /** ============================================================================================
     * Instânciar o Helper:AdmsValEmail para verificar se o e-mail é válido
     * Instânciar o Helper:AdmsValEmailSingle para verificar se o e-mail não está cadastrado no DB, não permitido cadastro com e-mail duplicado.
     * Instânciar o Helper:validatePassword para validar a senha
     * Instânciar o Helper:validateUserSingleLogin para verificar se o usuário não está cadastrado no DB, não permitido cadastro duplicado
     * Instânciar o Método:add quando não houver nenhum erro de preenchimento
     * Retorna flase quando houver algun erro  -  @return void  */
    private function valInput(): void
    {
        //instancia a classe para Validar o email
        $valEmail = new \Adm\Models\helper\AdmValEmail();
        $valEmail->validateEmail($this->data['adm_email']);

        //instancia a classe para Validar se o email já existe no banco de dados
        $valEmailSingle = new \Adm\Models\helper\AdmValEmailSingle();
        $valEmailSingle->validateEmailSingle($this->data['adm_email']);

        //instancia a classe para Validar a senha
        $valPassword = new \Adm\Models\helper\AdmValPassword();
        $valPassword->validatePassword($this->data['adm_pass']);

        //instancia a classe para validadr se o usuário já existe no DB
        $valUserSingleLogin = new \Adm\Models\helper\AdmValUserSingleLogin();
        //no caso o parametro é EMAIL, pois foi utilizado para cadastrar o NOME do USER
        $valUserSingleLogin->validateUserSingleLogin($this->data['adm_email']);

        if (($valEmail->getResult()) and ($valEmailSingle->getResult()) and ($valPassword->getResult()) and ($valUserSingleLogin->getResult())) {
            $this->add();
        } else {
            $this->result = false;
        }
    }
    /** ===========================================================================================
     * Cadastrar usuário no DB  - @return void
     * Retorna true quando cadastrar com sucesso e false quando não cadastrar   */
    private function add(): void
    {
        // Verifica através do método:accessLevel(), o nivel de acesso e a situação do usuário na tabela:adms_levels_forms, que deve ser cadastrada para o novo usuário
        // if($this->accessLevel()){

            // Criptografar a senha
            $this->data['adm_pass'] = password_hash($this->data['adm_pass'], PASSWORD_DEFAULT);
            // $this->data['user'] = $this->data['email'];
            $this->data['confirm_email'] = password_hash($this->data['adm_pass'].date("Y-m-d H:i:s"), PASSWORD_DEFAULT);
            
            $this->data['id_adms_access_level'] = "3";

            $this->data['created'] = date("Y-m-d H:i:s");
            // var_dump($this->data);

            $createUser = new \Adm\Models\helper\AdmCreate();
            $createUser->exeCreate("adms_user", $this->data);

            //verifica se existe o ultimo ID inserido
            if ($createUser->getResult()) {
                $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Usuário cadastrado com sucesso</p>";
                $this->result = true;

                $this->sendEmail();
            } else {
                $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Não foi possível cadastrar o usuário</p>";
                $this->result = false;
            }
        // } else {
        //     $_SESSION['msg'] = "<p class='alert alert-warning'>Erro (accessLevel())! Não foi possível cadastrar o usuário</p>";
        //     $this->result = false;
        // }
    }
    /** -------------------------------------------------------------------------------------------
     * Pesquisar no banco de dados o nivel de acesso e a situação que deve ser utilizada no formulário cadastrar usuário na pagina de login
     * @return bool - verdadeiro ou false    */
    // private function accessLevel(): bool
    // {
    //     $viewAccessLevel = new \Adm\Models\helper\AdmRead();
    //     $viewAccessLevel->fullRead("SELECT adms_access_level_id, adms_sits_user_id FROM adms_levels_forms ORDER BY id ASC LIMIT :limit", "limit=1");
    //     $this->resultBd = $viewAccessLevel->getResult();
    //     // var_dump($this->resultBd);
    //     if($this->resultBd){
    //         //ERRO MEU... na tabela adms_users DEVERIA ser:adms_access_level_id eu colquei:access_level_id
    //         $this->data['access_level_id'] = $this->resultBd[0]['adms_access_level_id'];
    //         $this->data['adms_sits_user_id'] = $this->resultBd[0]['adms_sits_user_id'];
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
    /** =============================================================================================
     * Médoto responsável por enviar o e-mail    -  @return void     */
    private function sendEmail(): void
    {
        $this->contentEmailHtml();
        $this->contentEmailText();
        
        $sendEmail = new \Adm\Models\helper\AdmSendEmail();
        // o ID do e-mail q será usado, está sendo colocado manualmente aqui 1
        $sendEmail->sendEmail($this->emailData, 1);

        //faz a notificação se conseguiu ou não enviar o email
        if($sendEmail->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Usuário cadastrado com sucesso, acesse sua caixa de e-mail para confirmar o e-mail!</p>";
            $this->result = true;
        }else{
            //instancia o método:getFromEmail(), para receber o email de quem está enviando
            $this->fromEmail = $sendEmail->getFromEmail();
            $_SESSION['msg'] = "<p class='alert alert-warning'>Usuário cadastrado com sucesso. Mas houve um erro ao enviar o e-mail de confirmação, entre em contado com {$this->fromEmail}</p>";
            $this->result = true;
        }
    }
    /** ============================================================================================
     * Método para criação do conteúdo HTML do e-mail
     * @return void     */
    private function contentEmailHtml():void
    {
        $name = explode(" ", $this->data['adm_user']);
        $this->firstName = $name[0];

        $this->emailData['toEmail'] = $this->data['adm_email'];
        $this->emailData['toName'] = $this->data['adm_user'];
        $this->emailData['subject'] = "Confirme seu E-mail!";
        $this->url = URLADM."conf-email/index?key=".$this->data['confirm_email'];

        $this->emailData['contentHtml'] = "Prezado Sr(a) {$this->firstName}.<br><br>";
        $this->emailData['contentHtml'] .= "Agradecemos sua solicitação de cadastro em nosso site!.<br><br>";
        $this->emailData['contentHtml'] .= "Para que possamos liberar seu cadastro em nosso sistema, solicitamos a confirmação do e-mail clicando no link abaixo:<br><br>";
        $this->emailData['contentHtml'] .= "<a href='{$this->url}'>{$this->url}</a><br><br>";
        $this->emailData['contentHtml'] .= "Esta menssagem foi enviado a você pela empresa XXX.<br>Você nunca recebera nenhum e-mail solicitando qualquer informações cadastrais...<br><br>";
    }
    /** ============================================================================================
     * Método para criação do conteúdo TXT do e-mail
     * @return void     */
    private function contentEmailText():void
    {
        $this->emailData['contentText'] = "Prezado Sr(a) {$this->firstName}.\n\n";
        $this->emailData['contentText'] .= "Agradecemos sua solicitação de cadastro em nosso site!\n\n";
        $this->emailData['contentText'] .= "Para que possamos liberar seu cadastro em nosso sistema, solicitamos a confirmação do e-mail. COPIE e COLE o endereço abaixo, na barra de endereço do seu navegador de internet.\n\n";
        $this->emailData['contentText'] .= $this->url."\n\n ";
        $this->emailData['contentText'] .= "Esta menssagem foi enviado a você pela empresa XXX.\n Você nunca recebera nenhum e-mail solicitando qualquer informações cadastrais...\n\n";
    }
}
