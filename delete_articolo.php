<?php
require_once 'config.php';

// Verifica se l'utente è loggato
redirectIfNotLoggedIn();

// Verifica se è stato specificato un ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: articoli.php');
    exit;
}

$id = (int)$_GET['id'];

try {
    // Verifica se l'articolo esiste
    $stmt = $pdo->prepare("SELECT id FROM articoli WHERE id = :id");
    $stmt->execute(['id' => $id]);
    
    if ($stmt->rowCount() == 0) {
        // Articolo non trovato
        header('Location: articoli.php?message=' . urlencode('Articolo non trovato.'));
        exit;
    }
    
    // Elimina l'articolo
    $stmt = $pdo->prepare("DELETE FROM articoli WHERE id = :id");
    $stmt->execute(['id' => $id]);
    
    // Redirect con messaggio di successo
    header('Location: articoli.php?message=' . urlencode('Articolo eliminato con successo.'));
    exit;
} catch (PDOException $e) {
    // Errore durante l'eliminazione
    header('Location: articoli.php?error=' . urlencode('Errore durante l\'eliminazione: ' . $e->getMessage()));
    exit;
}
?>
