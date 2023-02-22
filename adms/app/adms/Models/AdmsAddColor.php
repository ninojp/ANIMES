<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
// Classe(Models) para verificar se já existe, senão, cadastrar uma nova Cor
class AdmsAddColor
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
    public function createAddColors(array $data=null)
    {
        //recebe os PARAMETROS:$data e depois atribui para o atributo:$this->data
        $this->data = $data;
        var_dump($this->data);
        //instancia a classe:AdmsValEmptyField e cria o objeto:$valEmptyField
        $valAddColors = new \Adms\Models\helper\AdmsValEmptyField();
        $valAddColors->valField($this->data);
        //verifica, se o objeto:$valAddColors ainda está com true
        if($valAddColors->getResult()){
            //se sim, continua e instância o método:valInputSits()

            // $this->valInputColors();
            $this->addColors();

        } else {
            //se não, atribui false, para este método:createAddSitsUsers(), através do getResult()
            $this->result = false;
        }
    }
    /** ===========================================================================================
     * Método para validadar se já existe uma car com o mesmo nome
     * @return void     */
    private function valInputColors():void
    {
        //validação de nome unico, para não haver outro com mesmo nome
        $valColorsSingle = new \Adms\Models\helper\AdmsValColorSingle();
        $valColorsSingle->validateColorsSingle($this->data['name_color']);

        if($valColorsSingle->getResult()){
            $this->addColors();
        } else {
            $this->result = false;
        }
    }
    /** =============================================================================================
     * @return void     */
    private function addColors():void
    {
        //usa a função:date() para receber a data e hora atual e atribui para o atributo:$this->data na posição:['created']
        $this->data['created'] = date('Y-m-d H:i:s');
        var_dump($this->data);

        $addColors = new \Adms\Models\helper\AdmsCreate();
        $addColors->exeCreate("adms_color", $this->data);
        //Usa o objeto para instânciar o método:getResult(), e verificar, se o método retornou true, adicionou com sucesso
        if($addColors->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Cor cadastrada com sucesso</p>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-danger'>Erro 068! Cor não cadastrado com sucesso</p>";
            $this->result = false;
        }
    }
    
}