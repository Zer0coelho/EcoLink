<?php
include('config/config.php');

$msg = "";
if(isset($_POST['enviar'])){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $assunto = $_POST['assunto'];
    $mensagem = $_POST['mensagem'];

    $stmt = $conn->prepare("INSERT INTO contatos (nome,email,assunto,mensagem) VALUES (?,?,?,?)");
    if(!$stmt){
        die("Erro na preparação da query: " . $conn->error);
    }

    $stmt->bind_param("ssss",$nome,$email,$assunto,$mensagem);
    if($stmt->execute()){
        $msg = "🌿 Sua mensagem foi recebida com sucesso! Nossa equipe retornará em breve.";
    } else {
        $msg = "⚠️ Erro ao enviar sua mensagem: ".$stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Contato - EcoLink</title>
<link rel="stylesheet" href="style.css">
<link rel="icon" type="imagem/png" href="imagem/LOGO-EL.png">

<style>
/* ======== Estilo exclusivo para página de Contato ======== */
.contato-container {
    max-width: 750px;
    margin: 60px auto;
    background: linear-gradient(145deg, #14c383ff, #0ef6b4ff);
    border-radius: 15px;
    padding: 40px 50px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.1);
    position: relative;
    overflow: hidden;
}

.contato-container::before {
    content: "";
    position: absolute;
    top: -40px;
    right: -40px;
    width: 180px;
    height: 180px;
    background: rgba(46, 125, 50, 0.08);
    border-radius: 50%;
    z-index: 0;
}

.contato-container h2 {
    text-align: center;
    color: #2e7d32;
    font-size: 2rem;
    margin-bottom: 10px;
    z-index: 1;
    position: relative;
}

.contato-container p.intro {
    text-align: center;
    color: #555;
    font-size: 1.05rem;
    margin-bottom: 35px;
    z-index: 1;
    position: relative;
}

form {
    display: flex;
    flex-direction: column;
    gap: 15px;
    z-index: 1;
    position: relative;
}

label {
    font-weight: 600;
    color: #2e7d32;
    margin-bottom: 4px;
}

input, textarea {
    padding: 12px 14px;
    border-radius: 8px;
    border: 1px solid #c8e6c9;
    font-size: 1rem;
    transition: all 0.3s ease;
}

input:focus, textarea:focus {
    outline: none;
    border-color: #2e7d32;
    box-shadow: 0 0 0 3px rgba(46,125,50,0.2);
}

textarea {
    min-height: 120px;
    resize: vertical;
}

.btn {
    background: #2e7d32;
    color: #fff;
    font-weight: bold;
    padding: 12px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 1.05rem;
    transition: 0.3s;
}

.btn:hover {
    background: #1b5e20;
    transform: scale(1.03);
}

/* Mensagem de sucesso ou erro */
.card {
    background: #e8f5e9;
    color: #2e7d32;
    border-left: 6px solid #2e7d32;
    padding: 15px 20px;
    margin-bottom: 20px;
    border-radius: 8px;
    font-weight: 600;
    text-align: center;
}

/* Responsividade */
@media (max-width: 768px) {
    .contato-container {
        padding: 25px 20px;
        margin: 40px 15px;
    }
}
</style>
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
                <li><a href="doacao.php">Doação</a></li>
                <li><a href="contato.php" class="active">Contato</a></li>
                <li><a href="Grupo.php">Participantes</a></li>
            </ul>
        </nav>
    </div>
</header>

<main class="contato-container">
    <h2>Entre em Contato</h2>
    <p class="intro">
        Quer conversar com a equipe <strong>EcoLink</strong>?  
        Envie sua mensagem — dúvidas, parcerias ou sugestões são sempre bem-vindas 🌱
    </p>

    <?php if($msg): ?>
        <p class="card"><?php echo $msg; ?></p>
    <?php endif; ?>

    <form method="POST">
        <label for="nome">Nome Completo</label>
        <input type="text" id="nome" name="nome" required>

        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" required>

        <label for="assunto">Assunto</label>
        <input type="text" id="assunto" name="assunto" required>

        <label for="mensagem">Mensagem</label>
        <textarea id="mensagem" name="mensagem" required></textarea>

        <button type="submit" name="enviar" class="btn">Enviar Mensagem</button>
    </form>
</main>

<footer>
    <p>© 2025 EcoLink - EcoVocação. Todos os direitos reservados do nome registrado "GrupoGostosinho©".</p>
    <p>Desenvolvido para promover sustentabilidade e impacto social positivo 🌱</p>
</footer>
</body>
</html>
