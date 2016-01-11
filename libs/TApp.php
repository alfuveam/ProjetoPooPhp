<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TApp
 *
 * @author Felipe
 */
class TApp {

    private $to;
    private $method;
    private $params;

    public function __construct() {
        $url = isset($_GET['url']) ? $_GET['url'] : FALSE;
        $url = rtrim($url, "/");

        if ($url) {
            //cadastro-de-pessoas/listar-por-codigo/10
            //  To é usado para a classe
            $arr = explode("/", $url);
            if (isset($arr[0])) {
                $to = strtolower($arr[0]);
                $to = explode("-", $to);
                $strTo = '';
                foreach ($to as $possicao => $valorArmazenado) {
                    $strTo .= strtoupper(substr($valorArmazenado, 0, 1)) . substr($valorArmazenado, 1);
                }
                $this->to = $strTo;
//                print_r($strTo);
            }

            if (isset($arr[1])) {
                //  Mt é usado para o método
                $mt = strtolower($arr[1]);
                $mt = explode("-", $mt);
                $strMt = '';

                foreach ($mt as $possicao => $valorArmazenado) {
                    if ($possicao === 0) {
                        $strMt .= $valorArmazenado;
                    } else {
                        $strMt .= strtoupper(substr($valorArmazenado, 0, 1)) . substr($valorArmazenado, 1);
                    }
                }
                $this->method = $strMt;
//                print_r($strMt);
            }
            unset($arr[0]);
            unset($arr[1]);
            $this->params = $arr;
            //print_r($arr);
        } else {
            $this->to = "controleUsuario";
            $this->method = "listaDeUsuario";
            $this->params = null;
        }
    }

    public function executar() {
        if (class_exists($this->to)) {
            try {
                //  Construtor
                $c = new $this->to();
                if ($c instanceof IPrivateTO) {
                    session_start();
                    if (!$_SESSION['usuario']) {
                        header("location: " . URL . "login/autenticar");
                    }
                }

                if (method_exists($c, $this->method)) {
                    //  Se tiver parametros
                    if ($this->params != null) {
                        $c->{$this->method}($this->params);
                    } else {
                        $c->{$this->method}();
                    }
                } else {
                    //  Tratar erro
                }
            } catch (Exception $exc) {
                echo $exc->getMessage();
            }
        } else {
            
        }
    }

}
