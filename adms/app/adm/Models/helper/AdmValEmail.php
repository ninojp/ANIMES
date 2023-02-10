<?php
namespace Adm\Models\helper;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe genérica para fazer a validação de Email */
class AdmValEmail
{
    private string $email;
    private bool $result;

    /** ==============================================================================================
     * @return boolean     */
    function getResult():bool
    {
        return $this->result;
    }
    /** ==============================================================================================
     * @param string $email
     * @return void     */
    function validateEmail(string $email):void
    {
        $this->email = $email;
        if(filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 009! E-mail inválido</p>";
            $this->result = false;
        }
    }

}
