<?php
namespace AdmsSrc;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }

/** Recebe a URL e a manipula. Carregar a CONTROLLER
 * @author NinoJP <ninocriptocoin@gmail.com> - 07/02/2023 */
class ConfigControllerAdms extends ConfigAdms
{
    /** @var string $url Recebe a URL do .htaccess */
    private string $url;

    /** @var array $urlArray Recebe a URL convertida para array */
    private array $urlArray;

    /** @var string $urlController Recebe da URL o nome da controller */
    private string $urlController;

    /** @var string $urlParamentro Recebe da URL o parâmetro */
    /*private string $urlParameter;*/

    /** @var string $urlSlugController     */
    private string $urlSlugController;

    /** @var array $format Recebe o array de caracteres especiais que devem ser substituido */
    private array $format;

    /** @var string $classe Recebe a classe */
    private string $classLoad;

    /** ==========================================================================================
     * O Método __construct, é automaticamente executado quando a classe é instanciada
     * Recebe a URL do .htaccess
     * Validar a URL     */
    public function __construct()
    {
        // echo "(ConfigController)! Carregar esta pagina! <br>";
        $this->configAdms();
        if (!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))) {
            $this->url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);
            // var_dump($this->url);
            $this->clearUrl();

            // Explode para separar(converter), a string em um array com duas posições
            $this->urlArray = explode("/", $this->url);
            // var_dump($this->urlArray);

            if (isset($this->urlArray[0])) {
                // var_dump($this->urlArray[0]);
                $this->urlController = $this->slugController($this->urlArray[0]);
            } else {
                //Caso não seja enviado a pagina(controller), carrega a página ERRO
                $this->urlController = $this->slugController(CONTROLLERERRO);
                // Em servidores linux a primeira letra deve ser Maiúscula(igual a classe)
                // Em servidores Windows, é indiferente
            }
        } else {
            // echo "Acessa a pagina inicial! <br>";
            // Caso não seja enviado a pagina(controller), carrega uma página padrão(Inicial)
            $this->urlController = $this->slugController(CONTROLLER);
        }
        // echo "Controller: {$this->urlController}<br>";
    }
    /** =========================================================================================
     * Método privado não pode ser instanciado fora da classe
     * Limpara a URL, elimando as TAG, os espaços em brancos, retirar a barra no final da URL e retirar os caracteres especiais
     * @return void  */
    private function clearUrl(): void
    {
        //Eliminar as tag
        $this->url = strip_tags($this->url);
        //Eliminar espaços em branco
        $this->url = trim($this->url);
        //Eliminar a barra no final da URL
        $this->url = rtrim($this->url, "/");
        //Eliminar caracteres 
        $this->format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]?;:.,\\\'<>°ºª ';
        $this->format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr-------------------------------------------------------------------------------------------------';
        $this->url = strtr(utf8_decode($this->url), utf8_decode($this->format['a']), $this->format['b']);
    }
    /** =========================================================================================
     * Converter o valor obtido da URL "sobre-empresa" e converter no formato da classe "SobreEmpresa".
     * Utilizado as funções para converter tudo para minúsculo, converter o traço pelo espaço, converter cada letra da primeira palavra para maiúsculo, retirar os espaços em branco
     * @param string $slugController Nome da classe
     * @return string Retorna a controller "sobre-empresa" convertido para o nome da Classe "SobreEmpresa"     */
    private function slugController($slugController): string
    {
        //Converter para minusculo
        $this->urlSlugController = strtolower($slugController);
        //Converter o traco para espaco em braco
        $this->urlSlugController = str_replace("-", " ", $this->urlSlugController);
        //Converter a primeira letra de cada palavra para maiusculo
        $this->urlSlugController = ucwords($this->urlSlugController);
        //Retirar espaco em branco
        $this->urlSlugController = str_replace(" ", "", $this->urlSlugController);
        return $this->urlSlugController;
    }
    /** =======================================================================================
     * Carregar as Controllers.
     * Instanciar as classes da controller e carregar o método index.
     * @return void     */
    public function loadPage(): void
    {
        // echo "ANIMES/ADMS/SRC/ConfigControllerAdms.php - Carregar a pagina(Controller)<br>";
        $this->classLoad = "\\Adm\\Controllers\\" . $this->urlController;
        // $classLoad = "\\Adm\\Controllers\\" . $this->urlController;
        // $classPage = new $classLoad();
        // $classPage->index();
        if (class_exists($this->classLoad)) {
            $this->loadClass();
        } else {
            $this->urlController = $this->slugController(CONTROLLERERRO);
            $this->loadPage();
        }
    }
    /** =======================================================================================
     * Verificar se o método existe, existindo o método carrega a página;
     * Não existindo o método, para o carregamento e apresenta mensagem de erro.
     * @return void     */
    private function loadClass(): void
    {
        $classPage = new $this->classLoad();
        if (method_exists($classPage, "index")) {
            $classPage->index();
        } else {
            die("Erro 005! Por favor tente novamente. Caso o problema persista, entre em contato o administrador " . EMAILADM);
        }
    }
}
