<?php
namespace Adm\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe:AdmsDashboard, Pagina inicial do sistema administrativo "Dashboard" */
class AdmDashboard
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result = false;
    /** @var array - Recebe os registros do banco de dados    */
    private array|null $resultBd;

    /** ============================================================================================
     * Retorna TRUE se executar o processo com sucesso, FALSE quando houver erro e atribui para o atributo:$this->result    -  @return void     */
    function getResult():bool
    {
        return $this->result;
    }
    /** ============================================================================================
     * Retorna os dados   @return void     */
    function getResultBd():array|null
    {
        return $this->resultBd;
    }
    /** ===========================================================================================
     * Méodo para retornar os dados para o Dashboard
     * Retorna False se houver algun erro    */
    public function countUsers():void
    {
        $countUsers = new \Adm\Models\helper\AdmRead();
        $countUsers->fullRead("SELECT COUNT(id_user) AS qntUsers FROM adms_user");

        $this->resultBd = $countUsers->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            $this->result = true;
        }else{
            // $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Usuário não encontrado!</p>";
            $this->result = false;
        }
    }
}
