<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
class AdmsAddSitsUsers
{
    private array|string|null $data;

    private bool $result;

    private array $resultListCor;

    /** ============================================================================================
     * Recebe o resultado da query e atribui para o atributo:$this->result, Retorna true quando executado com sucesso e false quando houver erro  -  @return void     */
    function getResult():bool
    {
        return $this->result;
    }
    public function createAddSitsUsers(array $data=null)
    {
        //recebe os PARAMETROS:$data e depois atribui para o atributo:$this->data
        $this->data = $data;
        // var_dump($this->data);
        //instancia a classe:AdmsValEmptyField e cria o objeto:$valEmptyField
        $valAddStitsUsers = new \Adms\Models\helper\AdmsValEmptyField();
        $valAddStitsUsers->valField($this->data);
        //verifica, se o objeto:$valAddStitsUsers ainda está com true
        if($valAddStitsUsers->getResult()){
            //se sim, continua e instância o método:valInputSits()
            $this->valInputSits();
        } else {
            //se não, atribui false, para este método:createAddSitsUsers(), através do getResult()
            $this->result = false;
        }
    }
    /** ===========================================================================================
     * @return void     */
    private function valInputSits():void
    {
        //validação de nome unico, para não haver outro com mesmo nome
        $valSitsSingle = new \Adms\Models\helper\AdmsValSitsSingle();
        $valSitsSingle->validateSitsSingle($this->data['name_sits_user']);

        if($valSitsSingle->getResult()){
            $this->addSitsUsers();
        } else {
            $this->result = false;
        }
    }
    /** =============================================================================================
     * @return void     */
    private function addSitsUsers():void
    {
        //usa a função:date() para receber a data e hora atual e atribui para o atributo:$this->data na posição:['created']
        $this->data['created'] = date('Y-m-d H:i:s');

        $addSitsUsers = new \Adms\Models\helper\AdmsCreate();
        $addSitsUsers->exeCreate("adms_sits_user", $this->data);
        //Usa o objeto para instânciar o método:getResult(), e verificar, se o método retornou true, adicionou com sucesso
        if($addSitsUsers->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Situação cadastrado com sucesso</p>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-danger'>Erro 123! Situação não cadastrado com sucesso</p>";
            $this->result = false;
        }
    }
    /** ==============================================================================
     * @return array     */
    public function listSelectCor():array
    {
        //instância a classe:AdmsRead() para fazer a consulta
        $listCor = new \Adms\Models\helper\AdmsRead();
        //usa o método:fullRead() para fazer a query
        $listCor->fullRead("SELECT id_color, name_color, color_adms FROM adms_color ORDER BY name_color ASC");
        //recebe o resultado da query e o atribui para um NOVO array:$resultCor['cor']
        $resultCor['cor'] = $listCor->getResult();
        //coloca no atributo:$this->resultListCor
        $this->resultListCor = ['cor' => $resultCor['cor']];
        // var_dump($this->resultListCor);
        return $this->resultListCor;
    }
    
}