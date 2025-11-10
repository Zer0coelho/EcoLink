<?php
include('config/config.php');

$msg = "";

if (isset($_POST['cadastrar'])) {
    $tipo = $_POST['tipo'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $telefone = $_POST['telefone'] ?? '';
    $area = $_POST['area'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $localizacao = $_POST['localizacao'] ?? '';
    $site = $_POST['site'] ?? '';
    $imagem = null;

    // Upload de imagem apenas se for empresa
    if ($tipo === 'empresa' && isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $dir = "uploads/";
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $nomeArquivo = basename($_FILES['imagem']['name']);
        $extensao = strtolower(pathinfo($nomeArquivo, PATHINFO_EXTENSION));
        $permitidos = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($extensao, $permitidos)) {
            $novoNome = uniqid() . "." . $extensao;
            $caminho = $dir . $novoNome;
            if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho)) {
                $imagem = $caminho;
            } else {
                $msg = "Erro ao enviar a imagem.";
            }
        } else {
            $msg = "Formato de imagem inválido. Envie JPG, PNG ou GIF.";
        }
    }

    // Inserção dependendo do tipo
    if ($tipo === 'empresa') {
        $stmt = $conn->prepare("INSERT INTO empresa (tipo, nome, email, senha, telefone, area, descricao, site) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $tipo, $nome, $email, $senha, $telefone, $area, $descricao, $site);
    } else {
        $stmt = $conn->prepare("INSERT INTO usuarios (tipo, nome, email, senha, telefone, area, descricao, localizacao) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $tipo, $nome, $email, $senha, $telefone, $area, $descricao, $localizacao);
    }

    if ($stmt->execute()) {
        $msg = "✅ Cadastro realizado com sucesso!";
    } else {
        $msg = "❌ Erro ao cadastrar: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Cadastro - EcoLink</title>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="cadastro.css">
<link rel="icon" type="imagem/png" href="imagem/LOGO-EL.png">
<script>
function verificarTipo() {
    const tipo = document.querySelector('select[name="tipo"]').value;
    const campoSite = document.querySelector('input[name="site"]');
    const campoImagem = document.getElementById('imagem');
    const campoLocalizacao = document.querySelector('select[name="localizacao"]');

    if (tipo === 'empresa') {
        campoSite.disabled = false;
        campoImagem.disabled = false;
        campoLocalizacao.disabled = true;
    } else if (tipo === 'profissional') {
        campoSite.disabled = true;
        campoImagem.disabled = true;
        campoLocalizacao.disabled = false;
        campoSite.value = "";
        campoImagem.value = "";
    } else {
        campoSite.disabled = true;
        campoImagem.disabled = true;
        campoLocalizacao.disabled = true;
    }
}
</script>
<style>
.card {
    background: #e7ffe7;
    color: #006400;
    padding: 10px;
    border-radius: 5px;
    text-align: center;
    margin-bottom: 10px;
    border: 1px solid #00aa00;
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
                <li><a href="cadastro.php" class="active">Cadastro</a></li>
                <li><a href="vagas.php">Vagas</a></li>
                <!--<li><a href="candidatos.php">Candidatos</a></li>-->
                <li><a href="doacao.php">Doação</a></li>
                <li><a href="contato.php">Contato</a></li>
                <li><a href="Grupo.php">Participantes</a></li>
            </ul>
        </nav>
    </div>
</header>

<main class="container">
    <h2>Junte-se à nossa comunidade sustentável</h2>
    <?php if ($msg) echo "<p class='card'>$msg</p>"; ?>

    <form method="POST" enctype="multipart/form-data">
        <label>Tipo de Cadastro</label>
        <select name="tipo" required onchange="verificarTipo()">
            <option value="">Selecione</option>
            <option value="profissional">Profissional</option>
            <option value="empresa">Empresa</option>
        </select>

        <label>Nome</label>
        <input type="text" name="nome" required>

        <label>E-mail</label>
        <input type="email" name="email" required>

        <label>Senha</label>
        <input type="password" name="senha" required>

        <label>Telefone</label>
        <input type="text" name="telefone">

        <label>Área / Sustentabilidade</label>
        <input type="text" name="area">

        <label>Descrição</label>
        <textarea name="descricao"></textarea>

        <label>Localização (somente profissionais)</label>
        <select name="localizacao">
            <option value="">Selecione o Estado</option>
            <option value="AC">Acre (AC)</option>
            <option value="AL">Alagoas (AL)</option>
            <option value="AP">Amapá (AP)</option>
            <option value="AM">Amazonas (AM)</option>
            <option value="BA">Bahia (BA)</option>
            <option value="CE">Ceará (CE)</option>
            <option value="DF">Distrito Federal (DF)</option>
            <option value="ES">Espírito Santo (ES)</option>
            <option value="GO">Goiás (GO)</option>
            <option value="MA">Maranhão (MA)</option>
            <option value="MT">Mato Grosso (MT)</option>
            <option value="MS">Mato Grosso do Sul (MS)</option>
            <option value="MG">Minas Gerais (MG)</option>
            <option value="PA">Pará (PA)</option>
            <option value="PB">Paraíba (PB)</option>
            <option value="PR">Paraná (PR)</option>
            <option value="PE">Pernambuco (PE)</option>
            <option value="PI">Piauí (PI)</option>
            <option value="RJ">Rio de Janeiro (RJ)</option>
            <option value="RN">Rio Grande do Norte (RN)</option>
            <option value="RS">Rio Grande do Sul (RS)</option>
            <option value="RO">Rondônia (RO)</option>
            <option value="RR">Roraima (RR)</option>
            <option value="SC">Santa Catarina (SC)</option>
            <option value="SP">São Paulo (SP)</option>
            <option value="SE">Sergipe (SE)</option>
            <option value="TO">Tocantins (TO)</option>
        </select>

        <label>Site (somente empresas)</label>
        <input type="text" name="site" disabled>

        <label>Imagem (somente empresas)</label>
        <input type="file" name="imagem" id="imagem" accept="image/*" disabled>

        <button type="submit" name="cadastrar" class="btn">Cadastrar</button>
    </form>
</main>

<footer>
    <p>© 2025 EcoLink - EcoVocação. Todos os direitos reservados do nome registrado "GrupoGostosinho©".</p>
    <p>Desenvolvido para promover sustentabilidade e impacto social positivo 🌱</p>
</footer>
</body>
</html>
