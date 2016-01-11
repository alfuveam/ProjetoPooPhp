
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">        

        <title>Aplicativo Teste</title>

        <!-- Bootstrap core CSS -->
        <link href="../public/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>

        <div class="container">
            
                <a href="<?php echo URL; ?>login/logout"> Logout</a>
                <a href="<?php echo URL; ?>controle-usuario/novo"> Novo Usuário</a>

                <table border="1">
                    <thead>
                        <tr>
                            <th>ID</th>                
                            <th>NOME</th>     
                            <th>Controles</th>
                        </tr>
                    <tbody>

                        <?php
                        if ($this->getDados('usuarios')) {
                            $ar = $this->getDados('usuarios');

                            foreach ($ar as $usuario) {
                                $usuario instanceof Usuario;
                                echo "<tr><td>{$usuario->getId()}</td>";
                                echo "<td>{$usuario->getNome()}</td>";

                                echo "<td>"
                                . "<a href=\"" . URL . "controle-usuario/excluir/{$usuario->getId()}\">Excluir Usuário</a>"
                                . "  |  <a href=\"" . URL . "controle-usuario/editar/{$usuario->getId()}\">Editar Usuário</a>"
                                . "</td></tr>";
                            }
                        }
                        ?>
                    <tbody>
                        </thead>
                </table>
        </div>
    </body>
</html>