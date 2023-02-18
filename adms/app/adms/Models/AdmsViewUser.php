<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe:AdmsViewUsers, Visualizar os usuários no banco de dados */
class AdmsViewUser
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result = false;
    
    /** @var array - Recebe os registros do banco de dados    */
    private array|null $resultBd;

    /** @var integer|string|null - Recebe o ID do registro    */
    private int|string|null $id_user;

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
    public function viewUsers(int $id_user):void
    {
        $this->id_user = $id_user;

        $viewUsers = new \Adms\Models\helper\AdmsRead();
        $viewUsers->fullRead("SELECT usr.id_user, usr.adm_user, usr.adm_email, usr.adm_img, usr.id_sits_user, usr.created, usr.modified, sit.name_sits_user, col.name_color, col.color_adms, lev.id_access_level, lev.access_level FROM adms_user AS usr INNER JOIN adms_sits_user AS sit ON sit.id_sits_user=usr.id_sits_user 
        INNER JOIN adms_color AS col ON col.id_color=sit.id_color 
        INNER JOIN adms_access_level AS lev ON lev.id_access_level=usr.id_access_level 
        WHERE usr.id_user=:id_user AND lev.order_level >:order_level LIMIT :limit", "id_user={$this->id_user}&order_level=".$_SESSION['order_level']."&limit=1");

        $this->resultBd = $viewUsers->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 035! Usuário não encontrado!</p>";
            $this->result = false;
        }
    }
}
