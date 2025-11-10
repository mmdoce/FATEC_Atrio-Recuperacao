<?php
include 'conexao.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta os dados 
    $nome_completo = $conn->real_escape_string($_POST['nome_completo']);
    $data_nascimento = $conn->real_escape_string($_POST['data_nascimento']);
    $cpf = $conn->real_escape_string($_POST['cpf']);
    
    // Coletar todos os outros campos
    $endereco = isset($_POST['endereco']) ? $conn->real_escape_string($_POST['endereco']) : NULL;
    $data_entrada_casa = isset($_POST['data_entrada_casa']) && $_POST['data_entrada_casa'] != '' ? $conn->real_escape_string($_POST['data_entrada_casa']) : NULL;
    $nome_mae = isset($_POST['nome_mae']) ? $conn->real_escape_string($_POST['nome_mae']) : NULL;
    $nome_pai = isset($_POST['nome_pai']) ? $conn->real_escape_string($_POST['nome_pai']) : NULL;
    
    $historico_psiquiatrico = isset($_POST['historico_psiquiatrico']) && $_POST['historico_psiquiatrico'] == 'sim' ? 1 : 0;
    $toma_medicamento = isset($_POST['toma_medicamento']) && $_POST['toma_medicamento'] == 'sim' ? 1 : 0;
    $medicamento_especifico = isset($_POST['medicamento_especifico']) ? $conn->real_escape_string($_POST['medicamento_especifico']) : NULL;
    $entorpecentes_usados = isset($_POST['entorpecentes_usados']) ? $conn->real_escape_string($_POST['entorpecentes_usados']) : NULL;
    $observacao_profissional = isset($_POST['observacao_profissional']) ? $conn->real_escape_string($_POST['observacao_profissional']) : NULL;


    $sql = "INSERT INTO Pacientes (nome_completo, data_nascimento, cpf, endereco, data_entrada_casa, 
                                  nome_mae, nome_pai, historico_psiquiatrico, toma_medicamento, 
                                  medicamento_especifico, entorpecentes_usados, observacao_profissional)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssbssss", $nome_completo, $data_nascimento, $cpf, $endereco, $data_entrada_casa, 
                                    $nome_mae, $nome_pai, $historico_psiquiatrico, $toma_medicamento, 
                                    $medicamento_especifico, $entorpecentes_usados, $observacao_profissional);

    if ($stmt->execute()) {
        echo "Novo paciente cadastrado com sucesso!";
        // Redireciona para lista
        header("Location: lista-alunos.html"); 
        exit();
    } else {
        echo "Erro: " . $stmt->error;
    }
    $stmt->close();
}

// 6. Fecha a conexão
$conn->close();
?>