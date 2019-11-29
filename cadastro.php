<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastro avaliador</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./_css/estilo.css">
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

        <div class="row justify-content-center">
            <? echo $data?>
            <form action="processa.php" method="POST" title="Cadastro avaliador">
                <h1>Cadastro avaliador</h1>
                <input type="hidden" name="id" value="<?php echo $id?>">
                <div class="form-group">

                    <label for="name">Nome</label>
                    <input type="text" name="nome" class="form-control" value="<?php echo $name?>">
                </div>
                <div class="form-group">
                    <label>CPF</label>
                    <input type="text" name="cpf" class="form-control" data-mask="000.000.000-00" value="<?php echo $cpf?>">
                </div>
                <div class="form-group">
                    <label>UF</label>
                    <select class="custom-select" name="estados" id="">
                        <option value="" name="uf">Selecione</option>
                        <?php
                        $result_estados = "SELECT * FROM estados";
                        $result_estado = mysqli_query($mysqli, $result_estados);
                        while ($row_result_estado = mysqli_fetch_assoc($result_estado)) { ?>
                            <option value="<?php echo $row_result_estado['sigla']; ?>"><?php echo utf8_encode($row_result_estado['estado']); ?>
                            </option><?php
                                        }
                                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>RG</label>
                    <input type="text" name="rg" class="form-control" value="<?php echo $rg?>">
                </div>
                <div class="form-group">
                    <label>Data de nascimento</label>
                    <input type="text" name="data_nasc" class="form-control" data-mask="00/00/0000" value="<?php echo $data_nasc?>">
                </div>
                
                <div class="form-group">
                    <label>Sexo</label>
                    <select class="custom-select" name="sex">
                        <option selected>Selecione</option>
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Grau acadêmico</label>
                    <input type="text" name="acad" class="form-control" value="<?php echo $grau_acad?>">
                </div>
                <div class="form-group">
                    <label>Instituição</label>
                    <input type="text" name="inst" class="form-control" value="<?php echo $instituicao?>">
                </div>
                <div class="form-group" id="btn">
                    <?php if($altere == true): ?>
                    <button type="submit" class="ai" name="atualizar">Atualizar</button>
                    <?php else : ?>
                    <button type="submit" class="ai" name="gravar">Salvar</button>
                    <?php endif ; ?>

                </div>
            </form>
        </div>
    </div>
    <script async="" src="//www.google-analytics.com/analytics.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="//assets.locaweb.com.br/locastyle/2.0.6/javascripts/locastyle.js"></script>
    <script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
</body>

</html>