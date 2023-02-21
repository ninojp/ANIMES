<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe(Models):AdmsEditDropdownMenu, para editar se o item(página) deve ou não ser um Dropdown */
class AdmsEditDropdownMenu
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result = false;

    /** @var array - Recebe os dados do conteúdo do e-mail     */
    private array|null $resultBd;

    /** @var integer|string|null - Recebe o ID do registro    */
    private int|string|null $id_level_page;

    /** @var array|null - Recebe os dados que devem ser slavos no DB     */
    private array|null $data;

    /** ============================================================================================
     * Retorna TRUE se executar o processo com sucesso, FALSE quando houver erro e atribui para o atributo:$this->result    -  @return void     */
    function getResult():bool
    {
        return $this->result;
    }
    /** ============================================================================================
     * Retorna os detalhes do registro
     * @return void     */
    function getResultBd():array|null
    {
        return $this->resultBd;
    }
    /** ===========================================================================================
     * O Método recebe como parametro o ID que será usado para verificar se tem o registro no DB 
     * se o registro for encontrado, instância o método:edit para editar o mesmo */
    public function editDropdownMenu(int $id_level_page):void
    {
        $this->id_level_page = $id_level_page;
        // var_dump($this->id);

        $vieweditPrintMenu = new \Adms\Models\helper\AdmsRead();
        $vieweditPrintMenu->fullRead("SELECT lev_pag.id_level_page, lev_pag.dropdown_menu
        FROM adms_level_page AS lev_pag INNER JOIN adms_access_level AS lev ON lev.id_access_level=lev_pag.id_access_level LEFT JOIN adms_page AS pag ON pag.id_page=lev_pag.id_page WHERE lev_pag.id_level_page=:id AND lev.order_level >=:order_level
        AND (((SELECT permission_level_page FROM adms_level_page WHERE id_page=lev_pag.id_page 
        AND id_access_level={$_SESSION['id_access_level']}) = 1) OR (public_page = 1))
        LIMIT :limit", "id={$this->id_level_page}&order_level=".$_SESSION['order_level']."&limit=1");

        $this->resultBd = $vieweditPrintMenu->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            // $this->result = true;
            $this->edit();
        } else {
            $_SESSION['msg'] = "<p class='alert alert-danger'>Erro 057! Necessário selecionar uma página!</p>";
            $this->result = false;
        }
    }
    /** ===========================================================================================
     * Método para alterar(exibir ou ocultar) o item no menu Dropdown no DB
     * @return void    */
    private function edit():void
    {
        // var_dump($this->resultBd);
        if($this->resultBd[0]['dropdown_menu'] == 1){
            $this->data['dropdown_menu'] = 2;
        } else {
            $this->data['dropdown_menu'] = 1;
        }
        $this->data['modified'] = date("Y-m-d H:i:s");

        $upPrintMenu = new \Adms\Models\helper\AdmsUpdate();
        $upPrintMenu->exeUpdate("adms_level_page", $this->data, "WHERE id_level_page=:id", "id={$this->id_level_page}");
        if($upPrintMenu->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Página DropDown Editada com sucesso</p>";
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 057.1! Não foi possível Editar a Página DropDown</p>";
            $this->result = false;
        }
    }

}
