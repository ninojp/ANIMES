<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe(Models) para vizualizar os detalhes da situação atual do usuário  */
class AdmsViewItensMenu
{
    private bool $result;
    private array|null $resultBd;
    private int|string|null $id_item_menu;

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
    public function viewItensMenu(int $id_item_menu): void
    {
        //atribui o id recebido como parametro no atributo:$this->id
        $this->id_item_menu = $id_item_menu;
        //instância a classe:AdmsRead() e cria o objeto:$viewSitsUsers
        $viewItensMenu = new \Adms\Models\helper\AdmsRead();
        //usa o objeto para instânciar o método:fullRead(), passando a query desejada
        $viewItensMenu->fullRead("SELECT id_item_menu, name_item_menu, icon_item_menu, order_item_menu, created, modified FROM adms_item_menu WHERE id_item_menu=:id LIMIT :limit", "id={$this->id_item_menu}&limit=1");
        //usa o objeto para instânciar o método:getResult() e atribui o seu valor no atributo:$this->resultBd

        $this->resultBd = $viewItensMenu->getResult();
        //verifica se atributo:$this->resultBd é true, se for atribui o true para o atributo:$this->result
        if ($this->resultBd) {
            // var_dump($this->resultBd);
            $this->result = true;
            //se o atributo:$this->resultBd é false, atribui a frase na constante:$_SESSION['msg']
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 079! Item de Menu não encontrada!</p>";
            $this->result = false;
        }
    }
}
