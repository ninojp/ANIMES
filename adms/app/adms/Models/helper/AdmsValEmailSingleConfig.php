<?php
namespace Adms\Models\helper;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
class AdmsValEmailSingleConfig
{
    /** @var string - Recebe o email q deve ser validado    */
    private string $email_config;
    /** @var boolean|null - Recebe a informação que é utilizada para verificar se é para validar
     * e-mail para cadastro ou edição     */
    private bool|null $edit;
    /** @var integer|null - Recebe o id do usuário q deve ser ignorado quando estiver validando o email para edição     */
    private int|null $id_email_config;
    /** @var array|null - Recebe os registros do banco de dados    */
    private array|null $resultBd;
    /** @var boolean - Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result;
    
    /** ============================================================================================= 
     * Retorna true quando executtar o processo com sucesso e false quando houver erro
     * @return boolean */
    function getResult():bool
    {
        return $this->result;
    }
    /** =============================================================================================
     * Método para validar se o email é único
     * Recebe o email que deve ser verificado se o mesmo já existe no DB
     * Acessa o IF quando estiver validado o email para o fomulário editar
     * Acessa o ELSE quando estiver validado o email para o formulário cadastrar.
     * Retorna TRUE quando não encontrar outro, nenhum usuário utilizando o e-mail em questão
     * Retorna FALSE quando o e-mail já está sendo utilizado por outro usuário
     * @param string $email - Recebe o email q deve ser validado
     * @param boolean|null|null $edit - Recebe TRUE quando deve validar o e-mail para o formulário editar.
     * @param integer|null|null $id - Recebe o ID do usuário quando deve validar o e-mail para o formulário editar
     * @return void   */
    public function valEmailSingleConfig(string $email_config, bool|null $edit=null, int|null $id_email_config=null):void
    {
        $this->email_config = $email_config; 
        // var_dump($this->email);
        $this->edit = $edit; 
        $this->id_email_config = $id_email_config; 

        $valEmailSingle = new \Adms\Models\helper\AdmsRead();
        if(($this->edit == true) and (!empty($this->id_email_config))){
            $valEmailSingle->fullRead("SELECT id_email_config FROM adms_email_config WHERE email_config =:email AND id_email_config <>:id LIMIT :limit", "email={$this->email_config}&id={$this->id_email_config}&limit=1");
        }else{
            $valEmailSingle->fullRead("SELECT id_email_config FROM adms_email_config WHERE email_config =:email LIMIT :limit", "email={$this->email_config}&limit=1");
        }
        $this->resultBd = $valEmailSingle->getResult();
        // var_dump($this->resultBd);
        if(!$this->resultBd){
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-danger'>Erro 131! Este email já está cadastrado!</p>";
            $this->result = false;
        }
    }

}
