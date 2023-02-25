<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe:AdmsViewUsers, Editar Imagem do perfil do usuário */
class AdmsEditProfileImage
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result = false;

    /** @var array - Recebe os registros do banco de dados    */
    private array|null $resultBd;

    /** @var array - Recebe os dados da view, como um parametro    */
    private array|null $data;

    /** @var array - ...    */
    private array|null $dataImagem;

    /** @var array|string - ...    */
    private array|string|null $nameImg;

    /** @var array|string - ...    */
    private array|string|null $directory;
    
    /** @var array|string - ...    */
    private array|string|null $delImg;

    /** ============================================================================================
     * Retorna TRUE se executar o processo com sucesso, FALSE quando houver erro e atribui para o atributo:$this->result    -  @return void     */
    function getResult():bool
    {
        return $this->result;
    }
    /** ============================================================================================
     * Retorna os detalhes do registro
     * @return void     */
    function getResultBd():array|null
    {
        return $this->resultBd;
    }
    /** ============================================================================================
    */
    public function viewProfile():bool
    {
        $viewUsers = new \Adms\Models\helper\AdmsRead();
        $viewUsers->fullRead("SELECT id_user, adm_img FROM adms_user WHERE id_user=:id LIMIT :limit", "id=".$_SESSION['id_user']."&limit=1");

        $this->resultBd = $viewUsers->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            $this->result = true;
            return true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 089! Perfil não encontrado!</p>";
            $this->result = false;
            return false;
        }
    }
     /** ===========================================================================================
     * @param array|null $data
     * @return void    */
    public function update(array $data = null):void
    {
        $this->data = $data;
        // var_dump($this->data);

        $this->dataImagem = $this->data['new_image'];
        //destroi estes dados do array
        unset($this->data['new_image']);
        // var_dump($this->data);
        
        // instancia a classe:AdmsValEmptyField e cria o objeto:$valEmptyField
        $valEmptyField = new \Adms\Models\helper\AdmsValEmptyField();
        //usa o objeto:$valEmptyField para instanciar o método:valField() para validar os dados dentro do atributo:$this->data
        $valEmptyField->valField($this->data);
        //verifica se o método:getResult() retorna true, se sim significa q deu tudo certo se não aprensenta o Erro
        if ($valEmptyField->getResult()) {
            if(!empty($this->dataImagem['name'])){
                // $this->result = false;
                $this->valInput();
            } else {
                $_SESSION['msg'] = "<p class='alert alert-warning'>Erro ! Necessário selecionar uma imagem</p>";
                $this->result = false;
            }
        } else {
            $this->result = false;
        }
    }
    /** ============================================================================================
     * Verificar se existe o usuário com o id Logado
     * Retorna false quando houver algun erro  -  @return void  */
    private function valInput(): void
    {
        $valExtImg = new \Adms\Models\helper\AdmsValExtImg();
        $valExtImg->validateExtImg($this->dataImagem['type']);

        if(($this->viewProfile()) and ($valExtImg->getResult())){
            // $this->result = false;
            $this->upload();
        } else {
            $this->result = false;
        }
    }

    /** ===========================================================================================
     * @return void     */
    private function upload()
    {
        //instancia a classe responsável por alterar o NOME da imagem
        $slugImg = new \Adms\Models\helper\AdmsSlug();
        $this->nameImg = $slugImg->slug($this->dataImagem['name']);
        // var_dump($this->nameImg);

        //Diretório onde ficaram as imagens do usuário(criada dinamicamente com o ID do usuário)
        $this->directory = "app/adms/assets/imgs/users/".$_SESSION['id_user']."/";

        $uploadImgRes = new \Adms\Models\helper\AdmsUploadImgRes();
        $uploadImgRes->upload($this->dataImagem, $this->directory, $this->nameImg, 300, 300);

        if($uploadImgRes->getResult()){
            $this->edit();
        } else {
            $this->result = false;
        }
    }
    /** =============================================================================================
    * @return void     */
    private function edit():void
    {
        $this->data['adm_img'] = $this->nameImg;
        $this->data['modified'] = date("Y-m-d H:i:s");

        $upUser = new \Adms\Models\helper\AdmsUpdate();
        $upUser->exeUpdate("adms_user", $this->data, "WHERE id_user=:id", "id=".$_SESSION['id_user']);
        if($upUser->getResult()){
            $_SESSION['adm_img'] = $this->nameImg;
            $this->deleteImage();
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 089.2! Imagem Não Editada com sucesso</p>";
            $this->result = false;
        }
    }
    /** =========================================================================================
     * @return void     */
    private function deleteImage():void
    {
        if(((!empty($this->resultBd[0]['adm_img'])) or ($this->resultBd[0]['adm_img'] != null)) and ($this->resultBd[0]['adm_img'] != $this->nameImg)){
            $this->delImg = "app/adms/assets/imgs/users/".$_SESSION['id_user']."/".$this->resultBd[0]['adm_img'];
            if(file_exists($this->delImg)){
            unlink($this->delImg);
            }
        }
        $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Imagem Editada com sucesso! </p>";
        $this->result = true;
    }
}
