<?php
namespace Adm\Models;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
/** Classe(Models) para sincronizar o nivel de acesso e as paginas */
class AdmSyncPageLevel
{
    private bool $result;

    /** @var array|null - Recebe os registros do banco de dados(DB)     */
    private array|null $resultBd;

    /** @var array|null - Recebe os registros do banco de dados(DB)     */
    private array|null $resultBdLevel;

    /** @var array|null - Recebe os registros do banco de dados(DB)     */
    private array|null $resultBdPages;

    /** @var array|null - Recebe as informações q devem ser salvas no DB     */
    private array|null $resultBdLevelPage;

    /** @var array|null - Recebe os registros do banco de dados(DB)     */
    private array|null $resultBdLastOrder;

    /** @var array|null - Recebe os registros do banco de dados(DB)     */
    private array|null $resultBdLevelDefault;
    
    /** @var array|null - Recebe os registros do banco de dados(DB)     */
    private array|null $dataLevelPage;

    /** @var integer|string|null - Recebe o Id do Nivel de acesso   */
    private int|string|null $levelId;

    /** @var integer|string|null - Recebe o Id da pagina   */
    private int|string|null $pageId;

    /** @var integer|string|null - Recebe o tipo de permissão da página */
    private int|string|null $public_page;

    /** ==========================================================================================
     * @return boolean         */
    public function getResult(): bool
    {
        return $this->result;
    }
    /** ==========================================================================================
     * @return array|null         */
    public function getResultBd(): array|null
    {
        return $this->resultBd;
    }
    /** ==========================================================================================
     * Método para recuperar os niveis de acesso no DB
     * @return void - Retorna false se houver algun erro   */
    public function SyncPageLevel(): void
    {
        //instância a classe:AdmsRead() e cria o objeto:$listNivels
        $listLevel = new \Adm\Models\helper\AdmRead();
        //usa o objeto para instânciar o método:fullRead(), passando a query desejada
        $listLevel->fullRead("SELECT id_access_level FROM adms_access_level");
        //usa o objeto para instânciar o método:getResult() e atribui o seu valor no atributo:$this->resultBd

        $this->resultBdLevel = $listLevel->getResult();
        //verifica se atributo:$this->resultBd é true, se for atribui o true para o atributo:$this->result
        if ($this->resultBdLevel) {
            // var_dump($this->resultBd);
            // $this->result = true;
            //se o atributo:$this->resultBd é false, atribui a frase na constante:$_SESSION['msg']
            // var_dump($this->resultBdNivels);
            $this->listPages();
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 025! Nivel de acesso não encontrada!</p>";
            $this->result = false;
        }
    }
    /** =============================================================================================
     * @return void - Recuperar as paginas no DB     */
    private function listPages():void
    {
        //instância a classe:AdmsRead() e cria o objeto:$listNivels
        $listPages = new \Adm\Models\helper\AdmRead();
        //usa o objeto para instânciar o método:fullRead(), passando a query desejada
        $listPages->fullRead("SELECT id_page, public_page FROM adms_page");
        //usa o objeto para instânciar o método:getResult() e atribui o seu valor no atributo:$this->resultBd
        $this->resultBdPages = $listPages->getResult();
        //verifica se atributo:$this->resultBd é true, se for atribui o true para o atributo:$this->result
        if ($this->resultBdPages) {
            // var_dump($this->resultBd);
            // $this->result = true;
            //se o atributo:$this->resultBd é false, atribui a frase na constante:$_SESSION['msg']
            // var_dump($this->resultBdPages);
            $this->readNivels();
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 025.1! Nenhuma página encontrada!</p>";
            $this->result = false;
        }
    }
    /** =============================================================================================
     * @return void - Ler os niveis de acesso no DB     */
    private function readNivels():void
    {
        foreach($this->resultBdLevel as $level){
            // var_dump($nivel);
            extract($level);
            // echo "ID do nivel de acesso: $id <br>";
            $this->levelId = $id_access_level;
            $this->readPages();
        }
    }
    /** =============================================================================================
     * @return void - Ler as paginas de acesso no DB     */
    private function readPages():void
    {
        foreach($this->resultBdPages as $page){
            // var_dump($page);
            extract($page);
            // echo "ID da Página: $id <br>";
            $this->pageId = $id_page;
            $this->public_page = $public_page;
            $this->searchNivelsPage();
        }
    }
    /** =============================================================================================
     * @return void - Recuperar as paginas no DB     */
    private function searchNivelsPage():void
    {
        //instância a classe:AdmsRead() e cria o objeto:$listNivels
        $listLevelPage = new \Adm\Models\helper\AdmRead();
        //usa o objeto para instânciar o método:fullRead(), passando a query desejada
        $listLevelPage->fullRead("SELECT id_level_page FROM adms_level_page WHERE id_access_level=:id_access_level AND id_page=:id_page", "id_access_level={$this->levelId}&id_page={$this->pageId}");
        //usa o objeto para instânciar o método:getResult() e atribui o seu valor no atributo:$this->resultBdNivelsPage
        $this->resultBdLevelPage = $listLevelPage->getResult();
        //verifica se atributo:$this->resultBd Não for true, precisa cadastrar pois não encontrou no Db
        if ($this->resultBdLevelPage) {
            // var_dump($this->resultBd);
            // $this->result = true;
            //se o atributo:$this->resultBd é false, atribui a frase na constante:$_SESSION['msg']
            // var_dump($this->resultBdPages);
            // $this->readNivels();
            // echo "O nivel de acesso tem cadastro para a pagina: {$this->pageId} <br>";
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Todas as Permissões estão sincronizadas com sucesso!</p>";
            $this->result = true;
        } else {
            // echo "O nivel de acesso NÃO tem cadastro para a pagina: {$this->pageId} <br>";
            // $_SESSION['msg'] = "<p class='alert alert-warning'>Erro (listPages())! Nenhuma página encontrada!</p>";
            // $this->result = false;
            $this->addNivelPermission();
        }
    }
    /** ============================================================================================
     * @return void - Método para cadastrar na tabela:adms_level_page     */
    private function addNivelPermission():void
    {
        $this->searchLastOrder();
        // Se o nivel de acesso for 1(super adm) OU a página for publica (publish=1), ? = 1, por padrão tem permissão de acessar. Se não : = 2, não tem permissão
        $this->dataLevelPage['permission_level_page'] = (($this->levelId==1) or ($this->public_page==1)) ? 1 : 2;
        // Método para Procurar, se econtrar executa o nivel(LEVEL) de acesso PADRÃO 
        $this->searchNivelDefault();

        $this->dataLevelPage['order_level_page'] = $this->resultBdLastOrder[0]['order_level_page'] +1;
        $this->dataLevelPage['id_access_level'] = $this->levelId;
        $this->dataLevelPage['id_page'] = $this->pageId;
        $this->dataLevelPage['created'] = date("Y-m-d H:i:s");

        $addAccessNivel = new \Adm\Models\helper\AdmCreate();
        $addAccessNivel->exeCreate("adms_level_page", $this->dataLevelPage);

        if($addAccessNivel->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Permissões sincronizadas com sucesso!</p>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro 25.2! Não foi possivel sincronisar as permissões!</p>";
            $this->result = false;
        }
    }
    /** ============================================================================================
     * @return void - Método para se ha página está cadastrada para o nivel de acesso na tabela:adms_levels_pages      */
    private function searchLastOrder():void
    {
        $viewLastOrder = new \Adm\Models\helper\AdmRead();
        $viewLastOrder->fullRead("SELECT order_level_page, id_access_level FROM adms_level_page WHERE id_access_level=:id_access_level ORDER BY order_level_page DESC LIMIT :limit", "id_access_level={$this->levelId}&limit=1");

        $this->resultBdLastOrder = $viewLastOrder->getResult();

        if(!$this->resultBdLastOrder){
            $this->resultBdLastOrder[0]['order_level_page'] = 0;
        }
        // var_dump($this->resultBdLastOrder);
    }
    /** =======================================================================================
     * Método para verificar se existe o nivel(LEVEL) de acesso DEFAULT(padrão, ID=7)
     * Se existir usa os dados do mesmo como padrão para a criação do novo nivel(quando sincronizar)
     * @return void      */
    private function searchNivelDefault():void
    {
        $viewLevelDefault = new \Adm\Models\helper\AdmRead();
        // Nesta query eta sendo verificado(Definido) se o ID da tebela:adms_level_page é = 3
        $viewLevelDefault->fullRead("SELECT permission_level_page, print_menu, dropdown_menu, id_item_menu FROM adms_level_page WHERE id_page=:id_page AND id_access_level=3
        LIMIT :limit",
        "id_page={$this->pageId}&limit=1");

        $this->resultBdLevelDefault = $viewLevelDefault->getResult();
        // Verifica, se existir usa os dados do nivel de acesso padrão
        if($this->resultBdLevelDefault){
            $this->dataLevelPage['permission_level_page'] = $this->resultBdLevelDefault[0]['permission_level_page'];
            $this->dataLevelPage['print_menu'] = $this->resultBdLevelDefault[0]['print_menu'];
            $this->dataLevelPage['dropdown_menu'] = $this->resultBdLevelDefault[0]['dropdown_menu'];
            $this->dataLevelPage['id_item_menu'] = $this->resultBdLevelDefault[0]['id_item_menu'];
        }
    }
}
