<?php
//Session para aparecer mensagem
session_start();
//Conexão com o bd
$mysqli = new mysqli('localhost', 'root', '', 'cadastro') or die(mysqli_error($mysqli));
//Definindo valores padrões para algumas variáveis
$altere = false;
$id = 0;
$name = '';
$cpf = '';
$rg = '';
$data_nasc = null;
$grau_acad = '';
$instituicao = '';

//Salvar os dados do formulário no bd
if (isset($_POST['gravar'])) {
    //Pegando os dados de cada campo e colocando em variáveis
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $uf = $_POST['estados'];
    $rg = $_POST['rg'];
    $data = $_POST['data_nasc'];
    $sexo = $_POST['sex'];
    $acad = $_POST['acad'];
    $inst = $_POST['inst'];

    //formatando o valor do cpf para salva-lo como int
    $nbr_cpf = $cpf;
    $parte_um     = substr($nbr_cpf, 0, 3);
    $parte_dois   = substr($nbr_cpf, 4, 3);
    $parte_tres   = substr($nbr_cpf, 8, 3);
    $parte_quatro = substr($nbr_cpf, 12, 2);
    $monta_cpf = $parte_um . $parte_dois . $parte_tres . $parte_quatro;
    //fim da formatação do cpf
    
    //Formatando a data para colocar no bd
    $data = str_replace('/', '-', $data);
    echo $data;
    //Substituimos os / para -
    $data = date("Y/m/d", strtotime($data));
    echo $data;
    //Permutamos os elementos da data para o formato do db


    //Criando uma query para inserir os dados no bd
    $mysqli->query("INSERT INTO avaliadores (nome, cpf, UF, rg, data_nasc, sexo, grau_acad, instituicao) values('$nome', '$monta_cpf','$uf','$rg',STR_TO_DATE('$data','%Y/%m/%d'), '$sexo', '$acad', '$inst')") or
        die($mysqli->error);

    //Messagem de confirmação
    $_SESSION['message'] = "Os dados sobre o avaliador $nome foram salvos";
    $_SESSION['msg_type'] = "success";
    //Voltar para a página de cadastro
    header("location: cadastro.php");
}
//Função delete
if (isset($_GET['delete'])) {
    //Pegamos o id do registro
    $id = $_GET['delete'];
    //Deletamos no bd
    $mysqli->query("DELETE FROM avaliadores WHERE id=$id") or die($mysqli->error());
    //Mensagem de deletado
    $_SESSION['message'] = "O registro foi apagado";
    $_SESSION['msg_type'] = "danger";
    //Voltando para a página de pesquisaavaliador
    header("location: pesquisaavaliador.php");
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $altere = true;
    $result = $mysqli->query("SELECT * FROM avaliadores WHERE id='$id'") or die($mysqli->error());
    
    if (mysqli_num_rows($result) == 1) {
        $row = $result->fetch_array();

        $name = $row['nome'];
        $cpf = $row['cpf'];
        $rg = $row['rg'];
        $data_nasc = date("d/m/Y", strtotime($row['data_nasc']));
        $sexo = $row['sexo'];
        $grau_acad = $row['grau_acad'];
        $instituicao = $row['instituicao'];
    }
}
if (isset($_POST['atualizar'])) {
    $id = $_POST['id'];
    $name = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $uf = $_POST['estados'];
    $rg = $_POST['rg'];
    $data = $_POST['data_nasc'];
    $sexo = $_POST['sex'];
    $grau_acad = $_POST['acad'];
    $instituicao = $_POST['inst'];
    //formatando o valor do cpf
    $nbr_cpf = $cpf;

    $parte_um     = substr($nbr_cpf, 0, 3);
    $parte_dois   = substr($nbr_cpf, 4, 3);
    $parte_tres   = substr($nbr_cpf, 8, 3);
    $parte_quatro = substr($nbr_cpf, 12, 2);
    $cpf = $parte_um . $parte_dois . $parte_tres . $parte_quatro;
    //fim da formatação do cpf  
    $data = str_replace('/', '-', $data);
    $data = date("Y/m/d", strtotime($data));
    $mysqli->query("UPDATE avaliadores SET nome='$name', cpf='$cpf',UF ='$uf', rg='$rg', data_nasc='$data', sexo='$sexo', grau_acad='$grau_acad', instituicao='$instituicao' WHERE id = '$id'") or die($mysqli->error);

    $_SESSION['message'] = "Os dados sobre o avaliador $name foram atualizados.";
    $_SESSION['msg_type'] = "success";

    header("location: pesquisaavaliador.php");
}
if(isset ($_POST['pesquisa'])){
    
}

?>
