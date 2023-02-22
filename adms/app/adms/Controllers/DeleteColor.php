<?php
namespace Adms\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe(controller) para apagar uma Cor no DB */
class DeleteColor
{
    /** @var integer|string|null - Recebe o ID do registro    */
    private int|string|null $id_color;

    /** ===================================================================================
     * 
     * @return void */
    public function index(int|string|null $id_color = null): void
    {
        if (!empty($id_color)) {
            $this->id_color = (int) $id_color;
            // var_dump($this->id);
            $deleteColors = new \Adms\Models\AdmsDeleteColor();
            $deleteColors->deleteColors($this->id_color);
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 074! Necessário selecionar uma Cor !</p>";
        }
        $urlRedirect = URLADM."list-color/index";
        header("Location: $urlRedirect"); 
    }
}
