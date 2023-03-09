<?php
namespace AdmsSit\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** NinoJP - 07/03/2023 */
class MdEditSeries
{
    private bool $result = false;
    private array|null $resultBd;
    private int|string|null $id_serie;
    private array|null $data;
    private array $listRegistryAdd;

    /** ========================================================================================= */
    function getResult():bool
    {
        return $this->result;
    }
    /** ========================================================================================== */
    function getResultBd():array|null
    {
        return $this->resultBd;
    }
    /** ========================================================================================== */
    public function viewSeries(int $id_serie):void
    {
        $this->id_serie = $id_serie;
        $viewSeries = new \Adms\Models\helper\AdmsRead();
        $viewSeries->fullRead("SELECT ser.id_serie, ser.titulo_serie, ser.s_titulo_serie, ser.enredo_serie, ser.exib_inicio, ser.exib_fim, ser.num_ep_serie, ser.dura_ep_serie, ser.trailer, ser.anime_id, ser.cat_anime_id, ser.genero_id, ser.down_id, ser.online_id
        FROM serie AS ser INNER JOIN adms_access_level AS lev ON lev.id_access_level=ser.id_access_level INNER JOIN down ON id_down=ser.down_id WHERE ser.id_serie=:id_serie AND lev.order_level >:order_level LIMIT :limit", "id_serie={$this->id_serie}&order_level=".$_SESSION['order_level']."&limit=1");

        $this->resultBd = $viewSeries->getResult();
        if($this->resultBd){
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 155! Registro não encontrado!</p>";
            $this->result = false;
        }
    }
    /** ========================================================================================== */
    // public function update(array $data = null):void
    // {
    //     $this->data = $data;
    //     $valEmptyField = new \Adms\Models\helper\AdmsValEmptyField();
    //     $valEmptyField->valField($this->data);
    //     if ($valEmptyField->getResult()) {
    //         $this->valInput();
    //     } else {
    //         $this->result = false;
    //     }
    // }
    /** ========================================================================================== */
    // private function valInput(): void
    // {
    //     $valEmail = new \Adms\Models\helper\AdmsValEmail();
    //     $valEmail->validateEmail($this->data['adm_email']);
    //     $valEmailSingle = new \Adms\Models\helper\AdmsValEmailSingle();
    //     $valEmailSingle->validateEmailSingle($this->data['adm_email'], true, $this->data['id_serie']);
    //     $valUserSingle = new \Adms\Models\helper\AdmsValUserSingle();
    //     $valUserSingle->validateUserSingle($this->data['adm_user'], true, $this->data['id_serie']);
    //     if (($valEmail->getResult()) and ($valEmailSingle->getResult()) and ($valUserSingle->getResult())) {
    //         $this->edit();
    //     } else {
    //         $this->result = false;
    //     }
    // }
    /** =============================================================================================
     * @return void     */
    public function editSeries(array $data = null):void
    {
        $this->data = $data;
        $this->data['modified'] = date("Y-m-d H:i:s");
        $upUser = new \Adms\Models\helper\AdmsUpdate();
        $upUser->exeUpdate("serie", $this->data, "WHERE id_serie=:id_serie", "id_serie={$this->data['id_serie']}");
        if($upUser->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Registro Editado com sucesso</p>";
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 155.1! Não foi possível Editar o usuário</p>";
            $this->result = false;
        }
    }
    /** ===========================================================================================
     * @return array     */
    public function listSelect():array
    {
        $list = new \Adms\Models\helper\AdmsRead();
        $list->fullRead("SELECT id_anime, codnome FROM anime ORDER BY codnome ASC");
        $registry['ani'] = $list->getResult();

        $list->fullRead("SELECT id_cat_anime, cat_anime FROM anime_categoria ORDER BY cat_anime ASC");
        $registry['cat_ani'] = $list->getResult();

        $this->listRegistryAdd = ['ani' => $registry['ani'], 'cat_ani' => $registry['cat_ani']];
        // var_dump($this->listRegistryAdd);

        return $this->listRegistryAdd;
    }
}
