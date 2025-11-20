<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Átrio - Administração e Formulários</title>
    <link rel="stylesheet" href="assets/css/style_interno.css">
     <link rel="stylesheet" href="slide-bar/ESTILO.css">
    <!-- Fontes personalizadas -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

    <!-- Ícones -->
    <script src="https://kit.fontawesome.com/6105ef985f.js" crossorigin="anonymous"></script>
</head>
<body id="app">

     <?php include 'slide-bar/sidebar.html'; ?>
        
    <main class="main">
        <div class="header">
            <h2>Todos os pacientes</h2>
            <a href="aluno-exemplo.php?id=123">Ver Ficha</a>
            <div>
            <a href="cadastro.html"><button class="btn-geral"><i class="fa-solid fa-user-plus"></i> Cadastrar aluno</button></a>
                <form action="includes/lista.php" method="get"></form>
                <input type="text" class="input busca">
                <button id="btn-busca" class=" button fa-solid fa-magnifying-glass"></button> <!-- TODO: Adicionar o bendito ícone + funcionalidade do botão -->
            </form>
            </div>
        </div>
        <nav id="filtro"> <!-- TODO: Add funcionalidade dos filtros -->
            <p>Filtrar:</p>
            <input type="date" placeholder="Chegada" class="input">
            <input type="number" placeholder="Idade" class="input">
            <select name="ordenacao" id="ordem" class="input">
                <option value="">Ordem alfabética</option> <!-- TODO: Adicionar valor -->
                <option value="">Mais recente</option>
                <option value="">Mais antigo</option>
            </select>
        </nav>
        <section id="grade-pac">
            <div class="card quadrado"> <!-- TODO: Passar os cartões de paciente pra js e json, para automatização e organização. -->
                <a href="aluno-exemplo.html">
                                        <!-- Além disso, os cards deveriam ter um limite de caracteres a serem exbidos por fora, 
                                        a partir disso sendo interrompidos por reticêncicas (...) -->
                <img 
                src="https://i.pinimg.com/736x/a4/d8/28/a4d8289d97adac030bab9a4e7101bb5b.jpg" 
                alt="Foto do paciente"
                class="pac-icon quad">
                <div>
                    <h3 class="espaco">Fulano da Silva</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua... </p>
                    <p><strong>Idade: XX</strong></p>
                    <h4 class="espaco">Pendente : Feito</h4>
                </div>
            </a>
        </section>
    </main>
<<<<<<< HEAD:lista-alunos.php

    <script src="slide-bar/script.js"></script>

=======
    <script src="scripts/pacientes.js"></script>
>>>>>>> b1c3a1814bf17d0c39d817381643fef7c4244a84:lista-alunos.html
</body>
</html>