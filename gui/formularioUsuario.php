<?php
$id = "";
$nome = "";
$login = "";
$senha = "";
$status = "";

$usuario = $this->getDados("usuario");
if ($usuario) {
    $usuario instanceof Usuario;
    $id = $usuario->getId();
    $nome = $usuario->getNome();
    $login = $usuario->getLogin();
    $senha = $usuario->getSenha();
    $status = $usuario->getStatus();
}
?>

<form method="post" action="<?php echo URL; ?>controle-usuario/salvar">
    <label>ID</label><br>
    <input type="text" readonly="true" value="<?php echo $id ?>" name="id"><br>

    <label>Nome</label><br>
    <input type="text"  value="<?php echo $nome ?>" name="nome"><br>

    <label>Login</label><br>
    <input type="text" value="<?php echo $login ?>" name="login"><br>

    <label>Senha</label><br>
    <input type="password" value="<?php echo $senha ?>" name="senha"><br>

    <label>Status</label><br>
    
    <select name="status">
        <option value="a"<?php 
        if ($status == 'a') {
            echo 'selected "true"';
            }?>>Ativo</option>>
    
        <option value="i"<?php 
        if ($status == 'i') {
            echo 'selected "true"';
            }?>>Inativo</option>>
    </select>

    <input type="submit" value="Salvar"><br>
    <a href="<?php echo URL; ?>controle-usuario/lista-de-usuario">Voltar</a><br>
</form>
