<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe(Models) para Vizualizar os detalhes do registro Cor*/
class AdmsViewColor
{
    private bool $result = false;
    private array|null $resultBd;
    private int|string|null $id_color;

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
    public function viewColors(int $id_color): void
    {
        //atribui o id recebido como parametro no atributo:$this->id
        $this->id_color = (int) $id_color;
        //instância a classe:AdmsRead() e cria o objeto:$viewSitsUsers
        $viewColors = new \Adms\Models\helper\AdmsRead();
        //usa o objeto para instânciar o método:fullRead(), passando a query desejada
        $viewColors->fullRead("SELECT id_color, name_color, color_adms, created, modified FROM adms_color WHERE id_color=:id LIMIT :limit", "id={$this->id_color}&limit=1");

        //ESTE VAR_DUMP MOSTRA TUDO INCLUSIVE OS DADOS DE CONEXAO COM O DB (SENHA)
        // var_dump($viewSitUser); ME PARECE UMA FALHA DE SEGURANÇA

        //usa o objeto para instânciar o método:getResult() e atribui o seu valor no atributo:$this->resultBd
        $this->resultBd = $viewColors->getResult();
        //verifica se atributo:$this->resultBd é true, se for atribui o true para o atributo:$this->result
        if ($this->resultBd) {
            // var_dump($this->resultBd);
            $this->result = true;
            //se o atributo:$this->resultBd é false, atribui a frase na constante:$_SESSION['msg']
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 069! Cor não encontrada!</p>";
            $this->result = false;
        }
    }
}
