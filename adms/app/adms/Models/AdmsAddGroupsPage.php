<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
class AdmsAddGroupsPage
{
    private array|string|null $data;

    private bool $result;

    /** ============================================================================================
     * Recebe o resultado da query e atribui para o atributo:$this->result, Retorna true quando executado com sucesso e false quando houver erro  -  @return void     */
    function getResult():bool
    {
        return $this->result;
    }
    /** ============================================================================================
     * @param array|null $data  -    @return void      */
    public function createAddGroupsPgs(array $data=null)
    {
        //recebe os PARAMETROS:$data e depois atribui para o atributo:$this->data
        $this->data = $data;
        // var_dump($this->data);
        //instancia a classe:AdmsValEmptyField e cria o objeto:$valEmptyField
        $valAddGroupsPgs = new \Adms\Models\helper\AdmsValEmptyField();
        $valAddGroupsPgs->valField($this->data);
        //verifica, se o objeto:$valAddStitsUsers ainda está com true
        if($valAddGroupsPgs->getResult()){
            //se sim, continua e instância o método:valInputSits()
            $this->addGroupsPgs();
        } else {
            //se não, atribui false, para este método:createAddSitsUsers(), através do getResult()
            $this->result = false;
        }
    }
    /** =============================================================================================
     * @return void     */
    private function addGroupsPgs():void
    {
        //usa a função:date() para receber a data e hora atual e atribui para o atributo:$this->data na posição:['created']
        $this->data['created'] = date('Y-m-d H:i:s');

        $addGroupsPgs = new \Adms\Models\helper\AdmsCreate();
        $addGroupsPgs->exeCreate("adms_group_page", $this->data);
        //Usa o objeto para instânciar o método:getResult(), e verificar, se o método retornou true, adicionou com sucesso
        if($addGroupsPgs->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Grupo de Página cadastrado com sucesso</p>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-danger'>Erro 096! Grupo de Página não cadastrado com sucesso</p>";
            $this->result = false;
        }
    }
}