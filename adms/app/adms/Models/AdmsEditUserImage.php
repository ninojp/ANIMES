<?php
namespace Adms\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe:AdmsViewUsers, Editar a Imagem do usuário no banco de dados */
class AdmsEditUserImage
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result = false;
    /** @var array - Recebe os dados do conteúdo do e-mail     */
    private array|null $resultBd;
    /** @var integer|string|null - Recebe o ID do registro    */
    private int|string|null $id_user;
    /** @var array|null - Recebe as informações do formulário     */
    private array|null $data;
    /** @var array|null - Recebe os dados da imagem   */
    private array|null $dataImagem;
    /** @var string - Recebe o endereço de upload da imagem    */
    private string $directory;
    /** @var string - Recebe o endereço da imagem que deve ser excluida   */
    private string $delImg;
    /** @var string - Recebe o slug/nome da imagem   */
    private string $nameImg;

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
    public function viewUsers(int $id_user):bool
    {
        $this->id_user = $id_user;

        $viewUsers = new \Adms\Models\helper\AdmsRead();
        $viewUsers->fullRead("SELECT usr.id_user, usr.adm_img FROM adms_user AS usr INNER JOIN adms_access_level AS lev ON lev.id_access_level=usr.id_access_level WHERE usr.id_user=:id_user AND lev.order_level >:order_level LIMIT :limit", "id_user={$this->id_user}&order_level=".$_SESSION['order_level']."&limit=1");

        $this->resultBd = $viewUsers->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            $this->result = true;
            return true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 040! Usuário não encontrado!</p>";
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
                $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 040.1! Necessário selecionar uma imagem</p>";
                $this->result = false;
            }
        } else {
            $this->result = false;
        }
    }
    /** ============================================================================================
     * Verificar se existe o usuário com o id recebido
     * Retorna false quando houver algun erro  -  @return void  */
    private function valInput(): void
    {
        $valExtImg = new \Adms\Models\helper\AdmsValExtImg();
        $valExtImg->validateExtImg($this->dataImagem['type']);

        if(($this->viewUsers($this->data['id_user'])) and ($valExtImg->getResult())){
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
        $this->directory = "app/adms/assets/imgs/users/".$this->data['id_user']."/";
        
        // $uploadImg = new \App\adms\Models\helper\AdmsUpload();
        // $uploadImg->upload($this->directory, $this->dataImagem['tmp_name'], $this->nameImg);

        $uploadImgRes = new \Adms\Models\helper\AdmsUploadImgRes();
        $uploadImgRes->upload($this->dataImagem, $this->directory, $this->nameImg, 300, 300);

        if($uploadImgRes->getResult()){
            $this->edit();
        } else {
            $this->result = false;
        }
        
        // // Se Não existir um arquivo ou diretório com este nome:$this->directory
        // if((!file_exists($this->directory)) and (!is_dir($this->directory))){
        //     //Função:mkdir para criar o diretório, com as seguintes PERMISSÕES 0755(o default é 0777)
        //     mkdir($this->directory, 0755);
        // }
        // if(move_uploaded_file($this->dataImagem['tmp_name'], $this->directory . $this->nameImg)){
        //     $this->edit();
        //     // $this->result = false;
        // } else {
        //     $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Upload da imagem não realizado com sucesso!</p>";
        //     $this->result = false;
        // }
    }
    /** =============================================================================================
    * @return void     */
    private function edit():void
    {
        $this->data['adm_img'] = $this->nameImg;
        $this->data['modified'] = date("Y-m-d H:i:s");

        $upUser = new \Adms\Models\helper\AdmsUpdate();
        $upUser->exeUpdate("adms_user", $this->data, "WHERE id_user=:id_user", "id_user={$this->data['id_user']}");
        if($upUser->getResult()){
            $this->deleteImage();
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 040.2! Não foi possível Editar o usuário</p>";
            $this->result = false;
        }
    }
    /** =========================================================================================
     * Substitui a imagem anterior pela imagem atual
     * @return void     */
    private function deleteImage():void
    {
        if(((!empty($this->resultBd[0]['adm_img'])) or ($this->resultBd[0]['adm_img'] != null)) and ($this->resultBd[0]['adm_img'] != $this->nameImg)){
            $this->delImg = "app/adms/assets/imgs/users/".$this->data['id_user']."/".$this->resultBd[0]['adm_img'];
            if(file_exists($this->delImg)){
            unlink($this->delImg);
            }
        }
        $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Imagem Editada com sucesso! </p>";
        $this->result = true;
    }
}
