<?php
namespace Adms\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe da controller para apagar uma situação */
class DeleteSitsUsers
{
    /** @var integer|string|null - Recebe o ID(da situação) do registro    */
    private int|string|null $id_sits_user;

    /** ===================================================================================
     * 
     * @return void */
    public function index(int|string|null $id_sits_user = null): void
    {
        if (!empty($id_sits_user)) {
            $this->id_sits_user = (int) $id_sits_user;
            // var_dump($this->id);
            $deleteUser = new \Adms\Models\AdmsDeleteSitsUsers();
            $deleteUser->deleteSitsUsers($this->id_sits_user);
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 129! Necessário selecionar uma Situação !</p>";
        }
        $urlRedirect = URLADM."list-sits-users/index";
        header("Location: $urlRedirect"); 
    }
}
