<?php
namespace Adm\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }

use Adm\Models\helper\AdmConn;
use App\adms\Models\helper\AdmsSendEmail;
/** Solicitar novo link confirmar o e-mail */
class AdmNewConfirmEmail extends AdmConn
{
    //recebido como parametro através do método:create() e colocado neste atributo
    private array|null $data;
    /** @var boolean - Recebe do método:getResult() o valor:(true or false), q será atribuido aqui */
    private bool $result;
    /** @var array - Recebe os dados do conteúdo do e-mail     */
    private array $resultBd;
    /** @var string - Recebe o primeiro nome(digitado) do usuário    */
    private string $firstName;
    /** @var array - Recebe os dados do conteúdo do e-mail     */
    private array $emailData;

    private array $dataSave;

    private string $url;

    private string $fromEmail;

    /** ============================================================================================
     * Recebe o resultado da query e atribui para o atributo:$this->result o valor true ou false
     * @return void     */
    function getResult()
    {
        return $this->result;
    }
    /** ==========================================================================================
     * @param array|null $data
     * @return void    */
    // este método recebe os PARAMETROS:$data e depois atribui para o atributo:$this->data
    public function newConfEmail(array $data = null): void
    {
        $this->data = $data;
        $valEmptyField = new \Adm\Models\helper\AdmValEmptyField();
        $valEmptyField->valField($this->data);
        if($valEmptyField->getResult()){
            $this->valUser();
        }else{
            $this->result = false;
        }
    }
    /** ========================================================================================     * @return void     */
    private function valUser():void
    {
        $newConfEmail = new \Adm\Models\helper\AdmRead();
        $newConfEmail->fullRead("SELECT id_user, adm_user, adm_email, confirm_email FROM adms_user WHERE adm_email=:adm_email LIMIT :limit", "adm_email={$this->data['adm_email']}&limit=1");
        $this->resultBd = $newConfEmail->getResult();
        if ($this->resultBd) {
            $this->valConfEmail();
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 015! E-mail não cadastrado!</p>";
            $this->result = false;
        }
    }
    /** ==========================================================================================
     * @return void     */
    private function valConfEmail(): void
    {
        if ((empty($this->resultBd[0]['confirm_email'])) or ($this->resultBd[0]['confirm_email'] == NULL)) {
            $this->dataSave['confirm_email'] = password_hash(date("Y-m-d H:i:s") . $this->resultBd[0]['id_user'], PASSWORD_DEFAULT);
            $this->dataSave['modified'] = date("Y-m-d H:i:s");
            // $this->dataSave['exemplo2'] = password_hash(date("Y-m-d H:i:s") . $this->resultBd[0]['id'], PASSWORD_DEFAULT);

            $upNewConfEmail = new \Adm\Models\helper\AdmUpdate();
            $upNewConfEmail->exeUpdate("adms_user", $this->dataSave, "WHERE id_user=:id_user", "id_user={$this->resultBd[0]['id_user']}");

            if($upNewConfEmail->getResult()){
                $this->resultBd[0]['confirm_email'] = $this->dataSave['confirm_email'];
                $this->sendEmail();
            } else {
                $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 016! Link não enviado, tente novamente!</p>";
                $this->result = false;
            }

        } else {
            // echo "Possui valor na coluna 'conf_email'<br>";
            $this->sendEmail();
            // $this->result = false;
        }
    }
    /** ===========================================================================================
     * @return void     */
    private function sendEmail(): void
    {
        $sendEmail = new \Adm\Models\helper\AdmSendEmail();
        $this->emailHtml();
        $this->emailText();
        // AQUI está sendo colocado(manualmente) o ID(1) do e-mail, padrão q vai ENVIAR o e-mail
        $sendEmail->sendEmail($this->emailData, 1);
        if ($sendEmail->getResult()) {
            $_SESSION['msg'] = "<p class='alert alert-success'>OK! Novo Link enviado com sucesso, acesse sua caixa de e-mail para confirmar o e-mail!</p>";
            $this->result = true;
        } else {
            //instancia o método:getFromEmail(), para receber o email de quem está enviando
            $this->fromEmail = $sendEmail->getFromEmail();
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 017! Link não enviado,tente novamente ou entre em contado com o e-mail {$this->fromEmail}</p>";
            $this->result = false;
        }
    }
    /** ==========================================================================================
     * @return void     */
    private function emailHtml(): void
    {
        $name = explode(" ", $this->resultBd[0]['adm_user']);
        $this->firstName = $name[0];

        $this->emailData['toEmail'] = $this->data['adm_email'];
        $this->emailData['toName'] = $this->resultBd[0]['adm_user'];
        $this->emailData['subject'] = "Confirme seu E-mail!";
        $this->url = URLADM . "confirm-email/index?key=" . $this->resultBd[0]['confirm_email'];

        $this->emailData['contentHtml'] = "Prezado Sr(a) {$this->firstName}.<br><br>";
        $this->emailData['contentHtml'] .= "Agradecemos sua solicitação de cadastro em nosso site!.<br><br>";
        $this->emailData['contentHtml'] .= "Para que possamos liberar seu cadastro em nosso sistema, solicitamos a confirmação do e-mail clicando no link abaixo:<br><br>";
        $this->emailData['contentHtml'] .= "<a href='{$this->url}'>{$this->url}</a><br><br>";
        $this->emailData['contentHtml'] .= "Esta menssagem foi enviado a você pela empresa XXX.<br>Você nunca recebera nenhum e-mail solicitando qualquer informações cadastrais...<br><br>";
    }
    /** ==========================================================================================
     *
     * @return void     */
    private function emailText(): void
    {
        $this->emailData['contentText'] = "Prezado Sr(a) {$this->firstName}.\n\n";
        $this->emailData['contentText'] .= "Agradecemos sua solicitação de cadastro em nosso site!\n\n";
        $this->emailData['contentText'] .= "Para que possamos liberar seu cadastro em nosso sistema, solicitamos a confirmação do e-mail. COPIE e COLE o endereço abaixo, na barra de endereço do seu navegador de internet.\n\n";
        $this->emailData['contentText'] .= $this->url . "\n\n ";
        $this->emailData['contentText'] .= "Esta menssagem foi enviado a você pela empresa XXX.\n Você nunca recebera nenhum e-mail solicitando qualquer informações cadastrais...\n\n";
    }
}
