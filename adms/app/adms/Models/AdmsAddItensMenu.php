<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
class AdmsAddItensMenu
{
    private array|string|null $data;

    private bool $result;

    /** @var array|null - Recebe os campos que devem ser retirados da validação   */
    private array|null $dataExitVal;

    /** ============================================================================================
     * Recebe o resultado da query e atribui para o atributo:$this->result, Retorna true quando executado com sucesso e false quando houver erro  -  @return void     */
    function getResult():bool
    {
        return $this->result;
    }
    /** ============================================================================================
     * @param array|null $data  -    @return void      */
    public function createAddItemMenu(array $data=null)
    {
        //recebe os PARAMETROS:$data e depois atribui para o atributo:$this->data
        $this->data = $data;
        // var_dump($this->data);

        //Remover o item da validação de campo vazio
        $this->dataExitVal['icon_item_menu'] = $this->data['icon_item_menu'];
        unset($this->data['icon_item_menu']);

        //instancia a classe:AdmsValEmptyField e cria o objeto:$valEmptyField
        $valAddItemMenu = new \Adms\Models\helper\AdmsValEmptyField();
        $valAddItemMenu->valField($this->data);
        //verifica, se o objeto:$valAddStitsUsers ainda está com true
        if($valAddItemMenu->getResult()){
            //se sim, continua e instância o método:valInputSits()
            $this->addItemMenu();
        } else {
            //se não, atribui false, para este método:createAddSitsUsers(), através do getResult()
            $this->result = false;
        }
    }
    /** =============================================================================================
     * @return void     */
    private function addItemMenu():void
    {
        //usa a função:date() para receber a data e hora atual e atribui para o atributo:$this->data na posição:['created']
        $this->data['created'] = date('Y-m-d H:i:s');
        //Atribui NOVAMENTE(recupera) o valor q está no atributo:$this->dataExitval['nickname'] e coloca no atributo:$this->data['nickname'] para ser inserido no DB
        $this->data['icon_item_menu'] = $this->dataExitVal['icon_item_menu'];

        $addItemMenu = new \Adms\Models\helper\AdmsCreate();
        $addItemMenu->exeCreate("adms_item_menu", $this->data);
        //Usa o objeto para instânciar o método:getResult(), e verificar, se o método retornou true, adicionou com sucesso
        if($addItemMenu->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Item de Menu cadastrado com sucesso</p>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-danger'>Erro 076!Item de Menu não cadastrado com sucesso</p>";
            $this->result = false;
        }
    }
}