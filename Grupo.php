<?php
// participantes.php

// Array com os dados dos integrantes da equipe
$participantes = [
    [
        "nome" => "Guilherme",
        "cargo" => "Desenvolvedor Fullstack & Coordenador do Projeto",
        "descricao" => "Responsável pela programação do site, integração com banco de dados e implementação de funcionalidades como cadastro e login.",
        "imagem" => "imagem/gui2.webp"
    ],
    [
        "nome" => "David",
        "cargo" => "Designer & UI/UX",
        "descricao" => "Criou o layout do site, cuidou da estética, cores, tipografia e experiência do usuário.",
        "imagem" => "imagem/David.webp"
    ],
    [
        "nome" => "Maria",
        "cargo" => "Gerente de Conteúdo & Social Media",
        "descricao" => "Responsável pelos textos, descrição das funcionalidades, conteúdo do site e comunicação nas redes sociais.",
        "imagem" => "imagem/Maria.jpg"
    ],
    [
        "nome" => "Miguel",
        "cargo" => "Analista de Banco de Dados",
        "descricao" => "Gerenciou a criação das tabelas, relacionamentos, segurança e armazenamento de dados do sistema.",
        "imagem" => "imagem/miguel.png"
    ],
    [
        "nome" => "Thiago",
        "cargo" => "Tester & QA",
        "descricao" => "Responsável pelos testes do site, garantindo que todas as funcionalidades funcionem corretamente e sem erros.",
        "imagem" => "imagem/Thiago.jpg"
    ],
    [
        "nome" => "Caio",
        "cargo" => "Marketing & Divulgação",
        "descricao" => "Planejou estratégias de divulgação, comunicação e engajamento do público para o projeto EcoLink.",
        "imagem" => "imagem/Caio.jpg"
    ]
];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Participantes - EcoLink</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="imagem/png" href="imagem/LOGO-EL.png">

    <style>
        /* Fundo com visual mais artístico e com gradiente suave */
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #1a1a2e, #16213e, #0f3460);
            color: white;
            font-family: Arial, sans-serif;
        }

        /* Container principal da página */
        .container {
            max-width: 1000px;
            margin: 30px auto; /* Reduzi a margem para subir o título */
            padding: 0px;
        }

        /* Título principal */
        h2 {
            text-align: center;
            color: #d4af37; /* Dourado elegante */
            margin-bottom: 40px;
            margin-top: 10px; /* Posição mais alta */
            text-shadow: 0px 0px 10px #000;
            font-size: 2.3em;
        }

        /* Grade de participantes */
        .participants-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 25px;
        }

        /* Cartão individual de cada participante */
        .participant-card {
            background: rgba(255, 255, 255, 0.08); /* Fundo translúcido */
            border-radius: 15px;
            padding: 25px;
            min-height: 340px;
            text-align: center;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.4);
            transition: all 0.5s ease;
            position: relative;
            overflow: hidden;
        }

        /* Efeito de gradiente animado ao passar o mouse */
        .participant-card::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(45deg, #d4af37, #8e44ad, #1abc9c);
            opacity: 0;
            transition: opacity 0.5s ease;
            z-index: 0;
        }

        /* Ativa o gradiente ao passar o mouse */
        .participant-card:hover::before {
            opacity: 0.4;
        }

        /* Faz a caixa "pular" levemente */
        .participant-card:hover {
            transform: translateY(-8px);
        }

        /* Imagem de cada participante */
        .participant-card img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 10px;
            border: 3px solid #d4af37;
            position: relative;
            z-index: 1;
        }

        /* Nome do participante */
        .participant-card h3 {
            margin: 15px 0 8px;
            color: #fff;
            font-size: 20px;
            position: relative;
            z-index: 1;
        }

        /* Cargo */
        .participant-card p.cargo {
            font-weight: bold;
            color: #00ffcc;
            /* Cor aqua */
            font-size: 16px;
            text-shadow: 0 0 3px #ff00ff, 0 0 6px #00ffff;
            margin-bottom: 15px;
            position: relative;
            z-index: 1;
        }

        /* Descrição */
        .participant-card p.descricao {
            font-size: 15px;
            color: #ddd;
            line-height: 1.5;
            position: relative;
            z-index: 1;
        }

        /* Rodapé */
        footer {
            text-align: center;
            padding: 25px;
            background-color: #0f2027;
            color: #bbb;
            margin-top: 40px;
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        /* Easter egg animado */
        .easter-egg {
            position: fixed;
            bottom: 30px;
            right: 0;
            width: 30px;
            height: 30px;
            background-image: url('imagem/mamaco.jpg');
            background-size: contain;
            background-repeat: no-repeat;
            opacity: 0.5; /* Mais visível */
            animation: mover 4s ease-in-out infinite alternate;
            z-index: 999;
        }

        /* Movimento lateral */
        @keyframes mover {
            0% { transform: translateX(0px); }
            100% { transform: translateX(-40px); }
        }
    </style>
</head>

<body>
    <!-- Cabeçalho fixo com navegação -->
    <header>
        <div class="navegar">
            <h1>EcoLink</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="cadastro.php">Cadastro</a></li>
                    <li><a href="vagas.php">Vagas</a></li>
                    <li><a href="doacao.php">Doação</a></li>
                    <li><a href="contato.php">Contato</a></li>
                    <li><a href="Grupo.php" class="active">Participantes</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Conteúdo principal -->
    <main class="container">
        <h2>Nosso Time</h2>
        <div class="participants-grid">
            <?php foreach ($participantes as $p): ?>
                <div class="participant-card">
                    <img src="<?php echo $p['imagem']; ?>" alt="<?php echo $p['nome']; ?>">
                    <h3><?php echo $p['nome']; ?></h3>
                    <p class="cargo"><?php echo $p['cargo']; ?></p>
                    <p class="descricao"><?php echo $p['descricao']; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <!-- Rodapé -->
    <footer>
        <p>© 2025 EcoLink - EcoVocação. Todos os direitos reservados do nome registrado "GrupoGostosinho©".</p>
        <p>Desenvolvido para promover sustentabilidade e impacto social positivo 🌱</p>
    </footer>

    <!-- Easter egg animado -->
    <div class="easter-egg"></div>
</body>
</html>
