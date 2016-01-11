<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DaoUsuario
 *
 * @author Felipe
 */
class DaoUsuario implements IDao {

    public function excluir(\Usuario $u) {
        $sql = "delete FROM usuario where id=:ID";
        $conexao = Conexao::getConexao();
        $sth = $conexao->prepare($sql);
        $p1 = $u->getId();
        $sth->bindParam("ID", $p1);

        try {
            $sth->execute();
            return true;
        } catch (Exception $exc) {
            return $exc->getMessage();
        }
        $usu = $sth->fetchObject(get_class(Usuario));
        return $usu;
    }

    public function listar($p1) {
        $sql = "SELECT id, nome, login, senha, status FROM usuario where id=:ID";
        $conexao = Conexao::getConexao();
        $sth = $conexao->prepare($sql);
        $sth->bindParam("ID", $p1);

        try {
            $sth->execute();
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        $usu = $sth->fetchObject("Usuario");
        return $usu;
    }

    public function listarTodos() {
        $sql = "SELECT id, nome, login, senha, status FROM usuario";
        $conexao = Conexao::getConexao();
        $sth = $conexao->prepare($sql);

        try {
            $sth->execute();
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }

        $arUsuario = array();

        while ($uso = $sth->fetchObject("Usuario")) {
            $arUsuario[] = $uso;
        }
        return $arUsuario;
    }

    public function salvar(\Usuario $u) {
        $nome = $u->getNome();
        $login = $u->getLogin();
        $senha = $u->getSenha();
        $status = $u->getStatus();

        if ($u->getId()) {
            $id = $u->getId();
            $sql = "update usuario set nome=:nome, login=:login, senha=:senha, status=:status where id=:id";
        } else {
            $id = $this->generateID();
            $u->setId($id);
            $sql = "insert into usuario (id, nome, login, senha, status) values (:id, :nome, :login, :senha, :status)";
        }
        $cnx = Conexao::getConexao();
        $sth = $cnx->prepare($sql);
        $sth->bindParam("id", $id);
        $sth->bindParam("nome", $nome);
        $sth->bindParam("login", $login);
        $sth->bindParam("senha", $senha);
        $sth->bindParam("status", $status);

        try {
            $sth->execute();
            return $u;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    /**
     * 
     * @return int
     */
    private function generateID() {
        $sql = "select (coalesce(max(id),0)+1) as ID from usuario";
        $cnx = Conexao::getConexao();
        $sth = $cnx->prepare($sql);

        try {
            $sth->execute();
        } catch (Exception $exc) {
            return $exc->getMessage();
        }

        $res = $sth->fetch();
        $id = $res['ID'];
        return $id;
    }

    public function autenticar($login, $senha) {
        $sql = "select count(1) as U from usuario where login=:login and senha=:senha";
        $cnx = Conexao::getConexao();
        $sth = $cnx->prepare($sql);
        $sth->bindParam("login", $login);
        $sth->bindParam("senha", $senha);

        try {
            $sth->execute();
        } catch (Exception $exc) {
            return $exc->getMessage();
        }

        $res = $sth->fetch();
        $id = $res['U'];

        //  Faz a verificação
        return $id > 0;
    }

}
