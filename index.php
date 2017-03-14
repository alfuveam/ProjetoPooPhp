
<?php

header('Content-Type: Text/html; charset=utf-8');
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);

//    // put your code here
//    $aray[] = 'teste';
//    $aray[] = 'teste1';
//    $aray[] = 'teste2';
//    $aray[0] = 'teste0';
//
//    echo '<prev>';
//
//    foreach ($aray as $possicao => $valorArmazenado) {
//        echo $possicao . " - " . $valorArmazenado . "<br>";
//    }
//  Para adicionar a classe manualmente
//  require_once './dao/Teste.php';
//  Para adicionar a pasta onde se encontra as classes
include_once './config/config.php';


// teste

function __autoload($c) {
    $diretorios = array(
        './',
        './model/',
        './libs/',
        './gui/',        
        './to/',
        './dao/'
    );
    
    foreach ($diretorios as $dir) {
        if (file_exists($dir . $c . '.php')) {
            require_once $dir . $c . ".php";
        }
    }
}

$app = new TApp();
$app->executar();