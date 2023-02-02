<?php

namespace Core;

if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }

/**
 * Carregar as páginas da View
 * 
 * @author Cesar <cesar@celke.com.br>
 */
class ConfigView
{

    /**
     * Receber o endereço da VIEW e os dados.
     * @param string $nameView Endereço da VIEW que deve ser carregada
     * @param array|string|null $data Dados que a VIEW deve receber.
     */
    public function __construct(private string $nameView, private array|string|null $data)
    {        
    }

    /**
     * Carregar a VIEW.
     * Verificar se o arquivo existe, e carregar caso exista, não existindo para o carregamento
     * 
     * @return void
     */
    public function loadView(): void
    {
        if (file_exists('app/' . $this->nameView . '.php')) {
            include 'app/sts/Views/include/header.php';
            include 'app/sts/Views/include/menu.php';
            include 'app/' . $this->nameView . '.php';
            include 'app/sts/Views/include/footer.php';
        } else {
            die("Erro: Por favor tente novamente. Caso o problema persista, entre em contato o administrador " . EMAILADM);
        }
    }
}
