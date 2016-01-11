<h2>Deseja excluir este usuário: <?php
    $usuario = $this->getDados("usuario");
    if ($usuario instanceof Usuario) {
        echo $usuario->getNome();
    }
    ?></h2>

<form method="post" action="<?php echo URL;?>controle-usuario/confirma-exclusao">
    <input type="hidden" name="id" value="<?php
    if ($usuario instanceof Usuario) {
        echo $usuario->getId();
    }
    ?>">
    <input type="submit" value="Sim">
</form>
<a href="<?php echo URL; ?>controle-usuario/lista-de-usuario">Não</a>