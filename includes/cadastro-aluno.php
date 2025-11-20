<?php
include 'conexao.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome_completo = $conn->real_escape_string($_POST['nome_completo']);
    $data_nascimento = $conn->real_escape_string($_POST['data_nascimento']);
    $cpf = $conn->real_escape_string($_POST['cpf']);

    $endereco = $_POST['endereco'] ?? NULL;
    $data_entrada_casa = $_POST['data_entrada_casa'] ?? NULL;
    $nome_mae = $_POST['nome_mae'] ?? NULL;
    $nome_pai = $_POST['nome_pai'] ?? NULL;

    $historico_psiquiatrico = isset($_POST['historico_psiquiatrico']) && $_POST['historico_psiquiatrico'] == 'sim' ? 1 : 0;
    $toma_medicamento = isset($_POST['toma_medicamento']) && $_POST['toma_medicamento'] == 'sim' ? 1 : 0;

    $medicamento_especifico = $_POST['medicamento_especifico'] ?? NULL;
    $entorpecentes_usados = $_POST['entorpecentes_usados'] ?? NULL;
    $observacao_profissional = $_POST['observacao_profissional'] ?? NULL;

    $sql = "INSERT INTO Pacientes (nome_completo, data_nascimento, cpf, endereco, data_entrada_casa,
                                  nome_mae, nome_pai, historico_psiquiatrico, toma_medicamento,
                                  medicamento_especifico, entorpecentes_usados, observacao_profissional)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ssssssiiisss",
        $nome_completo, 
        $data_nascimento, 
        $cpf, 
        $endereco, 
        $data_entrada_casa,
        $nome_mae, 
        $nome_pai, 
        $historico_psiquiatrico, 
        $toma_medicamento,
        $medicamento_especifico, 
        $entorpecentes_usados, 
        $observacao_profissional
    );

    if ($stmt->execute()) {
        header("Location: lista-alunos.html");
        exit();
    } else {
        echo "Erro: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
