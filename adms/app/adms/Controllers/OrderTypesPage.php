<?php
namespace Adms\controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
// Classe(Controllers) para Alterar a ordem do Tipo de pagina
class OrderTypesPage
{
    /**  @var integer|string|null - Recebe como parametro o ID   */
    private int|string|null $id_type_page;

    /** @var integer|string|array|null - Recebe o numero da pagina    */
    private int|string|array|null $pag;

    /** =============================================================================================
     * Alterar a ordem do Tipo de pagina
     * Recebe como parametro o id que será usado na pesquisa das informações no DB e instância a Models:AdmsOrderAccessNivels(), Após editado retorna MSG e redireciona para o listar Niveis 
     * @param integer|string|null|null $id,  @return void     */
    public function index(int|string|null $id_type_page = null):void
    {
        $this->pag = filter_input(INPUT_GET, "pag", FILTER_SANITIZE_NUMBER_INT);

        //verifica se existe um ID, se existir prossegue
        if((!empty($id_type_page) and (!empty($this->pag)))) {
            //define o id como um inteiro o o atribui para o atributo:$this->id
            $this->id_type_page = (int) $id_type_page;
            //Instância a classe:AdmsViewSitsUsers() e cria um objeto:$resultSitsUsers
            $viewOrderTypesPgs = new \Adms\Models\AdmsOrderTypesPage();
            //usa o objeto para instânciar o método:viewSitsUsers(), que faz a consulta com o id 
            $viewOrderTypesPgs->orderTypesPgs($this->id_type_page);
            //usa o objeto para instanciar o método:getResult() e verificar se o mesmo é true
            if($viewOrderTypesPgs->getResult()){
                // se for true, redireciona para o listar niveis e apresenta a MSG
                // var_dump($viewAccessNivels->getResultBd());
                $urlRedirect = URLADM."list-types-page/index/{$this->pag}";
                header("Location: $urlRedirect");
            } else {
                $urlRedirect = URLADM."list-types-page/index/{$this->pag}";
                header("Location: $urlRedirect");
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 118! Tipo de pagina não encontrada!</p>";
            $urlRedirect = URLADM."list-types-page/index";
            header("Location: $urlRedirect");
        }
    }
}