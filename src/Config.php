<?php
namespace Src;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ header("Location: https://localhost/animes/"); }

/** Classe abstract(ABSTRATA) não pode ser instânciada, somente herdada.
 * Configurações(CONSTANTES) básicas da PARTE ADMINISTRATVA do site ANIME.
 * @author NinoJP <meu.sem@gmail.com> - 07/02/2023 */
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
    protected function config()
    {
        //URL do projeto
        define('URL','https://localhost/ANIMES/');
        define('URLADM','https://localhost/ANIMES/adms/');

        //Página inicial (Principal)
        define('CONTROLLER','list-animes');

        define('METODO','index');
        //Página de erro (em caso de erro de carregamento)
        define('CONTROLLERERRO','erro-animes');

        // E-mail definido como e-mail administrativo (depois alterar)
        define('EMAILADM', 'meu.sem@gmail.com');

        //credenciais do DB
        define('HOST', 'localhost');
        define('USER', 'NinoJP');
        define('PASS', '3RtsEpuR21!@');
        define('DBNAME', 'animes');
        define('PORT', 3306);

        //credenciais do DB
        // define('HOST','localhost');
        // define('USER','root');
        // define('PASS','');
        // define('DBNAME','animes');
        // define('PORT',3306);

    }
}