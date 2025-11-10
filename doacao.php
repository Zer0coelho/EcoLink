<?php
// Importa o arquivo de configuração
include('config/config.php');

$result = $conn->query("SELECT * FROM doacoes");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Doação - EcoLink</title>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="doacao.css">
<link rel="icon" type="imagem/png" href="imagem/LOGO-EL.png">

</head>

<body>
<header>
    <div class="navegar">
        <h1>EcoLink</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="cadastro.php">Cadastro</a></li>
                <li><a href="vagas.php">Vagas</a></li>
                <li><a href="doacao.php" class="active">Doação</a></li>
                <li><a href="contato.php">Contato</a></li>
                <li><a href="Grupo.php">Participantes</a></li>
            </ul>
        </nav>
    </div>
</header>

<main class="container">
    <h2>Apoie Empresas Sustentáveis</h2>

    <!-- Caixa de destaque -->
    <div class="doacao-destaque">
        <div class="doacao-imagem">
            <img src="imagem/eco1.jpg" alt="Imagem ilustrativa de projeto sustentável">
            <div class="doacao-info-overlay">
                <h3>Maria, Agricultora Familiar - Projeto Raízes do Futuro 🌱</h3>
                <p>
                    Maria vive no interior de Minas Gerais e lidera uma pequena comunidade de agricultura sustentável. 
                    Ela precisa de apoio para comprar novas mudas e equipamentos de irrigação ecológica. 
                    Sua ajuda pode transformar o futuro da produção local e reduzir o impacto ambiental.
                </p>
            </div>
        </div>

        <div class="qr-area">
            <img src="imagem/essepix.jpg" alt="QR Code para doação">
            <span>Doe via PIX</span>
        </div>
    </div>

    <!-- Caixa de destaque 2 -->
<div class="doacao-destaque">
    <div class="doacao-imagem">
        <img src="imagem/eco2.jpg" alt="Instituto Verde Esperança">
        <div class="doacao-info-overlay">
            <h3>Instituto Verde Esperança 🌳</h3>
            <p>
                O Instituto Verde Esperança atua no reflorestamento da Mata Atlântica e na educação ambiental em escolas públicas.
                Sua doação ajuda a financiar o plantio de árvores e a formação de jovens agentes ambientais.
            </p>
        </div>
    </div>
    <div class="qr-area">
        <img src="imagem/essepix.jpg" alt="QR Code para doação">
        <span>Doe via PIX</span>
    </div>
</div>

    <!-- Caixa de destaque 3 -->
<div class="doacao-destaque">
    <div class="doacao-imagem">
        <img src="imagem/Mar-Azul.jpeg" alt="Associação Mar Azul">
        <div class="doacao-info-overlay">
            <h3>Associação Mar Azul 🌊</h3>
            <p>
                A Associação Mar Azul trabalha na limpeza de praias e na recuperação de corais no litoral nordestino.
                Sua contribuição ajuda a financiar mergulhos ecológicos e ações educativas com pescadores locais.
            </p>
        </div>
    </div>
    <div class="qr-area">
        <img src="imagem/outropix.jpg" alt="QR Code para doação">
        <span>Doe via PIX</span>
    </div>
</div>

<!-- Caixa de destaque 4 -->
<div class="doacao-destaque">
    <div class="doacao-imagem">
        <img src="imagem/agua-limpa.jpg" alt="Projeto Água Limpa">
        <div class="doacao-info-overlay">
            <h3>Projeto Água Limpa 💧</h3>
            <p>
                O Projeto Água Limpa trabalha para levar água potável para comunidades rurais do Nordeste brasileiro,
                construindo sistemas de captação e tratamento sustentável. Sua doação ajuda a transformar vidas.
            </p>
        </div>
    </div>
    <div class="qr-area">
        <img src="imagem/essepix.jpg" alt="QR Code para doação">
        <span>Doe via PIX</span>
    </div>
</div>

<!-- Caixa de destaque 5 -->
<div class="doacao-destaque">
    <div class="doacao-imagem">
        <img src="imagem/eco5.jpg" alt="Fundação Verde Amazônia">
        <div class="doacao-info-overlay">
            <h3>Fundação Verde Amazônia 🌳</h3>
            <p>
                Dedicada à conservação da floresta amazônica, a Fundação Verde Amazônia investe em pesquisa e proteção
                das tribos indígenas, além de combater o desmatamento ilegal.
            </p>
        </div>
    </div>
    <div class="qr-area">
        <img src="imagem/outropix.jpg" alt="QR Code para doação">
        <span>Doe via PIX</span>
    </div>
</div>

<!-- Caixa de destaque 6 -->
<div class="doacao-destaque">
    <div class="doacao-imagem">
        <img src="imagem/casa-sus.jpg" alt="Casa Sustentável">
        <div class="doacao-info-overlay">
            <h3>Casa Sustentável 🏡</h3>
            <p>
                A Casa Sustentável promove o ensino de técnicas de construção ecológica e eficiência energética para
                famílias de baixa renda, visando reduzir a pegada ambiental e aumentar qualidade de vida.
            </p>
        </div>
    </div>
    <div class="qr-area">
        <img src="imagem/essepix.jpg" alt="QR Code para doação">
        <span>Doe via PIX</span>
    </div>
</div>

<!-- Caixa de destaque 7 -->
<div class="doacao-destaque">
    <div class="doacao-imagem">
        <img src="imagem/Recicla.webp" alt="Movimento Reciclar é Viver">
        <div class="doacao-info-overlay">
            <h3>Movimento Reciclar é Viver ♻️</h3>
            <p>
                Incentivando a coleta seletiva e reciclagem em comunidades urbanas, o Movimento Reciclar é Viver gera emprego
                e consciência ambiental. Sua doação amplia ações e projetos educacionais.
            </p>
        </div>
    </div>
    <div class="qr-area">
        <img src="imagem/essepix.jpg" alt="QR Code para doação">
        <span>Doe via PIX</span>
    </div>
</div>

<!-- Caixa de destaque 8 -->
<div class="doacao-destaque">
    <div class="doacao-imagem">
        <img src="imagem/energia.webp" alt="Projeto Energia Limpa">
        <div class="doacao-info-overlay">
            <h3>Projeto Energia Limpa ⚡</h3>
            <p>
                O Projeto Energia Limpa investe em fontes renováveis para comunidades isoladas, como painéis solares e
                mini-eólicas, garantindo energia sustentável e barata.
            </p>
        </div>
    </div>
    <div class="qr-area">
        <img src="imagem/outropix.jpg" alt="QR Code para doação">
        <span>Doe via PIX</span>
    </div>
</div>


    <!-- Lista das doações do banco -->
    <?php
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div class='card'>";
            echo "<p><strong>Empresa:</strong> ".$row['empresa']."</p>";
            echo "<p><strong>Valor de Doação:</strong> R$ ".$row['valor']."</p>";
            echo "</div>";
        }
    } else {
        echo "<p class='card'>Nenhuma empresa cadastrada no momento.</p>";
    }
    ?>
</main>

<footer>
    <p>© 2025 EcoLink - EcoVocação. Todos os direitos reservados do nome registrado "GrupoGostosinho©".</p>
    <p>Desenvolvido para promover sustentabilidade e impacto social positivo 🌱</p>
</footer>
</body>
</html>
