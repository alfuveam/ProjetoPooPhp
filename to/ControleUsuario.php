<?php

/**
 * Description of ControleUsuario
 *
 * @author Felipe
 */
class ControleUsuario implements IPrivateTO{

    public function listaDeUsuario() {
        $du = new DaoUsuario();
        $usuarios = $du->listarTodos();

        $v = new TGui("listaDeUsuarios");
        //  Tem um atributo usuarios
        $v->addDados("usuarios", $usuarios);
        $v->renderizar();
    }

    public function editar($id) {
        //  Como é um array tem temos que usar o print_r();
        //echo 'Editar usuario' . print_r($id);
        $p1 = $id[2];
        $du = new DaoUsuario();
        $u = $du->listar($p1);
        $v = new TGui("formularioUsuario");
        $v->addDados("usuario", $u);
        $v->renderizar();
    }

    public function novo() {
        $u = new Usuario();
        $v = new TGui("formularioUsuario");
        $v->addDados("usuario", $u);
        $v->renderizar();
    }

    public function salvar() {
        // Array ( [id] => 1 [nome] => 123456 [login] => 123456 [senha] => 123456 [status] => a )
        $u = new Usuario();
        $id = isset($_POST['id']) ? $_POST['id'] : FALSE;

        if (trim($id) != "") {
            $u->setId($id);
        }
        //  Verifica no post
        $nome = isset($_POST['nome']) ? $_POST['nome'] : FALSE;
        if (!$nome || trim($nome) == "") {
            throw new Exception("O campo nome è Obrigatorio!");
        }

        $login = isset($_POST['login']) ? $_POST['login'] : FALSE;
        if (!$login || trim($login) == "") {
            throw new Exception("O campo login è Obrigatorio!");
        }

        $senha = isset($_POST['senha']) ? $_POST['senha'] : FALSE;
        if (!$senha || trim($senha) == "") {
            throw new Exception("O campo senha è Obrigatorio!");
        }

        $status = isset($_POST['status']) ? $_POST['status'] : FALSE;
        if (!$status || trim($status) == "") {
            throw new Exception("O campo status è Obrigatorio!");
        }

        $u->setNome($nome);
        $u->setLogin($login);
        $u->setSenha($senha);
        $u->setStatus($status);

        $du = new DaoUsuario();
        $usu = $du->salvar($u);
//        var_dump($usu);
//        die;

        if ($usu instanceof Usuario) {
            header("location: " . URL . "controle-usuario/lista-de-usuario");
        } else {
            echo 'Não foi possivel salvar o usuário';
        }
    }

    public function excluir($id) {
        $p1 = $id[2];
        $du = new DaoUsuario();
        $u = $du->listar($p1);
        $v = new TGui("confirmaExclusaoUsuario");
        $v->addDados("usuario", $u);
        $v->renderizar();
    }

    public function confirmaExclusao() {
        $id = isset($_POST['id']) ? $_POST['id'] : false;

        if ($id) {
            $du = new DaoUsuario();
            $u = $du->listar($id);
            
            if($du->excluir($u)){
                header("location: " . URL . "controle-usuario/lista-de-usuario");
            }else{
                echo 'Não foi possivel excluir o registro';
            }
            
        } else {
            header("location: " . URL . "controle-usuario/lista-de-usuario");
        }
    }

}
