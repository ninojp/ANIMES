<?php
namespace Animes\Controllers;
if(!defined('$2y!10#OaHjLtR20hiD23TKNv(0$2)TkYur)$23$(zF')){ header("Location: https://localhost/animes/"); }
/** Classe controller, para gerenciar as informações entre a Views e a Models
 * @author NinoJP <ninocriptocoin@gmail.com> - 03/02/2023 */
class ListAnimes
{
    /** @var array|string|null - Recebe os dados que devem ser enviados para View     */
    private array|string|null $data;

    /** =========================================================================================
     * Undocumented function
     * @return void     */
    public function index()
    {
        

        $loadView = new \Src\ConfigViewAnimes("animes/Views/animes/listAnimes", $this->data);
        $loadView->loadViewAnimes();
    }
}