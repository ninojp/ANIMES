<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe:AdmsViewUsers, Visualizar os usuários no banco de dados */
class AdmsViewAccessLevel
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result = false;
    /** @var array - Recebe os registros do banco de dados    */
    private array|null $resultBd;
    /** @var integer|string|null - Recebe o ID do registro    */
    private int|string|null $id_access_level;

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
    /** ========================================================================================
    */
    public function viewAccessNivels(int $id_access_level):void
    {
        $this->id_access_level = $id_access_level;

        $viewAccessNivels = new \Adms\Models\helper\AdmsRead();
        $viewAccessNivels->fullRead("SELECT id_access_level, access_level, order_level, created, modified FROM adms_access_level WHERE id_access_level=:id AND order_level >=:order_level LIMIT :limit", "id={$this->id_access_level}&order_level=".$_SESSION['order_level']."&limit=1");

        $this->resultBd = $viewAccessNivels->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 059! Nivel de acesso não encontrado!</p>";
            $this->result = false;
        }
    }
}
