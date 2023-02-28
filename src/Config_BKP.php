<?php
namespace Src;
if(!defined('$2y!10#OaHjLtR20hiD23TKNv(0$2)TkYur)$23$(zF')){ header("Location: https://localhost/animes/"); }

/** Classe abstract(ABSTRATA) não pode ser instânciada, somente herdada.
 * Configurações(CONSTANTES) básicas do site ANIME.
 * @author NinoJP <meu.sem@gmail.com> - 01/02/2023 */
abstract class Config
{
    /** ==========================================================================================
     * Método protected(PROTEGIDO) somente pode ser instânciado dentro da classe ou da classe FILHA
     * Possui as constantes com as configurações.
     * Configurações de endereço do projeto.
     * Página principal do projeto.
     * Credenciais de acesso ao banco de dados
     * E-mail do administrador.
     * @return void   */
    protected function config(): void
    {
        // echo "Classe CONFIG! <br>";
        //URL do projeto
        define('URL', 'https://localhost/ANIMES/');
        define('URLADM', 'https://localhost/ANIMES/adms/');
        
        //Página inicial (Principal)
        define('CONTROLLER', 'ListAnimes');
        
        //Página de erro (em caso de erro de carregamento)
        define('CONTROLLERERRO', 'Erro');
        
        // E-mail definido como e-mail administrativo (depois alterar)
        define('EMAILADM', 'ninocriptocoin@gmail.com');

        //Credenciais(Com senha) do banco de dados
        define('HOST', 'localhost');
        define('USER', 'NinoJP');
        define('PASS', '3RtsEpuR21!@');
        define('DBNAME', 'animes');
        define('PORT', 3306);

        //credenciais(Sem senha) do DB
        // define('HOST','localhost');
        // define('USER','root');
        // define('PASS','');
        // define('DBNAME','animes');
        // define('PORT',3306);
    }
}
