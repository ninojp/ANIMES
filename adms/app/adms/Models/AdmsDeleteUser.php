<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe:AdmsDeleteUsers, Apagar o usuário no banco de dados */
class AdmsDeleteUser
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result = false;

    /** @var integer|string|null - Recebe o ID do registro    */
    private int|string|null $id_user;

    /** @var array - Recebe os registros do banco de dados    */
    private array|null $resultBd;

    /** @var string - Recebe o endereço para apagar o diretório    */
    private string $delDirectory;

    /** @var string - Recebe o endereço para apagar a imagem    */
    private string $delImg;

    /** ============================================================================================
     * Retorna TRUE se executar o processo com sucesso, FALSE quando houver erro e atribui para o atributo:$this->result    -  @return void     */
    function getResult():bool
    {
        return $this->result;
    }
    /** ============================================================================================
     *  @return void      */
    public function deleteUsers(int $id_user):void
    {
        $this->id_user = (int) $id_user;
        // var_dump($this->id);
        if($this->viewUsers()){
            $deleteUser = new \Adms\Models\helper\AdmsDelete();
            $deleteUser->exeDelete("adms_user", "WHERE id_user=:id_user", "id_user={$this->id_user}");

            if($deleteUser->getResult()){
                $this->deleteImg();
                $_SESSION['msg'] = "<p class='alert alert-danger'>OK! Usuário APAGADO com sucesso!</p>";
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 045! Usuário Não APAGADO com sucesso!!</p>";
                $this->result = false;
            }
        } else {
            $this->result = false;
        }
    }
    /** ============================================================================================
    * @return boolean   */
    private function viewUsers():bool
    {
        $viewUsers = new \Adms\Models\helper\AdmsRead();
        $viewUsers->fullRead("SELECT usr.id_user, usr.adm_img FROM adms_user AS usr INNER JOIN adms_access_level AS lev ON lev.id_access_level=usr.id_access_level WHERE usr.id_user=:id_user AND lev.order_level >:order_level LIMIT :limit", "id_user={$this->id_user}&order_level=".$_SESSION['order_level']."&limit=1");

        $this->resultBd = $viewUsers->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            return true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 045.1! Usuário não encontrado!</p>";
            return false;
        }
    }
    /** ==========================================================================================
     * Método responsável por DELETAR o diretório e a imagem
     * @return void     */
    private function deleteImg():void
    {
        if((!empty($this->resultBd[0]['adm_img'])) or ($this->resultBd[0]['adm_img'] != null)){
            //Atribui o endereço do diretório onde está a imagem, para o atributo:$this->delDirectory
            $this->delDirectory = "app/adms/assets/imgs/users/".$this->resultBd[0]['id_user'];
            //Atribui o endereço do diretório e da imagem, para o atributo:$this->delImg
            $this->delImg = $this->delDirectory."/".$this->resultBd[0]['adm_img'];
            //verifica se existe a imagem, se existir apaga
            if(file_exists($this->delImg)){
                unlink($this->delImg);
            }
            //verifica se existe o diretório, se existir apaga 
            if(file_exists($this->delDirectory)){
                rmdir($this->delDirectory);
            }
        }
    }
}
