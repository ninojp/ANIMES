<?php
namespace Animes\Controllers;
if(!defined('$2y!10#OaHjLtR20hiD23TKNv(0$2)TkYur)$23$(zF')){ header("Location: https://localhost/animes/"); }

/** Classe controller, para gerenciar as informações entre a Views e a Models
 * @author NinoJP <ninocriptocoin@gmail.com> - 04/02/2023 */
class Contato
{
    /** @var array|string|null - Recebe os dados que devem ser enviados para View     */
    private array|string|null $data;

    /** =========================================================================================
     * Undocumented function
     * @return void     */
    public function index()
    {
        $this->data = "Controller CONTATO!";

        $loadView = new \Src\ConfigViewAnimes("animes/Views/contato/contato", $this->data);
        $loadView->loadViewAnimes();
    }
}