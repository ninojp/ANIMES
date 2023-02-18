<?php
namespace Adms\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe(controller):DeletePages, para apagar os dados da pagina */
class DeletePage
{
    /** @var integer|string|null - Recebe o ID do registro    */
    private int|string|null $id_page;

    /** ===================================================================================
     * 
     * @return void */
    public function index(int|string|null $id_page = null): void
    {
        if (!empty($id_page)) {
            $this->id_page = (int) $id_page;
            // var_dump($this->id);
            $deletePage = new \Adms\Models\AdmsDeletePage();
            $deletePage->deletePages($this->id_page);
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 047! Necessário selecionar uma Página !</p>";
        }
        $urlRedirect = URLADM."list-page/index";
        header("Location: $urlRedirect"); 
    }
}
