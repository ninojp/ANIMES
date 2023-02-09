<?php
namespace Adm\Models\helper;
if(!defined('@2y!10#OaHjLtR02hiD23TKNv(0$2)TkYur)$ADMS$(zF')){ 
    header("Location: https://localhost/adms/");
    die("Erro 000! Página Não encontrada"); }
use PDO;
use PDOException;

/** Classe ABSTRACT(Models), para fazer a conexão com o DB(Banco de Dados).
 * @author NinoJP <ninocriptocoin@gmail.com> - 04/02/2023 */
class AdmConn
{
    // Atributos que recebem o valor das contantes da Config
    private string $host = HOST;
    private string $user = USER;
    private string $pass = PASS;
    private string $dbname = DBNAME;
    private int $port = PORT;
    private object $connect;

    //o método protected só pode ser instanciado pela própria classe ou pela classe filha
    function connectDb():object
    {
        try{
            //Realizar a conexão com a porta, com a Base de Dados - DB
            $this->connect = new PDO("mysql:host={$this->host};port={$this->port};dbname=".$this->dbname,$this->user,$this->pass);

            // echo "OK! Conexão com sucesso";
            return $this->connect;
        }catch(PDOException $err){
            die("Erro - 001! Tente Novamente ou entre em contato com: ".EMAILADM);
        }
    }
}