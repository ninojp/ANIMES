<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe(Models) para vizualizar os detalhes da situação atual do usuário  */
class AdmsViewGroupsPage
{
    private bool $result;
    private array|null $resultBd;
    private int|string|null $id_group_page;

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
     * @param integer $id_group_page -  @return void      */
    public function viewGroupsPage(int $id_group_page): void
    {
        //atribui o id recebido como parametro no atributo:$this->id
        $this->id_group_page = $id_group_page;
        //instância a classe:AdmsRead() e cria o objeto:$viewSitsUsers
        $viewGroupsPgs = new \Adms\Models\helper\AdmsRead();
        //usa o objeto para instânciar o método:fullRead(), passando a query desejada
        $viewGroupsPgs->fullRead("SELECT id_group_page, name_group_page, order_group_page, created, modified FROM adms_group_page WHERE id_group_page=:id LIMIT :limit", "id={$this->id_group_page}&limit=1");
        //usa o objeto para instânciar o método:getResult() e atribui o seu valor no atributo:$this->resultBd

        $this->resultBd = $viewGroupsPgs->getResult();
        //verifica se atributo:$this->resultBd é true, se for atribui o true para o atributo:$this->result
        if ($this->resultBd) {
            // var_dump($this->resultBd);
            $this->result = true;
            //se o atributo:$this->resultBd é false, atribui a frase na constante:$_SESSION['msg']
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 094! Grupos de página não encontrada!</p>";
            $this->result = false;
        }
    }
}
