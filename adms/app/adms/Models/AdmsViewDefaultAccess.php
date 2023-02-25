<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe(Models) para Vizualizar os detalhes do registro Cor*/
class AdmsViewDefaultAccess
{
    private bool $result = false;
    private array|null $resultBd;
    // private int|string|null $id;

    /** ==========================================================================================
     * @return boolean         */
    public function getResult(): bool
    {
        return $this->result;
    }
    /** ==========================================================================================
     * @return array|null         */
    public function getResultBd(): array|null
    {
        return $this->resultBd;
    }
    /** ==========================================================================================
     * @param integer $id -  @return void      */
    public function viewLevelsForms(): void
    {
        // echo "Carregou a Models!<br>";
        // $this->result = true;
        // $this->resultBd = [];
        //atribui o id recebido como parametro no atributo:$this->id
        // $this->id = (int) $id;
        //instância a classe:AdmsRead() e cria o objeto:$viewSitsUsers
        $viewLevelsForms = new \Adms\Models\helper\AdmsRead();
        //usa o objeto para instânciar o método:fullRead(), passando a query desejada
        $viewLevelsForms->fullRead("SELECT alf.id_default_access, alf.created, alf.modified, aal.access_level, asu.name_sits_user FROM adms_default_access AS alf 
        INNER JOIN adms_access_level AS aal ON aal.id_access_level=alf.id_access_level
        INNER JOIN adms_sits_user AS asu ON asu.id_sits_user=alf.id_sits_user");
        //usa o objeto para instânciar o método:getResult() e atribui o seu valor no atributo:$this->resultBd

        $this->resultBd = $viewLevelsForms->getResult();
        //verifica se atributo:$this->resultBd é true, se for atribui o true para o atributo:$this->result
        if ($this->resultBd) {
            // var_dump($this->resultBd);
            $this->result = true;
            //se o atributo:$this->resultBd é false, atribui a frase na constante:$_SESSION['msg']
        } else {
            $_SESSION['msg'] = "<p class='alert alert-danger'>Erro 083! Registro:adms_levels_forms, não encontrado!</p>";
            $this->result = false;
        }
    }
}
