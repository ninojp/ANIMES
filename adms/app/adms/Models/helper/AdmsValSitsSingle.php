<?php
namespace Adms\Models\helper;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
class AdmsValSitsSingle
{
    /** @var string - Recebe a situação q deve ser validada    */
    private string $name_sits_user;
    /** @var boolean|null - Recebe a informação que é utilizada para verificar se é para validar
     * a situação para cadastro ou edição     */
    private bool|null $edit;
    /** @var integer|null - Recebe o id do usuário q deve ser ignorado quando estiver validando a situação para edição     */
    private int|null $id_sits_user;
    /** @var array|null - Recebe os registros do banco de dados    */
    private array|null $resultBd;
    /** @var boolean - Recebe true quando executar o processo com sucesso e false quando houver erro*/
    private bool $result;
    
    /** ============================================================================================= 
     * Retorna true quando executtar o processo com sucesso e false quando houver erro
     * @return boolean */
    function getResult():bool
    {
        return $this->result;
    }
    /** =============================================================================================
     * Método para validar se a Situação é única
     * Recebe a Situação que deve ser verificado se o mesmo já existe no DB
     * Acessa o IF quando estiver validado a Situação para o fomulário editar
     * Acessa o ELSE quando estiver validado a Situação para o formulário cadastrar.
     * Retorna TRUE quando não encontrar outro, nenhum usuário utilizando o e-mail em questão
     * Retorna FALSE quando o e-mail já está sendo utilizado por outro usuário
     * @param string $sits - Recebe o sits q deve ser validado
     * @param boolean|null|null $edit - Recebe TRUE quando deve validar o e-mail para o formulário editar.
     * @param integer|null|null $id - Recebe o ID do usuário quando deve validar o e-mail para o formulário editar
     * @return void   */
    public function validateSitsSingle(string $name_sits_user, bool|null $edit=null, int|null $id_sits_user=null):void
    {
        $this->name_sits_user = $name_sits_user; 
        // var_dump($this->sits);
        $this->edit = $edit; 
        $this->id_sits_user = $id_sits_user; 

        $valSitsSingle = new \Adms\Models\helper\AdmsRead();
        if(($this->edit == true) and (!empty($this->id_sits_user))){
            $valSitsSingle->fullRead("SELECT id_sits_user FROM adms_sits_user WHERE (name_sits_user =:name_sits_user) AND id_sits_user <>:id LIMIT :limit", "name_sits_user={$this->name_sits_user}&id={$this->id_sits_user}&limit=1");
        }else{
            $valSitsSingle->fullRead("SELECT id_sits_user FROM adms_sits_user WHERE name_sits_user =:name_sits_user LIMIT :limit", "name_sits_user={$this->name_sits_user}&limit=1");
        }
        $this->resultBd = $valSitsSingle->getResult();
        // var_dump($this->resultBd);
        if(!$this->resultBd){
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-danger'>Erro 122! Esta Situação já está cadastrado!</p>";
            $this->result = false;
        }
    }

}
