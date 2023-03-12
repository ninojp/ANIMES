<?php
namespace AdmsSit\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** NinoJP - 07/03/2023 */
class MdEditSeriesAdm
{
    private bool $result = false;
    private array|null $resultBd;
    private int|string|null $id_serie;
    private array|null $data;
    private array|null $down;
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
        $viewSeries->fullRead("SELECT ser.id_serie, ser.titulo_serie, ser.s_titulo_serie, ser.enredo_serie, ser.exib_inicio, ser.exib_fim, ser.num_ep_serie, ser.dura_ep_serie, ser.trailer, ser.img_mini, ser.anime_id, ser.cat_anime_id, ser.serie_genero_id, ser.down_id FROM serie AS ser INNER JOIN adms_access_level AS lev ON lev.id_access_level=lev.id_access_level WHERE ser.id_serie=:id_serie AND lev.order_level >:order_level LIMIT :limit", "id_serie={$this->id_serie}&order_level=".$_SESSION['order_level']."&limit=1");

        $this->resultBd = $viewSeries->getResult();
        // var_dump($this->resultBd);
        if($this->resultBd){
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 155! Registro não encontrado!</p>";
            $this->result = false;
        }
    }
    /** ========================================================================================== */
    public function editSeries(array $data=null, array $down=null):void
    {
        $this->data = $data;
        $this->down = $down;
        var_dump($this->data);
        var_dump($this->down);
        die ("AQUI! Model");
        $this->data['modified'] = date("Y-m-d H:i:s");
        $updateSerie = new \Adms\Models\helper\AdmsUpdate();
        $updateSerie->exeUpdate("serie", $this->data, "WHERE id_serie=:id_serie", "id_serie={$this->data['id_serie']}");
        $updateSerie->exeUpdate("down", $this->down, "WHERE id_down=:down_id", "down_id={$this->data['down_id']}");

        if($updateSerie->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Registro Editado com sucesso</p>";
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 155.1! Não foi possível Editar o Registro</p>";
            $this->result = false;
        }
    }
    /** ======================================================================================== */
    public function listSelect():array
    {
        $list = new \Adms\Models\helper\AdmsRead();
        $list->fullRead("SELECT id_anime, codnome FROM anime ORDER BY codnome ASC");
        $registry['ani'] = $list->getResult();

        $list->fullRead("SELECT id_cat_anime, cat_anime FROM anime_categoria ORDER BY cat_anime ASC");
        $registry['cat_ani'] = $list->getResult();

        $list->fullRead("SELECT id_down, link_down, link_down_desc, link_online, link_online_desc, link_torrent, link_torrent_desc FROM down ");
        $registry['down'] = $list->getResult();

        $this->listRegistryAdd = ['ani' => $registry['ani'], 'cat_ani' => $registry['cat_ani'], 'down' => $registry['down']];
        // var_dump($this->listRegistryAdd);

        return $this->listRegistryAdd;
    }
}
