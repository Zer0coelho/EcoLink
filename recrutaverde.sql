-- Tabela de usuários
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo ENUM('profissional','empresa') NOT NULL,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    telefone VARCHAR(20),
    area VARCHAR(255),
    descricao TEXT,
    localizacao VARCHAR(255),
    site VARCHAR(255)
);

-- Tabela de vagas
CREATE TABLE vagas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    empresa VARCHAR(255) NOT NULL,
    area VARCHAR(255) NOT NULL,
    descricao TEXT NOT NULL,
    imagem VARCHAR(255) DEFAULT NULL -- caminho da imagem no servidor (ex: 'uploads/vaga1.jpg')
);

-- Tabela de doações (simulação)
CREATE TABLE doacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    empresa VARCHAR(255) NOT NULL,
    valor DECIMAL(10,2)
);

-- Tabela de contatos
CREATE TABLE contatos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    assunto VARCHAR(255) NOT NULL,
    mensagem TEXT NOT NULL
);
