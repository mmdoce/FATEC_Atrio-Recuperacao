<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Átrio - Lista de Pacientes</title>

    <link rel="stylesheet" href="assets/css/style_interno.css">
    <link rel="stylesheet" href="slide-bar/ESTILO.css">

    <!-- Fontes -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">

    <!-- Ícones -->
    <script src="https://kit.fontawesome.com/6105ef985f.js" crossorigin="anonymous"></script>
</head>

<body id="app">

    <!-- SIDEBAR -->
    <?php include 'slide-bar/sidebar.html'; ?>

    <!-- MAIN -->
    <main class="main">

        <!-- HEADER DA PÁGINA -->
        <div class="header">
            <h2>Todos os pacientes</h2>

            <div style="display:flex; gap:10px; align-items:center;">
                <a href="cadastro.php">
                    <button class="btn-geral">
                        <i class="fa-solid fa-user-plus"></i> Cadastrar aluno
                    </button>
                </a>

                <form action="" method="get" style="display:flex;">
                    <input type="text" name="busca" class="input busca" placeholder="Pesquisar...">
                    <button id="btn-busca" class="button">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </div>
        </div>

        <!-- FILTROS -->
        <nav id="filtro">
            <p>Filtrar:</p>
            <input type="date" class="input">
            <input type="number" class="input" placeholder="Idade">

            <select class="input">
                <option value="">Ordem alfabética</option>
                <option value="">Mais recente</option>
                <option value="">Mais antigo</option>
            </select>
        </nav>

        <!-- LISTA DE PACIENTES -->
        <section id="grade-pac">
            <?php include 'includes/lista.php'; ?>
        </section>

    </main>

    <script src="slide-bar/script.js"></script>
</body>
</html>
