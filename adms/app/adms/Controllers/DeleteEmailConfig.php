<?php
namespace Adms\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe(controllers) para apagar um E-mail de configuração */
class DeleteEmailConfig
{
    /** @var integer|string|null - Recebe o ID do registro    */
    private int|string|null $id_email_config;

    /** ===================================================================================
     * 
     * @return void */
    public function index(int|string|null $id_email_config = null): void
    {
        if (!empty($id_email_config)) {
            $this->id_email_config = (int) $id_email_config;
            // var_dump($this->id_email_config);
            $deleteEmailConfs = new \Adms\Models\AdmsDeleteEmailConfig();
            $deleteEmailConfs->deleteEmailConfs($this->id_email_config);
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 140! Necessário selecionar um Usuário !</p>";
        }
        $urlRedirect = URLADM."list-email-config/index";
        header("Location: $urlRedirect"); 
    }
}
