<?php
namespace Adms\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe(controller):DeleteTypesPgs para apagar um Tipo de pagina */
class DeleteTypesPage
{
    /** @var integer|string|null - Recebe o ID do registro    */
    private int|string|null $id_type_page;

    /** ===================================================================================
     * 
     * @return void */
    public function index(int|string|null $id_type_page = null): void
    {
        if (!empty($id_type_page)) {
            $this->id_type_page = (int) $id_type_page;
            // var_dump($this->id);
            $deleteSitsUsers = new \Adms\Models\AdmsDeleteTypesPage();
            $deleteSitsUsers->deleteTypePg($this->id_type_page);
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 120! Necessário selecionar um Tipo de pagina!</p>";
        }
        $urlRedirect = URLADM."list-types-page/index";
        header("Location: $urlRedirect"); 
    }
}
