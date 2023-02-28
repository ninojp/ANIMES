<?php
namespace Src;
if(!defined('$2y!10#OaHjLtR20hiD23TKNv(0$2)TkYur)$23$(zF')){ header("Location: https://localhost/animes/"); }

/*************************************************************************************************
 * Carregar as páginas da View
 * @author NinoJP <ninocriptocoin@gmail.com> - 03/02/2023 */
class ConfigViewAnimes
{
    // Apartir do PHP 8, pode colocar este atributo:$nameView direto dentro do método:__construct()
    // private string $nameView;
    // private array|string|null $data

    /** ==========================================================================================
     * Receber o endereço da VIEW e os dados.
     * @param string $nameView Endereço da VIEW que deve ser carregada
     * @param array|string|null $data Dados que a VIEW deve receber.     */
    public function __construct(private string $nameView, private array|string|null $data)
    { 
        // var_dump($this->nameView);      
        // var_dump($this->data);      
    }
    /** ==========================================================================================
     * Carregar a VIEW.
     * Verificar se o arquivo existe, e carregar caso exista, não existindo para o carregamento
    * @return void     */
    public function loadViewAnimes(): void
    {
        if (file_exists('app/' . $this->nameView . '.php')) {
            include 'app/animes/Views/include/head.php';
            include 'app/animes/Views/include/navbar.php';
            include 'app/animes/Views/include/sidebar.php';
            include 'app/'.$this->nameView.'.php';
            include 'app/animes/Views/include/footer.php';
        } else {
            die("Erro 002! Por favor tente novamente. Caso o problema persista, entre em contato o administrador ".EMAILADM);
        }
    }
}
