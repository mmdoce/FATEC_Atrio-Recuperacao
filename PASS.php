<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Átrio - Plano de Assistência Singular</title>
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

    <!-- TODO: funcionalidade (e um campo) de adicionar foto -->
    <main class="main">
        <button class="btn-nobg"><a href="aluno-exemplo.html"><i class="fa-solid fa-chevron-left"></i> Voltar</a></button>
        <div id="content">
        <div class="header">
            <h2>Plano de Assistência Singular</h2>
        </div>
        <form action="includes/pass.php" method="post">
            <form-group>
                <!-- descrição da sessão, análise da sessão, observação -->
                <label for="quixa" class="form-label">Queixa principal</label>
                <textarea name="queixa" id="obs" class="form-txt pass"></textarea>
                <label for="desc-sessao" class="form-label">Descrição da sessão</label>
                <textarea name="desc-sessao" id="" class="form-txt pass"></textarea>
                <label for="analise-sessao" class="form-label">Análise da sessão</label>
                <textarea name="analise-sessao" id="" class="form-txt pass"></textarea>
                <label for="obs" class="form-label">Observação</label>
                <textarea name="obs" id="" class="form-txt pass"></textarea>
            </form-group>
            <form-group>
                <h2>Laboterapia</h2>
                <!-- LABOTERAPIA: espiritualidade, evolução de vínculo familiar -->
                <label for="espi" class="form-label">Espíritualidade</label>
                <textarea name="espi" id="" class="form-txt pass"></textarea>
                <label for="evo-vin" class="form-label">Evolução de vínculo familiar</label>
                <textarea name="evo-vin" id="" class="form-txt pass"></textarea>
            </form-group>
            </form>
            <button class="btn-geral">Salvar <i class="fa-solid fa-ellipsis"></i></button>
            <button class="btn-alt">Imprimir</button>
        </form>
        </div>
    </main>
    <section class="profile">
        <div class="profile-info">
            <div>
            <h3>Fulano da Silva</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            <p><strong>Idade: XX</strong></p>
            </div>
            <img 
            src="https://i.pinimg.com/736x/a4/d8/28/a4d8289d97adac030bab9a4e7101bb5b.jpg" 
            alt="Foto do paciente"
            class="pac-icon quad">
        </div>
        <div class="hist-sessao">
            <h2 class="header-hist">Histórico de sessões</h2>
            <div class="sessao">
                <h3>Sessão X</h3>
                <p>23/05/20111</p>
            </div>
            <div class="sessao">
                <h3>Sessão Y</h3>
                <p>23/06/20111</p>
            </div>
            <div class="sessao last">
                <h3>Sessão Z</h3>
                <p>23/07/20111</p>
            </div>
        </div>
    </section>

    <script src="slide-bar/script.js"></script>

</body>
</html>