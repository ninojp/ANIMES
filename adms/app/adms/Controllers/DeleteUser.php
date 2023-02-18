<?php
namespace Adms\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe da controller da pagina para apagar o usuário */
class DeleteUser
{
    /** @var integer|string|null - Recebe o ID(do usuário) do registro    */
    private int|string|null $id_user;

    /** ===================================================================================
     * 
     * @return void */
    public function index(int|string|null $id_user = null): void
    {
        if (!empty($id_user)) {
            $this->id_user = (int) $id_user;
            // var_dump($this->id_user);
            $deleteUser = new \Adms\Models\AdmsDeleteUser();
            $deleteUser->deleteUsers($this->id_user);
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 046! Necessário selecionar um Usuário !</p>";
        }
        $urlRedirect = URLADM."list-user/index";
        header("Location: $urlRedirect"); 
    }
}
