<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe(Models) para vizualizar os detalhes da situação atual do usuário  */
class AdmsViewSitsUsers
{
    private bool $result;
    private array|null $resultBd;
    private int|string|null $id_sits_user;

    /** ==========================================================================================
     * @return boolean         */
    public function getResult(): bool
    {
        return $this->result;
    }
    /** ==========================================================================================
     * @return array|null         */
    public function getResultBd(): array|null
    {
        return $this->resultBd;
    }
    /** ==========================================================================================
     * @param integer $id -  @return void      */
    public function viewSitsUsers(int $id_sits_user): void
    {
        //atribui o id recebido como parametro no atributo:$this->id
        $this->id_sits_user = $id_sits_user;
        //instância a classe:AdmsRead() e cria o objeto:$viewSitsUsers
        $viewSitUser = new \Adms\Models\helper\AdmsRead();
        //usa o objeto para instânciar o método:fullRead(), passando a query desejada
        $viewSitUser->fullRead("SELECT sits.id_sits_user, sits.name_sits_user, sits.created, sits.modified, col.name_color, col.color_adms FROM adms_sits_user AS sits INNER JOIN adms_color AS col ON col.id_color=sits.id_color WHERE sits.id_sits_user=:id LIMIT :limit", "id={$this->id_sits_user}&limit=1");
        //usa o objeto para instânciar o método:getResult() e atribui o seu valor no atributo:$this->resultBd

        //ESTE VAR_DUMP MOSTRA TUDO INCLUSIVE OS DADOS DE CONEXAO COM O DB (SENHA)
        // var_dump($viewSitUser); ME PARECE UMA FALHA DE SEGURANÇA

        $this->resultBd = $viewSitUser->getResult();
        //verifica se atributo:$this->resultBd é true, se for atribui o true para o atributo:$this->result
        if ($this->resultBd) {
            // var_dump($this->resultBd);
            $this->result = true;
            //se o atributo:$this->resultBd é false, atribui a frase na constante:$_SESSION['msg']
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 124! Situação não encontrada!</p>";
            $this->result = false;
        }
    }
}
