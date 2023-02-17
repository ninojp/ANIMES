<?php
namespace AdmsSrc;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Verificar se existe a classe e Carregar a CONTROLLER
 * @author Nino JP <meu.sem@gmail.com>  */
class LoadPageAdmsLevel
{
    /** @var string $urlController Recebe da URL o nome da controller */
    private string $urlController;

    /** @var string $urlMetodo Recebe da URL o nome do método */
    private string $urlMetodo;

    /** @var string $urlParamentro Recebe da URL o parâmetro */
    private string $urlParameter;
    
    /** @var string $classLoad Controller que deve ser carregada */
    private string $classLoad;

    /** @var array - $resultPage: Recebe os dados da pagina do DB */
    private array|null $resultPage;

    /** @var array - $resultPage: Recebe os dados da permissão do DB */
    private array|null $resultLevelPage;

    /** ==========================================================================================
     * Método para verificar se existe a classe   -  @return void
     * @param string|null $urlController
     * @param string|null $urlMetodo
     * @param string|null $urlParameter */
    public function loadPage(string|null $urlController, string|null $urlMetodo, string|null $urlParameter):void
    {
        $this->urlController = $urlController;
        $this->urlMetodo = $urlMetodo;
        $this->urlParameter = $urlParameter;
        var_dump($this->urlController);

        $this->searchPage();
    }
    /** ===========================================================================================
     * @return void     */
    private function searchPage():void
    {
        $searchPage = new \Adms\Models\helper\AdmsRead();
        $searchPage->fullRead("SELECT pag.id_page, pag.public_page, typ.type_page FROM adms_page AS pag INNER JOIN adms_type_page AS typ ON typ.id_type_page=pag.id_type_page
        WHERE pag.controller_page =:controller_page AND pag.metodo_page =:metodo_page
        AND pag.id_sits_page=:id_sits_page LIMIT :limit",
        "controller_page={$this->urlController}&metodo_page={$this->urlMetodo}&id_sits_page=1&limit=1");
        $this->resultPage = $searchPage->getResult();

        if($this->resultPage){
            var_dump($this->resultPage);
            if($this->resultPage[0]['public_page'] == 1){
                // echo "Página PUBLICA! <br>";
                $this->classLoad = URLADM. "app/adms/Controllers/".$this->urlController.'.php';
                // $this->classLoad = "\App\\".$this->resultPage[0]['type_page']."\\Controllers\\".$this->urlController;
                var_dump($this->classLoad);
                $this->loadMetodo();
            } else {
                echo "Verificar se o user está logado <br>";
            //     $this->verifyLogin();
            }
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro (searchPage()): Página não encontrada!</p>";
            $urlRedirect = URLADM."login/index";
            header("Location: $urlRedirect");

            // Ao invés de fazer o redirecionamento pode se usar o DIE() para finalizar
            // die("Erro 033! Tente Novamente ou entre em contato: ".EMAILADM);
        }
    }
    /** ============================================================================================
     * Verificar se existe o método e carregar a página(controller)
     * @return void    */
    private function loadMetodo():void
    {
        $classLoad = new $this->classLoad;
        var_dump($classLoad);
        if(method_exists($classLoad, $this->urlMetodo)){
            //passando a parametro recebido no atributo:$this->urlParameter
            $classLoad->{$this->urlMetodo}($this->urlParameter);
        }else{
            die("Erro 033.1! Tente Novamente ou entre em contato: ".EMAILADM);
        }
    } 
    /** ===========================================================================================
     * Método para verificar se foi feito o LOGIN
     * @return void    */
    private function verifyLogin():void
    {
        if((isset($_SESSION['id_user'])) and (isset($_SESSION['adm_user'])) and (isset($_SESSION['adm_email'])) and (isset($_SESSION['id_access_level'])) and (isset($_SESSION['order_level']))) {
            // $this->classLoad = "\\App\\adms\\Controllers\\".$this->urlController;
            $this->searchLevelPage();
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 033.2: Para acessar a Página realize o login!</p>";
            $urlRedirect = URLADM."login/index";
            header("Location: $urlRedirect"); 
        }
    }
    /** ------------------------------------------------------------------------------------------
     * @return void     */ 
    private function searchLevelPage():void
    {
        $searchLevelPage = new \Adms\Models\helper\AdmsRead();
        $searchLevelPage->fullRead("SELECT id_level_page, permission_level_page FROM adms_level_page WHERE id_page=:id_page AND id_access_level=:id_access_level AND permission_level_page=:permission_level_page LIMIT :limit", "id_page={$this->resultPage[0]['id_page']}&id_access_level=".$_SESSION['id_access_level']."&permission_level_page=1&limit=1");

        $this->resultLevelPage = $searchLevelPage->getResult();
        if($this->resultLevelPage){
            $this->classLoad = "\\app\\".$this->resultPage[0]['type_page']."\\Controllers\\".$this->urlController;
            $this->loadMetodo();
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 033.3! Necessário permissão para acessar a página!</p>";
            $urlRedirect = URLADM."login/index";
            header("Location: $urlRedirect");
        }
    }
}
