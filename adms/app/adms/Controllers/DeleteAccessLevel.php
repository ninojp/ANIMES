<?php
namespace Adms\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe da controller da pagina para apagar o usuário */
class DeleteAccessLevel
{
    /** @var integer|string|null - Recebe o ID(do usuário) do registro    */
    private int|string|null $id_access_level;

    /** ===================================================================================
     * 
     * @return void */
    public function index(int|string|null $id_access_level = null): void
    {
        if (!empty($id_access_level)) {
            $this->id_access_level = (int) $id_access_level;
            // var_dump($this->id);
            $delAccessNivels = new \Adms\Models\AdmsDeleteAccessLevel();
            $delAccessNivels->deleteAccessNivels($this->id_access_level);
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 064! Necessário selecionar um Nivel de Acesso !</p>";
        }
        $urlRedirect = URLADM."list-access-level/index";
        header("Location: $urlRedirect"); 
    }
}
