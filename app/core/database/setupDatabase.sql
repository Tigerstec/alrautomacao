CREATE DATABASE IF NOT EXISTS `alrbd`;
USE `alrbd`;

CREATE TABLE contact_submissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    company VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    location VARCHAR(255) NOT NULL,
    service VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    submission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)

-- Tabela de Usuários para o Login
CREATE TABLE `usuarios` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `usuario` VARCHAR(50) NOT NULL UNIQUE,
  `senha` VARCHAR(255) NOT NULL,
  `nome` VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Inserir um usuário padrão (admin / 123456)
-- A senha '123456' é criptografada com password_hash do PHP
INSERT INTO `usuarios` (`usuario`, `senha`, `nome`) VALUES
('admin', '$2y$10$3zR1b.FrzZJ6bV8./jM8IuSti6A8kRveMC0DS2bYkH3bL2p.plU1S', 'Admin');

-- Tabela de Serviços
CREATE TABLE `servicos` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nome` VARCHAR(255) NOT NULL,
  `categoria` VARCHAR(100) NOT NULL,
  `preco` DECIMAL(10, 2) NOT NULL,
  `duracao` INT NOT NULL, -- em minutos
  `descricao` TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabela de Orçamentos
CREATE TABLE `orcamentos` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `cliente` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `telefone` VARCHAR(20) NOT NULL,
  `valor` DECIMAL(10, 2) NOT NULL,
  `descricao` TEXT,
  `status` VARCHAR(50) NOT NULL DEFAULT 'Pendente',
  `data_criacao` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabela de Agendamentos
CREATE TABLE `agendamentos` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `cliente` VARCHAR(255) NOT NULL,
  `telefone` VARCHAR(20) NOT NULL,
  `servico_id` INT NOT NULL,
  `data_agendamento` DATE NOT NULL,
  `hora_agendamento` TIME NOT NULL,
  `status` VARCHAR(50) NOT NULL DEFAULT 'Agendado',
  `observacoes` TEXT,
  FOREIGN KEY (`servico_id`) REFERENCES `servicos`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;