<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe(Models) para Alterar a ordem do Tipo de pagina */
class AdmsOrderTypesPage

{
    private bool $result;
    private array|null $resultBd;
    private array|null $resultBdPrev;
    private int|string|null $id_type_page;
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
     * Recebe como parametro o id, através do mesmo verifica o nivel de acesso atual:order_type_pg, se for maior, o coloca no atributo:$resultBd para instanciar o método:viewPrevTypePg()
     * @param integer $id -  @return void      */
    public function orderTypesPgs(int $id_type_page): void
    {
        //atribui o id recebido como parametro no atributo:$this->id
        $this->id_type_page = (int) $id_type_page;
        //instância a classe:AdmsRead() e cria o objeto:$atualTypesPgs
        $atualTypesPgs = new \Adms\Models\helper\AdmsRead();
        //usa o objeto para instânciar o método:fullRead(), passando a query desejada
        $atualTypesPgs->fullRead("SELECT id_type_page, order_type_page FROM adms_type_page WHERE id_type_page=:id LIMIT :limit", "id={$this->id_type_page}&limit=1");
        //usa o objeto para instânciar o método:getResult() e atribui o seu valor no atributo:$this->resultBd

        $this->resultBd = $atualTypesPgs->getResult();
        //verifica se atributo:$this->resultBd é true, se for atribui o true para o atributo:$this->result
        if ($this->resultBd) {
            // var_dump($this->resultBd);
            $this->viewPrevOrderTypePg();
            //se o atributo:$this->resultBd é false, atribui a frase na constante:$_SESSION['msg']
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 117! Tipo de Página não encontrada!</p>";
            $this->result = false;
        }
    }
    /** =============================================================================================
     * Método para recuper a Ordem de acesso do nivel  superior(nivel acima do atual)
     * @return void     */
    private function viewPrevOrderTypePg():void
    {
        $prevOrderType = new \Adms\Models\helper\AdmsRead();
        $prevOrderType->fullRead("SELECT id_type_page, order_type_page FROM adms_type_page WHERE order_type_page <:order_type_page ORDER BY order_type_page DESC LIMIT :limit", "order_type_page={$this->resultBd[0]['order_type_page']}&limit=1");

        $this->resultBdPrev = $prevOrderType->getResult();
        if($this->resultBdPrev){
            // var_dump($this->resultBdPrev);
            $this->editMoveDown();
            // $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 117.1! Tipo de página não encontrada!</p>";
            $this->result = false;
        }
    }
    /** =============================================================================================
     * @return void     */
    private function editMoveDown(): void
    {
        $this->data['order_type_page'] = $this->resultBd[0]['order_type_page'];
        $this->data['modified'] = date("Y-m-d H:i:s");
        // var_dump($this->data);

        $moveDown = new \Adms\Models\helper\AdmsUpdate();
        $moveDown->exeUpdate("adms_type_page", $this->data, "WHERE id_type_page=:id", "id={$this->resultBdPrev[0]['id_type_page']}");

        if($moveDown->getResult()){
            $this->result = true;
            $this->editMoveUp();
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 117.2! Ordem do Nivel de Acesso editado com sucesso!</p>";
            $this->result = false;
        }
    }
    /** ============================================================================================
     * @return void     */
    private function editMoveUp():void
    {
        $this->data['order_type_page'] = $this->resultBdPrev[0]['order_type_page'];
        $this->data['modified'] = date("Y-m-d H:i:s");
        // var_dump($this->data);

        $moveUp = new \Adms\Models\helper\AdmsUpdate();
        $moveUp->exeUpdate("adms_type_page", $this->data, "WHERE id_type_page=:id", "id={$this->resultBd[0]['id_type_page']}");

        if($moveUp->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Ordem do tipo de página editado com sucesso!</p>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 117.3! Ordem do tipo de página Não editado com sucesso!</p>";
            $this->result = false;
        }
    }
}
