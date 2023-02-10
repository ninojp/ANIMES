<?php
namespace Adm\Models\helper;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe genérica para fazer a validação da SENHA via PHP */
class AdmValPassword
{
    /** @var string - $adm_pass: Recebe a senha q dever ser validada */
    private string $adm_pass;
    /** @var boolean - $result: Recebe true quando executar o processo com sucessoe false quando houver erro  */
    private bool $result;

    /** =============================================================================================
     * Retorna true quando executar o processo com sucesso e false quando houver erro
     * @return boolean     */
    function getResult():bool
    {
        return $this->result;
    }
    /** =============================================================================================
     * @param string $adm_pass
     * @return void     */
    public function validatePassword(string $adm_pass):void
    {
        //Atribui o parametro $adm_pass para o atributo:$this->adm_pass, para poder utilizado fora do escopo do método:validateadm_pass(), como atributo pode ser usado em qualquer lugar na classe 
        $this->adm_pass = $adm_pass;

        if(stristr($this->adm_pass, "'")){
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 011! O Caracter (') utilizado na senha, é inválido!</p>";
            $this->result=false;
        }else {
            if(stristr($this->adm_pass, " ")){
                $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 011! Proibido utilizar espaço em branco no campo senha!</p>";
                $this->result=false;
            }else{
                $this->valExtensPassword();
            }
        }
    }
    /** ==============================================================================================
     * @return void     */
    private function valExtensPassword():void
    {
        if(strlen($this->adm_pass) < 6){
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 011! A senha deve ter no minímo 6 caracteres!</p>";
                $this->result=false;
        }else{
            $this->valValuePassword();
        }
    }
    /** ==============================================================================================
     * @return void     */
    private function valValuePassword():void
    {
        if(preg_match('/^(?=.*[0-9])(?=.*[a-zA-Z])[a-zA-Z0-9-@#$%;!*]{6,}$/',$this->adm_pass)){
            $this->result=true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 011! A senha deve ter Letras e números!</p>";
                $this->result=false;
        }
    }

}
