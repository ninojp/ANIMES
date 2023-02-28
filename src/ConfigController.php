<?php
namespace Src;
if(!defined('$2y!10#OaHjLtR20hiD23TKNv(0$2)TkYur)$23$(zF')){ header("Location: https://localhost/animes/"); }
/** Recebe a URL e manipula - Carregar a CONTROLLER
 * @author NinoJP <meu.sem@gmail.com> - 07/02/2023 
 * DOCUMENTAÇÃO - Manual
 * https://www.php-fig.org/psr/
 * https://github.com/php-fig/fig-standards/blob/master/proposed/phpdoc.md
 * https://github.com/php-fig/fig-standards/blob/master/proposed/phpdoc-tags.md */
class ConfigController extends Config
{
    /** @var string $url Recebe a URL do .htaccess */
    private string $url;
    /** @var array $urlArray Recebe a URL convertida para array */
    private array $urlArray;
    /** @var string $urlController Recebe da URL o nome da controller */
    private string $urlController;
    /** @var string $urlMetodo Recebe da URL o nome do método */
    private string $urlMetodo;
    /** @var string $urlParamentro Recebe da URL o parâmetro */
    private string $urlParameter;
    /** @var string $classLoad Controller que deve ser carregada */
    private string $classLoad;
    /** @var array $format Recebe o array de caracteres especiais que devem ser substituido */
    private array $format;
    /** @var string $urlSlugController Recebe o controller tratada */
    private string $urlSlugController;
    /** @var string $urlSlugMetodo Recebe o metodo tratado */
    private string $urlSlugMetodo;

    /** =============================================================================================
     * Este método se autoexecuta quando a classe é instanciada 
     * Recebe a URL do .HTACCESS - Validar a URL */
    public function __construct()
    {
        //instanicia o método:configAdm() da classe pai:Config
        $this->config();
        // Verifica se esta recebendo algo na URL
        if (!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))) {
            $this->url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);
            var_dump($this->url);
            //instancia o método:clearUrl() para executar(automaticamente), junto com este método
            $this->clearUrl();
            // Se receber, divide a string:url em três partes e cria um array:$urlArray
            $this->urlArray = explode("/", $this->url);
            // var_dump($this->urlArray);
            // 1 parte, é a controller:$urlController
            if(isset($this->urlArray[0])){
                $this->urlController = $this->slugController($this->urlArray[0]);
            }else{
                $this->urlController = $this->slugController(CONTROLLER);
            }
            // 2 parte, é o método:$urlMetodo
            if(isset($this->urlArray[1])){
                $this->urlMetodo = $this->slugMetodo($this->urlArray[1]);
            }else{
                $this->urlMetodo = $this->slugMetodo(METODO);
            }
            // 3 parte, é um parametro/valor(ira receber um id por exemplo):$urlParameter
            if(isset($this->urlArray[2])){
                $this->urlParameter = $this->urlArray[2];
            }else{
                $this->urlParameter = "";
            }
        }else{
            // Se não receber valores na URL, então use o padrão a seguir, nesta ordem
            $this->urlController = $this->slugController(CONTROLLERERRO);
            $this->urlMetodo = $this->slugMetodo(METODO);
            $this->urlParameter = "";
        }
        // echo "Controller: {$this->urlController}<br>";
        // echo "Método: {$this->urlMetodo}<br>";
        // echo "Parametro: {$this->urlParameter}<br>";
    }
    /** =========================================================================================
     * Método privado para fazer a limpeza da URL
     * @return void */
    private function clearUrl():void
    {
        // Eliminar as tags
        $this->url = strip_tags($this->url);
        // Eliminar os espaços em branco
        $this->url = trim($this->url);
        // Eliminar a barra no final da url
        $this->url = rtrim($this->url, "/");
        //Eliminar os caracteres especiais(faz a substituição) 
        $this->format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]?;:.,\\\'<>°ºª ';
        $this->format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr-------------------------------------------------------------------------------------------------';
        $this->url = strtr(utf8_decode($this->url), utf8_decode($this->format['a']),$this->format['b']);
    }
    /** =========================================================================================
     * Faz o tratamento da url para um formato aceito como nome de classe
     * @return string - @param [string] $slugController */
    private function slugController(string $slugController):string
    {
        $this->urlSlugController = $slugController;
        //Converter tudo para minusculo
        $this->urlSlugController = strtolower($this->urlSlugController);
        //Converter o traço para o espaço em branco
        $this->urlSlugController = str_replace("-"," ",$this->urlSlugController);
        //Converter a primeira letra de cada palavra para Maiúscula(evitar erro no linux) 
        $this->urlSlugController = ucwords($this->urlSlugController);
        //Retirar o espaço em branco
        $this->urlSlugController = str_replace(" ","",$this->urlSlugController);

        // var_dump($this->urlSlugController);
        return $this->urlSlugController;
    }
    /** ==========================================================================================
     * Faz o tratamento da url para um formato aceito como nome de MÉTODO
     * @return string - instanciar o método que trata a controller */
    private function slugMetodo(string $urlSlugMetodo):string
    {
        //faz todo o tratamento com o Método:slugController() e depois atribui para: $urlSlugMetodo
        $this->urlSlugMetodo = $this->slugController($urlSlugMetodo);
        //Converter a primeira letra da frase em Minúsculo
        $this->urlSlugMetodo = lcfirst($this->urlSlugMetodo);
        // var_dump($this->urlSlugMetodo);
        return $this->urlSlugMetodo;
    }
    /** ============================================================================================
     * Método responsável pelo controle de carregamento das views
     * @return void - instanciar as classes da controller e carreagr o método */
    public function loadPage():void
    {

        echo "Carregou até aqui!";
        $loadPgAdm = new \Src\LoadPageLevel();
        $loadPgAdm->loadPage($this->urlController, $this->urlMetodo, $this->urlParameter);

        // Teste...
        // $loadPgAdm = new \AdmsSrc\CarregarPgAdm();
        // $loadPgAdm->loadPage($this->urlController, $this->urlMetodo, $this->urlParameter);
        
    }

}
