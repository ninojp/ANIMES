<?php
namespace AdmsSrc;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }

/****************************************************************************************************
 * Carregar as páginas da View
 * @author NinoJP <ninocriptocoin@gmail.com> - 07/02/2023
 * Classe:ConfigViewAdms que contém os métodos para carregar as paginas(view) pré definidas no método,
 * E mais a VIEW que estiver recebendo via parametro pelo método:__construct */
class ConfigViewAdms
{
    // Apartir do PHP 8, pode colocar este atributo:$nameView direto dentro do método:__construct()
    // private string $nameView;
    // private array|string|null $data

    /** ==============================================================================================
     * Método:__construct()(roda automaticamente quanto se instacia esta classe)
     * @param string $nameView - Recebe da controller o endereço e nome da view que deve ser carregada
     * @param array|string|null $data - Recebe da controller os DADOS q a view deve receber */
    public function __construct(private string $nameView, private array|string|null $data)
    {
    }
    /** =============================================================================================
     * Método q verifica se existe e carrega(executa) a URL(string) recebida pela comtroller.
     * Não existindo apresenta a menssagem de erro!     * @return void */
    public function loadViewAdms():void
    {
        //verifica se existe o arquivo(indicado pela controller) a ser carregado 
        if(file_exists('app/'.$this->nameView.'.php')){
            // var_dump($this->data);
            //inclui o arquivo head.php com o cabeçalho html para todas as Paginas(Views)
            include 'app/adms/Views/include/head.php';
            //inclui o arquivo com o NAVBAR
            include 'app/adms/Views/include/navbar.php';
            //inclui o arquivo com o MENU SideBar
            include 'app/adms/Views/include/menu.php';
            //se existir, inclui o arquivo(indicado pela controller)
            include 'app/'.$this->nameView.'.php';
            //inclui o arquivo footer.php com o rodapé html para todas as Paginas(Views)
            include 'app/adms/Views/include/footer.php';
        }else{
            //pode-se criar uma tabela com codigos de erros, para uso interno:Erro 501
            die("Erro - 002! Tente Novamente ou entre em contato com: ".EMAILADM);
        }
    }
    /** =============================================================================================
     * Método q verifica se existe e carrega(executa) a View Login, sem o MENU
     * Não existindo apresenta a menssagem de erro!     * @return void */
    public function loadViewLoginAdms():void
    {
        //verifica se existe o arquivo(indicado pela controller) a ser carregado 
        if(file_exists('app/'.$this->nameView.'.php')){
            // var_dump($this->data);
            //inclui o arquivo head.php com o cabeçalho html para todas as Paginas(Views)
            include 'app/adms/Views/include/head_login.php';
            //se existir, inclui o arquivo(indicado pela controller)
            include 'app/'.$this->nameView.'.php';
            //inclui o arquivo footer.php com o rodapé html para todas as Paginas(Views)
            include 'app/adms/Views/include/footer_login.php';
        }else{
            //pode-se criar uma tabela com codigos de erros, para uso interno:Erro 501
            die("Erro - 002.1! Por Favor Tente Novamente ou entre em contato com: ".EMAILADM);
        }
    }
    /** =============================================================================================
     * Método q verifica se existe e carrega(executa) a URL(string) recebida pela comtroller.
     * Não existindo apresenta a menssagem de erro!     * @return void */
    public function loadViewSite():void
    {
        //verifica se existe o arquivo(indicado pela controller) a ser carregado 
        if(file_exists('app/'.$this->nameView.'.php')){
            // var_dump($this->data);
            //inclui o arquivo head.php com o cabeçalho html para todas as Paginas(Views)
            include 'app/adms/Views/include/head.php';
            //inclui o arquivo com o NAVBAR
            include 'app/adms/Views/include/navbar.php';
            //inclui o arquivo com o MENU SideBar
            include 'app/adms/Views/include/menu.php';
            //se existir, inclui o arquivo(indicado pela controller)
            include 'app/'.$this->nameView.'.php';
            //inclui o arquivo footer.php com o rodapé html para todas as Paginas(Views)
            include 'app/adms/Views/include/footer.php';
        }else{
            //pode-se criar uma tabela com codigos de erros, para uso interno:Erro 501
            die("Erro - 002.2! Tente Novamente ou entre em contato com: ".EMAILADM);
        }
    }
}
