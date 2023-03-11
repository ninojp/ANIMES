<?php
namespace Animes\Controllers;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ header("Location: https://localhost/animes/"); }
/** Classe controller, para gerenciar as informações entre a Views e a Models
 * @author NinoJP <ninocriptocoin@gmail.com> - 03/02/2023 */
class ListAnimesAdm
{
    /** @var array|string|null - Define que o atributo:$data pode receber(da view) os dados(parametros) de diversos tipos, q devem ser enviados novamente para serem exibidos pela view */
    private array|string|null $data;

    /** @var array|null - Recebe os dados do formulário de pesquisa   */
    private array|null $dataForm;

    /** @var string|integer|null - Recebe o numero da pagina atual   */
    private string|int|null $page;

    /** @var string|null $searchName - Recebe o nome a ser pesquisado  */
    private string|null $searchName;

    /** =========================================================================================
     * Undocumented function
     * @return void     */
    public function index(string|int|null $page = null)
    {
        $this->page = (int) $page ? $page : 1;
        // Recebe os dados do formulário de pesquisa:form_pesquisar
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        // Recebe os dados da pesquisa via URL
        $this->searchName = filter_input(INPUT_GET, 'search_name', FILTER_DEFAULT);

        $listAnimes = new \Animes\Models\MdListAnimesAdm();

        //verifica se foi clicado no botão pesquisar, se foi executa o codigo abaixo
        if (!empty($this->dataForm['SendSearchAnime'])) {
        //sempre quando clicar no pesquisar, redireciona para pagina 1
        $this->page = 1;
        //instância o método que fara a pesquisa e passa como parametro a pagina e os dados que estão nas posições do array:$this->dataForm['']
        $listAnimes->listSearchAnimes($this->page, $this->dataForm['search_name']);
        //para manter os dados no formulário, na view
        $this->data['form'] = $this->dataForm;
            // verifica se está recebendo via GET na url
        } elseif ((!empty($this->searchName))) {
            //instância o método que fara a pesquisa e passa como parametro a pagina e os dados que estão nas posições do array:$this->dataForm['']
            $listAnimes->listSearchAnimes($this->page, $this->searchName);
            //para manter os dados no formulário, na view
            $this->data['form']['search_name'] = $this->searchName;
            //Se não foi clicado carrega os dados do listar normalmente
        } else {
            //envia para a models a pagina atual
            $listAnimes->listAnimes($this->page);
        }
        if ($listAnimes->getResult()) {
            $this->data['listAnimes'] = $listAnimes->getResultBd();
            // var_dump($this->data['listUsers']);
            // PAGINAÇÃO - cria a POSIÇÃO:['pagination'] no array:$this->data
            $this->data['pagination'] = $listAnimes->getResultPg();
        } else {
            $this->data['listAnimes'] = [];
            $this->data['pagination'] = "";
        }
        $loadView = new \Src\ConfigViewAnimes("animes/Views/animes/listAnimes", $this->data);
        $loadView->loadViewAnimes();
    }
}