<?php
namespace Adms\Models\helper;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/**  */
class AdmsValEmptyField
{
    private array|null $data;
    private bool $result;

    /** ============================================================================================
     * Recebe o resultado da query e atribui para o atributo:$this->result
     * @return void     */
    function getResult()
    {
        return $this->result;
    }
    /** ==========================================================================================
     * @param array|null $data
     * @return void    */
    // este método recebe os PARAMETROS:$data e depois atribui para o atributo:$this->data
    public function valField(array $data = null)
    {
        $this->data = $data;
        //verificar se possui alguma TAG, se possuir, retire
        $this->data = array_map('strip_tags', $this->data);
        //retirar os espaços em branco
        $this->data = array_map('trim', $this->data);
        //verificar se veio algun campo vazio do formulario
        if(in_array('', $this->data)){
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 008! É Necessário prencher todos os campos<br>";
            $this->result = false;
        }else{
            $this->result = true;
        }
    }

}
