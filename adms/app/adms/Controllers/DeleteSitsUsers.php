<?php
namespace Adm\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe da controller para apagar uma situação */
class DeleteSitsUsers
{
    /** @var integer|string|null - Recebe o ID(da situação) do registro    */
    private int|string|null $id;

    /** ===================================================================================
     * 
     * @return void */
    public function index(int|string|null $id = null): void
    {
        if (!empty($id)) {
            $this->id = (int) $id;
            // var_dump($this->id);
            $deleteUser = new \App\adms\Models\AdmsDeleteSitsUsers();
            $deleteUser->deleteSitsUsers($this->id);
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Necessário selecionar uma Situação !</p>";
        }
        $urlRedirect = URLADM."list-sits-users/index";
        header("Location: $urlRedirect"); 
    }
}
