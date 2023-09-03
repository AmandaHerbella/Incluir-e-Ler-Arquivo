<?php 
    $msg = " ";
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nome = $_POST["nome"]; 
        $matricula = $_POST["matricula"];
        $periodo = $_POST["periodo"];
        //echo "Nome: " . $nome . " Matricula: " . $matricula . " Periodo: " . $periodo; mostrando na tela
        $arquivo = fopen("matriculas.txt", "a") or die("Erro ao criar arquivo :(");
        $linha = $nome . " | " . $matricula . " | " . $periodo . "\n";
        fwrite($arquivo, $linha);
        fclose($arquivo);
        $msg = "Dados enviados com sucesso.";
    }
?>

<!DOCTYPE html>
<html>
    <head>
    <style>
        table, th, td {
            border:1px solid black;
        }
    </style>
        <title>FAETERJ - Aluno</title>
    </head>
    <body>
        <h1><strong>Informe seus dados</strong></h1>
        <form action="index.php" method="POST">
            Nome: <input type="text" name="nome">
            <br><br>
            Matrícula: <input type="number" name="matricula">
            <br><br>
            Periodo: <input type="number" name="periodo" min="1" max="5">
            <br><br>
            <input type="submit" value="Enviar">
        </form>
        <?php echo $msg ?>

        <h2>Dados dos alunos de FAETERJ - RJ</h2>
        <table>
            <tr>
                <th>NOME</th>
                <th>MATRICULA</th>
                <th>PERIODO</th>
            </tr>
            <?php 
                error_reporting(0);
                $arquivo = fopen("matriculas.txt", "r");
                $x = 0;
                while(!feof($arquivo)){
                    $linha[] = fgets($arquivo);
                    $colunaDados = explode(" | ", $linha[$x]);
                    $nome = $colunaDados[0];
                    $matricula = $colunaDados[1];
                    $periodo = $colunaDados[2];

                    echo "<tr>";
                    echo "<td>" . $nome . "</td>";
                    echo "<td>" . $matricula . "</td>";
                    echo "<td>" . $periodo . "</td>";
                    echo "</tr>";
                    
                    $x++;
                }

                fclose($arquivo);
            ?>
        </table>
    </body>
</html>