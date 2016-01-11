<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author Felipe
 */
class Usuario {
    
    /**
     *
     * @var int identificador do registro
     */
    
    private $id;
    
    /**
     *
     * @var string nome do usuario
     */
    
    private $nome;
    /**
     *
     * @var string login do usuario
     */
    private $login;
    /**
     *
     * @var string senha do usuario
     */
    private $senha;
    /**
     *
     * @var string status do usuario
     */
    private $status;
    
    public function __construct() {
        //$this->id = null;
    }
    
    /**
     * 
     * @return int     
     */
    
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getLogin() {
        return $this->login;
    }

    function getSenha() {
        return $this->senha;
    }

    function getStatus() {
        return $this->status;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function setStatus($status) {
        $this->status = $status;
    }
}
