<?php
namespace Animes\Models;
if(!defined('$2y!10#OaHjLtR20hiD23TKNv(0$2)TkYur)$23$(zF')){ header("Location: https://localhost/animes/"); }
/** Classe Models, Recebe e envia as requisições(Dados) para a Controller
 * @author NinoJP <ninocriptocoin@gmail.com> - 04/02/2023 */
class MdListAnimes
{
    private array $data;

    private object $conn;

    public function index():array
    {
        $this->data = ['title' => 'Topo da Pagina', 'description' => 'Descrição do serviço'];

        $conn = new \Animes\Models\helper\MdConn();
        $this->conn = $conn->connectDb();
        // var_dump($this->conn);

        return $this->data;
    }
}