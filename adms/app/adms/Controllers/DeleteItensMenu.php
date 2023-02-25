<?php
namespace Adms\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe da controller da pagina para apagar o usuário */
class DeleteItensMenu
{
    /** @var integer|string|null - Recebe o ID(do usuário) do registro    */
    private int|string|null $id_item_menu;

    /** ===================================================================================
     * 
     * @return void */
    public function index(int|string|null $id_item_menu = null): void
    {
        if (!empty($id_item_menu)) {
            $this->id_item_menu = (int) $id_item_menu;
            // var_dump($this->id);
            $deleteItensMenu = new \Adms\Models\AdmsDeleteItensMenu();
            $deleteItensMenu->deleteItensMenu($this->id_item_menu);
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 082! Necessário selecionar um Item de Menu !</p>";
        }
        $urlRedirect = URLADM."list-itens-menu/index";
        header("Location: $urlRedirect"); 
    }
}
