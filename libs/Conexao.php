<?php

/*
 * Classe para abastração de conexao com o banco mysql
 *
 * @author Felipe
 */

class Conexao {
    private static $cnx;
    /**
     * 
     * @return PDO
     */
    
    public static function getConexao(){
        if (!self::$cnx) {            
            //  Tem que usar o self para falar que é da classe, duvido sobre o this
            self::open();
        }
        return self::$cnx;
    }

    private static function open(){
        $host = HOST;
        $port = PORT;
        $dbName = DB_NAME;
        $userName = USER_NAME;
        $pass = PASSWORD;
        
        self::$cnx = new PDO("mysql:host={$host}; port={$port}; dbname={$dbName}", $userName, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND=> "SET NAMES utf8"));
    }
}