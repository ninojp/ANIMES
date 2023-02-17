<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
use Adms\Models\helper\AdmsConn;
/** Confirmar o cadastro do usuário, alterando a situação no banco de dados */
class AdmsConfirmEmail extends AdmsConn
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
            $viewKeyConfEmail = new \Adms\Models\helper\AdmsRead();
            $viewKeyConfEmail->fullRead("SELECT id_user FROM adms_user WHERE confirm_email=:confirm_email LIMIT  :limit", "confirm_email={$this->key}&limit=1");
            $this->resultBd = $viewKeyConfEmail->getResult();

            if ($this->resultBd) {
                $this->updateSitUser();
            } else {
                $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 014! Necessário confirmar o E-mail, Solicite um novo:<a href='".URLADM."new-confirm-email/index'> link aqui!</a></p>";
                $this->result = false;
                // echo "<p class='alert alert-warning'>Erro! Link Invalido</p>";
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 014! Necessário confirmar o E-mail, Solicite um novo:<a href='".URLADM."new-confirm-email/index'> link aqui!</a></p>";
            $this->result = false;
        }
    }
    /** ============================================================================================
     * @return void     */
    private function updateSitUser(): void
    {
        $this->dataSave['confirm_email'] = null;
        $this->dataSave['id_sits_user'] = 1;
        $this->dataSave['modified'] = date("Y-m-d H:i:s");
        // $conf_email = null;
        // $adms_sits_user_id = 1;

        $upConfEmail = new \Adms\Models\helper\AdmsUpdate();
        $upConfEmail->exeUpdate("adms_user", $this->dataSave, "WHERE id_user=:id_user", "id_user={$this->resultBd[0]['id_user']}");

        if($upConfEmail->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! E-mail Ativado com Sucesso!</p>";
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 014.1! Necessário confirmar o E-mail, Solicite um novo:<a href='".URLADM."new-confirm-email/index'> link aqui!</a></p>";
            $this->result = false;
        }
    }
}
