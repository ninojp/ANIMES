<?php
namespace Adm\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe(controller):DeletePages, para apagar os dados da pagina */
class DeletePages
{
    /** @var integer|string|null - Recebe o ID do registro    */
    private int|string|null $id;

    /** ===================================================================================
     * 
     * @return void */
    public function index(int|string|null $id = null): void
    {
        if (!empty($id)) {
            $this->id = (int) $id;
            // var_dump($this->id);
            $deletePage = new \App\adms\Models\AdmsDeletePages();
            $deletePage->deletePages($this->id);
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Necessário selecionar uma Página !</p>";
        }
        $urlRedirect = URLADM."list-pages/index";
        header("Location: $urlRedirect"); 
    }
}
