<?php
namespace Adms\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe da controller para apagar uma situação da Página */
class DeleteSitsPage
{
    /** @var integer|string|null - Recebe o ID(da situação) do registro    */
    private int|string|null $id_sits_page;

    /** ===================================================================================
     * 
     * @return void */
    public function index(int|string|null $id_sits_page = null): void
    {
        if (!empty($id_sits_page)) {
            $this->id_sits_page = (int) $id_sits_page;
            // var_dump($this->id);
            $deleteSitsPgs = new \Adms\Models\AdmsDeleteSitsPage();
            $deleteSitsPgs->deleteSitsPgs($this->id_sits_page);
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 110! Necessário selecionar uma Situação da Página!</p>";
        }
        $urlRedirect = URLADM."list-sits-page/index";
        header("Location: $urlRedirect");
    }
}
