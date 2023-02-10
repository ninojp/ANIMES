<?php
namespace Adm\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
use Adm\Models\helper\AdmConn;
use PDO;
/** Confirmar o cadastro do usuário, alterando a situação no banco de dados */
class AdmConfirmEmail extends AdmConn
{
    /** @var string - Recebe da URL a chave para confirmar o cadastro     */
    private string $key;
    /** @var boolean - Recebe do método:getResult() o valor:(true or false), q será atribuido aqui */
    private bool $result;
    /** @var array - Recebe os dados do conteúdo do e-mail     */
    private array $resultBd;

    private array $dataSave;

    /** ============================================================================================
     * Recebe o resultado da query e atribui para o atributo:$this->result o valor true ou false
     * @return void     */
    function getResult():bool
    {
        return $this->result;
    }
    /** ==========================================================================================
     * @param array|null $data
     * @return void    */
    // este método recebe os PARAMETROS:$data e depois atribui para o atributo:$this->data
    public function confEmail(string $key): void
    {
        $this->key = $key;
        // var_dump($this->key);
        if (!empty($this->key)) {
            $viewKeyConfEmail = new \Adm\Models\helper\AdmRead();
            $viewKeyConfEmail->fullRead("SELECT id_adm_user FROM adms_user WHERE confirm_email=:confirm_email LIMIT  :limit", "confirm_email={$this->key}&limit=1");
            $this->resultBd = $viewKeyConfEmail->getResult();

            if ($this->resultBd) {
                $this->updateSitUser();
            } else {
                $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Necessário confirmar o E-mail, Solicite um novo:<a href='".URLADM."new-conf-email/index'> link aqui!</a></p>";
                $this->result = false;
                // echo "<p class='alert alert-warning'>Erro! Link Invalido</p>";
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Necessário confirmar o E-mail, Solicite um novo:<a href='".URLADM."new-conf-email/index'> link aqui!</a></p>";
            $this->result = false;
        }
    }
    /** ==============================================================================================
     * @return void     */
    private function updateSitUser(): void
    {
        $this->dataSave['conf_email'] = null;
        $this->dataSave['adms_sits_user_id'] = 1;
        $this->dataSave['modified'] = date("Y-m-d H:i:s");
        // $conf_email = null;
        // $adms_sits_user_id = 1;

        $upConfEmail = new \App\adms\Models\helper\AdmsUpdate();
        $upConfEmail->exeUpdate("adms_users", $this->dataSave, "WHERE id=:id", "id={$this->resultBd[0]['id']}");

        if($upConfEmail->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! E-mail Ativado com Sucesso!</p>";
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Necessário confirmar o E-mail, Solicite um novo:<a href='".URLADM."new-conf-email/index'> link aqui!</a></p>";
            $this->result = false;
        }
        // $query_ativate_user = "UPDATE adms_users SET conf_email=:conf_email, adms_sits_user_id=:adms_sits_user_id, modified=NOW() WHERE id=:id LIMIT 1";
        // $activate_email = $this->connectDb()->prepare($query_ativate_user);
        // $activate_email->bindParam(':conf_email', $conf_email);
        // $activate_email->bindParam(':adms_sits_user_id', $adms_sits_user_id);
        // $activate_email->bindParam(':id', $this->resultBd[0]['id']);
        // $activate_email->execute();

        // if($activate_email->rowCount()){
        //     $_SESSION['msg'] = "<p class='alert alert-success'>Ok! E-mail Ativado com Sucesso!</p>";
        //     $this->result = true;
        // }else{
        //     $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Link Invalido!!!!</p>";
        //     $this->result = false;
        // }
    }
}
