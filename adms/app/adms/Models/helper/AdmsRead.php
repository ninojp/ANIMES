<?php
namespace Adms\Models\helper;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
use PDO;
use PDOException;
/** Classe(Models/Helper) genérica para selecionar registros no banco de dados */
class AdmsRead extends AdmsConn
{
    /** @var string - Recebe a QUERY   */
    private string $select;

    /** @var array - Recebe os valores que devem ser atribuidos nos links da QUERY BINDVALUE  */
    private array $values = [];

    /** @var array|null - Recebe os registros do banco de dados e retorna para a Models  */
    private array|null $result;

    /** @var object  - Recebe a QUERY preparada  */
    private object $query;

    /** @var object  - Recebe a conexão com o Banco de Dados (DB)     */
    private object $conn;

    /** ===========================================================================================
     * @return array|null  - Retorna o array de dados    */
    function getResult(): array|null
    {
        return $this->result;
    }
    /** ===========================================================================================
     * Recebe os valores para montar a QUERY. Converte a parseString de string para array
     * @param string $table - Recebe o nome da tabela do DB
     * @param string|null|null $terms - Recebe os links da QUERY, exemplo, tab.id=:id_link
     * @param string|null|null $parseString - Rcebe os valores que devem ser substituidos no :link
     * @return void     */
    public function exeRead(string $table, string|null $terms = null, string|null $parseString = null): void
    {
        if (!empty($parseString)) {
            parse_str($parseString, $this->values);
            // var_dump($this->values);
        }
        $this->select = "SELECT * FROM {$table} {$terms}";
        // var_dump($this->select);
        $this->exeInstruction();
    }
    /** ===========================================================================================
     * @param string $query
     * @param string|null|null $parseString
     * @return void     */
    public function fullRead(string $query, string|null $parseString=null):void
    {
        $this->select = $query;
        if (!empty($parseString)) {
            parse_str($parseString, $this->values);
            // var_dump($this->values);
        }
        $this->exeInstruction();
    }
    /** ===========================================================================================
     * @return void     */
    private function exeInstruction(): void
    {
        $this->connection();
        try {
            $this->exeParameter();
            // var_dump($this->query);
            $this->query->execute();
            $this->result = $this->query->fetchAll();
        } catch (PDOException $err) {
            $this->result = null;
        }
    }
    /** ===========================================================================================
     * @return void     */
    private function connection()
    {
        $this->conn = $this->connectDb();
        $this->query = $this->conn->prepare($this->select);
        $this->query->setFetchMode(PDO::FETCH_ASSOC);
    }
    /** ==========================================================================================
     * @return void     */
    private function exeParameter(): void
    {
        if ($this->values) {
            foreach ($this->values as $link => $value) {
                // var_dump($link);
                // var_dump($value);
                // Verifica se o :link(palavra) for igual(limit, offset, ou id), sempre deve ser inteiro  
                if(($link == 'limit') or ($link == 'offset') or ($link == 'id')){
                    $value = (int) $value;
                }
                // Senão, o :link deve ser inteiro ou string(no caso o valor do link)
                $this->query->bindValue(":{$link}", $value, (is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR));
            }
        }
    }
}
