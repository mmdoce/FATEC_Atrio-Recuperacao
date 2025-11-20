<?php
include 'includes/conexao.php'; // IMPORTANTE: conexão primeiro

$nome = "";
$email = "";
$senha_hash = "";
$perfil = "";
$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha_hash = $_POST['senha'] ?? '';
    $perfil = $_POST['nivel'] ?? '';

    // Validação
    if (empty($nome) || empty($email) || empty($senha_hash) || empty($perfil) ) {
        $errorMessage = "Preencha todos os campos.";
    } else {

      
       

        $sql = "INSERT INTO usuarios (nome, email, senha_hash, perfil)
                VALUES (?, ?, ?, ?)";

        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ssss", $nome, $email, $senha_hash, $perfil);

        if ($stmt->execute()) {
            $successMessage = "Usuário cadastrado com sucesso!";
            header("Location: acessos.php");
            exit;
        } else {
            $errorMessage = "Erro ao cadastrar: " . $connection->error;
        }

        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Acessos</title>

    <link rel="stylesheet" href="assets/css/style_interno.css">
    <link rel="stylesheet" href="slide-bar/ESTILO.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style> /* Reset básico */ * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Arial', sans-serif; } /* Corpo e layout principal */ body { display: flex; min-height: 100vh; background-color: #f5f5f5; color: #333; } /* Sidebar (mantendo a existente) */ .sidebar { width: 250px; /* ajuste conforme seu sidebar.html */ background-color: #1f2937; color: #fff; display: flex; flex-direction: column; } /* Page content */ .page-content { flex: 1; padding: 30px; margin-left: 250px; /* mesma largura da sidebar */ } /* Títulos */ .page-content h2, .page-content h3 { color: #1f2937; margin-bottom: 20px; } /* Formulário */ form { background-color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); } .form-label { display: block; margin-bottom: 5px; font-weight: bold; } .form-entry { width: 100%; padding: 8px 12px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px; transition: all 0.2s; } .form-entry:focus { outline: none; border-color: #3b82f6; /* azul suave */ box-shadow: 0 0 5px rgba(59,130,246,0.3); } /* Botão */ .btn-geral { background-color: #3b82f6; color: #fff; border: none; padding: 12px 20px; border-radius: 6px; cursor: pointer; font-weight: bold; transition: background 0.2s; } .btn-geral:hover { background-color: #2563eb; } /* Tabela de usuários */ table { width: 100%; border-collapse: collapse; background-color: #fff; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.05); } table thead { background-color: #3b82f6; color: #fff; } table th, table td { padding: 12px; text-align: left; } table tbody tr:nth-child(even) { background-color: #f0f4f8; } table tbody tr:hover { background-color: #e0e7ff; } /* Responsivo */ @media (max-width: 768px) { body { flex-direction: column; } .sidebar { width: 100%; height: auto; } .page-content { margin-left: 0; padding: 20px; } form { grid-template-columns: 1fr !important; } } .content-container { display: flex; flex-direction: column; /* Força os elementos internos a ficarem na vertical */ gap: 30px; /* Espaçamento entre o formulário e a tabela */ } /* Ajuste o formulário para ter 100% de largura */ .cadastro-container { /* Opcional: Adicionar um container para gerenciar o formulário */ background-color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); } /* Remova o display: grid; inline do form e aplique aqui */ #cadastroForm { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; padding: 0; /* Remove o padding do form, pois colocamos no .cadastro-container */ background: none; /* Remove o background do form, pois colocamos no .cadastro-container */ box-shadow: none; /* Remove a sombra do form, pois colocamos no .cadastro-container */ } /* Opcional: Ajustar o grid responsivo para o formulário */ @media (max-width: 900px) { /* Ajuste o breakpoint se necessário */ #cadastroForm { grid-template-columns: 1fr; /* Coluna única em telas menores */ } } </style>

</head>
<body>

<?php include 'slide-bar/sidebar.html'; ?>

<div class="page-content">

    <h2><i class="fa-solid fa-key"></i> Gerenciar Acessos</h2>

    <!-- MENSAGENS -->
    <?php if (!empty($errorMessage)): ?>
        <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
    <?php endif; ?>

    <?php if (!empty($successMessage)): ?>
        <div class="alert alert-success"><?php echo $successMessage; ?></div>
    <?php endif; ?>

    <!-- FORM DE CADASTRO -->
    <div class="cadastro-container">
        <form action="" method="POST" id="cadastroForm"> 

            <div>
                <label class="form-label">Nome</label>
                <input class="form-entry" type="text" name="nome" required value="<?php echo $nome; ?>">
            </div>

            <div>
                <label class="form-label">E-mail</label>
                <input class="form-entry" type="email" name="email" required value="<?php echo $email; ?>">
            </div>

            <div>
                <label class="form-label">Senha</label>
                <input class="form-entry" type="password" name="senha" required value="<?php echo $senha_hash; ?>">
            </div>

            <div>
                <label class="form-label">Nível de acesso</label>
                <select class="form-entry" name="nivel" required>
                    <option value="">Selecione</option>
                    <option value="admin"   <?php echo ($perfil == 'admin')   ? 'selected' : ''; ?>>Administrador</option>
                    <option value="monitor" <?php echo ($perfil == 'monitor') ? 'selected' : ''; ?>>Monitor</option>
                    <option value="basico"  <?php echo ($perfil == 'basico')  ? 'selected' : ''; ?>>Básico</option>
                </select>
            </div>

            <button class="btn-geral" type="submit" style="grid-column: span 2;">
                Cadastrar Usuário
            </button>
        </form>
    </div>

    <h3>Usuários cadastrados</h3>

    <!-- TABELA -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Nível</th>
                <th>Data Entrada</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            <?php
                $sql = "SELECT usuario_id, nome, email, perfil, data_cadastro, senha_hash FROM usuarios ORDER BY usuario_id DESC";
                $result = $connection->query($sql);

                if (!$result) {
                    die("Erro ao buscar usuários: " . $connection->error);
                }

                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>{$row['usuario_id']}</td>
                        <td>{$row['nome']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['perfil']}</td>
                        <td>{$row['data_cadastro']}</td>
                        <td>
                            <a href='includes/edit.php?usuario_id={$row['usuario_id']}' class='btn-edit'>Editar</a>
                            <a href='includes/delete.php?usuario_id={$row['usuario_id']}' class='btn-delet'>Deletar</a>

                        </td>
                    </tr>";
                }
            ?>
        </tbody>
    </table>

</div>

<script src="slide-bar/script.js"></script>
</body>
</html>
