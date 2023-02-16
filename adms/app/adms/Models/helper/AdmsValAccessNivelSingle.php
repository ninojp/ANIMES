<?php
namespace Adms\Models\helper;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe genérica para validar o usuário único, somente um cadastro pode utilizar o usuário */
class AdmsValAccessNivelSingle
{
    /** @var string - Recebe o usuário q deve ser validado    */
    private string $access_level;

    /** @var integer|null - Recebe o id do Nivel de Acesso q deve ser ignorado quando estiver validando o usuário para edição     */
    private int|null $id_access_level;

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
     * Método para validar se o Nivel de Acesso já existe no banco de dados
     * @param string $access_level
     * @param integer|null|null $id_access_level
     * @return void    */
    public function validateAccessNivelsSingle(string $access_level, int|null $id_access_level=null):void
    {
        $this->access_level = $access_level; 
        // var_dump($this->user);
        $this->id_access_level = $id_access_level; 

        $valAccessNivelsSingle = new \Adms\Models\helper\AdmsRead();
        if((!empty($this->access_level)) and (!empty($this->id_access_level))){
            $valAccessNivelsSingle->fullRead("SELECT id_access_level, access_level, order_level FROM adms_access_level WHERE access_level =:access_level AND id_access_level <>:id_access_level LIMIT :limit", "access_level={$this->access_level}&id_access_level={$this->id_access_level}&limit=1");
        }else{
            $valAccessNivelsSingle->fullRead("SELECT id_access_level FROM adms_access_level WHERE access_level =:access_level LIMIT :limit", "access_level={$this->access_level}&limit=1");
        }
        $this->resultBd = $valAccessNivelsSingle->getResult();
        // var_dump($this->resultBd);
        if(!$this->resultBd){
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-danger'>Erro 033! Este Nivel de Acesso já está cadastrado!</p>";
            $this->result = false;
        }
    }

}
