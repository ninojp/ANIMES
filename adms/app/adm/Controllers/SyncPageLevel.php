<?php
namespace Adm\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
class SyncPageLevel
{
    /** ===================================================================================
     * Método que instancia a classe responsavel em sincronizar o nivel de acesso e as paginas
     * @return void */
    public function index():void
    {
        
        $syncPageLevel = new \Adm\Models\AdmSyncPageLevel();
        $syncPageLevel->SyncPageLevel();
        
        $urlRedirect = URLADM."list-access-level/index";
        header("Location: $urlRedirect");
    }
}