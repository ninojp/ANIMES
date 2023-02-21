<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe(Models):AdmsEditColors, para editar uma Cor no banco de dados */
class AdmsEditPermission
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result = false;

    /** @var array - Recebe os dados do conteúdo do e-mail     */
    private array|null $resultBd;

    /** @var integer|string|null - Recebe o ID do registro    */
    private int|string|null $id_level_page;

    private array|null $data;

    /** ============================================================================================
     * Retorna TRUE se executar o processo com sucesso, FALSE quando houver erro e atribui para o atributo:$this->result    -  @return void     */
    function getResult():bool
    {
        return $this->result;
    }
    /** ==========================================================================================
     * Retorna os detalhes do registro
     * @return void     */
    function getResultBd():array|null
    {
        return $this->resultBd;
    }
    /** ===========================================================================================
     * O Método recebe como parametro o ID que será usado para verificar se tem o registro no DB  */
    public function editPermission(int $id_level_page):void
    {
        $this->id_level_page = $id_level_page;
        // var_dump($this->id);

        $viewPermission = new \Adms\Models\helper\AdmsRead();
        $viewPermission->fullRead("SELECT lev_pag.id_level_page, lev_pag.permission_level_page 
        FROM adms_level_page AS lev_pag INNER JOIN adms_access_level AS lev ON lev.id_access_level=lev_pag.id_access_level LEFT JOIN adms_page AS pag ON pag.id_page=lev_pag.id_page WHERE lev_pag.id_level_page=:id AND lev.order_level >:order_level
        AND (((SELECT permission_level_page FROM adms_level_page WHERE id_page=lev_pag.id_page
        AND id_access_level={$_SESSION['id_access_level']}) = 1) OR (public_page = 1))
        LIMIT :limit", "id={$this->id_level_page}&order_level=".$_SESSION['order_level']."&limit=1");
        $this->resultBd = $viewPermission->getResult();
        var_dump($this->resultBd);
        if($this->resultBd){
            // var_dump($this->resultBd);
            // $this->result = true;
            $this->edit();
        } else {
            $_SESSION['msg'] = "<p class='alert alert-danger'>Erro 053! Necessário selecionar uma página válida!</p>";
            $this->result = false;
        }
    }
    /** ==========================================================================================
     * @return void     */
    private function edit():void
    {
        // var_dump($this->resultBd);
        if($this->resultBd[0]['permission_level_page'] == 1){
            $this->data['permission_level_page'] = 2;
        } else {
            $this->data['permission_level_page'] = 1;
        }
        $this->data['modified'] = date("Y-m-d H:i:s");

        $upPermission = new \Adms\Models\helper\AdmsUpdate();
        $upPermission->exeUpdate("adms_level_page", $this->data, "WHERE id_level_page =:id_level_page", "id_level_page={$this->id_level_page}");
        if($upPermission->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Permissão Editada com sucesso</p>";
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 053.1! Não foi possível Editar a Permissão</p>";
            $this->result = false;
        }
    }

}
