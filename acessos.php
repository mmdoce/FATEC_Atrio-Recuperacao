<?php include 'includes/proteger.php'; ?>
<?php include 'includes/conexao.php'; ?>
<?php include 'side-bar/sidebar.html'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Acessos</title>

    <link rel="stylesheet" 
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="assents\css\style_interno.css">
</head>
<body>

<div class="page-content">

    <h2 style="margin-bottom: 20px;">
        <i class="fa-solid fa-key"></i> Gerenciar Acessos
    </h2>

    <div style="background: var(--sec-color); padding: 20px; border-radius: 10px; box-shadow: var(--accents) 0 2px 5px;">
        
        <form action="salvar-usuario.php" method="POST" style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">

            <div>
                <label class="form-label">Nome</label>
                <input class="form-entry" type="text" name="nome" required>
            </div>

            <div>
                <label class="form-label">E-mail</label>
                <input class="form-entry" type="email" name="email" required>
            </div>

            <div>
                <label class="form-label">Senha</label>
                <input class="form-entry" type="password" name="senha" required>
            </div>

            <div>
                <label class="form-label">Nível de acesso</label>
                <select class="form-entry" name="nivel" required>
                    <option value="">Selecione</option>
                    <option value="admin">Administrador</option>
                    <option value="monitor">Monitor</option>
                    <option value="basico">Básico</option>
                </select>
            </div>

            <button class="btn-geral" type="submit" style="grid-column: span 2;">
                Cadastrar Usuário
            </button>
        </form>
    </div>

    <br><br>

    <h3>Usuários cadastrados</h3>

    <table style="width:100%; margin-top:15px; background:white; border-radius:10px; overflow:hidden;">
        <thead style="background: var(--prim-color); color:white;">
            <tr>
                <th style="padding:10px; text-align:left;">Nome</th>
                <th style="padding:10px; text-align:left;">E-mail</th>
                <th style="padding:10px; text-align:left;">Nível</th>
                <th style="padding:10px;">Ações</th>
            </tr>
        </thead>
        <tbody>

        <?php
        $sql = "SELECT * FROM usuarios ORDER BY id DESC";
        $result = $conn->query($sql);

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                echo "
                <tr style='border-bottom:1px solid #ddd;'>
                    <td style='padding:10px;'>{$row['nome']}</td>
                    <td style='padding:10px;'>{$row['email']}</td>
                    <td style='padding:10px;'>{$row['nivel']}</td>
                    <td style='padding:10px; text-align:center;'>
                        <a href='editar-usuario.php?id={$row['id']}'>
                            <i class='fa-solid fa-pen' style='color:#007bff;'></i>
                        </a>
                        &nbsp;&nbsp;
                        <a href='excluir-usuario.php?id={$row['id']}' onclick='return confirm(\"Tem certeza?\")'>
                            <i class='fa-solid fa-trash' style='color:#e63946;'></i>
                        </a>
                    </td>
                </tr>
                ";
            }
        } else {
            echo "<tr><td colspan='4' style='padding:10px;'>Nenhum usuário encontrado.</td></tr>";
        }
        ?>

        </tbody>
    </table>

</div>

</body>
</html>
