<?php
namespace AdmsSrc;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }

/*************************************************************************************************
 * Carregar as páginas da View
 * @author NinoJP <ninocriptocoin@gmail.com> - 07/02/2023 */
class ConfigViewAdms
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
    public function loadViewAdms(): void
    {
        if (file_exists('app/' . $this->nameView . '.php')) {
            include 'app/adm/Views/include/head.php';
            // include 'app/animes/Views/include/navbar.php';
            include 'app/'.$this->nameView.'.php';
            // include 'app/animes/Views/include/sidebar.php';
            include 'app/adm/Views/include/footer.php';
        } else {
            die("Erro 002! Por favor tente novamente. Caso o problema persista, entre em contato o administrador ".EMAILADM);
        }
    }
      /** =============================================================================================
     * Método q verifica se existe e carrega(executa) a View Login, sem o MENU
     * Não existindo apresenta a menssagem de erro!     * @return void */
    public function loadViewAdmsLogin():void
    {
        //verifica se existe o arquivo(indicado pela controller) a ser carregado 
        if(file_exists('app/'.$this->nameView.'.php')){
            // var_dump($this->data);
            //inclui o arquivo head.php com o cabeçalho html para todas as Paginas(Views)
            include 'app/adm/Views/include/head_login.php';
            //se existir, inclui o arquivo(indicado pela controller)
            include 'app/'.$this->nameView.'.php';
            //inclui o arquivo footer.php com o rodapé html para todas as Paginas(Views)
            include 'app/adm/Views/include/footer_login.php';
        }else{
            //pode-se criar uma tabela com codigos de erros, para uso interno:Erro 501
            die("Erro - 004! Por Favor Tente Novamente ou entre em contato com: ".EMAILADM);
        }
    }
}
