<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe(Models) para Alterar a ordem do Item de menu */
class AdmsOrderPageMenu
{
    /** @var boolean - Recebe true ou false     */
    private bool $result;

    /** @var array|null - Recebe os registros do DB    */
    private array|null $resultBd;

    /** @var array|null - Rcebe os registros do DB     */
    private array|null $resultBdPrev;

    /** @var integer|string|null - Rcebe o id do registro     */
    private int|string|null $id_level_page;

    /** @var array|null - Recebe as novas posições e as atribui para o array - Eu que criei, na aula o prof não o fez     */
    private array|null $data;

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
     * @param integer $id -  @return void      */
    public function orderPageMenu(int $id_level_page): void
    {
        //atribui o id recebido como parametro no atributo:$this->id
        $this->id_level_page = (int) $id_level_page;
        //instância a classe:AdmsRead() e cria o objeto:$viewSitsUsers
        $viewPageMenu = new \Adms\Models\helper\AdmsRead();
        //usa o objeto para instânciar o método:fullRead(), passando a query desejada
        $viewPageMenu->fullRead("SELECT lev_p.id_level_page, lev_p.order_level_page, lev_p.id_access_level FROM adms_level_page AS lev_p INNER JOIN adms_access_level AS lev ON lev.id_access_level=lev_p.id_access_level LEFT JOIN adms_page AS pag ON pag.id_page=lev_p.id_page
        WHERE lev_p.id_level_page=:id AND lev.order_level >=:order_level
        AND (((SELECT permission_level_page FROM adms_level_page WHERE id_page=lev_p.id_page 
        AND id_access_level={$_SESSION['id_access_level']})=1) OR (public_page=1)) LIMIT :limit",
        "id={$this->id_level_page}&order_level=".$_SESSION['order_level']."&limit=1");
        //usa o objeto para instânciar o método:getResult() e atribui o seu valor no atributo:$this->resultBd

        $this->resultBd = $viewPageMenu->getResult();
        //verifica se atributo:$this->resultBd é true, se for atribui o true para o atributo:$this->result
        if ($this->resultBd) {
            // var_dump($this->resultBd);
            $this->viewPrevPageMenu();
            //se o atributo:$this->resultBd é false, atribui a frase na constante:$_SESSION['msg']
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 144! Item de Menu não encontrada!</p>";
            $this->result = false;
        }
    }
    /** =============================================================================================
     * Método para recuper a Ordem do item de Menu superior(nivel acima do atual)
     * @return void     */
    private function viewPrevPageMenu():void
    {
        $prevPageMenu = new \Adms\Models\helper\AdmsRead();
        $prevPageMenu->fullRead("SELECT lev_p.id_level_page, lev_p.order_level_page
        FROM adms_level_page AS lev_p LEFT JOIN adms_page AS pag ON pag.id_page=lev_p.id_page
        WHERE lev_p.order_level_page <:order_level_page AND lev_p.id_access_level=:id_access_level
        AND (((SELECT permission_level_page FROM adms_level_page WHERE id_page=lev_p.id_page 
        AND id_access_level={$_SESSION['access_level_id']}) = 1) OR (public_page = 1))
        ORDER BY lev_p.order_level_page DESC LIMIT :limit",
        "order_level_page={$this->resultBd[0]['order_level_page']}&id_access_level={$this->resultBd[0]['id_access_level']}&limit=1");

        $this->resultBdPrev = $prevPageMenu->getResult();
        if($this->resultBdPrev){
            // var_dump($this->resultBdPrev);
            $this->editMoveDown();
            // $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 144.1! Item de menu não encontrada!</p>";
            $this->result = false;
        }
    }
    /** ---------------------------------------------------------------------------------------------
     * Método para alterar a ordem do item de menu superior para o inferior
     * @return void     */
    private function editMoveDown(): void
    {
        $this->data['order_level_page'] = $this->resultBd[0]['order_level_page'];
        $this->data['modified'] = date("Y-m-d H:i:s");
        // var_dump($this->data);

        $moveDown = new \Adms\Models\helper\AdmsUpdate();
        $moveDown->exeUpdate("adms_level_page", $this->data, "WHERE id_level_page=:id", "id={$this->resultBdPrev[0]['id_level_page']}");

        if($moveDown->getResult()){
            $this->result = true;
            $this->editMoveUp();
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 144.2! Ordem do Item de Menu não editado com sucesso!</p>";
            $this->result = false;
        }
    }
    /** --------------------------------------------------------------------------------------------
     * Método para alterar a ordem do item de Menu inferior para o superior
     * @return void     */
    private function editMoveUp():void
    {
        $this->data['order_level_page'] = $this->resultBdPrev[0]['order_level_page'];
        $this->data['modified'] = date("Y-m-d H:i:s");
        // var_dump($this->data);

        $moveUp = new \Adms\Models\helper\AdmsUpdate();
        $moveUp->exeUpdate("adms_level_page", $this->data, "WHERE id_level_page=:id", "id={$this->resultBd[0]['id_level_page']}");

        if($moveUp->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Ordem do Item de Menu editado com sucesso!</p>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 144.3! Ordem do Item de Menu Não editado com sucesso!</p>";
            $this->result = false;
        }
    }
}
