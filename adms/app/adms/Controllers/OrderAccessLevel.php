<?php
namespace Adms\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
// Classe(Controllers) para Alterar a ordem do Nivel de acesso
class OrderAccessLevel
{
    /**  @var integer|string|null - Recebe como parametro o ID   */
    private int|string|null $id_access_level;

    /** @var integer|string|array|null - Recebe o numero da pagina    */
    private int|string|array|null $pag;

    /** =============================================================================================
     * Alterar a ordem do Nivel de acesso
     * Recebe como parametro o id_access_level que será usado na pesquisa das informações no DB e instância a Models:AdmsOrderAccessNivels(), Após editado retorna MSG e redireciona para o listar Niveis 
     * @param integer|string|null|null $id_access_level,  @return void     */
    public function index(int|string|null $id_access_level = null):void
    {
        $this->pag = filter_input(INPUT_GET, "pag", FILTER_SANITIZE_NUMBER_INT);

        //verifica se existe um ID, se existir prossegue
        if((!empty($id_access_level) and (!empty($this->pag)))) {
            //define o id como um inteiro o o atribui para o atributo:$this->id
            $this->id_access_level = (int) $id_access_level;
            //Instância a classe:AdmsViewSitsUsers() e cria um objeto:$resultSitsUsers
            $viewAccessNivels = new \Adms\Models\AdmsOrderAccessLevel();
            //usa o objeto para instânciar o método:viewSitsUsers(), que faz a consulta com o id 
            $viewAccessNivels->orderAccessNivels($this->id_access_level);
            //usa o objeto para instanciar o método:getResult() e verificar se o mesmo é true
            if($viewAccessNivels->getResult()){
                // se for true, redireciona para o listar niveis e apresenta a MSG
                // var_dump($viewAccessNivels->getResultBd());
                $urlRedirect = URLADM."list-access-level/index/{$this->pag}";
                header("Location: $urlRedirect");
            } else {
                $urlRedirect = URLADM."list-access-level/index/{$this->pag}";
                header("Location: $urlRedirect");
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 051! Nivel de acesso não encontrada!</p>";
            $urlRedirect = URLADM."list-access-level/index";
            header("Location: $urlRedirect");
        }
    }
}