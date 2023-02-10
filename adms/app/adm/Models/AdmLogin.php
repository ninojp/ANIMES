<?php
namespace Adm\Models;
//verifica se está definido a constante(defida na index), se não estiver
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe:AdmConn(Model), Recebe as requisições da controller e faz as consultas no DB */
class AdmLogin
{
    private array|null $data;

    // Atributo q recebe o resultado da query ao DB, table adms_users
    private $resultBd;

    // Recebe true quando executar o processo com sucesso e false quando houver erro
    private $result;

    /** ===========================================================================================
     * Método q atribui ao atributo o valor true ou false 
     * @return void  */
    function getResult()
    {
        return $this->result;
    }
    /** ==========================================================================================
     * @param array|null - recebe os PARAMETROS:$data e depois atribui para o atributo:$this->data
     * @return void 
     * Este método recupera as informações do usuário no banco de dados:$viewUser->fullRead
     * Quando encontrar o usuário no DB, instancia o método:$this->valPassword(), para validadar
     * a senha, retornando true se não encontrar retorna false */
    public function login(array $data=null)
    {
        //atribui o parametro:$data para o atributo:$this->data
        $this->data = $data;
        // var_dump($this->data);
        $viewUser = new \Adm\Models\helper\AdmRead();

        //Retorna somente as colunas indicadas e Faz a verificação:WHERE através do USER OR EMAIL
        $viewUser->fullRead("SELECT usr.id_adm_user, usr.adm_user, usr.adm_email, usr.adm_pass, usr.id_adms_access_level, usr.adm_img, lev.id_adms_access_level FROM adms_user AS usr
        INNER JOIN adms_access_level AS lev ON lev.id_adms_access_level=usr.id_adms_access_level
        WHERE adm_user =:adm_user LIMIT :limit", "adm_user={$this->data['adm_user']}&limit=1");

        $this->resultBd = $viewUser->getResult();
        // var_dump($this->resultBd);
        if($this->resultBd){
            // var_dump($this->resultBd);
            $this->valPassword();
        }else{
            $_SESSION['msg'] = "<p class='alert alert-danger'>Erro 006! Usuário ou a senha incorreta!</p>";
            $this->result = false;
        }        
    }

    /** ===========================================================================================
     * @return void  */
    private function valPassword()
    {   
        //verifica se o password q está no atributo:$data e o mesmo do atributo:$resultDB
        if(password_verify($this->data['adm_pass'], $this->resultBd[0]['adm_pass'])){
        // if($this->data['adm_pass'] == $this->resultBd[0]['adm_pass']){
            // $_SESSION['msg'] = "<p class='alert alert-success'>Login realizado com sucesso</p>";
            //coloca na constante global:$_SESSION os seguintes valores do usuário
            $_SESSION['id_adm_user'] = $this->resultBd[0]['id_adm_user'];
            $_SESSION['adm_user'] = $this->resultBd[0]['adm_user'];
            $_SESSION['adm_email'] = $this->resultBd[0]['adm_email'];
            $_SESSION['adm_img'] = $this->resultBd[0]['adm_img'];
            $_SESSION['id_adms_access_level'] = $this->resultBd[0]['id_adms_access_level'];
            $this->result = true;
            // echo $_SESSION['msg'];
        }else{
            // $_SESSION['msg'] = "<p class='alert alert-danger'>Erro! Senha não incorreta</p>";
            $_SESSION['msg'] = "<p class='alert alert-danger'>Erro 007! Usuário ou Senha incorreta</p>";
            $this->result = false;
            // echo $_SESSION['msg'];
        }
    }

}