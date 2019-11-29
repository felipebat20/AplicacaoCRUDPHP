<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./_css/estilo.css">

    <title>Pesquisa Avaliador</title>
</head>

<body>
    

    <div class="interface">
        <header>
            <nav id="menu">
                <ul>

                    <li><a href="http://localhost/LpI/cadastro.php" target="_self">Cadastro</a></li>


                    <li><a href="http://localhost/LpI/pesquisaavaliador.php">Procure</a></li>

                </ul>
            </nav>
        </header>
        <?php require_once 'processa.php';  ?>
        
        <?php
        if (isset($_SESSION['message'])) : ?>

            <div class="alert alert-<?= $_SESSION['msg_type'] ?>">

                <?php
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                    ?>

            </div>
        <?php endif ?>

        <div class="row ">
            <form action="processa.php">
                <div class="form-group">
                    <label for="pesquisa">Procure o Avaliador</label>
                    <input type="text" name="pesquisa" class="form-control" value="Escreva o nome do avaliador">
                </div>
                <div class="form-group" id="">
                    <button type="submit" class="btn btn-primary" name="busca">Buscar</button>
                </div>
            </form>
        </div>
        <div class="ava">
            <h1>Avaliadores cadastrados</h1>
        </div>
        <?php
        $mysqli = new mysqli('localhost', 'root', '', 'cadastro') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM avaliadores") or die($mysqli->error);
        //pre_r($result);
        ?>

        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>UF</th>
                        <th>RG</th>
                        <th>Data de Nascimento</th>
                        <th>Sexo</th>
                        <th>Grau acadêmico</th>
                        <th>Instituição</th>
                        <th colspan="2">Ação</th>
                    </tr>
                </thead>
                <?php
                while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <!-- <td>
                            <?php echo $row['id']; ?>
                        </td> -->
                        <td>
                            <?php echo $row['nome']; ?>
                        </td>
                        <td>
                            <?php
                                $nbr_cpf = $row['cpf'];

                                $parte_um     = substr($nbr_cpf, 0, 3);
                                $parte_dois   = substr($nbr_cpf, 3, 3);
                                $parte_tres   = substr($nbr_cpf, 6, 3);
                                $parte_quatro = substr($nbr_cpf, 9, 2);

                                $monta_cpf = "$parte_um.$parte_dois.$parte_tres-$parte_quatro";

                                
                                ?>
                            <?php echo $monta_cpf; ?>

                        </td>
                        <td>
                            <?php echo $row['UF']; ?>
                        </td>
                        <td>
                            <?php echo $row['rg']; ?>
                        </td>
                        <td>
                            <?php echo date("d/m/Y", strtotime($row['data_nasc'])); ?>
                        </td>
                        <td>
                            <?php echo $row['sexo']; ?>
                        </td>
                        <td>
                            <?php echo $row['grau_acad']; ?>
                        </td>
                        <td>
                            <?php echo $row['instituicao']; ?>
                        </td>

                        <td>
                            <a href="cadastro.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Editar</a>
                            <a href="processa.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Apagar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>

        <?php
        function pre_r($array)
        {
            echo '<pre>';
            print_r($array);
            echo '</pre>';
        }
        ?>

    </div>
</body>

</html>