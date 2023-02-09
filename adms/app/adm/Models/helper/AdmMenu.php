<?php
namespace Adm\Models\helper;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe genérica para verificar as permissões de acesso ao Menu DropDown lateral sidebar */
class AdmMenu
{
    /** @var array|null - Recebe os registros do banco de dados e retorna para a Controllers  */
    // private array|null $resultBd;
    private string $resultBd;

    /** ===========================================================================================
     * 
     * @return array|null     */
    public function itemMenu()
    // public function itemMenu(): array|bool|null
    {
        echo "HELPER - AdmMenu.php!";
        // $listMenu = new \Adm\Models\helper\AdmRead();
        // $listMenu->fullRead("SELECT lev_pag.id AS id_lev_pag, lev_pag.adms_page_id, lev_pag.dropdown,pag.id AS id_pag, pag.menu_controller, pag.menu_metodo, pag.name_page, pag.icon, itm_men.id AS id_itm_men, itm_men.name AS name_itm_men, itm_men.icon AS icon_itm_men 
        // FROM adms_levels_pages AS lev_pag
        // INNER JOIN adms_items_menus AS itm_men ON itm_men.id=lev_pag.adms_items_menu_id
        // INNER JOIN adms_pages AS pag ON pag.id=lev_pag.adms_page_id
        // WHERE ((lev_pag.adms_access_level_id=:adms_access_level_id)
        // AND (lev_pag.permission=:permission) AND (print_menu = 1)
        // AND (pag.adms_sits_pgs_id=:adms_sits_pgs_id))
        // ORDER BY itm_men.order_item_menu, lev_pag.order_level_page ASC",
        // "adms_access_level_id=".$_SESSION['access_level_id']."&permission=1&adms_sits_pgs_id=1");

        // $this->resultBd = $listMenu->getResult();
        // if($this->resultBd) {
        //     return $this->resultBd;
        // } else {
        //     return false;
        // }
    }
}
