<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe(Models) para Alterar a ordem do Nivel de acesso */
class AdmsOrderGroupsPage

{
    private bool $result;
    private array|null $resultBd;
    private array|null $resultBdPrev;
    private int|string|null $id_group_page;
    private $data;

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
     * Recebe como parametro o id, através do mesmo verifica o nivel de acesso atual:order_levels, se for maior, o coloca no atributo:$resultBd para instanciar o método:viewPrevAccessNivels()
     * @param integer $id_group_page -  @return void      */
    public function orderGroupsPgs(int $id_group_page): void
    {
        //atribui o id recebido como parametro no atributo:$this->id
        $this->id_group_page = (int) $id_group_page;
        // var_dump($this->id_group_page);
        //instância a classe:AdmsRead() e cria o objeto:$viewSitsUsers
        $atualGroupsPgs = new \Adms\Models\helper\AdmsRead();
        //usa o objeto para instânciar o método:fullRead(), passando a query desejada
        $atualGroupsPgs->fullRead("SELECT id_group_page, order_group_page FROM adms_group_page WHERE id_group_page=:id LIMIT :limit", "id={$this->id_group_page}&limit=1");
        //usa o objeto para instânciar o método:getResult() e atribui o seu valor no atributo:$this->resultBd

        $this->resultBd = $atualGroupsPgs->getResult();
        // var_dump($this->resultBd);
        // die ("AQUI!");
        //verifica se atributo:$this->resultBd é true, se for atribui o true para o atributo:$this->result
        if ($this->resultBd) {
            // var_dump($this->resultBd);
            $this->viewPrevGroupsPgs();
            //se o atributo:$this->resultBd é false, atribui a frase na constante:$_SESSION['msg']
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 101! Grupo de Páginas não encontrada!</p>";
            $this->result = false;
        }
    }
    /** =============================================================================================
     * Método para recuper a Ordem de acesso do nivel  superior(nivel acima do atual)
     * @return void     */
    private function viewPrevGroupsPgs():void
    {
        $prevGroupsPgs = new \Adms\Models\helper\AdmsRead();
        $prevGroupsPgs->fullRead("SELECT id_group_page, order_group_page FROM adms_group_page WHERE order_group_page <:order_group_page ORDER BY order_group_page DESC LIMIT :limit", "order_group_page={$this->resultBd[0]['order_group_page']}&limit=1");

        $this->resultBdPrev = $prevGroupsPgs->getResult();
        if($this->resultBdPrev){
            // var_dump($this->resultBdPrev);
            $this->editMoveDown();
            // $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 101.1! Grupo de páginas não encontrada!</p>";
            $this->result = false;
        }
    }
    /** =============================================================================================
     * @return void     */
    private function editMoveDown(): void
    {
        $this->data['order_group_page'] = $this->resultBd[0]['order_group_page'];
        $this->data['modified'] = date("Y-m-d H:i:s");
        // var_dump($this->data);

        $moveDown = new \Adms\Models\helper\AdmsUpdate();
        $moveDown->exeUpdate("adms_group_page", $this->data, "WHERE id_group_page=:id", "id={$this->resultBdPrev[0]['id_group_page']}");

        if($moveDown->getResult()){
            $this->result = true;
            $this->editMoveUp();
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 101.2! Ordem do Grupos de páginas editado com sucesso!</p>";
            $this->result = false;
        }
    }
    private function editMoveUp():void
    {
        $this->data['order_group_page'] = $this->resultBdPrev[0]['order_group_page'];
        $this->data['modified'] = date("Y-m-d H:i:s");
        // var_dump($this->data);

        $moveUp = new \Adms\Models\helper\AdmsUpdate();
        $moveUp->exeUpdate("adms_group_page", $this->data, "WHERE id_group_page=:id", "id={$this->resultBd[0]['id_group_page']}");

        if($moveUp->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Ordem do Grupo de páginas editado com sucesso!</p>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 103! Ordem do Grupo de páginas Não editado com sucesso!</p>";
            $this->result = false;
        }

    }
}
