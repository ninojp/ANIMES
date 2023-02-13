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
    private string|array|null $resultBd;

    /** ===========================================================================================
     * 
     * @return array|null     */
    public function itemMenu()
    // public function itemMenu(): array|bool|null
    {
        $listMenu = new \Adm\Models\helper\AdmRead();
        $listMenu->fullRead("SELECT levpg.id_level_page, levpg.id_page, levpg.dropdown_menu, levpg.id_access_level, pag.id_page, pag.menu_controller, pag.menu_metodo, pag.name_page, pag.icon_menu_page, itm_men.id_item_menu, itm_men.name_item_menu, itm_men.icon_item_menu 
        FROM adms_level_page AS levpg
        INNER JOIN adms_item_menu AS itm_men ON itm_men.id_item_menu=levpg.id_item_menu
        INNER JOIN adms_page AS pag ON pag.id_page=levpg.id_page
        WHERE ((levpg.id_access_level =:id_access_level) AND (levpg.permission_level_page =:permission_level_page) AND (levpg.print_menu = 1) AND (pag.id_sits_page =:id_sits_page))
        ORDER BY itm_men.order_item_menu, levpg.order_level_page ASC",
        "id_access_level=".$_SESSION['id_access_level']."&permission_level_page=1&id_sits_page=1");
        // var_dump($listMenu);

        $this->resultBd = $listMenu->getResult();
        // var_dump($this->resultBd);
        if($this->resultBd) {
            return $this->resultBd;
        } else {
            return false;
        }
    }
}
