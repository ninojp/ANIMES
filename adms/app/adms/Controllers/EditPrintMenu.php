<?php
namespace Adms\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe(Controlles) para editar o imprimir item de menu */
class EditPrintMenu
{
    //Recebe o id do registro a ser editado
    private int|string|null $id_level_page;

    //Recebe o level de acesso
    private int|string|null $level;

    //Recebe o numero da página
    private int|string|null $pag;

    /** ==========================================================================================
     * Método para editar o imprimir item de menu
     * @param integer|string|null|null $id
     * @return void    */
    public function index(int|string|null $id_level_page=null):void
    {
        $this->id_level_page = $id_level_page;
        $this->level = filter_input(INPUT_GET, "level", FILTER_SANITIZE_NUMBER_INT);
        $this->pag = filter_input(INPUT_GET, "pag", FILTER_SANITIZE_NUMBER_INT);

        if((!empty($this->id_level_page)) and (!empty($this->level)) and (!empty($this->pag))){
            $editPrintMenu = new \Adms\Models\AdmsEditPrintMenu();
            $editPrintMenu->editPrintMenu($this->id_level_page);
            // echo "Alterar Permissão";
            $urlRedirect = URLADM."list-permission/index/{$this->pag}?level={$this->level}";
            header("Location: $urlRedirect");
        } else {
            // echo "Erro: Alterar Permissão";
            $_SESSION['msg'] = "<p class='alert alert-danger'>Erro 056! Necessário selecionar o item de menu</p>";
            $urlRedirect = URLADM."list-access-level/index";
            header("Location: $urlRedirect");
        }
    }
    
}