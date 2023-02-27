<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe:AdmsViewUsers, Visualizar os usuários no banco de dados */
class AdmsViewEmailConfig
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result = false;
    /** @var array - Recebe os registros do banco de dados    */
    private array|null $resultBd;
    /** @var integer|string|null - Recebe o ID do registro    */
    private int|string|null $id_email_config;

    /** ============================================================================================
     * Retorna TRUE se executar o processo com sucesso, FALSE quando houver erro e atribui para o atributo:$this->result    -  @return void     */
    function getResult():bool
    {
        return $this->result;
    }
    /** ============================================================================================
     * Retorna os detalhes do registro
     * @return void     */
    function getResultBd():array|null
    {
        return $this->resultBd;
    }
    /** ============================================================================================
    */
    public function ViewEmailConfs(int $id_email_config):void
    {
        $this->id_email_config = $id_email_config;

        $ViewEmailConfs = new \Adms\Models\helper\AdmsRead();
        $ViewEmailConfs->fullRead("SELECT id_email_config, title_email_config, name_email_config, email_config, host_email_config, user_email_config, smtpsecure, port, created, modified FROM adms_email_config WHERE id_email_config=:id LIMIT :limit", "id={$this->id_email_config}&limit=1");

        $this->resultBd = $ViewEmailConfs->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 133! Nenhum registro de E-mail encontrado!</p>";
            $this->result = false;
        }
    }
}
