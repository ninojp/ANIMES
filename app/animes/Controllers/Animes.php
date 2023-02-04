<?php
namespace Animes\Controllers;
if(!defined('$2y!10#OaHjLtR20hiD23TKNv(0$2)TkYur)$23$(zF')){ header("Location: https://localhost/animes/"); }
/** Classe controller, para gerenciar as informações entre a Views e a Models
 * @author NinoJP <ninocriptocoin@gmail.com> - 02/02/2023 */
class Animes
{
    /** @var array - Recebe os dados da View     */
    private array $data;

    public function index()
    {
        $this->data = [];

        $loadView = new \Src\ConfigViewAnimes("animes/views/animes/animes.php", $this->data);
        $loadView->loadViewAnimes();
    }
}