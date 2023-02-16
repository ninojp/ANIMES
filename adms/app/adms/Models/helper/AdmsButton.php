<?php
namespace Adms\Models\helper;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe genérica para verificar as permissões de acesso a os botões */
class AdmsButton
{
    /** @var array|null - Recebe os registros do banco de dados e retorna para a Models  */
    private array|null $result;

    /** @var array|null - Recebe o array de dados   */
    private array|null $data;

    /** ============================================================================================
     * @return array|null     */
    function getResult(): array|null
    {
        return $this->result;
    }
    /** ===========================================================================================
     * 
     * @return array|null     */
    public function buttonPermission(array|null $data): array|null
    {
        $this->data = $data;
        // var_dump($this->data);

        foreach($this->data as $key => $button){
            // var_dump($key);
            // var_dump($button);
            extract($button);

            $viewButton = new \Adm\Models\helper\AdmRead();
            $viewButton->fullRead("SELECT pag.id_page FROM adms_page AS pag INNER JOIN adms_level_page AS lev_pag ON lev_pag.id_page=pag.id_page WHERE pag.menu_controller=:menu_controller AND pag.menu_metodo =:menu_metodo AND lev_pag.permission_level_page=1 AND lev_pag.id_access_level=:id_access_level LIMIT :limit", "menu_controller=$menu_controller&menu_metodo=$menu_metodo&id_access_level=".$_SESSION['id_access_level']."&limit=1");
            // Verifica se obteve resultado, através do objeto:viewButton
            if($viewButton->getResult()){
                // no array com a respectiva posição recebe true, pode acessar
                $this->result[$key] = true;
            } else {
                $this->result[$key] = false;
            }
        }
        return $this->result;
    }

}
