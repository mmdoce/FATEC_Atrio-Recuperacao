<?php
include 'conexao.php';

// Verifica se o usuário tem permissão para ver a lista
if (!isset($_SESSION['usuario_id']) || $_SESSION['perfil'] == 'GUEST') {
}

$sql = "SELECT paciente_id, nome_completo, cpf, data_entrada_casa, status_cadastro FROM Pacientes ORDER BY nome_completo ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    echo "<table>";
    echo "<thead><tr><th>ID</th><th>Nome</th><th>CPF</th><th>Entrada</th><th>Status</th><th>Ações</th></tr></thead>";
    echo "<tbody>";
    
 
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["paciente_id"] . "</td>";
        echo "<td>" . $row["nome_completo"] . "</td>";
        echo "<td>" . $row["cpf"] . "</td>";
        echo "<td>" . $row["data_entrada_casa"] . "</td>";
        echo "<td>" . $row["status_cadastro"] . "</td>";
        echo "<td><a href='aluno-exemplo.php?id=" . $row["paciente_id"] . "'>Ver Ficha</a></td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
} else {
    echo "Nenhum paciente cadastrado.";
}

$conn->close();
?>