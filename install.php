<?php
require_once 'config.php';

// Script per creare le tabelle del database

// Tabella utenti
$pdo->exec("CREATE TABLE IF NOT EXISTS utenti (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nome VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

// Tabella articoli
$pdo->exec("CREATE TABLE IF NOT EXISTS articoli (
    id INT AUTO_INCREMENT PRIMARY KEY,
    data_creazione TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    descrizione TEXT,
    costo_lavorazione DECIMAL(10,2) DEFAULT 0,
    incassatura DECIMAL(10,2) DEFAULT 0,
    incisione DECIMAL(10,2) DEFAULT 0,
    rodiatura_1 DECIMAL(10,2) DEFAULT 0,
    rodiatura_2 DECIMAL(10,2) DEFAULT 0,
    brillanti_1 DECIMAL(10,2) DEFAULT 0,
    brillanti_2 DECIMAL(10,2) DEFAULT 0,
    brillanti_3 DECIMAL(10,2) DEFAULT 0,
    brillanti_4 DECIMAL(10,2) DEFAULT 0,
    brillanti_5 DECIMAL(10,2) DEFAULT 0,
    grammi_oro DECIMAL(10,2) DEFAULT 0,
    costo_lavorazione_finale DECIMAL(10,2) DEFAULT 0,
    incassatura_finale DECIMAL(10,2) DEFAULT 0,
    incisione_finale DECIMAL(10,2) DEFAULT 0,
    rodiatura_1_finale DECIMAL(10,2) DEFAULT 0,
    rodiatura_2_finale DECIMAL(10,2) DEFAULT 0,
    brillanti_1_finale DECIMAL(10,2) DEFAULT 0,
    brillanti_2_finale DECIMAL(10,2) DEFAULT 0,
    brillanti_3_finale DECIMAL(10,2) DEFAULT 0,
    brillanti_4_finale DECIMAL(10,2) DEFAULT 0,
    brillanti_5_finale DECIMAL(10,2) DEFAULT 0,
    grammi_oro_finale DECIMAL(10,2) DEFAULT 0,
    stato ENUM('magazzino', 'venduto') DEFAULT 'magazzino'
)");

// Tabella impostazioni
$pdo->exec("CREATE TABLE IF NOT EXISTS settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL UNIQUE,
    valore TEXT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)");

// Inserire impostazione prezzo oro predefinito se non esiste
$stmt = $pdo->prepare("SELECT COUNT(*) FROM settings WHERE nome = 'prezzo_oro'");
$stmt->execute();
if ($stmt->fetchColumn() == 0) {
    $stmt = $pdo->prepare("INSERT INTO settings (nome, valore) VALUES ('prezzo_oro', '50')");
    $stmt->execute();
}

// Creare un utente admin predefinito se non ne esistono
$stmt = $pdo->prepare("SELECT COUNT(*) FROM utenti");
$stmt->execute();
if ($stmt->fetchColumn() == 0) {
    $password_hash = password_hash('admin', PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO utenti (email, password, nome) VALUES ('admin@example.com', :password, 'Amministratore')");
    $stmt->bindParam(':password', $password_hash);
    $stmt->execute();
    echo "Utente admin creato. Email: admin@example.com, Password: admin";
}

echo "Database e tabelle create con successo!";
?>
