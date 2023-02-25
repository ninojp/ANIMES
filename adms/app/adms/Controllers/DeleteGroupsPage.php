<?php
namespace Adms\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe da controller da pagina para apagar o usuário */
class DeleteGroupsPage
{
    /** @var integer|string|null - Recebe o ID(do usuário) do registro    */
    private int|string|null $id_group_page;

    /** ===================================================================================
     * 
     * @return void */
    public function index(int|string|null $id_group_page = null): void
    {
        if (!empty($id_group_page)) {
            $this->id_group_page = (int) $id_group_page;
            // var_dump($this->id);
            $deleteGroupsPgs = new \Adms\Models\AdmsDeleteGroupsPage();
            $deleteGroupsPgs->deleteGroupPgs($this->id_group_page);
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 100! Necessário selecionar um Grupo de páginas!</p>";
        }
        $urlRedirect = URLADM."list-groups-page/index";
        header("Location: $urlRedirect"); 
    }
}
