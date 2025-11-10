<?php
include('config/config.php');

// Captura pesquisa (opcional)
$pesquisa = isset($_GET['empresa']) ? trim($_GET['empresa']) : "";

// Monta consulta SQL
$sql = "SELECT c.id, u.nome AS candidato, u.email, u.area, u.localizacao, 
            v.titulo AS vaga, e.nome AS empresa, c.data_candidatura
        FROM candidaturas c
        INNER JOIN usuarios u ON c.id_usuario = u.id
        INNER JOIN vagas v ON c.id_vaga = v.id
        INNER JOIN empresa e ON v.empresa = e.nome";

if ($pesquisa !== "") {
    $sql .= " WHERE e.nome LIKE ?";
}

$stmt = $conn->prepare($sql);

if ($pesquisa !== "") {
    $param = "%{$pesquisa}%";
    $stmt->bind_param("s", $param);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Candidatos - EcoLink</title>
<link rel="stylesheet" href="style.css">
<link rel="icon" type="imagem/png" href="imagem/LOGO-EL.png">

<style>
/* ======== Estilo isolado para página candidatos ======== */
.candidatos-container {
    max-width: 1000px;
    margin: 60px auto;
    background: #f9fff9;
    padding: 30px 40px;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.candidatos-container h2 {
    text-align: center;
    color: #2e7d32;
    margin-bottom: 20px;
}

.pesquisa-form {
    text-align: center;
    margin-bottom: 25px;
}

.pesquisa-form input {
    width: 300px;
    padding: 10px 14px;
    border: 1px solid #c8e6c9;
    border-radius: 8px;
    font-size: 1rem;
}

.pesquisa-form button {
    background-color: #2e7d32;
    color: white;
    border: none;
    padding: 10px 18px;
    border-radius: 8px;
    cursor: pointer;
    margin-left: 10px;
    transition: 0.3s;
}

.pesquisa-form button:hover {
    background-color: #1b5e20;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}

th, td {
    padding: 12px;
    border-bottom: 1px solid #ddd;
    text-align: center;
}

th {
    background-color: #2e7d32;
    color: white;
}

tr:nth-child(even) {
    background-color: #f1f8f4;
}

tr:hover {
    background-color: #e8f5e9;
    transition: 0.2s;
}

.sem-resultados {
    text-align: center;
    font-weight: 600;
    color: #555;
    margin-top: 25px;
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
                <li><a href="contato.php">Contato</a></li>
                <li><a href="candidatos.php" class="active">Candidatos</a></li>
            </ul>
        </nav>
    </div>
</header>

<main class="candidatos-container">
    <h2>Lista de Candidatos às Vagas</h2>

    <form class="pesquisa-form" method="GET">
        <input type="text" name="empresa" placeholder="Pesquisar por empresa..." value="<?php echo htmlspecialchars($pesquisa); ?>">
        <button type="submit">Pesquisar</button>
    </form>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Candidato</th>
                    <th>E-mail</th>
                    <th>Área</th>
                    <th>Localização</th>
                    <th>Vaga</th>
                    <th>Empresa</th>
                    <th>Data da Candidatura</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['candidato']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['area']); ?></td>
                        <td><?php echo htmlspecialchars($row['localizacao']); ?></td>
                        <td><?php echo htmlspecialchars($row['vaga']); ?></td>
                        <td><?php echo htmlspecialchars($row['empresa']); ?></td>
                        <td><?php echo date('d/m/Y H:i', strtotime($row['data_candidatura'])); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="sem-resultados">Nenhum candidato encontrado para esta pesquisa.</p>
    <?php endif; ?>
</main>

<footer>
    <p>© 2025 EcoLink - EcoVocação. Todos os direitos reservados do nome registrado "GrupoGostosinho©".</p>
</footer>
</body>
</html>
<!-- banco de dados se for usar 
  -- ============================================================
-- Tabela: candidaturas (liga usuários às vagas)
-- ============================================================
CREATE TABLE candidaturas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_vaga INT NOT NULL,
    data_candidatura TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (id_vaga) REFERENCES vagas(id) ON DELETE CASCADE
);
-->