<?php
// aluno-ficha.php
include 'includes/conexao.php';

if (!isset($_GET['id'])) die("Paciente não especificado!");

$id = $_GET['id'];

// Paciente
$sql = "SELECT * FROM paciente WHERE id_paciente = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$paciente = $result->fetch_assoc();
if (!$paciente) die("Paciente não encontrado!");

// Sessões PASS
$sql_sessoes = "SELECT * FROM pas WHERE id_paciente = ? ORDER BY data_criacao DESC";
$stmt_sess = $connection->prepare($sql_sessoes);
$stmt_sess->bind_param("i", $id);
$stmt_sess->execute();
$result_sess = $stmt_sess->get_result();
$sessoes = $result_sess->fetch_all(MYSQLI_ASSOC);

// Botão nova sessão
$ultima_sessao = $sessoes[0]['data_criacao'] ?? null;
$mostrar_botao = false;
if (!$ultima_sessao || (new DateTime())->diff(new DateTime($ultima_sessao))->days >= 15) {
    $mostrar_botao = true;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ficha do Paciente</title>
<link rel="stylesheet" href="assets/css/style_interno.css">
<link rel="stylesheet" href="slide-bar/ESTILO.css">
<style>
/* Layout geral */
body { margin: 0; font-family: Arial, sans-serif; display: flex; }
#app { flex: 1; display: flex; }
.main { flex: 1; padding: 20px; }

/* Sidebar fixa */
.sidebar { position: fixed; left: 0; top: 0; bottom: 0; width: 220px; background: #1f1f1f; color: #fff; }

/* Container do conteúdo principal */
#info { margin-left: 240px; max-width: 900px; }

/* Header */
.header h2 { margin-bottom: 20px; }

/* Foto e upload */
.foto-box { text-align: center; margin-bottom: 20px; }
.foto-perfil { width: 130px; height: 130px; object-fit: cover; border-radius: 50%; border: 3px solid #ddd; margin-bottom: 10px; }
.btn-upload { display: inline-block; padding: 6px 12px; background: #2D4BFF; color: #fff; border-radius: 6px; cursor: pointer; font-size: 14px; }
.btn-upload input { display: none; }

/* Cards de dados do paciente */
.card { background: #f8f8f8; padding: 15px; margin-bottom: 15px; border-radius: 8px; box-shadow: 0 0 5px rgba(0,0,0,0.1); }
.card label { font-weight: bold; display: block; margin-top: 10px; }
.card input, .card textarea { width: 100%; padding: 6px; margin-top: 4px; border-radius: 4px; border: 1px solid #ccc; }

/* Sessões PASS */
.sessoes-box { background: #fff; padding: 15px; border-radius: 8px; border: 1px solid #ccc; margin-top: 20px; }
.sessoes-box ul { list-style: none; padding: 0; margin: 0; }
.sessoes-box li { display: flex; justify-content: space-between; margin-bottom: 8px; }
.btn-geral { padding: 6px 12px; background: #2D4BFF; color: #fff; border: none; border-radius: 6px; cursor: pointer; text-decoration: none; display: inline-block; }
.btn-nobg a { color: #2D4BFF; text-decoration: none; }

/* Responsivo */
@media(max-width: 768px){
    #info { margin-left: 0; padding: 10px; }
}
</style>
</head>
<body id="app">

<?php include 'slide-bar/sidebar.html'; ?>

<main class="main">
    <button class="btn-nobg"><a href="lista-alunos.php">&larr; Voltar</a></button>

    <div id="info">
        <div class="header"><h2>Ficha do Paciente</h2></div>

        <!-- Foto e Upload -->
        <div class="foto-box">
           <img src="uploads/<?= htmlspecialchars($paciente['foto'] ?? 'default.png') ?>" class="foto-perfil">
           
            <form action="includes/upload-foto.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_paciente" value="<?= $paciente['id_paciente'] ?>">
                <label class="btn-upload">
                    <input type="file" name="foto" accept="image/*" onchange="this.form.submit()">
                    📸 Upload Foto
                </label>
            </form>
        </div>

        <!-- Dados do paciente em card -->
        <div class="card">
            <form action="includes/editar-aluno.php" method="post">
                <input type="hidden" name="id_paciente" value="<?= $paciente['id_paciente'] ?>">

                <label>Nome Completo</label>
                <input type="text" name="nome" value="<?= htmlspecialchars($paciente['nome']) ?>">

                <label>Data de Nascimento</label>
                <input type="date" name="data_nascimento" value="<?= $paciente['data_nascimento'] ?>">

                <label>CPF</label>
                <input type="text" name="cpf" value="<?= $paciente['cpf'] ?>">

                <label>Endereço</label>
                <input type="text" name="endereco" value="<?= htmlspecialchars($paciente['endereco']) ?>">

                <label>Data de Entrada na Casa</label>
                <input type="date" name="data_entrada" value="<?= $paciente['data_entrada'] ?>">

               <label>Acompanhamento Psiquiátrico?</label>
                <p><?= $paciente['historico_psiquiatrico'] == 1 ? 'Sim' : 'Não' ?></p>
                <label>Toma Medicamento?</label>

                <p><?= ucfirst($paciente['toma_medicamento']) ?></p>

                <label>Acompanhamento Psiquiátrico?</label>

                <p><?= ucfirst($paciente['historico_psiquiatrico']) ?></p>

                <label>Especifique</label>
                <input type="text" name="medicamento_especificar" value="<?= htmlspecialchars($paciente['medicamento_especificar']) ?>">

                <label>Entorpecentes Usados</label>
                <input type="text" name="entorpecentes_usados" value="<?= htmlspecialchars($paciente['entorpecentes_usados']) ?>">

                <label>Nome da Mãe</label>
                <input type="text" name="nome_mae" value="<?= htmlspecialchars($paciente['nome_mae']) ?>">

                <label>Nome do Pai</label>
                <input type="text" name="nome_pai" value="<?= htmlspecialchars($paciente['nome_pai']) ?>">

                <label>Observação Profissional</label>
                <textarea name="observacao_profissional"><?= htmlspecialchars($paciente['observacao_profissional']) ?></textarea>

                <button type="submit" class="btn-geral">Salvar Alterações</button>
            </form>
        </div>

<!-- Sessões PASS -->
<div class="sessoes-box">
    <h3>Sessões PASS</h3>

    <?php if (!empty($sessoes)): ?>
        <ul class="lista-sessoes">
            <?php foreach($sessoes as $sessao): ?>
                <li class="sessao-item">
                    <div class="sessao-info">
                        <span class="sessao-data"><?= date('d/m/Y', strtotime($sessao['data_criacao'])) ?></span>
                        <span class="sessao-id">#<?= $sessao['id_pas'] ?></span>
                    </div>
                    <a href="PASS-detalhes.php?id=<?= $sessao['id_pas'] ?>" class="btn-ver">Ver →</a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p class="nenhuma-sessao">Nenhuma sessão registrada.</p>
    <?php endif; ?>
</div>



        <!-- Botão nova sessão -->
        <?php if ($mostrar_botao): ?>
            <a href="PASS-novo.php?id=<?= $paciente['id_paciente'] ?>" class="btn-geral">Nova Sessão</a>
        <?php else: ?>
            <p>Não é possível criar uma nova sessão antes de 15 dias da última.</p>
        <?php endif; ?>
    </div>
</main>

<script src="slide-bar/script.js"></script>
</body>
</html>
