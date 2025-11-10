<?php
include('config/config.php');
$mensagem = "";

// ==========================
// PUBLICAR VAGA (EMPRESA)
// ==========================
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["acao"]) && $_POST["acao"] == "publicar") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $titulo = $_POST["titulo"];
    $empresa = $_POST["empresa"];
    $area = $_POST["area"];
    $descricao = $_POST["descricao"];

    // 1. Verificar se o usuário existe e é uma empresa
    $sql_user = "SELECT * FROM empresa WHERE email = '$email'";
    $resultado = $conn->query($sql_user);

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
        // 2. Verificar senha
        if (password_verify($senha, $usuario["senha"])) {

            // Upload da imagem
            $imagem = "";
            if (isset($_FILES["imagem"]) && $_FILES["imagem"]["error"] == 0) {
                $nome_arquivo = basename($_FILES["imagem"]["name"]);
                $caminho = "uploads/" . $nome_arquivo;
                move_uploaded_file($_FILES["imagem"]["tmp_name"], $caminho);
                $imagem = $nome_arquivo;
            }

            // Inserir vaga
            $sql_vaga = "INSERT INTO vagas (titulo, empresa, area, descricao, imagem)
                        VALUES ('$titulo', '$empresa', '$area', '$descricao', '$imagem')";

            if ($conn->query($sql_vaga) === TRUE) {
                $mensagem = "✅ Vaga publicada com sucesso!";
            } else {
                $mensagem = "❌ Erro ao publicar vaga: " . $conn->error;
            }
        } else {
            $mensagem = "⚠️ Senha incorreta para o e-mail informado.";
        }
    } else {
        $mensagem = "⚠️ E-mail não encontrado ou usuário não é uma empresa.";
    }
}

// ==========================
// CANDIDATAR-SE (PROFISSIONAL)
// ==========================
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["acao"]) && $_POST["acao"] == "candidatar") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $vaga_id = $_POST["vaga_id"];

    $sql_user = "SELECT * FROM usuarios WHERE email = '$email' AND tipo = 'profissional'";
    $resultado = $conn->query($sql_user);

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
        if (password_verify($senha, $usuario["senha"])) {
            $mensagem = "✅ Candidatura enviada com sucesso para a vaga #$vaga_id!";
        } else {
            $mensagem = "⚠️ Senha incorreta para o e-mail informado.";
        }
    } else {
        $mensagem = "⚠️ E-mail não encontrado ou usuário não é profissional.";
    }
}

// ==========================
// CONSULTAR TODAS AS VAGAS
// ==========================
$result = $conn->query("SELECT * FROM vagas ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Vagas - EcoLink</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="vagas.css">
    <link rel="icon" type="image/png" href="imagem/LOGO-EL.png">

    <style>
        .mensagem {
            margin: 20px auto;
            padding: 10px;
            border-radius: 8px;
            text-align: center;
            font-weight: bold;
            width: 80%;
        }

        .sucesso {
            background: #d4edda;
            color: #155724;
        }

        .erro {
            background: #f8d7da;
            color: #721c24;
        }

        .container select {
            margin-left: 10px;
        }
/*
        .card {
            border: 1px solid #ccc;
            padding: 15px;
            border-radius: 10px;
            margin: 10px 0;
        }*/

        .card img {
            display: block;
            margin: 0 auto;
            width: 65%;
            border-radius: 10px;
        }


        form input,
        form textarea {
            width: 100%;
            margin-bottom: 10px;
        }

        button {
            background: #2f855a;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #276749;
        }
    </style>

    <script>
        function mudarTipoUsuario() {
            const tipo = document.getElementById("tipoUsuario").value;
            document.getElementById("formEmpresa").style.display = (tipo === "empresa") ? "block" : "none";
            document.getElementById("vagasListadas").style.display = (tipo === "profissional") ? "block" : "none";
        }
    </script>
</head>

<body>
    <header>
        <div class="navegar">
            <h1>EcoLink</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="cadastro.php">Cadastro</a></li>
                    <li><a href="vagas.php" class="active">Vagas</a></li>
                    <li><a href="doacao.php">Doação</a></li>
                    <li><a href="contato.php">Contato</a></li>
                    <li><a href="Grupo.php">Participantes</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container">
        <h2>
            Vagas Sustentáveis
            <select id="tipoUsuario" onchange="mudarTipoUsuario()">
                <option value="">Selecione</option>
                <option value="profissional">Profissional</option>
                <option value="empresa">Empresa</option>
            </select>
        </h2>

        <?php
        if ($mensagem != "") {
            $classe = (str_contains($mensagem, "✅")) ? "sucesso" : "erro";
            echo "<div class='mensagem $classe'>$mensagem</div>";
        }
        ?>

        <!-- FORMULÁRIO PARA EMPRESA -->
        <div id="formEmpresa" style="display:none;">
            <h3>Publicar Nova Vaga</h3>
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="acao" value="publicar">

                <label>Título:</label>
                <input type="text" name="titulo" required>

                <label>Empresa:</label>
                <input type="text" name="empresa" required>

                <label>Área:</label>
                <input type="text" name="area" required>

                <label>Descrição:</label>
                <textarea name="descricao" required></textarea>

                <label>Imagem (opcional):</label>
                <input type="file" name="imagem" accept="image/*">

                <label>Email:</label>
                <input type="email" name="email" required>

                <label>Senha:</label>
                <input type="password" name="senha" required>

                <button type="submit">Publicar Vaga</button>
            </form>
        </div>

        <!-- LISTA DE VAGAS PARA PROFISSIONAL -->
        <div id="vagasListadas" style="display:none;">
            <h3>Vagas Disponíveis</h3>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='card'>";
                    if (!empty($row['imagem'])) {
                        echo "<img src='uploads/" . $row['imagem'] . "' alt='Imagem da vaga' style='width:65%; border-radius:10px;'>";
                    }
                    echo "<h3>" . $row['titulo'] . "</h3>";
                    echo "<p><strong>Empresa:</strong> " . $row['empresa'] . "</p>";
                    echo "<p><strong>Área:</strong> " . $row['area'] . "</p>";
                    echo "<p>" . $row['descricao'] . "</p>";

                    echo "<form method='POST'>
                            <input type='hidden' name='acao' value='candidatar'>
                            <input type='hidden' name='vaga_id' value='" . $row['id'] . "'>
                            <h3><strong> Se candidate para essa vaga se for de seu interesse.</strong></h3>
                            <label>Email:</label>
                            <input type='email' name='email' required>
                            <label>Senha:</label>
                            <input type='password' name='senha' required>
                            <button type='submit'>Candidatar-se</button>
                        </form>";
                    echo "</div>";
                }
            } else {
                echo "<p class='card'>Nenhuma vaga disponível no momento.</p>";
            }
            ?>
        </div>
    </main>

    <footer>
        <p>© 2025 EcoLink - EcoVocação. Todos os direitos reservados do nome registrado "GrupoGostosinho©".</p>
        <p>Desenvolvido para promover sustentabilidade e impacto social positivo 🌱</p>
    </footer>
</body>

</html>