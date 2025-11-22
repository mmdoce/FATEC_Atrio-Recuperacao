<?php
 require_once __DIR__ . "/conexao.php";

 mysqli_report(MYSQLI_REPORT_OFF);



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $connection->real_escape_string($_POST['nome']);
    $data_nascimento = $connection->real_escape_string($_POST['data_nascimento']);
    $cpf = $connection->real_escape_string($_POST['cpf']);

    $endereco = $_POST['endereco'] ?? NULL;
    $data_entrada = $_POST['data_entrada'] ?? NULL;
    $nome_mae = $_POST['nome_mae'] ?? NULL;
    $nome_pai = $_POST['nome_pai'] ?? NULL;

    $historico_psiquiatrico = (isset($_POST['historico_psiquiatrico']) && $_POST['historico_psiquiatrico'] == 'sim') ? 1 : 0;
    $toma_medicamento = (isset($_POST['toma_medicamento']) && $_POST['toma_medicamento'] == 'sim') ? 1 : 0;

    $medicamento_especificar = $_POST['medicamento_especificar'] ?? NULL;
    $entorpecentes_usados = $_POST['entorpecentes_usados'] ?? NULL;
    $observacao_profissional = $_POST['observacao_profissional'] ?? NULL;

  $sql = "INSERT INTO paciente 
            (nome, data_nascimento, cpf, endereco, historico_psiquiatrico, entorpecentes_usados, 
            data_entrada, toma_medicamento, medicamento_especificar, nome_mae, nome_pai, observacao_profissional)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";


    $stmt = $connection->prepare($sql);

   $stmt->bind_param(
    "ssssississss",
    $nome,
    $data_nascimento,
    $cpf,
    $endereco,
    $historico_psiquiatrico,
    $entorpecentes_usados,
    $data_entrada,
    $toma_medicamento,
    $medicamento_especificar,
    $nome_mae,
    $nome_pai,
    $observacao_profissional
);


if ($stmt->execute()) {
            header("Location: /FATEC_Atrio-Recuperacao/lista-alunos.php");
    exit();
} else {
    // erro 1062 = chave duplicada
    if ($stmt->errno == 1062) {
            header("Location: /FATEC_Atrio-Recuperacao/cadastro.php?erro=cpf");

        exit();
    } else {
            header("Location: /FATEC_Atrio-Recuperacao/cadastro.php?erro=geral");
        exit();
    }
}




    $stmt->close();
}

$connection->close();
?>
