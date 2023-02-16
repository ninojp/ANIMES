<?php
namespace Adms\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
class Logout
{

    /** ===================================================================================
     * Método para destruir os dados da sessão do usuario logado - @return void */
    public function index():void
    {
        //destrui os dados do usuario
        unset($_SESSION['id_user'], $_SESSION['adm_user'], $_SESSION['adm_email'], $_SESSION['adm_img'], $_SESSION['id_access_level']);

        $_SESSION['msg'] = "<p class='alert alert-success'>Logout realizado com sucesso</p>";
        $urlRedirect = URLADM."login/index";
        header("Location: $urlRedirect"); 
    }
}