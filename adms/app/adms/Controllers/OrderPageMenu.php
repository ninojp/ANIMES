<?php
namespace Adms\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
// Classe(Controllers) para Alterar a ordem do Item de menu(sidebar)
class OrderPageMenu
{
    //Recebe o id do registro a ser editado
    private int|string|null $id_level_page;

    //Recebe o level de acesso
    private int|string|null $level;

    //Recebe o numero da página
    private int|string|null $pag;

    /** =============================================================================================
     * Alterar a ordem do Item de menu
     * Recebe como parametro o id que será usado na pesquisa das informações no DB e instância a Models:...(), Após editado retorna MSG e redireciona para o ... 
     * @param integer|string|null|null $id_level_page,  @return void     */
    public function index(int|string|null $id_level_page = null):void
    {
        $this->id_level_page = (int) $id_level_page;
        $this->level = filter_input(INPUT_GET, "level", FILTER_SANITIZE_NUMBER_INT);
        $this->pag = filter_input(INPUT_GET, "pag", FILTER_SANITIZE_NUMBER_INT);

        //verifica se recebeu o ID, nivel de acesso(level) e pagina atual(pag) se recebeu prossegue
        if((!empty($this->id_level_page)) and (!empty($this->level)) and (!empty($this->pag))){
            $editOrderPageMenu = new \Adms\Models\AdmsOrderPageMenu();
            $editOrderPageMenu->orderPageMenu($this->id_level_page);
            // echo "Alterar Permissão";
            $urlRedirect = URLADM."list-permission/index/{$this->pag}?level={$this->level}";
            header("Location: $urlRedirect");
        } else {
            $_SESSION['msg'] = "<p class='alert alert-danger'>Erro 145! Necessário selecionar Item de Menu</p>";
            $urlRedirect = URLADM."list-access-level/index";
            header("Location: $urlRedirect");
        }
    }
}