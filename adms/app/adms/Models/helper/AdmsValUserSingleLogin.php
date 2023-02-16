<?php
namespace Adms\Models\helper;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe genérica para validar o usuário único, somente um cadastro pode utilizar o usuário */
class AdmsValUserSingleLogin
{
    /** @var string - Recebe o usuário q deve ser validado    */
    private string $adm_user;
    /** @var boolean|null - Recebe a informação que é utilizada para verificar se é para validar
     * o usuario para cadastro ou edição     */
    private bool|null $edit;
    /** @var integer|null - Recebe o id do usuário q deve ser ignorado quando estiver validando o usuário para edição     */
    private int|null $id_adm_user;
    /** @var array|null - Recebe os registros do banco de dados    */
    private array|null $resultBd;
    /** @var boolean - Recebe true quando executar o processo com sucesso e false quando houver erro*/
    private bool $result;
    
    /** ============================================================================================ 
     * Retorna true quando executtar o processo com sucesso e false quando houver erro
     * @return boolean */
    function getResult():bool
    {
        return $this->result;
    }
    /** ============================================================================================
     * Método para validar se o usuário já existe no banco de dados
     * @param string $email
     * @param boolean|null|null $edit
     * @param integer|null|null $id_adm_user
     * @return void    */
    public function validateUserSingleLogin(string $adm_user, bool|null $edit=null, int|null $id_adm_user=null):void
    {
        $this->adm_user = $adm_user; 
        // var_dump($this->adm_user);
        $this->edit = $edit; 
        $this->id_adm_user = $id_adm_user; 

        $valUserSingle = new \Adms\Models\helper\AdmsRead();
        if(($this->edit == true) and (!empty($this->id_adm_user))){
            $valUserSingle->fullRead("SELECT id_user FROM adms_user WHERE adm_user =:adm_user id_user <>:id_user LIMIT :limit", "adm_user={$this->adm_user}&id_user={$this->id_adm_user}&limit=1");
        }else{
            $valUserSingle->fullRead("SELECT id_user FROM adms_user WHERE adm_user =:adm_user LIMIT :limit", "adm_user={$this->adm_user}&limit=1");
        }
        $this->resultBd = $valUserSingle->getResult();
        // var_dump($this->resultBd);
        if(!$this->resultBd){
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-danger'>Erro 012! Este Usuário(user) já está cadastrado!</p>";
            $this->result = false;
        }
    }

}
