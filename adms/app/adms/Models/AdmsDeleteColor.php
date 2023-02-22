<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe:AdmsDeleteSitsUsers, para Apagar uma situação no banco de dados */
class AdmsDeleteColor
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result = false;

    /** @var integer|string|null - Recebe o ID do registro    */
    private int|string|null $id_color;

    /** @var array - Recebe os registros do banco de dados    */
    private array|null $resultBd;

    /** ============================================================================================
     * Retorna TRUE se executar o processo com sucesso, FALSE quando houver erro e atribui para o atributo:$this->result    -  @return void     */
    function getResult():bool
    {
        return $this->result;
    }
    /** ============================================================================================
     *  @return void      */
    public function deleteColors(int $id_color):void
    {
        $this->id_color = (int) $id_color;
        // var_dump($this->id_color);
        if(($this->viewAtualColors()) and ($this->checkStatusUsed())){
            $deleteColor = new \Adms\Models\helper\AdmsDelete();
            $deleteColor->exeDelete("adms_color", "WHERE id_color=:id", "id={$this->id_color}");

            if($deleteColor->getResult()){
                $_SESSION['msg'] = "<p class='alert alert-warning'>OK! Cor APAGADO com sucesso!</p>";
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 073! Cor NÃO APAGADA!!</p>";
                $this->result = false;
            }
        } else {
            $this->result = false;
        }
    }
    /** ============================================================================================
    * @return boolean   */
    private function viewAtualColors():bool
    {
        $viewAtualColors = new \Adms\Models\helper\AdmsRead();
        $viewAtualColors->fullRead("SELECT id_color FROM adms_color WHERE id_color=:id LIMIT :limit", "id={$this->id_color}&limit=1");

        $this->resultBd = $viewAtualColors->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            return true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 073.1! Cor não encontrado!</p>";
            return false;
        }
    }
    /** ==============================================================================================
     * Método para verificar se existe algum usuário utilizando a situação q será apagada
     * @return void     */
    private function checkStatusUsed():bool
    {
        $viewColorUsed = new \Adms\Models\helper\AdmsRead();
        $viewColorUsed->fullRead("SELECT id_sits_user FROM adms_sits_user WHERE id_color =:id_color LIMIT :limit", "id_color={$this->id_color}&limit=1");
        if($viewColorUsed->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 073.2! A Cor não pode ser apagada, pois existe uma Situação há utilizando!</p>";
            return false;
        } else {
            return true;
        }
    }
}
